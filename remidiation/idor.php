<?php
    $pages = [
        "login" => "pages/login.php",
        "home" => "pages/home.php",
        "error404" => "pages/error404.php",
        "..." => "pages/....php"
    ];

    // if not logged in, redirect to login page
    if (!isset($_SESSION["user_id"])) {
        $page = $pages["login"];

    // if logged in and a page is requested
    } else if (isset($_GET["page"])) {

        // if requested page exists in pages list, include requested file
        if($pages[$_GET["page"]]) {
            $page = $pages[$_GET["page"]];
        }

        // else include error404 file
        else {
            $page = $pages["error404"];
        }    

    // if logged in and no page is set, include home page
    } else {
        $page = $pages["home"];
    }

    include($page);
?>

