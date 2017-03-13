<?php
    require_once("connect.php");
    if (isset($_POST["username"])) {
        $username = mysql_escape_string($_POST["username"]);
        $password = mysql_escape_string($_POST["password"]);
        $options = [
            'cost' => 11,
            'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
        ];
        $password = password_hash($password, PASSWORD_DEFAULT, $options);
        $query = mysqli_query($connect, "INSERT INTO `users` VALUES ('" . $username . "', '" . $password . "');");
        $user = mysqli_fetch_assoc($query);
        session_start();
        $_SESSION["username"] = $username;
        header("Location: index.php");
        exit();
    } else {
        header("Location: signin.php");
        exit();
    }
?>
