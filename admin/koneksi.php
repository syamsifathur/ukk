<?php 
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'toko_online';

$koneksi = new mysqli($host, $username, $password, $database);

if ($koneksi->connect_error) {
    die('Connection failed: ' . $koneksi->connect_error);
}
?>
