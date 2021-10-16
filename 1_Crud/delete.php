<?php
// Load file koneksi.php
include "koneksi.php";
$id = $_POST['id']; // Ambil data NIS yang dikirim oleh index.php melalui form submit
$query = "DELETE FROM febyan WHERE id IN(".implode(",", $id).")"; // Buat variabel $query untuk menampung query delete
$sql = $pdo->prepare($query);
$sql->execute(); // Eksekusi/Jalankan query dari variabel $query
header("location: index.php"); // Redirect ke halaman index.php
?>