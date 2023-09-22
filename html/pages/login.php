<div class="container width-30">
    <div class="row">
        <h1>Login</h1>
    </div>
    <form method="POST">
        <div class="row">
            <label>Username:</label>
            <input type="text" name="username" placeholder="Username" required>
        </div>
        <div class="row">
            <label>Password:</label>
            <input type="password" name="password" placeholder="Password" required>
        </div>
        <div class="row">
            <button type="submit" name="login">Login</button>
        </div>
    </form>
</div>
<?php
    // if 'login' button was pressed, retrieve corresponding user from the database
    if (isset($_POST["login"])) {
        // if the credentials are valid, set session cookie and redirect to homepage
        if($user = $query_handler->insecure_get_user_by_username_and_password($_POST["username"], $_POST["password"])) {
            $_SESSION["user_id"] = $user->get_user_id();
            // also save the username to display it in the navbar without db request
            $_SESSION["username"] = $user->get_username();

            header("Location: ?page=home.php");

        // if the credentials are invalid, display error message
        } else {
            ugly_alert("Invalid Credentials!");
        }
    }
?>
