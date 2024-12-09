<?php
// Pastikan Anda sudah menghubungkan file koneksi database di sini
include 'configadmin.php'; // sesuaikan dengan nama file koneksi Anda

// Query untuk mengambil data buku
$query = "SELECT * FROM buku";
$result = mysqli_query($conn, $query);

// Periksa apakah query berhasil
if (!$result) {
    die('Query gagal: ' . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koleksi Buku Populer</title>
    <link rel="stylesheet" href="style.css"> <!-- Pastikan menghubungkan file CSS Anda -->
</head>

<body>

    <section class="dishes" id="populer">
        <h3 class="sub-heading"> Koleksi Buku Kami </h3>
        <h1 class="heading"> Buku Populer </h1>
        <div class="box-container">
        
       <?php
// Menampilkan buku-buku dari database
   while ($row = mysqli_fetch_assoc($result)) {
    echo '<div class="box">';
    echo '<a href="sukai.php" class="fas fa-heart"></a>';
    echo '<img src="' . $row['gambar'] . '" alt="">'; // Gambar buku
    echo '<h3>' . htmlspecialchars($row['judul']) . '</h3>'; // Judul buku
    echo '<p>' . htmlspecialchars($row['deskripsi']) . '</p>'; // Deskripsi buku
    echo '<span>Rp.' . number_format($row['harga'], 0, ',', '.') . '</span>'; // Harga buku
    echo '<a href="keranjang.php?action=add&id=' . $row['id'] . '" class="btn">Tambahkan ke Keranjang</a>';
    echo '</div>';
        }
        ?>

        </div>

        <!-- Tombol Kembali -->
      <a href="indexlogin.html" class="btn-kembali">Kembali ke Menu Utama</a>

    </section>

</body>

</html>
