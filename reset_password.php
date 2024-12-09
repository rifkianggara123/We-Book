<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    try {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Logika pengiriman email reset
            echo "<script>alert('Link reset kata sandi telah dikirim ke email Anda.');</script>";
        } else {
            echo "<script>alert('Email tidak ditemukan.');</script>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Reset Password</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Reset Password</h2>
        <form method="post" action="">
            <input type="email" name="email" placeholder="Masukkan email Anda" required>
            <button type="submit">Kirim Link Reset</button>
        </form>
        <p><a href="login.php">Kembali ke login</a></p>
    </div>
</body>
</html>
