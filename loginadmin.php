<?php
session_start();
include('configadmin.php');

// Proses login
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Enkripsi password menggunakan MD5

    $sql = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        header("Location: read.php"); // Arahkan ke halaman CRUD
    } else {
        $error_message = "Username atau Password salah!";
    }
}

// Cek apakah pengguna sudah login
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    header("Location: read.php");
    exit;
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

        .error {
            color: red;
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
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
            background-color: #A52A2A;
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

        .btn-back {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #555;
            text-decoration: none;
            font-size: 1rem;
        }

        .btn-back:hover {
            color: #000;
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

        <?php if (isset($error_message)) { ?>
        <div class="error"><?php echo $error_message; ?></div>
        <?php } ?>

        <form method="POST" action="">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Login</button>
        </form>

        <!-- Tombol Kembali -->
        <a href="index.html" class="btn-back">Kembali ke Menu Utama</a>
    </div>
</body>
</html>
