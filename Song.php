<?php
    class Song {
        public $name;
        public $annotation;

        function __construct() { }

        function set_name($name) {
            $this->name = $name;
        }
        function get_name() {
            return $this->name;
        }

        function set_annotation($annotation) {
            $this->annotation = $annotation;
        }
        function get_annotation() {
            return $this->annotation;
        }
    }

?>