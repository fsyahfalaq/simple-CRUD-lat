<?php 
    require 'func.php';

    $id = $_GET["id"];
    $editMahasiswa = query("SELECT * FROM mahasiswa WHERE id = $id")[0];

    var_dump($editMahasiswa);
    if (isset($_POST["submit"])) {
        
        $result = UpdateData($_POST);

        var_dump(mysqli_affected_rows($link));
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Data</title>
</head>
<style>
    div {
        margin-top: 10px;
    }
</style>
<body>
    <h1>Update Data</h1>
    
    <form action="" method="post" enctype="multipart/form-data">
        <div>
            <input type="hidden" name="id" value="<?=$editMahasiswa["id"]?>">
            <input type="hidden" name="fotoLama" value="<?=$editMahasiswa["foto"]?>">
        </div>
        <div>
            <label for="nama">Nama :    </label>
            <input type="text" name="nama" id="nama" value="<?=$editMahasiswa["nama"]?>">
        </div>
        <div>
            <label for="npm">NPM:   </label>
            <input type="text" name="npm" id="npm" value="<?=$editMahasiswa["npm"]?>">
        </div>
        <div>
            <label for="email">Email:   </label>
            <input type="text" name="email" id="email" value="<?=$editMahasiswa["email"]?>">
        </div>
        <div>
            <label for="jurusan">Jurusan:   </label>
            <input type="text" name="jurusan" id="jurusan" value="<?=$editMahasiswa["jurusan"]?>">
        </div>
        <div>
            <label for="foto">Foto:   </label>
            <br>
            <img src="img/<?=$editMahasiswa["foto"]?>" alt="foto" width="50">
            <br>
            <input type="file" name="foto" id="foto">
        </div>
        <br>
        <button type="submit" name="submit">Update</button>
        <?php 
            if (isset($result)) {
                echo "<label>$result</label>";
            }
        ?>
    </form>
</body>
</html>