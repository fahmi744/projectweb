<?php
require_once '../model/auth.php';

header('Content-Type: application/json');

$auth = new Auth();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request method.'
    ]);
    exit;
}

try {
    // ambil data
    $email = $_POST['email'] ?? ''; // ganti dari email ke username
    $password = $_POST['password'] ?? '';

    // panggil model
    $login = $auth->login($email, $password);

    if ($login) {
        echo json_encode([
            'success' => true,
            'level'   => $_SESSION['level'] // info level kalau mau pakai untuk redirect di JS nanti
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Username atau password salah.'
        ]);
    }

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Server error: ' . $e->getMessage()
    ]);
}
?>
 