<?php
    session_start();
    if (!isset($_SESSION["username"])) {
        header("Location: signin.php");
        exit();
    }
    require_once("connect.php");
    $query = mysqli_query($connect, "SELECT * FROM `users` WHERE `username` = '" . $_SESSION["username"] . "';");
    $user = mysqli_fetch_assoc($query);
    if ((isset($_POST["username"])) && ($user['tier'] == "1")) {
        $username = mysql_real_escape_string($_POST["username"]);
        $password = mysql_real_escape_string($_POST["password"]);
        $tier = mysql_real_escape_string($_POST["tier"]);
        $options = [
            'cost' => 11,
            'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
        ];
        $password = password_hash($password, PASSWORD_DEFAULT, $options);

        $query = mysqli_query($connect, "SELECT * FROM `users` WHERE `username` = '" . $username . "';");
        $rows = mysqli_num_rows($query);
        if ($rows < 1) {
            $query = mysqli_query($connect, "INSERT INTO `users` VALUES ('" . $username . "', '" . $password . "', '" . $tier . "', '" . $_SERVER['REMOTE_ADDR'] . "');");
            header("Location: index.php");
            exit();
        } else {
            header("Location: index.php");
            exit();
        }
    } else {
        header("Location: index.php");
        exit();
    }
?>
