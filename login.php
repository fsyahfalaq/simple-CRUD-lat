<?php 
require 'func.php';

if (isset($_POST["login"])) {
    
    $username = $_POST["username"];
    $password = $_POST["password"];

    $query = "SELECT * FROM users WHERE username = '$username'";
    $login = mysqli_query($link, $query);
    
    
    if ($login) {
        echo "hello!";
        //password checking
        $row = mysqli_fetch_assoc($login);
        if (password_verify($password, $row["password"])) {
            header("Location: admin.php");
            exit();
        }
    }

    $errorLogin = true;
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
<body>
    <h1>Login</h1>
    <form action="" method="post">
        <label for="username">Username: </label>
        <input type="text" name="username" id="username">
        <br>
        <label for="password">Password: </label>
        <input type="password" name="password" id="password">
        <br>
        <button type="submit" name="login">Login</button>
        <?php 
            if (isset($errorLogin)) {
                echo "<label>Password atau Username Anda Salah</label>";
            }
        ?>
    </form>
</body>
</html>