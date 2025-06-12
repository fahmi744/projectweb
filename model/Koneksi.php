<?php  
class koneksi {
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $dbname = "dblogin";

    private $conn;

    public function __construct() {
        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->dbname);

        if ($this->conn->connect_error) {
            die('Tidak terhubung ke database: ' . $this->conn->connect_error);
        } else {
            // echo "Terhubung ke database";
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}

$koneksi = new koneksi();
?>
