<div class="container">
    <div class="row">
        <h1>Home</h1>
    </div>
    <?php
        $blogposts = $query_handler->get_blogposts();

        if(!empty($blogposts)) {
            foreach($blogposts as $blogpost) {
                $user = $query_handler->get_user_by_id($blogpost->get_user_id());
                $username = $user->get_username();
                $date_time = $blogpost->get_date_time();
                $heading = $blogpost->get_heading();
                $blogpost_text = $blogpost->get_blogpost();

                // might change this to proper dom manipulation later on but it kinda works for now
                echo "<div class=\"row\">";
                    echo "<div class=\"width-20\">";
                        echo "<p>" . $date_time . "</p><br>";
                        echo "<p>User: " . $username . "</p>";
                    echo "</div>";
                    echo "<div>";
                        echo "<h2>" . $heading . "</h2>";
                        echo "<p>" . $blogpost_text . "</p>";
                    echo "</div>";
                echo "</div>";
            }
        }
    ?>
</div>
