<?php
include('configadmin.php');

// Proses jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];
    $gambar = $_POST['gambar'];

    // Query untuk memasukkan data ke tabel produk
    $sql = "INSERT INTO buku (judul, deskripsi, harga, gambar, created_at) 
            VALUES ('$judul', '$deskripsi', '$harga', '$gambar', NOW())";

    if ($conn->query($sql) === TRUE) {
        echo "<p style='color: green;'>buku berhasil ditambahkan!</p>";
    } else {
        echo "<p style='color: red;'>Error: " . $sql . "<br>" . $conn->error . "</p>";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Buku</title>
    <link rel="stylesheet" href="style.css">
    <style>
    /* General styles */
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }

    h1 {
        font-size: 2em;
        color: #333;
    }

    /* Form container */
    .form-container {
        width: 80%;
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
        background-color: white;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        margin-top: 50px;
    }

    label {
        font-size: 1.2em;
        color: #333;
        margin-bottom: 5px;
        display: inline-block;
    }

    input[type="text"],
    input[type="number"],
    textarea {
        width: 100%;
        padding: 10px;
        margin: 8px 0 20px 0;
        border-radius: 5px;
        border: 1px solid #ccc;
        box-sizing: border-box;
    }

    textarea {
        resize: vertical;
        height: 100px;
    }

    input[type="submit"] {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 1em;
    }

    input[type="submit"]:hover {
        background-color: #45a049;
    }

    /* Link styling */
    a {
        text-decoration: none;
        color: #4CAF50;
        font-size: 1.2em;
    }

    a:hover {
        text-decoration: underline;
    }
    </style>
</head>

<body>
    <div class="form-container">
        <h1>Tambah Buku Baru</h1>
        <form method="POST" action="create.php">
            <label for="judul">Judul:</label>
            <input type="text" id="judul" name="judul" required><br><br>

            <label for="deskripsi">Deskripsi:</label>
            <textarea id="deskripsi" name="deskripsi" required></textarea><br><br>

            <label for="harga">Harga:</label>
            <input type="number" id="harga" name="harga" step="0.01" required><br><br>

            <label for="gambar">Gambar:</label>
            <input type="blob" id="gambar" name="gambar" required><br><br>

            <input type="submit" value="Tambah Produk">
        </form>
        <br>
        <a href="read.php">Kembali ke Daftar Produk</a>
    </div>
</body>

</html>