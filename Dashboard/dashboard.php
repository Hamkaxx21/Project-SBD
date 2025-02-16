<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php"); // Kembali ke login jika tidak login
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Dashboard Konseling UNNES</title>
    <style>
        body {
            font-family: 'Fira Sans', sans-serif;
        }
        .banner {
    background: url('../img/unnes background.jpg') no-repeat center center;
    background-size: cover;
    height: 600px;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    opacity: 0; /* Awal animasi */
    animation: fadeInBackground 2s ease-in-out forwards; /* Animasi fade-in */
}

@keyframes fadeInBackground {
    from {
        opacity: 0; /* Tidak terlihat */
    }
    to {
        opacity: 1; /* Terlihat penuh */
    }
}

        .banner h1 {
            font-size: 2.5rem;
            font-weight: bold;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7);
        }
        .section-title {
            margin-top: 20px;
            margin-bottom: 15px;
            font-weight: bold;
            text-transform: uppercase;
            color: #007bff;
            
        }
        footer {
            background-color: #f8f9fa;
            text-align: center;
            padding: 10px 0;
            border-top: 1px solid #ddd;
            margin-top: 30px;
        }
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
        h2.section-title {
            background-color: #ffcc00; /* Warna kuning */
            color: #000a2a; /* Warna font #000a2a */
            padding: 10px; /* Memberikan jarak di sekitar teks */
            border-radius: 5px; /* Membuat sudut sedikit membulat */
            font-size: 24px; /* Ukuran font */
            font-weight: bold; /* Menebalkan teks */
            margin-bottom: 20px; /* Jarak bawah untuk memberi spasi dengan elemen lain */
        }
        
        h2.section-title {
            animation: slideIn 1s ease-in-out;
        }
        p, ul {
            animation: fadeIn 2s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes slideIn {
            from {
                transform: translateX(-100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        @keyframes fadeLogo {
    from {
        opacity: 0;
        transform: scale(0.8);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

header .logo img {
    animation: fadeLogo 2s ease-in-out; /* Durasi animasi 2 detik */
    height: 50px;
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
        <a href="dashboard.php">Dashboard</a>
        <a href="../komunitas/komunitas.php">Komunitas</a>
        <a href="../Konselling/konselling.php">Konseling</a>
    </nav>
    <div class="admin-info">Admin Baru</div>
    </header>

    <!-- Banner -->
    <div class="banner">
        <h1>Konselling Universitas Negeri Semarang</h1>    
    </div>

    <!-- Content -->
    <div class="container mt-5">
        <!-- Section Profil -->
        <div class="row">
            <div class="col-md-12">
                <h2 class="section-title">Profil Konseling UNNES</h2>
                <p>
                    Konseling UNNES adalah layanan konseling online yang bertujuan untuk membantu mahasiswa dalam menjaga kesehatan mental, 
                    memberikan dukungan emosional, dan menciptakan lingkungan kampus yang lebih inklusif. Dengan dukungan konselor berpengalaman,
                    kami siap memberikan solusi terbaik untuk setiap permasalahan yang Anda hadapi.
                </p>
            </div>
        </div>

        <!-- Section Tujuan -->
        <div class="row mt-4">
            <div class="col-md-12">
                <h2 class="section-title">Tujuan Kami</h2>
                <ul>
                    <li>Meningkatkan kesejahteraan psikologis mahasiswa.</li>
                    <li>Memberikan bimbingan emosional dan akademik.</li>
                    <li>Mendukung mahasiswa dalam menghadapi tantangan kehidupan kampus.</li>
                    <li>Menciptakan lingkungan kampus yang lebih sehat secara mental.</li>
                </ul>
            </div>
        </div>

        <!-- Section Layanan -->
        <div class="row mt-4">
            <div class="col-md-12">
                <h2 class="section-title">Layanan Kami</h2>
                <p>
                    Kami menyediakan layanan berikut:
                </p>
                <ul>
                    <li>Konseling individu secara online maupun tatap muka.</li>
                    <li>Forum komunitas dukungan mahasiswa secara anonim.</li>
                    <li>Monitoring dan evaluasi kesehatan mental.</li>
                    <li>Sesi pelatihan untuk meningkatkan keterampilan mengelola stres.</li>
                </ul>
            </div>
        </div>

        <!-- Section Informasi Kontak -->
        <div class="row mt-4">
            <div class="col-md-12">
                <h2 class="section-title">Informasi Kontak</h2>
                <p>
                    Jika Anda memiliki pertanyaan atau ingin mengetahui lebih lanjut tentang layanan kami, 
                    silakan hubungi kami di:
                </p>
                <ul>
                    <li>Email: konselling@unnes.ac.id</li>
                    <li>Telepon: +62-812-3456-7890</li>
                    <li>Alamat: Jl. Raya Sekaran, Gunungpati, Semarang, Jawa Tengah</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Konseling UNNES. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
