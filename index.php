<?php
include 'koneksi.php';

// Pencarian
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Pagination
$limit = 5;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;

// Hitung total data
$total_result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM sepatu WHERE nama LIKE '%$search%'");
$total_row = mysqli_fetch_assoc($total_result);
$total = $total_row['total'];
$pages = ceil($total / $limit);

// Ambil data
$sql = "SELECT * FROM sepatu WHERE nama LIKE '%$search%' ORDER BY id ASC LIMIT $start, $limit";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Manajemen Data Sepatu</title>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: #f3f6fa;
      margin: 0;
      padding: 20px;
    }
    .container {
      max-width: 900px;
      margin: auto;
      background: white;
      border-radius: 10px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      padding: 25px;
    }
    h2 { text-align: center; color: #333; }
    form { text-align: center; margin-bottom: 20px; }
    input[type="text"] {
      padding: 10px; width: 250px;
      border-radius: 8px; border: 1px solid #ccc;
    }
    button {
      background: #007bff; color: white; border: none;
      padding: 8px 16px; border-radius: 8px; cursor: pointer;
    }
    button:hover { background: #0056b3; }
    .btn {
      text-decoration: none; color: white; background: #28a745;
      padding: 8px 12px; border-radius: 8px;
    }
    .btn:hover { background: #1f7a32; }
    table {
      width: 100%; border-collapse: collapse; margin-top: 15px;
    }
    th, td {
      padding: 10px; text-align: center;
      border-bottom: 1px solid #ddd;
    }
    th { background: #007bff; color: white; }
    .pagination {
      text-align: center; margin-top: 15px;
    }
    .pagination a {
      padding: 8px 12px; margin: 2px;
      border: 1px solid #007bff; border-radius: 5px;
      text-decoration: none; color: #007bff;
    }
    .pagination a.active, .pagination a:hover {
      background: #007bff; color: white;
    }
    img { border-radius: 6px; }
  </style>
</head>
<body>
  <div class="container">
    <h2>Daftar Sepatu</h2>
    <form method="GET">
      <input type="text" name="search" placeholder="Cari nama sepatu..." value="<?= $search ?>">
      <button type="submit">Cari</button>
    </form>

    <a href="add.php" class="btn">+ Tambah Sepatu</a>

    <table>
      <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Merek</th>
        <th>Ukuran</th>
        <th>Harga</th>
        <th>Gambar</th>
        <th>Aksi</th>
      </tr>
      <?php while ($row = mysqli_fetch_assoc($result)) { ?>
      <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['nama'] ?></td>
        <td><?= $row['merek'] ?></td>
        <td><?= $row['ukuran'] ?></td>
        <td>Rp <?= number_format($row['harga'], 2, ',', '.') ?></td>
        <td><img src="uploads/<?= $row['gambar'] ?>" width="70"></td>
        <td>
          <a href="edit.php?id=<?= $row['id'] ?>">Edit</a> | 
          <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin hapus data ini?')">Hapus</a>
        </td>
      </tr>
      <?php } ?>
    </table>

    <div class="pagination">
      <?php for ($i = 1; $i <= $pages; $i++) { ?>
        <a href="?page=<?= $i ?>&search=<?= $search ?>" class="<?= ($i==$page)?'active':'' ?>"><?= $i ?></a>
      <?php } ?>
    </div>
  </div>
</body>
</html>
