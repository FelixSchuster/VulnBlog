<?php
    if($blogpost = $query_handler->get_blogpost_by_blogpost_id($_GET["id"])) {
        if(isset($_POST["heading"])) {
            $heading = $_POST["heading"];
        } else {
            $heading = $blogpost->get_heading();
        }
        if(isset($_POST["blogpost"])) {
            $blogpost_text = $_POST["blogpost"];
        } else {
            $blogpost_text = $blogpost->get_blogpost();
        }

    } else {
        ugly_alert("Blogpost not found!");
    }
?>

<div class="container">
    <div class="row">
        <h1>Edit Blogpost</h1>
    </div>
    <form method="POST">
        <div class="row">
            <label>Heading:</label>
            <input name="heading" placeholder="Heading" value="<?php echo $heading ?>" required>
        </div>
        <div class="row">
            <label>Blogpost:</label>
            <textarea type="textbox" name="blogpost" placeholder="Blogpost" required><?php echo $blogpost_text ?></textarea>
        </div>
        <div class="row">
            <button type="submit" name="edit_blogpost">Save Changes</button>
        </div>
    </form>
</div>
<?php
    if(isset($_POST["edit_blogpost"]) && isset($_POST["heading"]) && isset($_POST["blogpost"])) {
        if($query_handler->update_blogpost_by_blogpost_id($_GET["id"], $_SESSION["user_id"], date("Y-m-d H:i:s"), $_POST["heading"], $_POST["blogpost"])) {
            ugly_alert("Success!");
        } else {
            ugly_alert("Failure!");
        }
    }
?>
