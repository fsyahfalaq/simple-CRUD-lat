<?php 
session_start();
require 'func.php';

// cookie checking
if (isset($_COOKIE["id"]) && isset($_COOKIE["key"])) {
    $id = $_COOKIE["id"];
    $key = $_COOKIE["key"];

    $query = "SELECT * FROM users WHERE id = $id";
    $result = mysqli_query($link, $query);
    $row = mysqli_fetch_assoc($result);

    if ($key == hash("sha256", $row["username"])) {
        $_SESSION["login"] = true;
    }
}


if (isset($_SESSION["login"])) {
    header("Location: admin.php");
    exit();
}

if (isset($_POST["login"])) {
    
    $username = $_POST["username"];
    $password = $_POST["password"];

    $query = "SELECT * FROM users WHERE username = '$username'";
    $login = mysqli_query($link, $query);
    
    
    if ($login) {
        //password checking
        $row = mysqli_fetch_assoc($login);
        if (password_verify($password, $row["password"])) {
            $_SESSION["login"] = true;

            //remember me checking
            if (isset($_POST["rememberMe"])) {
                setcookie("id", $row["id"], time() + 60*60);
                setcookie("key", hash("sha256", $row["username"]));
            }
            
            //redirect to admin.php
            header("Location: admin.php");
            exit();
        }
        else {
            $errorLogin = true;
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halaman Login</title>
</head>
<style>
    div {
        margin: 5px;
    }
</style>
<body>
    <h1>Login</h1>
    <form action="" method="post">
        <div>
            <label for="username">Username: </label>
            <input type="text" name="username" id="username">
        </div>
        <div>
            <label for="password">Password: </label>
            <input type="password" name="password" id="password">
        </div>
        <div>
            <label for="rememberMe">Remember Me: </label>
            <input type="checkbox" name="rememberMe" id="rememberMe">
        </div>
        <button type="submit" name="login">Login</button>
        <?php 
            if (isset($errorLogin)) {
                echo "<label>Password atau Username Anda Salah</label>";
            }
        ?>
    </form>
</body>
</html>