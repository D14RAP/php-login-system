<?php
    session_start();
    if (!isset($_SESSION["username"])) {
        header("Location: signin.php");
        exit();
    }
    require_once("connect.php");
    $query = mysqli_query($connect, "SELECT * FROM `users` WHERE `username` = '" . $_SESSION["username"] . "';");
    $user = mysqli_fetch_assoc($query);
    $username = $user["username"];
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
        <div class="container" style="max-width:640px;">
            <div class="panel panel-primary">
                <div class="panel-heading" style="text-align:center;">
                    <h1>PHP Login System</h1>
                </div>
                <div class="panel-body">
                    <h2>
                        Welcome back, <b><?php echo $username; ?></b>!
                    </h2>
                    <p>
                        <a href="signout.php" class="btn btn-danger btn-block">Sign out</a>
                    </p>
                </div>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </body>
</html>
