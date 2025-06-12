<?php
require_once '../model/koneksi.php';

$query = "
    SELECT cart.id, produk.nama, produk.harga, produk.gambar, cart.quantity
    FROM cart
    JOIN produk ON cart.produk_id = produk.id
";
$result = $conn->query($query);

while ($row = $result->fetch_assoc()) {
    echo '<div>';
    echo '<img src="../img/' . htmlspecialchars($row['gambar']) . '" width="100">';
    echo '<p>' . htmlspecialchars($row['nama']) . '</p>';
    echo '<p>Rp ' . number_format($row['harga'], 0, ',', '.') . '</p>';
    echo '<p>Jumlah: ' . $row['quantity'] . '</p>';
    echo '</div>';
}
?>
