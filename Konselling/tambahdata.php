<?php
require '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $id_konselor = $_POST['id_konselor'];
    $tanggal_konsultasi = $_POST['tanggal_konsultasi'];
    $status_konsultasi = $_POST['status_konsultasi'];

    // Cek apakah NIM sudah ada di tabel pengguna
    $cek_nim = $conn->prepare("SELECT nim FROM pengguna WHERE nim = ?");
    $cek_nim->bind_param("s", $nim);
    $cek_nim->execute();
    $result = $cek_nim->get_result();

    if ($result->num_rows == 0) {
        // Jika NIM belum ada, tambahkan data ke tabel pengguna
        $stmt_pengguna = $conn->prepare("INSERT INTO pengguna (nim, nama, email, tanggal_lahir) VALUES (?, ?, ?, ?)");
        $stmt_pengguna->bind_param("ssss", $nim, $nama, $email, $tanggal_lahir);
        $stmt_pengguna->execute();
        $stmt_pengguna->close();
    }

    $cek_nim->close();

    // Masukkan data ke tabel konsultasi
    $stmt_konsultasi = $conn->prepare("INSERT INTO konsultasi (nim, id_konselor, tanggal_konsultasi, status_konsultasi) VALUES (?, ?, ?, ?)");
    $stmt_konsultasi->bind_param("siss", $nim, $id_konselor, $tanggal_konsultasi, $status_konsultasi);

    if ($stmt_konsultasi->execute()) {
        // Redirect langsung ke halaman utama
        header("Location: konselling.php");
        exit;
    } else {
        // Jika gagal, tampilkan pesan error (opsional)
        echo "Gagal menambahkan data. Silakan coba lagi.";
    }

    $stmt_konsultasi->close();
}
?>
