<?php
require '../koneksi.php';

// Proses penghapusan konsultasi dan riwayat
if (isset($_GET['hapus_konsul'])) {
    $id = $_GET['hapus_konsul'];

    // Hapus data riwayat terlebih dahulu jika ada
    $conn->query("DELETE FROM riwayat_konsultasi WHERE id_konsultasi = $id");

    // Hapus data konsultasi
    $conn->query("DELETE FROM konsultasi WHERE id_konsultasi = $id");

    // Redirect untuk menghindari penghapusan ganda
    header("Location: konselling.php");
    exit;
}

// Proses update jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $nim = $_POST['nim'];
    $evaluasi = $_POST['evaluasi'];

    $query = $conn->prepare("UPDATE konsultasi SET evaluasi = ? WHERE nim = ?");
    $query->bind_param("ss", $evaluasi, $nim);
    $query->execute();
    $query->close();

    // Redirect agar tidak resubmit
    header("Location: konselling.php");
    exit;
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Konseling</title>
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
            background-color:#000a2a;
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
</head>
<body>
    <!-- HEADER -->
    <header>
    <div class="logo">
        <img src="../img/unneslogo.png" alt="UNNES Konselling">  
    </div>
    <nav class="menu">
        <a href="../Dashboard/dashboard.php">Dashboard</a>
        <a href="../komunitas/komunitas.php">Komunitas</a>
        <a href="konselling.php">Konseling</a>
    </nav>
    <div class="admin-info">Admin Baru</div>
    </header>
    
    <!-- MAIN CONTENT -->
    <div class="container mt-5">
        <h2 class="text-center mb-4">Manajemen Konseling</h2>

    <!-- Form Tambah Data -->
    <div class="form-container mb-4">
        <h5 class="mb-3">Tambah Data Konsultasi</h5>
        <form method="POST" action="tambahdata.php">
            <div class="row">
                <div class="col-md-3">
                    <label for="nim" class="form-label">NIM Mahasiswa</label>
                    <input type="text" name="nim" class="form-control" required>
                </div>
                <div class="col-md-3">
                    <label for="nama" class="form-label">Nama Mahasiswa</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>
                <div class="col-md-3">
                    <label for="email" class="form-label">Email Mahasiswa</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="col-md-3">
                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="form-control" required>
                </div>
                <div class="col-md-3">
                    <label for="id_konselor" class="form-label">Konselor</label>
                    <select name="id_konselor" class="form-control" required>
                        <?php
                        $result = $conn->query("SELECT * FROM konselor");
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['id_konselor'] . "'>" . $row['nama'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="tanggal_konsultasi" class="form-label">Tanggal Konsultasi</label>
                    <input type="date" name="tanggal_konsultasi" class="form-control" required>
                </div>
                <div class="col-md-3">
                    <label for="status_konsultasi" class="form-label">Status</label>
                    <select name="status_konsultasi" class="form-control" required>
                        <option value="berjalan">Berjalan</option>
                        <option value="tertunda">Tertunda</option>
                        <option value="selesai">Selesai</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-success mt-3">Tambah</button>
        </form>
    </div>

    <!-- Tabel Data Konsultasi -->
<div class="mb-5">
    <h5>Data Konsultasi</h5>
    <div class="table-responsive">
        <table class="table table-bordered text-center">
            <thead>
            <tr>
                <th>ID</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>Konselor</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $query = "
                SELECT k.id_konsultasi, k.nim, ko.nama AS konselor, k.tanggal_konsultasi, k.status_konsultasi, p.nama AS nama_pengguna
                FROM konsultasi k
                JOIN konselor ko ON k.id_konselor = ko.id_konselor
                JOIN pengguna p ON k.nim = p.nim
            ";
            $result = $conn->query($query);

            if ($result) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>" . htmlspecialchars($row['id_konsultasi']) . "</td>
                        <td>" . htmlspecialchars($row['nim']) . "</td>
                        <td>" . htmlspecialchars($row['nama_pengguna']) . "</td>
                        <td>" . htmlspecialchars($row['konselor']) . "</td>
                        <td>" . htmlspecialchars($row['tanggal_konsultasi']) . "</td>
                        <td>" . htmlspecialchars($row['status_konsultasi']) . "</td>
                        <td>
                            <a href='updatekonsul.php?id=" . htmlspecialchars($row['id_konsultasi']) . "' class='btn btn-warning btn-sm'>Edit</a>
                            <a href='?hapus_konsul=" . htmlspecialchars($row['id_konsultasi']) . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Yakin ingin menghapus?\")'>Hapus</a>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='7'>Data tidak tersedia atau terjadi kesalahan.</td></tr>";
            }

            $result->free();
            ?>
            </tbody>
        </table>
    </div>
</div>

    <!-- Tabel Riwayat Konsultasi -->
<div class="mb-5">
    <h5>Riwayat Konsultasi</h5>
    <div class="table-responsive">
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Konselor</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Evaluasi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Query gabungan data dari tabel konsultasi, riwayat_konsultasi, dan pengguna
                $result = $conn->query("
                    SELECT k.id_konsultasi AS id, k.nim, ko.nama AS konselor, 
                           k.tanggal_konsultasi AS tanggal, k.status_konsultasi AS status,
                           r.catatan_konselor, r.rekomendasi_terapi,
                           p.nama AS nama_pengguna
                    FROM konsultasi k
                    LEFT JOIN riwayat_konsultasi r ON k.id_konsultasi = r.id_konsultasi
                    JOIN konselor ko ON k.id_konselor = ko.id_konselor
                    JOIN pengguna p ON k.nim = p.nim
                ");
                
                // Loop untuk menampilkan data
                if ($result) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>" . htmlspecialchars($row['id']) . "</td>
                            <td>" . htmlspecialchars($row['nim']) . "</td>
                            <td>" . htmlspecialchars($row['nama_pengguna']) . "</td>
                            <td>" . htmlspecialchars($row['konselor']) . "</td>
                            <td>" . htmlspecialchars($row['tanggal']) . "</td>
                            <td>" . htmlspecialchars($row['status']) . "</td>
                            <td>
                                Catatan: " . htmlspecialchars($row['catatan_konselor'] ?? "Belum ada") . "<br>
                                Rekomendasi: " . htmlspecialchars($row['rekomendasi_terapi'] ?? "Belum ada") . "
                            </td>
                            <td>
                                <a href='updateriwayat.php?id=" . htmlspecialchars($row['id']) . "' class='btn btn-info btn-sm'>Edit</a>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>Data tidak tersedia atau terjadi kesalahan.</td></tr>";
                }

                $result->free();
                ?>
            </tbody>
        </table>
    </div>
</div>


<!-- FOOTER -->
<footer>
    <p>&copy; 2024 Konseling Online. All rights reserved.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Proses penghapusan konsultasi dan riwayat
if (isset($_GET['hapus_konsul'])) {
    $id = $_GET['hapus_konsul'];

    // Hapus data riwayat terlebih dahulu jika ada
    $conn->query("DELETE FROM riwayat_konsultasi WHERE id_konsultasi = $id");

    // Hapus data konsultasi
    $conn->query("DELETE FROM konsultasi WHERE id_konsultasi = $id");

    // Redirect untuk menghindari penghapusan ganda
    header("Location: konselling.php");
    exit;
}
?>

