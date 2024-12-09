<?php
session_start();
include 'config.php';

$conn = new mysqli($host, $username, $password, $dbname);

// Cek koneksi database
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Menambahkan item ke keranjang
if (isset($_GET['action']) && $_GET['action'] === 'add' && isset($_GET['id']) && is_numeric($_GET['id'])) {
    $buku_id = intval($conn->real_escape_string($_GET['id']));
    $session_id = session_id();
    $jumlah = 1;

    // Periksa apakah buku sudah ada di keranjang
    $sql = "SELECT * FROM keranjang WHERE session_id = '$session_id' AND buku_id = $buku_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Jika buku sudah ada, tingkatkan jumlahnya
        $sql = "UPDATE keranjang SET jumlah = jumlah + 1 WHERE session_id = '$session_id' AND buku_id = $buku_id";
    } else {
        // Jika belum ada, tambahkan entri baru
        $sql = "INSERT INTO keranjang (session_id, buku_id, jumlah) VALUES ('$session_id', $buku_id, $jumlah)";
    }

    if ($conn->query($sql) === TRUE) {
        header("Location: keranjang.php"); // Redirect ke halaman keranjang
        exit();
    } else {
        die("Error: " . $conn->error); // Menampilkan error jika query gagal
    }
}

// Menghapus item dari keranjang
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id']) && is_numeric($_GET['id'])) {
    $buku_id = intval($conn->real_escape_string($_GET['id']));
    $session_id = session_id();

    // Hapus item dari keranjang
    $sql = "DELETE FROM keranjang WHERE session_id = '$session_id' AND buku_id = $buku_id";

    if ($conn->query($sql) === TRUE) {
        header("Location: keranjang.php"); // Redirect ke halaman keranjang
        exit();
    } else {
        die("Error: " . $conn->error); // Menampilkan error jika query gagal
    }
}

// Ambil data buku di keranjang
$session_id = session_id();
$sql = "SELECT k.jumlah, b.id AS buku_id, b.judul, b.harga, b.gambar
        FROM keranjang k
        JOIN buku b ON k.buku_id = b.id
        WHERE k.session_id = '$session_id'";
$result = $conn->query($sql);

$cart = [];
$total = 0;
$discount = 0;

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $cart[] = $row;
        $total += $row['harga'] * $row['jumlah'];
    }

    // Diskon 20% jika total lebih dari Rp 100.000
    if ($total > 100000) {
        $discount = 0.2 * $total;
        $total -= $discount;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
    <link rel="stylesheet" href="keranjang.css">
</head>
<body>
<div class="container">
    <header>
        <h1>Keranjang Belanja</h1>
    </header>
    <div class="cart">
        <div class="cart-items">
            <h2>Daftar Buku</h2>
            <?php if (empty($cart)): ?>
                <p>Keranjang Anda kosong.</p>
            <?php else: ?>
                <ul>
                    <?php foreach ($cart as $item): ?>
                    <li>
                        <img src="<?php echo htmlspecialchars($item['gambar']); ?>" alt="<?php echo htmlspecialchars($item['judul']); ?>" class="item-image">
                        <div class="item-details">
                            <h3><?php echo htmlspecialchars($item['judul']); ?></h3>
                            <p>Rp <?php echo number_format($item['harga'], 0, ',', '.'); ?></p>
                            <p>Jumlah: <?php echo $item['jumlah']; ?></p>
                        </div>
                        <a href="?action=delete&id=<?php echo $item['buku_id']; ?>" class="remove-item">Hapus</a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
        <div class="cart-summary">
            <h2>Ringkasan Keranjang</h2>
            <p><strong>Total Harga:</strong> Rp <?php echo number_format($total + $discount, 0, ',', '.'); ?></p>
            <?php if ($discount > 0): ?>
                <p><strong>Diskon:</strong> -Rp <?php echo number_format($discount, 0, ',', '.'); ?></p>
            <?php endif; ?>
            <p><strong>Subtotal:</strong> Rp <?php echo number_format($total, 0, ',', '.'); ?></p>
            <a href="checkout.php" class="checkout-btn">Checkout</a>
        </div>
    </div>
</div>
 <a href="koleksibuku.php" class="btn-kembali">Kembali</a>

</body>
</html>
