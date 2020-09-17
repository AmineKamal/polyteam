<?php

class Question {
    public $q;
    public $a1;
    public $a2;
    public $v1;
    public $v2;
    
    function __construct($q, $a1, $a2, $v1, $v2) {
      $this->q = $q;
      $this->a1 = $a1;
      $this->a2 = $a2;
      $this->v1 = $v1;
      $this->v2 = $v2;
    }
  }
  
class Section {
    public $title;
    public $questions;
    
    function __construct($t, $q) {
        $this->title = $t;
        $this->questions = $q;
    }
}

class Questionnaire {
    public $sections;

    function __construct() {
        $s1q1 = new Question("You are more :", "Sociable", "Reserved", "e", "i");
        $s1q2 = new Question("You are more :", "Expressive", "Contained", "e", "i");
        $s1q3 = new Question("You prefer :", "Groups", "Individuals", "e", "i");
        $s1q4 = new Question("You learn better by :", "Listening", "Reading", "e", "i");
        $s1q5 = new Question("You are more :", "Talkative", "Quiet", "e", "i");

        $s1q = array($s1q1, $s1q2, $s1q3, $s1q4, $s1q5);
        $s1 = new Section("Energy Direction", $s1q);

        $s2q1 = new Question("You are more :", "Systematic", "Casual", "j", "p");
        $s2q2 = new Question("You prefer activities :", "Planned", "Open-ended", "j", "p");
        $s2q3 = new Question("You work better :", "With pressure", "Without pressure", "j", "p");
        $s2q4 = new Question("You prefer :", "Routine", "Variety", "j", "p");
        $s2q5 = new Question("You are more :", "Methodical", "Improvisational", "j", "p");

        $s2q = array($s2q1, $s2q2, $s2q3, $s2q4, $s2q5);
        $s2 = new Section("Orientation", $s2q);

        $s3q1 = new Question("You prefer the :", "Concrete", "Abstract", "s", "n");
        $s3q2 = new Question("You prefer :", "Fact-finding", "Speculating", "s", "n");
        $s3q3 = new Question("You are more :", "Practical", "Conceptual", "s", "n");
        $s3q4 = new Question("You are more :", "Hands-on", "Theoretical", "s", "n");
        $s3q5 = new Question("You prefer the :", "Traditional", "Novel", "s", "n");

        $s3q = array($s3q1, $s3q2, $s3q3, $s3q4, $s3q5);
        $s3 = new Section("Information Collection Process", $s3q);

        $s4q1 = new Question("You prefer :", "Logic", "Empathy", "t", "f");
        $s4q2 = new Question("You are more :", "Truthful", "Tactful", "t", "f");
        $s4q3 = new Question("You see yourself as more :", "Questioning", "Accommodating", "t", "f");
        $s4q4 = new Question("You are more :", "Skeptical", "Tolerant", "t", "f");
        $s4q5 = new Question("You think judges should be :", "Impartial", "Merciful", "t", "f");

        $s4q = array($s4q1, $s4q2, $s4q3, $s4q4, $s4q5);
        $s4 = new Section("Decision Making Process", $s4q);

        $this->sections = array($s1, $s2, $s3, $s4);

        return $this->sections;
    }
}