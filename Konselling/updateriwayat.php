<?php
require '../koneksi.php';

$id_konsultasi = $_GET['id'] ?? null;

if (!$id_konsultasi) {
    echo "ID konsultasi tidak ditemukan.";
    exit;
}

// Query untuk mengecek apakah data riwayat konsultasi sudah ada
$query = "SELECT * FROM riwayat_konsultasi WHERE id_konsultasi = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_konsultasi);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $data = $result->fetch_assoc();
    $is_new_entry = false; // Data sudah ada
} else {
    $data = [
        'catatan_konselor' => '',
        'rekomendasi_terapi' => ''
    ];
    $is_new_entry = true; // Data baru
}

// Proses penyimpanan data (insert atau update)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $catatan_konselor = $_POST['catatan_konselor'];
    $rekomendasi_terapi = $_POST['rekomendasi_terapi'];

    if ($is_new_entry) {
        // Tambah data baru
        $query = "INSERT INTO riwayat_konsultasi (id_konsultasi, catatan_konselor, rekomendasi_terapi) VALUES (?, ?, ?)";
    } else {
        // Update data yang sudah ada
        $query = "UPDATE riwayat_konsultasi SET catatan_konselor = ?, rekomendasi_terapi = ? WHERE id_konsultasi = ?";
    }

    $stmt = $conn->prepare($query);
    if ($is_new_entry) {
        $stmt->bind_param("iss", $id_konsultasi, $catatan_konselor, $rekomendasi_terapi);
    } else {
        $stmt->bind_param("ssi", $catatan_konselor, $rekomendasi_terapi, $id_konsultasi);
    }
    $stmt->execute();
    $stmt->close();

    // Redirect setelah proses selesai
    header("Location: konselling.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $is_new_entry ? 'Tambah' : 'Edit' ?> Riwayat Konsultasi</title>
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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <header>
        <div class="logo">
            <img src="../img/unneslogo.png" alt="Logo UNNES">
        </div>
        <nav class="menu">
            <a href="../Dashboard/dashboard.php">Dashboard</a>
            <a href="../Komunitas/komunitas.php">Komunitas</a>
            <a href="konselling.php">Konseling</a>
        </nav>
        <div class="admin-info">Admin Baru</div>
    </header>
    <div class="container">
        <h2><?= $is_new_entry ? 'Tambah' : 'Edit' ?> Riwayat Konsultasi</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="catatan_konselor" class="form-label">Catatan Konselor</label>
                <textarea name="catatan_konselor" class="form-control" rows="4" required><?= htmlspecialchars($data['catatan_konselor']) ?></textarea>
            </div>
            <div class="mb-3">
                <label for="rekomendasi_terapi" class="form-label">Rekomendasi Terapi</label>
                <textarea name="rekomendasi_terapi" class="form-control" rows="4" required><?= htmlspecialchars($data['rekomendasi_terapi']) ?></textarea>
            </div>
            <button type="submit" class="btn btn-success"><?= $is_new_entry ? 'Tambah' : 'Update' ?></button>
        </form>
        <a href="konselling.php" class="btn btn-secondary mt-3">Kembali</a>
    </div>
   <footer>
   <p>© 2024 Konseling UNNES. All rights reserved.</p>
    </footer>
</body>
</html>
