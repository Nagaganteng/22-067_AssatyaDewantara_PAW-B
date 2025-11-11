<?php
include 'koneksi.php';
$id = $_GET['id'];

$result = mysqli_query($conn, "SELECT * FROM sepatu WHERE id=$id");
$row = mysqli_fetch_assoc($result);

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $merek = $_POST['merek'];
    $harga = $_POST['harga'];
    $ukuran = $_POST['ukuran'];

    if (!empty($_FILES['gambar']['name'])) {
        $gambar = $_FILES['gambar']['name'];
        $target = 'uploads/' . basename($gambar);
        $old_file = 'uploads/' . $row['gambar'];

        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target)) {
            if (file_exists($old_file)) unlink($old_file);
            $update = "UPDATE sepatu SET nama='$nama', merek='$merek', harga='$harga', ukuran='$ukuran', gambar='$gambar' WHERE id=$id";
        }
    } else {
        $update = "UPDATE sepatu SET nama='$nama', merek='$merek', harga='$harga', ukuran='$ukuran' WHERE id=$id";
    }

    mysqli_query($conn, $update);
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Edit Sepatu</title>
</head>
<body>
  <h2>Edit Sepatu</h2>
  <form method="POST" enctype="multipart/form-data">
    Nama: <input type="text" name="nama" value="<?= $row['nama'] ?>" required><br><br>
    Merek: <input type="text" name="merek" value="<?= $row['merek'] ?>" required><br><br>
    Harga: <input type="number" step="0.01" name="harga" value="<?= $row['harga'] ?>" required><br><br>
    Ukuran: <input type="text" name="ukuran" value="<?= $row['ukuran'] ?>" required><br><br>
    Gambar saat ini: <img src="uploads/<?= $row['gambar'] ?>" width="80"><br>
    Ganti Gambar: <input type="file" name="gambar"><br><br>
    <button type="submit" name="submit">Update</button>
    <a href="index.php">Kembali</a>
  </form>
</body>
</html>
