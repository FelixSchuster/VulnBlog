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
                $profile_picture = $result->profile_picture;
            
                return new User($user_id, $username, $password, $profile_picture);
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
                $profile_picture = $result->profile_picture;
            
                return new User($user_id, $username, $password, $profile_picture);
            }

            return false;
        }

        public function get_user_by_user_id($user_id) {
            $query = $this->db->prepare("SELECT * FROM users WHERE user_id = ?");
            $query->bind_param("i", $user_id);
            $query->execute();
            $results = $query->get_result();

            if($results == true && $result = $results->fetch_object()) {
                $user_id = $result->user_id;
                $username = $result->username;
                $password = $result->password;
                $profile_picture = $result->profile_picture;
            
                return new User($user_id, $username, $password, $profile_picture);
            }

            return false;
        }

        public function create_blogpost($user_id, $date_time, $heading, $blogpost,  $blog_image) {
            $zero = 0; // fix cannot pass parameter by reference error.. because php is beeing stupid once again
            $query = $this->db->prepare("INSERT INTO blogposts VALUES (?, ?, ?, ?, ?, ?)");
            $query->bind_param("iissss", $zero, $user_id, $date_time, $heading, $blogpost, $blog_image);
            $query->execute();

            // apparently there is no option to return the object that was inserted into the db
            // just return $query which results in true/false depending on the query beeing successful
            return $query;
        }

        public function create_blogpost_with_image($user_id, $date_time, $heading, $blogpost, $blog_image) {
            $zero = 0; // fix cannot pass parameter by reference error.. because php is beeing stupid once again
            $query = $this->db->prepare("INSERT INTO blogposts VALUES (?, ?, ?, ?, ?, ?)");
            $query->bind_param("iissss", $zero, $user_id, $date_time, $heading, $blogpost, $blog_image);
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
                    $blog_image = $result->blog_image;
    
                    array_push($result_array, new Blogpost($blogpost_id, $user_id, $date_time, $heading, $blogpost, $blog_image));
                }
    
                return $result_array;
            }

            return false;
        }

        public function get_blogposts_by_user_id($user_id) {
            $query = $this->db->prepare("SELECT * FROM blogposts WHERE user_id = ? ORDER BY date_time DESC");
            $query->bind_param("i", $user_id);
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
                    $blog_image = $result->blog_image;
    
                    array_push($result_array, new Blogpost($blogpost_id, $user_id, $date_time, $heading, $blogpost, $blog_image));
                }
    
                return $result_array;
            }

            return false;
        }

        public function get_blogpost_by_blogpost_id($blogpost_id) {
            $query = $this->db->prepare("SELECT * FROM blogposts WHERE blogpost_id = ? ORDER BY date_time DESC");
            $query->bind_param("i", $blogpost_id);
            $query->execute();
            $results = $query->get_result();

            if($results == true) {
                if($result = $results->fetch_object()) {
                    $blogpost_id = $result->blogpost_id;
                    $user_id = $result->user_id;
                    $date_time = $result->date_time;
                    $heading = $result->heading;
                    $blogpost = $result->blogpost;
                    $blog_image = $result->blog_image;
    
                    return new Blogpost($blogpost_id, $user_id, $date_time, $heading, $blogpost, $blog_image);
                }
            }

            return false;
        }

        public function update_blogpost_by_blogpost_id($blogpost_id, $user_id, $date_time, $heading, $blogpost) {
            $query = $this->db->prepare("UPDATE blogposts SET user_id = ?, date_time = ?, heading = ?, blogpost = ? WHERE blogpost_id = ?");
            $query->bind_param("isssi", $user_id, $date_time, $heading, $blogpost, $blogpost_id);
            $query->execute();
    
            // apparently there is no option to return the object that was updated
            // just return $query which results in true/false depending on the query beeing successful
            return $query;
        }
    }
?>
