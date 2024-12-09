<?php
require 'config.php';
session_start(); // Mulai sesi untuk cek login

// Cek jika sudah login, langsung arahkan ke halaman utama
if (isset($_SESSION['user_id'])) {
    header("Location: indexlogin.html");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        // Cek apakah username ada di database
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute([':username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verifikasi password yang dimasukkan
        if ($user && password_verify($password, $user['password'])) {
            // Login berhasil, simpan sesi
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: indexlogin.html"); // Arahkan ke halaman utama setelah login berhasil
            exit;
        } else {
            $error = "Username atau password salah.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>
    <h2>Login</h2>
    <?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>
    <form method="post" action="">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Login</button>
    </form>

    <p>Belum punya akun? <a href="register.php">Daftar sekarang</a></p>  <!-- Link ke halaman register -->
</body>
</html>
