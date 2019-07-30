<?php
session_start();
require 'func.php';

if (isset($_SESSION["login"])) {
    header("Location: admin.php");
    exit();
}

if (isset($_POST["register"])) {
    
        $result = register($_POST);

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Registration Form</title>
</head>
<style>
    div {
        margin: 5px;
    }
</style>
<body>
    <h1>Registration Form</h1>
    <form action="" method="post">
        <div>
            <label for="username">Username: </label>
            <input type="text" name="username" id="username" />
        </div>
        <div>    
            <label for="email">Email: </label>
            <input type="email" name="email" id="email" />
        </div>
        <div>    
            <label for="password">Password: </label>
            <input type="password" name="password" id="password" />
        </div>
        <div>
            <label for="password2">Retype Password: </label>
            <input type="password" name="password2" id="password2" />
        </div>
        <div>
            <button type="submit" name="register">Register</button>
            <?php 
                if (isset($result)) {
                    echo $result;
                }
            ?> 
        </div>
    </form>
</body>
</html>