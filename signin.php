<?php
    require_once("connect.php");
    if (isset($_POST["username"])) {
        $username = mysql_real_escape_string($_POST["username"]);
        $password = mysql_real_escape_string($_POST["password"]);
        $query = mysqli_query($connect, "SELECT * FROM `users` WHERE `username` = '" . $username . "';");
        $rows = mysqli_num_rows($query);
        if ($rows = 1) {
            $user = mysqli_fetch_assoc($query);
            if (password_verify($password, $user["password"])) {
                session_start();
                $_SESSION["username"] = $user["username"];
                $query = mysqli_query($connect, "UPDATE * `users` SET `ip` = '" . $_SERVER['REMOTE_ADDR'] . "' WHERE `username` = '" . $user["username"] . "';");
                header("Location: index.php");
                exit();
            }
        } else {
            header("Location: signin.php");
            exit();
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>PHP Login System</title>
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    </head>
    <body>
        <h1></h1>
        <div class="container" style="max-width:768px;">
            <div class="panel panel-primary">
                <div class="panel-heading" style="text-align:center;">
                    <h1>PHP Login System</h1>
                </div>
                <div class="panel-body">
                    <form method="post" action="signin.php">
                        <p>
                            <input name="username" type="text" placeholder="Username" class="form-control">
                        </p>
                        <input name="password" type="password" placeholder="Password" class="form-control">
                </div>
                <div class="panel-footer">
                    <button type="submit" class="btn btn-success btn-block">Sign In</button>
                    </form>
                </div>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </body>
</html>
