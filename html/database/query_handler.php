<?php
    class Query_Handler {
        private $db;
        
        function __construct($db) {
            $this->db = $db;
        }

        public function insecure_get_user_by_username_and_password($username, $password) {
            $results = $this->db->query("SELECT * FROM users WHERE username = '" . $username . "' AND password = '" . $password . "'");

            if($results == true && $result = $results->fetch_object()) {
                $user_id = $result->user_id;
                $username = $result->username;
                $password = $result->password;
            
                return new User($user_id, $username, $password);
            }

            return false;
        }

        public function secure_get_user_by_username_and_password($username, $password) {
            $query = $this->db->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
            $query->bind_param("ss", $username, $password);
            $query->execute();
            $results = $query->get_result();

            if($results == true && $result = $results->fetch_object()) {
                $user_id = $result->user_id;
                $username = $result->username;
                $password = $result->password;
            
                return new User($user_id, $username, $password);
            }

            return false;
        }

        public function get_user_by_id($user_id) {
            $query = $this->db->prepare("SELECT * FROM users WHERE user_id = ?");
            $query->bind_param("i", $user_id);
            $query->execute();
            $results = $query->get_result();

            if($results == true && $result = $results->fetch_object()) {
                $user_id = $result->user_id;
                $username = $result->username;
                $password = $result->password;
            
                return new User($user_id, $username, $password);
            }

            return false;
        }

        public function create_blogpost($user_id, $date_time, $heading, $blogpost) {
            $zero = 0; // fix cannot pass parameter by reference error.. because php is beeing stupid once again
            $query = $this->db->prepare("INSERT INTO blogposts VALUES (?, ?, ?, ?, ?)");
            $query->bind_param("iisss", $zero, $user_id, $date_time, $heading, $blogpost);
            $query->execute();

            // apparently there is no option to return the object that was inserted into the db
            // just return $query which results in true/false depending on the query beeing successful
            return $query;
        }

        public function get_blogposts() {
            $query = $this->db->prepare("SELECT * FROM blogposts ORDER BY date_time DESC");
            $query->execute();
            $results = $query->get_result();

            if($results == true) {
                $result_array = array();

                while($result = $results->fetch_object()) {
                    $blogpost_id = $result->blogpost_id;
                    $user_id = $result->user_id;
                    $date_time = $result->date_time;
                    $heading = $result->heading;
                    $blogpost = $result->blogpost;
    
                    array_push($result_array, new Blogpost($blogpost_id, $user_id, $date_time, $heading, $blogpost));
                }
    
                return $result_array;
            }

            return false;
        }
    }
?>
