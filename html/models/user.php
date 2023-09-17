<?php
    class User {
        private $user_id;
        private $username;
        private $password;

        function __construct($user_id, $username, $password) {
            $this->user_id = $user_id;
            $this->username = $username;
            $this->password = $password;
        }

        public function get_user_id() {
            return $this->user_id;
        }

        public function get_username() {
            return $this->username;
        }

        public function get_password() {
            return $this->password;
        }

        public function set_user_id($user_id) {
            $this->user_id = $user_id;
        }

        public function set_username($username) {
            $this->username = $username;
        }

        public function set_password($password) {
            $this->password = $password;
        }
    } 
?>
