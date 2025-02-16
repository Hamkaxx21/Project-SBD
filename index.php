<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === 'admin' && $password === 'admin') {
        $_SESSION['username'] = $username;
        header("Location: Dashboard/dashboard.php"); // Redirect sesuai folder
        exit();
    } else {
        $error_message = "Username atau Password salah.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f8f9fa;
        }

        .login-container {
            display: flex;
            width: 80%;
            height: 70vh;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            overflow: hidden;
        }

        .image-side {
            flex: 1;
            background: url('img/unnes background.jpg') no-repeat center center;
            background-size: cover;
            filter: brightness(1.0); /* Mengurangi saturasi */
        }

        .form-side {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: white;
            padding: 20px;
        }

        .form-container {
            width: 80%;
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #007bff;
        }

        .form-container .btn {
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <!-- Bagian Kiri -->
        <div class="image-side"></div>

        <!-- Bagian Kanan -->
        <div class="form-side">
            <div class="form-container">
                <h2>Selamat Datang di Konselling UNNES</h2>
                <form method="POST" action="">
    <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" name="username" id="username" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" id="password" class="form-control" required>
    </div>
    <?php if (isset($error_message)): ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php endif; ?>
    <button type="submit" class="btn btn-primary">Login</button>
</form>

            </div>
        </div>
    </div>
</body>
</html>
