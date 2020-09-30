<?php

class PolyteamProfileField {
    public $name;
    public $hidden;
    public $editable;
    public $type;
    public $default;
    public $stringify;

    function __construct($name, $hidden, $editable, $type, $default, Closure $stringify) {
        $this->name = $name;
        $this->hidden = $hidden;
        $this->editable = $editable;
        $this->type = $type; // ie. PARAM_TEXT
        $this->default = $default;
        $this->stringify = $stringify;
    }
}

class PolyteamStringifier {
    public static function text() {  
        return function($v) { return $v; };
    }

    public static function object() {  
        return function($obj) {
            $str = "";
            foreach ($obj as $key => $value) $str .= $key . " " . $value . " ";
            return $str;
        };
    }

    public static function array() {
        return function($arr) {
            $str = "";
            foreach ($arr as $value) $str .= $value . " ";
            return $str;
        };
    }
}

class PolyteamProfile {
    public $fields;

    function __construct() {
        $personality = new PolyteamProfileField("personality", false, false, null, null, PolyteamStringifier::object());
        $this->fields = array($personality);
    }
}
