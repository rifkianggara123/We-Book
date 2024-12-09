<?php
session_start();
include 'config.php';

$conn = new mysqli($host, $username, $password, $dbname);

// Cek koneksi database
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Menambahkan item ke favorit
if (isset($_GET['action']) && $_GET['action'] === 'add' && isset($_GET['id']) && is_numeric($_GET['id'])) {
    $buku_id = intval($_GET['id']);
    $session_id = session_id();

    // Periksa apakah buku sudah ada di favorit
    $stmt = $conn->prepare("SELECT * FROM favorit WHERE session_id = ? AND buku_id = ?");
    $stmt->bind_param("si", $session_id, $buku_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Buku sudah ada di favorit
        header("Location: favorit.php");
    } else {
        // Tambahkan buku ke favorit
        $stmt = $conn->prepare("INSERT INTO favorit (session_id, buku_id, jumlah) VALUES (?, ?, 1)");
        $stmt->bind_param("si", $session_id, $buku_id);
        $stmt->execute();
    }
    $stmt->close();
    header("Location: favorit.php");
    exit();
}

// Menghapus item dari favorit
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id']) && is_numeric($_GET['id'])) {
    $buku_id = intval($_GET['id']);
    $session_id = session_id();

    // Hapus buku dari favorit
    $stmt = $conn->prepare("DELETE FROM favorit WHERE session_id = ? AND buku_id = ?");
    $stmt->bind_param("si", $session_id, $buku_id);
    $stmt->execute();
    $stmt->close();
    header("Location: favorit.php");
    exit();
}

// Ambil data buku di favorit
$session_id = session_id();
$stmt = $conn->prepare("SELECT f.jumlah, b.id AS buku_id, b.judul, b.deskripsi, b.harga, b.gambar
                        FROM favorit f
                        JOIN buku b ON f.buku_id = b.id
                        WHERE f.session_id = ?");
$stmt->bind_param("s", $session_id);
$stmt->execute();
$result = $stmt->get_result();

$cart = [];
while ($row = $result->fetch_assoc()) {
    $cart[] = $row;
}
$stmt->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favorit</title>
    <link rel="stylesheet" href="favorit.css">
</head>
<body>
<div class="container">
    <header>
        <h1>Favorit</h1>
    </header>
    <div class="heart">
        <div class="heart-items">
            <h2>Daftar Favorit</h2>
            <?php if (empty($cart)): ?>
                <p>Favorit Anda kosong.</p>
            <?php else: ?>
                <ul>
                    <?php foreach ($cart as $item): ?>
                    <li>
                        <img src="images/<?php echo htmlspecialchars($item['gambar']); ?>" alt="<?php echo htmlspecialchars($item['judul']); ?>" class="item-image">
                        <div class="item-details">
                            <h3><?php echo htmlspecialchars($item['judul']); ?></h3>
                            <p><?php echo htmlspecialchars($item['deskripsi']); ?></p>
                            <p>Rp <?php echo number_format($item['harga'], 0, ',', '.'); ?></p>
                            <p>Jumlah: <?php echo $item['jumlah']; ?></p>
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
