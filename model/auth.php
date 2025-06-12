<?php
session_start();
require_once 'koneksi.php';

class Auth extends koneksi {

    private $conn;

    public function __construct(){
        parent::__construct();
        $this->conn = $this->getConnection();
    }

    public function login($email, $password){
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0){
            $row = $result->fetch_assoc();

            if (password_verify($password, $row['password'])) {
                $_SESSION['id_pengguna'] = $row['id'];
                $_SESSION['email']       = $row['email'];
                $_SESSION['level']       = $row['level'];
                return true;
            }
        }
        return false;
    }
}
?>
