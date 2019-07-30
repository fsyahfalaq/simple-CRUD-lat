<?php 
session_start();

if ($_SESSION["login"] == false) {
    header("Location: login.php");
    exit();
}
    require 'func.php';

    if (isset($_POST["submit"])) {
        
        $result = addData($_POST);

        var_dump(mysqli_affected_rows($link));
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah Data</title>
</head>
<style>
    div {
        margin-top: 10px;
    }
</style>
<body>
    <h1>Tambahkan Data</h1>
    
    <form action="" method="post" enctype="multipart/form-data">
        <div>
            <label for="nama">Nama :    </label>
            <input type="text" name="nama" id="nama">
        </div>
        <div>
            <label for="npm">NPM:   </label>
            <input type="text" name="npm" id="npm">
        </div>
        <div>
            <label for="email">Email:   </label>
            <input type="text" name="email" id="email">
        </div>
        <div>
            <label for="jurusan">Jurusan:   </label>
            <input type="text" name="jurusan" id="jurusan">
        </div>
        <div>
            <label for="foto">Foto:   </label>
            <input type="file" name="foto" id="foto">
        </div>
        <br>
        <button type="submit" name="submit">Submit</button>
        <?php 
            if (isset($result)) {
                echo "<label>$result</label>";
            }
        ?>
    </form>
</body>
</html>