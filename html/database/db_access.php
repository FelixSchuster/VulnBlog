<?php
    include_once "./database/query_handler.php";

    $db_host = "127.0.0.1";
    $db_user = "vulnuser";
    $db_pass = "P@ssword";
    $db_name = "vulnblog";
    
    $db = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    
    if ($db->connect_error) {
        echo "Error connecting to database: ".$db_obj->connect_error;
        exit();
    }

    $query_handler = new Query_Handler($db);
?>
