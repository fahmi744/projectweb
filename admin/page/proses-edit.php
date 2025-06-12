<?php
require_once '../../model/koneksi.php';
$conn = $koneksi->getConnection();

$id = $_POST['id'];
$nama = $_POST['nama'];
$harga = $_POST['harga'];
$gambar = $_POST['gambar'];

$query = "UPDATE produk SET nama='$nama', harga='$harga', gambar='$gambar' WHERE id=$id";
$conn->query($query);

header("Location: ../dashboard.php");
?>
