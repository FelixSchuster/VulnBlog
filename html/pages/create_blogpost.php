<div class="container">
    <div class="row">
        <h1>Create Blogpost</h1>
    </div>
    <form method="POST" enctype="multipart/form-data">
        <div class="row">
            <label>Heading:</label>
            <input name="heading" placeholder="Heading" required>
        </div>
        <div class="row">
            <label>Blogpost:</label>
            <textarea type="textbox" name="blogpost" placeholder="Blogpost" required></textarea>
        </div>
        <div class="row">
            <label>Upload Image:</label>
            <input type="file" name="image"/>
        </div>
        <div class="row">
            <button type="submit" name="create_blogpost">Create Blogpost</button>
        </div>
    </form>
</form>

</div>
<?php
    if(isset($_POST["create_blogpost"]) && isset($_POST["heading"]) && isset($_POST["blogpost"]) && $_FILES['image']['size'] > 0)
    {
        if(isset($_FILES['image'])) {
            $errors= array();
            $file_name = $_FILES['image']['name'];
            $file_size =$_FILES['image']['size'];
            $file_tmp =$_FILES['image']['tmp_name'];
            $file_type=$_FILES['image']['type'];

            if($file_size > 2097152) {
                $errors[]='File size > 2 MB';
            }
            
            if (file_exists("uploads/" . $file_name)) {
                $errors[]='File already exists';
            }

            if(empty($errors)==true) {
                move_uploaded_file($file_tmp,"uploads/".$file_name);

                if($query_handler->create_blogpost($_SESSION["user_id"], date("Y-m-d H:i:s"), $_POST["heading"], $_POST["blogpost"], $file_name)) {
                    ugly_alert("Success!");

                } else {
                    ugly_alert("Failure!");
                }

            } else {
                $errorMessage = '';

                foreach ($errors as $error) {
                    $errorMessage = $errorMessage . ' ' . $error;
                }

                ugly_alert($errorMessage);
            }
        }
    }
    else if (isset($_POST["create_blogpost"]) && isset($_POST["heading"]) && isset($_POST["blogpost"])) {
        if($query_handler->create_blogpost($_SESSION["user_id"], date("Y-m-d H:i:s"), $_POST["heading"], $_POST["blogpost"], NULL)) {
            ugly_alert("Success!");

        } else {
            ugly_alert("Failure!");
        }
    }
?>
