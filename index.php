<?php
    session_start();
    if (!isset($_SESSION["username"])) {
        header("Location: signin.php");
        exit();
    }
    require_once("connect.php");
    $query = mysqli_query($connect, "SELECT * FROM `users` WHERE `username` = '" . $_SESSION["username"] . "';");
    $user = mysqli_fetch_assoc($query);
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
        <?php if ($user["tier"] == "1") { ?>
        <div id="addUserModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add User</h4>
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
                                <select name="tier" class="form-control">
                                    <option value="3">Client</option>
                                    <option value="2">Staff</option>
                                    <option value="1">Administrator</option>
                                </select>
                            </p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info btn-block">Add User</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
        <h1></h1>
        <div class="container" style="max-width:768px;">
            <div class="panel panel-primary">
                <div class="panel-heading" style="text-align:center;">
                    <h1>PHP Login System</h1>
                </div>
                <div class="panel-body">
                    <h2>
                        Welcome back, <b><?php
                            if ($user["tier"] == "1") {
                                echo "<span class='label label-danger'>Administrator</span>";
                            } elseif ($user["tier"] == "2") {
                                echo "<span class='label label-warning'>Staff</span>";
                            } elseif ($user["tier"] == "3") {
                                echo "<span class='label label-info'>Client</span>";
                            }
                        ?> <?php echo $user["username"]; ?></b>!
                    </h2>
                    <hr>
                    <div class="thumbnail">
                        <img src="http://unsplash.it/1280/320/?random" alt="https://source.unsplash.com/random">
                    </div>
                    <?php if ($user["tier"] == "1") { ?>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>Username</th>
                                        <th>Tier</th>
                                        <th>IP Address</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $query = mysqli_query($connect, "SELECT * FROM `users`;");
                                        while($row = mysqli_fetch_array($query)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $row['username'] ?></td>
                                            <td><?php echo $row['tier'] ?></td>
                                            <td><?php echo $row['ip'] ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <a href="#" data-target="#addUserModal" data-toggle="modal" class="btn btn-info btn-block">Add User</a>
                    <?php } ?>
                </div>
                <div class="panel-footer">
                    <a href="signout.php" class="btn btn-danger btn-block">Sign out</a>
                </div>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </body>
</html>
