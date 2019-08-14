<?php 
session_start();
require 'func.php';

if ($_SESSION["login"] == false) {
    header("Location: login.php");
    exit();
}

//Pagination
$jumlahDataTampil  = 2;
$jumlahData = count(query("SELECT * FROM mahasiswa"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataTampil);
$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : $_GET["halaman"] = 1;
$firstIndex = ($jumlahDataTampil * $halamanAktif) - $jumlahDataTampil;

$mahasiswa = query("SELECT * FROM mahasiswa LIMIT $firstIndex, $jumlahDataTampil");

//Delete Feature
if (isset($_GET["delete"])) {
        
    $result = deleteData($_GET["id"]); ?>
        <script>
        alert('<?=$result;?>');
        document.location.href = 'tablemahasiswa.php';
        </script>
<?php } 

//Search Feature
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
    <h1>Table Mahasiswa</h1>
    
    <a href="logout.php">Logout</a>

    <div style="margin-bottom:10px">
    <form action="" method="get">
        <input type="text" name="keyword" id="keyword">
        <button type="submit" name="search" id="btnSearch">Search</button>
    </form>
    </div>

    <?php if ($halamanAktif > 1) {?>
    <a href="?halaman=<?=$halamanAktif - 1?>">&lt=</a>
    <?php } ?>

    <?php 
        for ($i = 1; $i <= $jumlahHalaman; $i++) { 
            if ($i == $halamanAktif) { ?>
                <a href="?halaman=<?=$i?>" style="font-weight:bold; text-decoration:none"><?=$i?></a>
    <?php } else { ?>    
            <a href="?halaman=<?=$i?>" style="text-decoration:none"><?=$i?></a>
        <?php } 
        }
        ?>

    <?php if ($jumlahHalaman > $halamanAktif) {?>
    <a href="?halaman=<?=$halamanAktif + 1?>">=&gt</a>
    <?php } ?>
    
    <div id="table">
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
        </table>
    </div>

    <a href="addData.php">Tambahkan data</a>
    
    <script src="js/script.js"></script>
</body>
</html>