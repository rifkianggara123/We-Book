<?php
include('configadmin.php');

// Ambil ID produk dari URL
$id = $_GET['id'];

// Ambil data produk berdasarkan ID dari database
$sql = "SELECT * FROM buku WHERE id = $id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

// Jika data ditemukan, lanjutkan dengan proses update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_produk = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];
    $gambar = $_POST['gambar'];

    // Proses update data produk tanpa gambar
    $update_sql = "UPDATE buku SET judul='$judul', deskripsi='$deskripsi', harga='$harga', gambar='$gambar' WHERE id=$id";
    
    if ($conn->query($update_sql) === TRUE) {
        echo "<script>alert('buku berhasil diupdate!'); window.location.href = 'read.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Produk</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .container {
        background-color: #fff;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        width: 60%;
    }

    h1 {
        text-align: center;
        font-size: 24px;
        margin-bottom: 20px;
    }

    form {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    label {
        font-size: 16px;
        margin-bottom: 5px;
    }

    input[type="text"],
    input[type="number"] {
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    button {
        padding: 10px;
        background-color: #4caf49;
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
    }

    button:hover {
        background-color: #45a049;
    }

    .cancel-btn {
        background-color: #45a049;
        margin-top: 10px;
        text-align: center;
    }

    .cancel-btn:hover {
        background-color: #45a060;
    }
    </style>
</head>

<body>
    <div class="container">
        <h1>Update Produk</h1>

        <!-- Form untuk mengedit data produk -->
        <form action="update.php?id=<?php echo $id; ?>" method="POST">
            <label for="judul">Judul</label>
            <input type="text" id="judul" name="judul" value="<?php echo $row['judul']; ?>" required>

            <label for="deskripsi">Deskripsi</label>
            <input type="text" id="deskripsi" name="deskripsi" value="<?php echo $row['deskripsi']; ?>" required>

            <label for="harga">Harga</label>
            <input type="number" id="harga" name="harga" value="<?php echo $row['harga']; ?>" required>

            <label for="gambar">Gambar</label>
            <input type="blob" id="gambar" name="gambar" value="<?php echo $row['gambar']; ?>" required>

            <button type="submit">Update Produk</button>
            <a href="read.php" class="cancel-btn"><button type="button">Batal</button></a>
        </form>
    </div>
</body>

</html>