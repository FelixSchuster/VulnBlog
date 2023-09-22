<div class="container">
    <div class="row">
        <h1>Previously created Blogposts</h1>
    </div>
    <div class="row">
        <?php
            $blogposts = $query_handler->get_blogposts_by_user_id($_SESSION["user_id"]);

            if(!empty($blogposts)) {
                echo "<table>";
                    echo "<tr>";
                        echo "<th>Date/Time</th>";
                        echo "<th>Heading</th>";
                        echo "<th>Blogpost</th>";
                        echo "<th>Edit</th>";
                    echo "</tr>";

                foreach($blogposts as $blogpost) {
                    $blogpost_id = $blogpost->get_blogpost_id();
                    $date_time = $blogpost->get_date_time();
                    $heading = $blogpost->get_heading();
                    $blogpost_text = $blogpost->get_blogpost();

                    echo "<tr>";
                        echo "<td class=\"width-15\">" . $date_time . "</td>";
                        echo "<td class=\"width-15\">" . $heading . "</td>";
                        echo "<td class=\"text-overflow\">" . $blogpost_text . "</td>";               
                        echo "<td class=\"width-10\">";
                            echo "<a href=\"?page=edit_blogpost.php&id=" . $blogpost_id . "\">";
                                echo "<button type=\"submit\ name=\"edit_blogpost\">Edit</button>";
                            echo "</a>";
                        echo "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            }
        ?>
    </div>
</div>
