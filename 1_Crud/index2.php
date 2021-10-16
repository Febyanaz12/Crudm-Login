<?php
session_start(); // Start session nya

// Kita cek apakah user sudah login atau belum
// Cek nya dengan cara cek apakah terdapat session username atau tidak
if(isset($_SESSION['username'])){ // Jika session username ada berarti dia sudah login
  header("location: welcome.php"); // Kita Redirect ke halaman welcome.php
}
?>

<html>
<head>
  <title>Halaman Sebelum Login</title>
</head>
<body>
  <h1>Silahkan login terlebih dahulu...</h1>
  
  <div style="color: red;margin-bottom: 15px;">
    <?php
    // Cek apakah terdapat cookie dengan nama message
    if(isset($_COOKIE["message"])){ // Jika ada
      echo $_COOKIE["message"]; // Tampilkan pesannya
    }
    ?>
  </div>
  
  <form method="post" action="login.php">
    <label>Username</label><br>
    <input type="text" name="username" placeholder="Username"><br><br>
    
    <label>Password</label><br>
    <input type="password" name="password" placeholder="Password"><br><br>
    
    <button type="submit">Login</button>
  </form>
</body>
</html>