<?php
session_start();
include 'config.php';

$conn = new mysqli($host, $username, $password, $dbname);

// Cek koneksi database
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Menambahkan buku ke favorit
if (isset($_GET['action']) && $_GET['action'] === 'add' && isset($_GET['id']) && is_numeric($_GET['id'])) {
    $buku_id = intval($conn->real_escape_string($_GET['id']));
    $session_id = session_id();

    // Periksa apakah buku sudah ada di favorit
    $sql = "SELECT * FROM favorit WHERE session_id = '$session_id' AND buku_id = $buku_id";
    $result = $conn->query($sql);
    
    if ($result->num_rows === 0) {
        // Jika belum ada, tambahkan buku ke favorit
        $sql = "INSERT INTO favorit (session_id, buku_id) VALUES ('$session_id', $buku_id)";
        if ($conn->query($sql) === TRUE) {
            header("Location: sukai.php"); // Redirect ke halaman favorit
            exit();
        } else {
            die("Error: " . $conn->error); // Menampilkan error jika query gagal
        }
    }
}

// Menghapus buku dari favorit
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id']) && is_numeric($_GET['id'])) {
    $buku_id = intval($conn->real_escape_string($_GET['id']));
    $session_id = session_id();

    // Hapus item dari favorit
    $sql = "DELETE FROM favorit WHERE session_id = '$session_id' AND buku_id = $buku_id";

    if ($conn->query($sql) === TRUE) {
        header("Location: sukai.php"); // Redirect ke halaman favorit
        exit();
    } else {
        die("Error: " . $conn->error); // Menampilkan error jika query gagal
    }
}

// Ambil data buku di favorit
$session_id = session_id();
$sql = "SELECT b.id AS buku_id, b.judul, b.deskripsi, b.harga, b.gambar
        FROM favorit f
        JOIN buku b ON f.buku_id = b.id
        WHERE f.session_id = '$session_id'"; // SQL query updated
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favorit</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
    <header>
        <h1>Favorit</h1>
    </header>
    <div class="heart">
        <div class="heart-items">
            <h2>Daftar Favorit</h2>
            <?php if (empty($heart)): ?>
                <p>Favorit Anda kosong.</p>
            <?php else: ?>
                <ul>
                    <?php foreach ($heart as $item): ?>
                    <li>
                        <img src="images/<?php echo htmlspecialchars($item['gambar']); ?>" alt="<?php echo htmlspecialchars($item['judul']); ?>" class="item-image">
                        <div class="item-details">
                            <h3><?php echo htmlspecialchars($item['judul']); ?></h3>
                            <p><?php echo htmlspecialchars($item['deskripsi']); ?></p>
                            <p>Rp <?php echo number_format($item['harga'], 0, ',', '.'); ?></p>
                        </div>
                        <a href="?action=delete&id=<?php echo $item['buku_id']; ?>" class="remove-item">Hapus</a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>
</div>
<a href="koleksibuku.php" class="btn-kembali">Kembali</a>
</body>
</html>
