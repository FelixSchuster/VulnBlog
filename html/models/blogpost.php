<?php
    class Blogpost {
        private $blogpost_id;
        private $user_id;
        private $date_time;
        private $heading;
        private $blogpost;

        function __construct($blogpost_id, $user_id, $date_time, $heading, $blogpost) {
            $this->blogpost_id = $blogpost_id;
            $this->user_id = $user_id;
            $this->date_time = $date_time;
            $this->heading = $heading;
            $this->blogpost = $blogpost;
        }

        public function get_blogpost_id() {
            return $this->blogpost_id;
        }

        public function get_user_id() {
            return $this->user_id;
        }

        public function get_date_time() {
            return $this->date_time;
        }

        public function get_heading() {
            return $this->heading;
        }

        public function get_blogpost() {
            return $this->blogpost;
        }

        public function set_blogpost_id($blogpost_id) {
            $this->blogpost_id = $blogpost_id;
        }

        public function set_user_id($user_id) {
            $this->user_id = $user_id;
        }

        public function set_date_time($date_time) {
            $this->date_time = $date_time;
        }

        public function set_heading($heading) {
            $this->heading = $heading;
        }

        public function set_blogpost($blogpost) {
            $this->blogpost = $blogpost;
        }
    } 
?>
