<?php

require_once($CFG->dirroot.'/user/profile/lib.php');
require_once("lib/questionnaire.class.php");
require_once("lib/student.class.php");
require_once("lib/lib.php");

class block_polyteamgenerator extends block_base {

    public function init() {
        $this->title = get_string('polyteamgenerator', 'block_polyteamgenerator');
    }

    public function get_content() {
        global $COURSE, $USER, $CFG;
        
        if ($this->content !== null) {
          return $this->content;
        }

        $context = context_course::instance($COURSE->id);
        $roles = array_values(get_user_roles($context, $USER->id, true));

        if (empty($roles)) {
            return null;
        }

        $is_teacher = false;
        $teacher_roles = array("1", "3", "4");

        foreach ($roles as $role){
            if (in_array($role->roleid, $teacher_roles)) {
                $is_teacher = true;
                break;
            }
        }

        if (!$is_teacher) {
            $this->content = new stdClass;
            $this->content->text = $this->get_student_content();
     
            return $this->content;
        }

        $groupings = array_values(groups_get_all_groupings($COURSE->id));
        $groups = array_values(groups_get_all_groups($COURSE->id));

        $get_section_name = function ($grouping) {
            $regex = "/^[A-Z]{3}[0-9]{4}([A-Z]{1})?_[0-9]{2}[LC]$/"; // Default
            if (isset($CFG->block_polyteamgenerator_section_regex)) {
                $regex = $CFG->block_polyteamgenerator_section_regex;
            }

            return preg_match($regex, $grouping->name) ? $grouping->name : null; 
        };

        $get_grouping_members = function($grouping) {
            $grouping_members = new stdClass();
            $grouping_members->id = $grouping->id;
            $grouping_members->grouping = $grouping;

            $students = groups_get_grouping_members($grouping->id);

            $members = array();
            foreach($students as $student) {
                profile_load_data($student);
                array_push($members, new Student($student));
            }

            $grouping_members->members = $members;

            return $grouping_members;
        };

        $get_group_name = function($group) { return $group->name; };

        $sections = array_filter(array_map($get_section_name, $groupings));
        $groupings = json_encode(array_map($get_grouping_members, $groupings));
        $groupnames = json_encode(array_map($get_group_name, $groups));

        $this->content = new stdClass;
        $this->content->text = $this->get_professor_content($groupings, $sections, $groupnames);
     
        return $this->content;
    }

    private function get_professor_content($groupings, $sections, $groupnames) {
        global $CFG;

        $url = "https://polyteam-backend-staging.herokuapp.com/teams"; // Default
        if (isset($CFG->block_polyteamgenerator_url)) {
            $url = $CFG->block_polyteamgenerator_url;
        }

        // Extra Scope Variables accessible in template
        $questions = $this->get_questions();
        $jsQuestions = json_encode($questions);
        $codes = json_encode(get_error_codes());
        
        ob_start();
        include('templates/block_generator.php');
        $template_html = ob_get_contents();
        ob_end_clean();

        return $template_html;
    }

    private function get_student_content() {
        // Extra Scope Variables accessible in template
        $questions = $this->get_questions();
        $jsQuestions = json_encode($questions);
        $codes = json_encode(get_error_codes());

        ob_start();
        include('templates/block_questionnaire.php');
        $template_html = ob_get_contents();
        ob_end_clean();

        return $template_html;
    }

    private function get_questions() {
       $questionnaire = new Questionnaire();
       return $questionnaire->sections;
    }
}