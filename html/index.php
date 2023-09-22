<?php
    session_start();

    include_once "./database/db_access.php";

    include_once "./models/blogpost.php";
    include_once "./models/comment.php";
    include_once "./models/user.php";
    
    // display errors for debug purposes, disable this for the final upload
    error_reporting(E_ALL);
    ini_set('display_errors', 'On');

    function ugly_alert($msg) {
        echo "<script>alert('$msg');</script>";
    }
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="./css/style.css">
    <title>VulnBlog</title>
    <?php
        if (isset($_SESSION["user_id"])) {
            include "./res/navbar.php";
        }
    ?>
</head>
<body>
    <?php
        // if not logged in, redirect to login page
        if (!isset($_SESSION["user_id"])) {
            $page = "login.php";

        // if logged just include the requested page
        } else if (isset($_GET["page"])) {
            $page = $_GET["page"];

        // if logged in and no page is set, include home.php
        } else {
            $page = "home.php";
        }
        $page = "./pages/" . $page;

        include($page);
    ?>
</body>
</html>
