<?php 
session_start();

// hancurkan $_SESSION['pelanggan']
session_destroy();

echo "<script>alert('anda telah log out');</script>";
echo "<script>location='index.php';</script>";
?>