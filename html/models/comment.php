<?php
    class Comment {
        private $comment_id;
        private $user_id;
        private $blogpost_id;
        private $date_time;
        private $comment;

        function __construct($comment_id, $user_id, $blogpost_id, $date_time, $comment) {
            $this->comment_id = $comment_id;
            $this->user_id = $user_id;
            $this->blogpost_id = $blogpost_id;
            $this->date_time = $date_time;
            $this->comment = $comment;
        }

        public function get_comment_id() {
            return $this->comment_id;
        }

        public function get_user_id() {
            return $this->user_id;
        }

        public function get_blogpost_id() {
            return $this->blogpost_id;
        }

        public function get_date_time() {
            return $this->date_time;
        }

        public function get_comment() {
            return $this->comment;
        }

        public function set_comment_id($comment_id) {
            $this->comment_id = $comment_id;
        }

        public function set_user_id($user_id) {
            $this->user_id = $user_id;
        }

        public function set_blogpost_id($blogpost_id) {
            $this->blogpost_id = $blogpost_id;
        }

        public function set_date_time($date_time) {
            $this->date_time = $date_time;
        }

        public function set_comment($comment) {
            $this->comment = $comment;
        }
    } 
?>
