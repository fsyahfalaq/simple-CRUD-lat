<?php 
    require 'func.php';

    $mahasiswa = query("SELECT * FROM mahasiswa");
    
    if (isset($_GET["delete"])) {
        
        $result = deleteData($_GET["id"]); ?>
        <script>
        alert('<?=$result;?>');
        document.location.href = 'tablemahasiswa.php';
        </script>
<?php } 
    
    if (isset($_GET["search"])) {
        $keyword = htmlspecialchars($_GET["keyword"]);
        $mahasiswa = query("SELECT * FROM mahasiswa WHERE 
        nama LIKE '%$keyword%' OR
        npm LIKE '%$keyword%' OR
        jurusan LIKE '%$keyword%'
        
        ");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Mahasiswa</title>
</head>
<body>
    <h1>Table Data Mahasiswa</h1>
    <div style="margin-bottom:10px">
    <form action="" method="get">
        <input type="text" name="keyword" id="keyword">
        <button type="submit" name="search">Search</button>
    </form>
    </div>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No.</th>
            <th>Aksi</th>
            <th>Foto</th>
            <th>Nama</th>
            <th>NPM</th>        
            <th>Email</th>
            <th>Jurusan</th>
        </tr>
    <?php $i = 1 ?>
    <?php foreach ($mahasiswa as $row) { ?>
        <tr>
            <td><?php echo "$i"; $i++;?></td>
            <td>
                <!-- <a href="delete.php?id=<?=$row["id"];?>">hapus</a> --> 
                <a href="?id=<?=$row["id"];?>&delete">hapus</a> |
                <a href="update.php?id=<?=$row["id"];?>">ubah</a>
            </td>
            <td><img src="img/<?= $row["foto"]; ?>" alt="foto" width="50"></td>
            <td><?= $row["nama"]; ?></td>
            <td><?= $row["npm"]; ?></td>
            <td><?= $row["email"]; ?></td>
            <td><?= $row["jurusan"]; ?></td>
        </tr>
    <?php } ?>
    <a href="addData.php">Tambahkan data</a>
    </table>

</body>
</html>