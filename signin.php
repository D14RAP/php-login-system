<?php
    require_once("connect.php");
    if (isset($_POST["username"])) {
        $username = mysql_escape_string($_POST["username"]);
        $password = mysql_escape_string($_POST["password"]);
        $query = mysqli_query($connect, "SELECT * FROM `users` WHERE `username` = '" . $username . "';");
        $user = mysqli_fetch_assoc($query);
        if (password_verify($password, $user["password"])) {
            session_start();
            $_SESSION["username"] = $user["username"];
            header("Location: index.php");
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
        <div id="signUpModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Sign Up</h4>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="signup.php">
                            <p>
                                <input name="username" type="text" placeholder="Username" class="form-control">
                            </p>
                            <p>
                                <input name="password" type="password" placeholder="Password" class="form-control">
                            </p>
                            <p>
                                <button type="submit" class="btn btn-info btn-block">Sign Up</button>
                            </p>
                        </form>
                    </div>
                    <!--div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div-->
                </div>
            </div>
        </div>
        <h1></h1>
        <div class="container" style="max-width:640px;">
            <div class="panel panel-primary">
                <div class="panel-heading" style="text-align:center;">
                    <h1>PHP Login System</h1>
                </div>
                <div class="panel-body">
                    <form method="post" action="signin.php">
                        <p>
                            <input name="username" type="text" placeholder="Username" class="form-control">
                        </p>
                        <p>
                            <input name="password" type="password" placeholder="Password" class="form-control">
                        </p>
                        <p>
                            <button type="submit" class="btn btn-success btn-block">Sign In</button>
                        </p>
                    </form>
                    <p>
                        <a href="#" data-target="#signUpModal" data-toggle="modal" class="btn btn-info btn-block">Sign Up</a>
                    </p>
                </div>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </body>
</html>
