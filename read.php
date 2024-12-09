<?php
session_start();

// Cek apakah pengguna sudah login
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("Location: login.php");
    exit;
}

include('configadmin.php');

// Ambil semua data produk dari database
$sql = "SELECT * FROM buku";
$result = $conn->query($sql);

// Cek jika ada produk yang akan dihapus
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    // Hapus data produk dari database
    $delete_sql = "DELETE FROM buku WHERE id = ?";
    $delete_stmt = $conn->prepare($delete_sql);
    $delete_stmt->bind_param('i', $delete_id);
    $delete_stmt->execute();

    // Redirect ke halaman daftar produk
    header("Location: read.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk</title>
    <style>
        /* Styling dasar */
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
            height: 90%;
            width: 90%;
            overflow-x: auto;
        }

        h1 {
            text-align: center;
            font-size: 70px;
            font-family: times;
            color: #A52A2A;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #ccc;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        a {
            text-align: center;
            display: block;
            margin-top: 20px;
            text-decoration: none;
            color: #007BFF;
        }

        a:hover {
            text-decoration: underline;
        }

        .btn {
            padding: 5px 10px;
            margin: 2px;
            color: white;
            text-decoration: none;
            border-radius: 30px;
            font-size: 14px;
        }

        .btn-update {
            background-color: #4CAF50;
        }

        .btn-delete {
            background-color: #f44336;
        }

        .btn-update:hover {
            background-color: #45a049;
        }

        .btn-delete:hover {
            background-color: #e53935;
        }

        /* Styling untuk pesan greeting */
        .greeting {
            font-size: 18px;
            color: #333;
            margin: 20px;
            padding: 10px;
            background-color: #f8f8f8;
            border-radius: 5px;
            display: inline-block;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Styling untuk link Logout */
        .logout-link {
            color: #f44336;
            font-weight: bold;
            text-decoration: none;
            margin-left: 10px;
        }

        .logout-link:hover {
            color: #d32f2f;
            text-decoration: underline;
        }

        /* Styling untuk gambar */
        .product-image {
            width: 100px;
            height: auto;
            max-height: 100px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Daftar Buku WeBook</h1>

        <p class="greeting">Halo, <?php echo $_SESSION['username']; ?>! <a href="logoutadmin.php" class="logout-link">Logout</a></p>

        <?php
        // Cek jika ada data produk
        if ($result->num_rows > 0) {
            // Tampilkan data produk dalam tabel
            echo "<table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Judul</th>
                            <th>Deskripsi</th>
                            <th>Harga</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>";

            // Loop untuk menampilkan data setiap baris
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row['id'] . "</td>
                        <td>" . $row['judul'] . "</td>
                        <td>" . $row['deskripsi'] . "</td>
                        <td>" . number_format($row['harga'], 2, ',', '.') . "</td>";

                // Menampilkan gambar jika ada
                echo "<td><img src='" . (empty($row['gambar']) ? 'default.jpg' : $row['gambar']) . "' alt='Gambar Produk' class='product-image'></td>";

                // Menampilkan tombol aksi
                echo "<td>
                        <a href='update.php?id=" . $row['id'] . "' class='btn btn-update'>Update</a>
                        <a href='read.php?delete_id=" . $row['id'] . "' class='btn btn-delete' onclick='return confirm(\"Anda yakin ingin menghapus produk ini?\")'>Delete</a>
                    </td>
                </tr>";
            }

            echo "</tbody></table>";
        } else {
            echo "<p>Tidak ada produk yang tersedia.</p>";
        }
        ?>

        <br>
        <a href="create.php">Tambah Produk Baru</a>

    </div>
</body>

</html>

<?php
// Tutup koneksi database
$conn->close();
?>
