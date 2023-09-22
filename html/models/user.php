<?php
    class User {
        private $user_id;
        private $username;
        private $password;
        private $profile_picture;

        function __construct($user_id, $username, $password, $profile_picture) {
            $this->user_id = $user_id;
            $this->username = $username;
            $this->password = $password;
            $this->profile_picture = $profile_picture;
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

        public function get_profile_picture() {
            return $this->profile_picture;
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

        public function set_profile_picture($profile_picture) {
            $this->profile_picture = $profile_picture;
        }
    } 
?>
