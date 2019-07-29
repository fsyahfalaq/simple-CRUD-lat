<?php 
//connection to database
$link = mysqli_connect("localhost", "root", "", "latihan");

function query($query) {
    global $link;
    $result = mysqli_query($link, $query);
    $rows = [];
    while($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function register($data) {
    global $link;
    $username = strtolower(htmlspecialchars($data["username"]));
    $email = htmlspecialchars($data["email"]);
    $password = mysqli_real_escape_string($link, $data["password"]);
    $password2 = mysqli_real_escape_string($link, $data["password2"]);

    if ($password !== $password2) {
        return $result = "<script>
                alert('Please retype password again');
            </script>";
    }

    $password = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO users VALUES (0, '$username', '$email', '$password')";

    if (mysqli_query($link, $query)) {
        $result = "Registration succesfully completed";
    }
    else if (mysqli_errno($link) == 1062) {
        //1062 is duplicate username error code
        $result = "username already exist";
    }
    else {
        $result = "Error: " . $query . mysqli_errno($link) . "<br>" . mysqli_error($link);
    }

    return $result;
}

function addData($data) {
    global $link;
    $nama = htmlspecialchars($data["nama"]);
    $npm = htmlspecialchars($data["npm"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    $foto = upload();

    //upload error checking
    if (!$foto) {
        $result = "Upload gagal!";
        return $result;
    }

    $query = "INSERT INTO mahasiswa VALUES (0, '$nama', '$npm', '$email', '$jurusan', '$foto')";

    if (mysqli_query($link, $query)) {
        $result = "New record created successfully";
    } 
    else {
        $result = "Error: " . $query . "<br>" . mysqli_error($link);
    }

    return $result;
}

function upload() {
    $namaFile = $_FILES["foto"]["name"];
    $ukuranFile = $_FILES["foto"]["size"];
    $error = $_FILES["foto"]["error"];
    $tmpname = $_FILES["foto"]["tmp_name"];
    $imageFileType = strtolower(pathinfo($namaFile,PATHINFO_EXTENSION));
    $namaFileBaru = $_POST["npm"];
    $namaFileBaru .= ".$imageFileType";

    $succes = $namaFileBaru;
    
    //image type checking
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $succes = false;
    }

    
    if ($ukuranFile > 500000) {
        echo "Sorry, your file is too large.";
        $succes = false;
    }

    if ($error == 4) {
        echo "
            <script>
                alert('Foto belum dipilih');
            </script>
        ";
        $succes = false;
    }

    if ($succes) {
        move_uploaded_file($tmpname, 'img/' . $namaFileBaru );
    }

    return $succes;
}

function deleteData($id) {
    global $link;
    $query = "DELETE FROM mahasiswa WHERE id = $id";

    if (mysqli_query($link, $query)) {
        $result = "Record deleted successfully";
    }
    else {
        $result = "Error: " . $query . "<br>" . mysqli_error($link);
    }
    return $result;
}

function updateData($data) {
    global $link;
    $id = $data["id"];
    $nama = htmlspecialchars($data["nama"]);
    $npm = htmlspecialchars($data["npm"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    $fotoLama = htmlspecialchars($data["fotoLama"]);

    if ($_FILES["foto"]["error"] == 0) {
        $foto = upload();
    }
    else {
        $foto = $fotoLama;
    }

    $query = "UPDATE mahasiswa SET nama = '$nama', npm = '$npm', email = '$email', jurusan = '$jurusan', 
    foto = '$foto' 
    WHERE id = $id";

    if (mysqli_query($link, $query)) {
        $result = "Record updated successfully";
    } 
    else {
        $result = "Error: " . $query . "<br>" . mysqli_error($link);
    }

    return $result;
}

?>