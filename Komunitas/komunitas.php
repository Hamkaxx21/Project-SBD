<?php
require '../koneksi.php';

$mode = $_GET['mode'] ?? 'admin'; // Default ke admin

// Bagian tampilKomunitas diubah
function tampilKomunitas($conn) {
    $result = $conn->query("SELECT * FROM komunitas");
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id_komunitas']}</td>
                <td>{$row['nama_komunitas']}</td>
                <td>{$row['deskripsi']}</td>
                <td>{$row['tanggal_dibuat']}</td>
                <td>
                    <a href='komunitas.php?id_komunitas={$row['id_komunitas']}&mode=postingan' class='btn btn-primary'>Akses</a>
                </td>
              </tr>";
    }
}


// Fungsi untuk menambahkan komunitas
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['tambah_komunitas'])) {
    $nama_komunitas = $_POST['nama_komunitas'];
    $deskripsi = $_POST['deskripsi'];
    $tanggal_dibuat = date('Y-m-d');
    $query = $conn->prepare("INSERT INTO komunitas (nama_komunitas, deskripsi, tanggal_dibuat) VALUES (?, ?, ?)");
    $query->bind_param("sss", $nama_komunitas, $deskripsi, $tanggal_dibuat);
    $query->execute();
    header("Location: komunitas.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Komunitas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        <style>
        table thead {
            background-color: #007bff;
            color: white;
        }
        .form-container {
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        header {
            background-color: #000a2a;
            color: white;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        header .logo img {
            height: 50px;
        }
        header .menu a {
            color: white;
            margin: 0 10px;
            text-decoration: none;
        }
        footer {
            background-color: #f8f9fa;
            text-align: center;
            padding: 10px 0;
            border-top: 1px solid #ddd;
            margin-top: 20px;
        }
    </style>
    </style>
</head>
<body>
<header>
    <div class="logo">
        <img src="../img/unneslogo.png" alt="Logo UNNES">
    </div>
    <nav class="menu">
        <a href="../Dashboard/dashboard.php">Dashboard</a>
        <a href="komunitas.php">Komunitas</a>
        <a href="../Konselling/konselling.php">Konseling</a>
    </nav>
    <div class="admin-info">Admin Baru</div>
</header>

<div class="container mt-5">
    <h2>Menu Komunitas</h2>

    <?php if ($mode == 'admin'): ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Komunitas</th>
                    <th>Deskripsi</th>
                    <th>Tanggal Dibuat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php tampilKomunitas($conn); ?>
            </tbody>
        </table>

        <h3>Tambah Komunitas Baru</h3>
        <form method="POST">
    <div class="mb-3">
        <label for="nama_komunitas" class="form-label">Nama Komunitas</label>
        <input type="text" name="nama_komunitas" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="deskripsi" class="form-label">Deskripsi</label>
        <textarea name="deskripsi" class="form-control" rows="3" required></textarea>
    </div>
    <div class="mb-3">
        <label for="tanggal_dibuat" class="form-label">Tanggal Dibuat</label>
        <input type="date" name="tanggal_dibuat" class="form-control" required>
    </div>
    <button type="submit" name="tambah_komunitas" class="btn btn-success">Tambah</button>
</form>

    <?php elseif ($mode == 'postingan' && isset($_GET['id_komunitas'])): ?>
        <!-- Halaman untuk postingan komunitas -->
        <?php
        $id_komunitas = $_GET['id_komunitas'];
        $result = $conn->query("SELECT * FROM postingan_komunitas WHERE id_komunitas = $id_komunitas");
        ?>
        <h3>Postingan Komunitas</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>NIM</th>
                    <th>Tanggal Postingan</th>
                    <th>Isi Postingan</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['nim'] ?></td>
                        <td><?= $row['tanggal_postingan'] ?></td>
                        <td><?= $row['isi_postingan'] ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <a href="komunitas.php" class="btn btn-secondary mt-3">Kembali</a>
    <?php endif; ?>
</div>

<footer>
    <p>© 2024 Konseling UNNES. All rights reserved.</p>
</footer>
</body>
</html>
