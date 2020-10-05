<?php

class Question {
    public $q;
    public $a1;
    public $a2;
    public $v1;
    public $v2;
    
    function __construct($q, $a1, $a2, $v1, $v2) {
      $this->q = get_string($q, 'block_polyteamgenerator');
      $this->a1 = get_string($a1, 'block_polyteamgenerator');
      $this->a2 = get_string($a2, 'block_polyteamgenerator');
      $this->v1 = $v1;
      $this->v2 = $v2;
    }
  }
  
class Section {
    public $title;
    public $questions;
    
    function __construct($t, $q) {
        $this->title = get_string($t, 'block_polyteamgenerator');
        $this->questions = $q;
    }
}

class Questionnaire {
    public $sections;

    function __construct() {
        $s1q1 = new Question("youaremore", "Sociable", "Reserved", "e", "i");
        $s1q2 = new Question("youaremore", "Expressive", "Contained", "e", "i");
        $s1q3 = new Question("youprefer", "Groups", "Individuals", "e", "i");
        $s1q4 = new Question("youlearnbetterby", "Listening", "Reading", "e", "i");
        $s1q5 = new Question("youaremore", "Talkative", "Quiet", "e", "i");

        $s1q = array($s1q1, $s1q2, $s1q3, $s1q4, $s1q5);
        $s1 = new Section("Energy-Direction", $s1q);

        $s2q1 = new Question("youaremore", "Systematic", "Casual", "j", "p");
        $s2q2 = new Question("youpreferactivities", "Planned", "Open-ended", "j", "p");
        $s2q3 = new Question("youworkbetter", "With-pressure", "Without-pressure", "j", "p");
        $s2q4 = new Question("youprefer", "Routine", "Variety", "j", "p");
        $s2q5 = new Question("youaremore", "Methodical", "Improvisational", "j", "p");

        $s2q = array($s2q1, $s2q2, $s2q3, $s2q4, $s2q5);
        $s2 = new Section("Orientation", $s2q);

        $s3q1 = new Question("youpreferthe", "Concrete", "Abstract", "s", "n");
        $s3q2 = new Question("youprefer", "Fact-finding", "Speculating", "s", "n");
        $s3q3 = new Question("youaremore", "Practical", "Conceptual", "s", "n");
        $s3q4 = new Question("youaremore", "Hands-on", "Theoretical", "s", "n");
        $s3q5 = new Question("youpreferthe", "Traditional", "Novel", "s", "n");

        $s3q = array($s3q1, $s3q2, $s3q3, $s3q4, $s3q5);
        $s3 = new Section("Information-Collection-Process", $s3q);

        $s4q1 = new Question("youprefer", "Logic", "Empathy", "t", "f");
        $s4q2 = new Question("youaremore", "Truthful", "Tactful", "t", "f");
        $s4q3 = new Question("youseeyourselfasmore", "Questioning", "Accommodating", "t", "f");
        $s4q4 = new Question("youaremore", "Skeptical", "Tolerant", "t", "f");
        $s4q5 = new Question("youthinkjudgesshouldbe", "Impartial", "Merciful", "t", "f");

        $s4q = array($s4q1, $s4q2, $s4q3, $s4q4, $s4q5);
        $s4 = new Section("Decision-Making-Process", $s4q);

        $this->sections = array($s1, $s2, $s3, $s4);
    }
}