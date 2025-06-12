<?php
// hash.php

$password = '12345'; // Ganti dengan password yang kamu inginkan
$hash = password_hash($password, PASSWORD_DEFAULT);

echo "Password asli: $password<br>";
echo "Hash: <code>$hash</code>";
