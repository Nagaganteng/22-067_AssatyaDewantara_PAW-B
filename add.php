<?php
include 'koneksi.php';

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $merek = $_POST['merek'];
    $harga = $_POST['harga'];
    $ukuran = $_POST['ukuran'];
    $gambar = $_FILES['gambar']['name'];
    $target = 'uploads/' . basename($gambar);

    if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target)) {
        $sql = "INSERT INTO sepatu (nama, merek, harga, ukuran, gambar) VALUES ('$nama', '$merek', '$harga', '$ukuran', '$gambar')";
        mysqli_query($conn, $sql);
        header("Location: index.php");
    } else {
        echo "Upload gambar gagal!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Tambah Sepatu</title>
</head>
<body>
  <h2>Tambah Sepatu</h2>
  <form method="POST" enctype="multipart/form-data">
    Nama: <input type="text" name="nama" required><br><br>
    Merek: <input type="text" name="merek" required><br><br>
    Harga: <input type="number" step="0.01" name="harga" required><br><br>
    Ukuran: <input type="text" name="ukuran" required><br><br>
    Gambar: <input type="file" name="gambar" required><br><br>
    <button type="submit" name="submit">Simpan</button>
    <a href="index.php">Kembali</a>
  </form>
</body>
</html>
