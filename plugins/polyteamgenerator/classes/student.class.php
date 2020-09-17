<?php

class Student {
    public $username;
    public $firstname;
    public $lastname;
    public $email;
    public $profile_field_polyteam;
    
    function __construct($moodle_student) {
      $this->username = $moodle_student->username;
      $this->firstname = $moodle_student->firstname;
      $this->lastname = $moodle_student->lastname;
      $this->email = $moodle_student->email;
      $this->profile_field_polyteam = $moodle_student->profile_field_polyteam;
    }
}