<?php
session_start(); // Start session nya
session_destroy(); // Hapus semua session
header("location: index2.php"); // Redirect ke halaman index.php
?>