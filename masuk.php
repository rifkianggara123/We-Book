<?php
require 'config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute([':username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: welcome.php");
        } else {
            echo "<script>alert('Username atau password salah.');</script>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        /* Global Styles */
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #A52A2A, #4C3228);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background-color: #fff;
            border-radius: 10px;
            padding: 40px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
            font-size: 2rem;
        }

        input {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 2px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        input:focus {
            border-color: #8B6C5C;
            outline: none;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color:#A52A2A;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 1.2rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #8B6C5C;
        }

        .links p {
            font-size: 0.9rem;
            color: #555;
        }

        .links a {
            color: #A52A2A;
            text-decoration: none;
        }

        .links a:hover {
            text-decoration: underline;
        }

        /* Responsiveness for mobile */
        @media (max-width: 480px) {
            .login-container {
                padding: 20px;
                width: 90%;
            }

            h2 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form method="post" action="">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <div class="links">
            <p>Belum mempunyai akun? <a href="daftar.php">Daftar sekarang</a></p>
            <p>Lupa kata sandi? <a href="reset_password.php">Reset di sini</a></p>
            <p>Kembali Ke Menu Utama <a href="index.html">Kembali</a></p>
        </div>
    </div>
</body>
</html>
