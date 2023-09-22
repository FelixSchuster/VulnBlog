<div class="container">
    <div class="row">
        <h1>Create Blogpost</h1>
    </div>
    <form method="POST">
        <div class="row">
            <label>Heading:</label>
            <input name="heading" placeholder="Heading" required>
        </div>
        <div class="row">
            <label>Blogpost:</label>
            <textarea type="textbox" name="blogpost" placeholder="Blogpost" required></textarea>
        </div>
        <div class="row">
            <button type="submit" name="create_blogpost">Create Blogpost</button>
        </div>
    </form>
</div>
<?php
    if (isset($_POST["create_blogpost"]) && isset($_POST["heading"]) && isset($_POST["blogpost"])) {
        if($query_handler->create_blogpost($_SESSION["user_id"], date("Y-m-d H:i:s"), $_POST["heading"], $_POST["blogpost"])) {
            ugly_alert("Success!");

        } else {
            ugly_alert("Failure!");
        }
    }
?>
