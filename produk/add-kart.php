<?php
session_start();
require_once '../model/koneksi.php';

if (!isset($_SESSION['user_id'])) {
    // Kalau belum login
    echo json_encode(['success' => false, 'message' => 'Anda harus login dulu']);
    exit;
}

$user_id = $_SESSION['user_id'];

// Ambil product_id dari request, misal POST
$product_id = $_POST['product_id'] ?? null;

if (!$product_id) {
    echo json_encode(['success' => false, 'message' => 'Produk tidak valid']);
    exit;
}

$conn = (new koneksi())->getConnection();

// Cek produk ada atau tidak (optional tapi disarankan)
$stmtCheck = $conn->prepare("SELECT id FROM products WHERE id = ?");
$stmtCheck->bind_param('i', $product_id);
$stmtCheck->execute();
$resultCheck = $stmtCheck->get_result();

if ($resultCheck->num_rows === 0) {
    echo json_encode(['success' => false, 'message' => 'Produk tidak ditemukan']);
    exit;
}

// Insert ke cart
$stmt = $conn->prepare("INSERT INTO cart (users_id, product_id, quantity) VALUES (?, ?, 1)");
$stmt->bind_param('ii', $user_id, $product_id);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Produk berhasil ditambahkan ke keranjang']);
} else {
    echo json_encode(['success' => false, 'message' => 'Gagal menambahkan produk ke keranjang']);
}
?>
