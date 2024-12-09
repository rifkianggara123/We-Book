<?php
session_start();

// Jika tombol logout ditekan, hapus sesi dan redirect
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Menghapus sesi dan menghancurkan sesi
    session_unset();
    session_destroy();

    // Redirect ke halaman login setelah logout
    header("Location: index.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 90%;
            max-width: 400px;
        }

        h2 {
            margin-bottom: 10px;
            color: #333;
        }

        p {
            color: #555;
            margin-bottom: 20px;
        }

        button {
            background-color: #f44336;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #d32f2f;
        }

        a {
            display: inline-block;
            margin-top: 15px;
            color: #2196f3;
            text-decoration: none;
            font-size: 1rem;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
    <script>
        // Konfirmasi saat pengguna mengklik tombol logout
        function confirmLogout() {
            return confirm("Apakah Anda yakin ingin keluar?");
        }
    </script>
</head>
<body>
    <div class="container logout-confirmation">
        <h2>Logout</h2>
        <p>Apakah Anda yakin ingin keluar?</p>
        <!-- Form logout -->
        <form method="POST" onsubmit="return confirmLogout();">
            <button type="submit">Ya, Keluar</button>
        </form>
        <a href="welcome.php">Batal</a>
    </div>
</body>
</html>
