
<?php
    class User {
        public $username;
        public $library;
        private $password;

        function __construct() { }

        function set_username($name) {
           $this->username = $name;
        }
        function set_password($pass) {
            $this->password = $pass;
        }

        function get_username() {
            return $this->username;
        }
        protected function get_password() {
            return $this->password;
        }

        function auth_password($authpass) {
            if($this->password === $authpass) {
                return 1;
            }
            else {
                return 0;
            }
        }

        function get_library() {
            return $this->library;
        }
        function set_library($lib) {
            $this->library = $lib; 
        }
    }
