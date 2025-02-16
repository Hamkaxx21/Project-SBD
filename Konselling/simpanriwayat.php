<?php
require '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_konsultasi = $_POST['id_konsultasi']; // Pastikan ID dikirim
    $catatan_konselor = $_POST['catatan_konselor'] ?? "Belum ada";
    $rekomendasi_terapi = $_POST['rekomendasi_terapi'] ?? "Belum ada";

    // Update atau Insert data ke tabel riwayat_konsultasi
    $query = $conn->prepare("
        INSERT INTO riwayat_konsultasi (id_konsultasi, catatan_konselor, rekomendasi_terapi) 
        VALUES (?, ?, ?)
        ON DUPLICATE KEY UPDATE 
        catatan_konselor = VALUES(catatan_konselor), 
        rekomendasi_terapi = VALUES(rekomendasi_terapi)
    ");
    $query->bind_param("iss", $id_konsultasi, $catatan_konselor, $rekomendasi_terapi);

    if ($query->execute()) {
        // Redirect ke halaman utama setelah sukses
        header("Location: konselling.php");
        exit;
    } else {
        echo "Gagal menyimpan evaluasi ke riwayat konsultasi.";
    }

    $query->close();
}
?>
