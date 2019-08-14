<?php 
require "../func.php";

$keyword = $_GET["keyword"];

$mahasiswa = query("SELECT * FROM mahasiswa WHERE nama LIKE '%$keyword%'  OR
                npm LIKE '%$keyword%' OR
                jurusan LIKE '%$keyword%'");

?>

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