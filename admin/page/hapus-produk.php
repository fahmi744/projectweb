<?php
require_once '../../model/koneksi.php';
$conn = $koneksi->getConnection();

$id = $_GET['id'];
$conn->query("DELETE FROM produk WHERE id=$id");

header("Location: ../dashboard.php");
?>
