<?php
require_once '../../model/koneksi.php';
$conn = $koneksi->getConnection();

$nama = $_POST['nama'];
$harga = $_POST['harga'];
$gambar = $_POST['gambar'];

$query = "INSERT INTO produk (nama, harga, gambar) VALUES ('$nama', '$harga', '$gambar')";
$conn->query($query);

header("Location: ../dashboard.php");
?>
