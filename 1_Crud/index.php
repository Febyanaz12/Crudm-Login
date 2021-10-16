<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD PHP</title>
    <!-- Load File bootstrap.min.css yang ada difolder css -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    f<style>
    .align-middle{
      vertical-align: middle !important;
    }
    </style>
    <script src="bootstrap/js/jquery.min.js"></script>
  </head>
  <body>
    <!-- Membuat Menu Header / Navbar -->
    <nav class="navbar navbar-inverse" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#" style="color: white;"><b>FEBYAN AZRIEL</b></a>
        </div>
        <p class="navbar-text navbar-right hidden-xs" style="color: white;padding-right: 10px;">
          FOLLOW US ON  
          <a target="_blank" style="background: #3b5998; padding: 0 5px; border-radius: 4px; color: #f7f7f7; text-decoration: none;" href="https://www.facebook.com/febyan.azriel.16/">Facebook</a> 
          <a target="_blank" style="background: #d34836; padding: 0 5px; border-radius: 4px; color: #ffffff; text-decoration: none;" href="https://www.instagram.com/febyanaz12/">Instagram</a>
          <a target="_blank" style="background: #fff; padding: 0 5px; border-radius: 4px; color: #d34836; text-decoration: none;" href="https://www.youtube.com/channel/UCXewITkcry-deGZVLpZ-hCg">YouTube</a>
        </p>
      </div>
    </nav>
    
    <div style="padding: 0 15px;">
      <!--
      -- Buat sebuah div dengan class row
      -- class row ini berfungsi untuk membagi-bagi layar
      -- di dalam bootstrap, 1 layar penuh (dari kiri ke kanan) dibagi menjadi 12 bagian / Kolom
      -- Atau lebih tepatnya sering disebut dengan GRID
      -- col-xs-12 artinya jika ukuran layar < 768px, maka gunakan 12 kolom
      -- col-sm-6 artinya jika ukuran layar >= 768px, maka gunakan 6 kolom
      -- Untuk lebih jelasnya soal Grid, silahkan buka link ini : http://viid.me/qb4V8P
      -->
      <div class="row">
        <div class="col-xs-12 col-sm-6">
          <!--
          -- Input Group adalah salah satu komponen yang disediakan bootstrap
          -- Untuk lebih jelasnya soal Input Group, silahkan buka link ini : http://viid.me/qb4Mup
          -->
          <div class="input-group">
            <!-- Buat 
              sebuah textbox dan beri id keyword -->
            <input type="text" class="form-control" placeholder="Pencarian..." id="keyword">
            
            <span class="input-group-btn">
              <!-- Buat sebuah tombol search dan beri id btn-search -->
              <button class="btn btn-primary" type="button" id="btn-search">SEARCH</button>
              <a href="" class="btn btn-warning">RESET</a>
  
            </span>
          </div>
        </div>
      </div>
      <br>
      
      <!--
      -- Buat sebuah div dengan id="view" yang digunakan untuk menampung data 
      -- yang ada pada tabel siswa di database
      -->
      <div id="view"><?php include "view.php"; ?></div>
    </div>
    
    <!-- Load File jquery.min.js yang ada difolder js -->
    <script src="js/jquery.min.js"></script>
    
    <!-- Load File bootstrap.min.js yang ada difolder js -->
    <script src="js/bootstrap.min.js"></script>
    
    <!-- Load file ajax.js yang ada di folder js -->
    <script src="js/ajax.js"></script>

     <script>
  $(document).ready(function(){ // Ketika halaman sudah siap (sudah selesai di load)
    $("#check-all").click(function(){ // Ketika user men-cek checkbox all
      if($(this).is(":checked")) // Jika checkbox all diceklis
        $(".check-item").prop("checked", true); // ceklis semua checkbox siswa dengan class "check-item"
      else // Jika checkbox all tidak diceklis
        $(".check-item").prop("checked", false); // un-ceklis semua checkbox siswa dengan class "check-item"
    });
    
    $("#btn-delete").click(function(){ // Ketika user mengklik tombol delete
      var confirm = window.confirm("Apakah Anda yakin ingin menghapus data-data ini?"); // Buat sebuah alert konfirmasi
      
      if(confirm) // Jika user mengklik tombol "Ok"
        $("#form-delete").submit(); // Submit form
    });
  });
  </script>
  </body>
</html>