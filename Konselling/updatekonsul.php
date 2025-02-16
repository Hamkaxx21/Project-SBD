<?php
require '../koneksi.php';
$id_konsultasi = $_GET['id'];
$result = $conn->query("
    SELECT k.*, p.nama 
    FROM konsultasi k
    JOIN pengguna p ON k.nim = p.nim 
    WHERE k.id_konsultasi = '$id_konsultasi'
");
$data = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Update Konsultasi</title>
    <style>
        header {
            background-color: #000a2a;
            color: white;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        header .menu a {
            color: white;
            margin: 0 10px;
            text-decoration: none;
        }
        .form-container {
            margin-top: 50px;
            padding: 20px;
            border: 1px solid #ddd;
            background-color: #f8f9fa;
            border-radius: 8px;
        }
        footer {
            background-color: #f8f9fa;
            padding: 10px 0;
            height : 200px;
            text-align: center;
            border-top: 1px solid #ddd;
        }
    </style>
</head>
<body>
<header>
    <div class="logo">
        <img src="../img/unneslogo.png" alt="Logo UNNES" height="50">
    </div>
    <nav class="menu">
        <a href="../Dashboard/dashboard.php">Dashboard</a>
        <a href="../Komunitas/komunitas.php">Komunitas</a>
        <a href="konselling.php">Konseling</a>
    </nav>
    <div class="admin-info">Admin Baru</div>
</header>

<div class="container">
    <div class="form-container">
        <h2 class="text-center">Update Data Konsultasi</h2>
        <form method="POST" action="">
            <div class="row">
                <div class="col-md-3">
                    <label for="nim" class="form-label">NIM Mahasiswa</label>
                    <input type="text" name="nim" class="form-control" value="<?php echo $data['nim']; ?>" required>
                </div>
                <div class="col-md-3">
                    <label for="nama" class="form-label">Nama Mahasiswa</label>
                    <input type="text" name="nama" class="form-control" value="<?php echo $data['nama']; ?>" required>
                </div>
                <div class="col-md-3">
                    <label for="id_konselor" class="form-label">Konselor</label>
                    <select name="id_konselor" class="form-control" required>
                        <?php
                        $result_konselor = $conn->query("SELECT * FROM konselor");
                        while ($row = $result_konselor->fetch_assoc()) {
                            echo "<option value='" . $row['id_konselor'] . "' " . ($row['id_konselor'] == $data['id_konselor'] ? 'selected' : '') . ">" . $row['nama'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="tanggal_konsultasi" class="form-label">Tanggal Konsultasi</label>
                    <input type="date" name="tanggal_konsultasi" class="form-control" value="<?php echo $data['tanggal_konsultasi']; ?>" required>
                </div>
                <div class="col-md-3">
                    <label for="status_konsultasi" class="form-label">Status</label>
                    <select name="status_konsultasi" class="form-control" required>
                        <option value="berjalan" <?php echo ($data['status_konsultasi'] == 'berjalan') ? 'selected' : ''; ?>>Berjalan</option>
                        <option value="tertunda" <?php echo ($data['status_konsultasi'] == 'tertunda') ? 'selected' : ''; ?>>Tertunda</option>
                        <option value="selesai" <?php echo ($data['status_konsultasi'] == 'selesai') ? 'selected' : ''; ?>>Selesai</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Update</button>
        </form>
    </div>
</div>

<footer>
    <p>© 2024 Konseling UNNES. All rights reserved.</p>
</footer>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $id_konselor = $_POST['id_konselor'];
    $tanggal_konsultasi = $_POST['tanggal_konsultasi'];
    $status_konsultasi = $_POST['status_konsultasi'];

    // Update tabel pengguna untuk nama mahasiswa
    $conn->query("UPDATE pengguna SET nama = '$nama' WHERE nim = '$nim'");

    // Update tabel konsultasi
    $conn->query("UPDATE konsultasi SET nim = '$nim', id_konselor = '$id_konselor', tanggal_konsultasi = '$tanggal_konsultasi', status_konsultasi = '$status_konsultasi' WHERE id_konsultasi = '$id_konsultasi'");

    header("Location: konselling.php");
}
?>
</body>
</html>
