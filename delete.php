<?php
include 'koneksi.php';
$id = $_GET['id'];

$result = mysqli_query($conn, "SELECT * FROM sepatu WHERE id=$id");
$row = mysqli_fetch_assoc($result);

if ($row) {
    $file = 'uploads/' . $row['gambar'];
    mysqli_query($conn, "DELETE FROM sepatu WHERE id=$id");
    if (file_exists($file)) unlink($file);
}
header("Location: index.php");
?>
