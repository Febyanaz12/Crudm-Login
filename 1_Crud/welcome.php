<?php
session_start(); // Start session nya

// Kita cek apakah user sudah login atau belum
// Cek nya dengan cara cek apakah terdapat session username atau tidak
if( ! isset($_SESSION['username'])){ // Jika tidak ada session username berarti dia belum login
  header("location: index2.php"); // Kita Redirect ke halaman index.php karena belum login
}
?>

<html>
<head>
  <title>Halaman Setelah Login</title>
</head>
<body>
  <h1>Selamat datang <?php echo $_SESSION['nama']; ?></h1>
  <h4>Anda berhasil login ke dalam aplikasi</h4>
  
  <a href="logout.php">Logout</a>
</body>
</html>