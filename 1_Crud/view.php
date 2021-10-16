<div class="table-responsive">
  <form method="post" action="delete.php" id="form-delete">
  <table class="table table-bordered">
    <tr>
      <th><input type="checkbox" id="check-all"></th>
      <th class="text-center">FOTO</th>
      <th>NIS</th>
      <th>NAMA</th>
      <th>JENIS KELAMIN</th>
      <th>TELP</th>
      <th>ALAMAT</th>
      <th>AKSI</th>
    </tr>
    <?php
    // Include / load file koneksi.php
    include "koneksi.php";
    
    // Cek apakah terdapat data page pada URL
    $page = (isset($_POST['page']))? $_POST['page'] : 1;
    $limit = 3; // Jumlah data per halamannya
    $no = (($page - 1) * $limit) + 1; // Untuk setting awal nomor pada halaman yang aktif
    // Untuk menentukan dari data ke berapa yang akan ditampilkan pada tabel yang ada di database
    $limit_start = ($page - 1) * $limit;
    
    // Cek apakah variabel data search tersedia
    // Artinya cek apakah user telah mengklik tombol search atau belum
    if(isset($_POST['search']) && $_POST['search'] == true){ // Jika ada data search yg dikirim (user telah mengklik tombol search) dan search sama dengan true
      // variabel $keyword ini berasal dari file search.php,
      // dimana isinya adalah apa yang diinput oleh user pada textbox pencarian
      $param = '%'.$keyword.'%';
      
      // Buat query untuk menampilkan data siswa berdasarkan NIS / Nama / Jenis Kelamin / Telp / Alamat
      // dan sesuai limit yang ditentukan
      $sql = $pdo->prepare("SELECT * FROM febyan WHERE id LIKE :ni OR nama LIKE :na OR jenis_kelamin LIKE :jk OR telp LIKE :t OR alamat LIKE :a LIMIT ".$limit_start.",".$limit);
      $sql->bindParam(':ni', $param);
      $sql->bindParam(':na', $param);
      $sql->bindParam(':jk', $param);
      $sql->bindParam(':t', $param);
      $sql->bindParam(':a', $param);
      $sql->execute(); // Eksekusi querynya
      
      // Buat query untuk menghitung semua jumlah data
      // dengan keyword yang telah di input
      $sql2 = $pdo->prepare("SELECT COUNT(*) AS jumlah FROM febyan WHERE nim LIKE :ni OR nama LIKE :na OR jenis_kelamin LIKE :jk OR telp LIKE :t OR alamat LIKE :a");
      $sql2->bindParam(':ni', $param);
      $sql2->bindParam(':na', $param);
      $sql2->bindParam(':jk', $param);
      $sql2->bindParam(':t', $param);
      $sql2->bindParam(':a', $param);
      $sql2->execute(); // Eksekusi querynya
      $get_jumlah = $sql2->fetch();
    }else{ // Jika user belum mengklik tombol search (PROSES TANPA AJAX)
      // Buat query untuk menampilkan semua data siswa
      $sql = $pdo->prepare("SELECT * FROM febyan LIMIT ".$limit_start.",".$limit);
      $sql->execute(); // Eksekusi querynya
      
      // Buat query untuk menghitung semua jumlah data
      $sql2 = $pdo->prepare("SELECT COUNT(*) AS jumlah FROM febyan");
      $sql2->execute(); // Eksekusi querynya
      $get_jumlah = $sql2->fetch();
    }
    while($data = $sql->fetch()){ // Ambil semua data dari hasil eksekusi $sql
      ?>
      <tr>
        <?php   echo "<td><input type='checkbox' class='check-item' name='id[]' value='".$data['id']."'></td>";
        ?>
        <td><img src="images/<?php echo $data['foto']; ?>" width="80" height="80"></td>
        <td class="align-middle"><?php echo $data['nim']; ?></td>
        <td class="align-middle"><?php echo $data['nama']; ?></td>
        <td class="align-middle"><?php echo $data['jenis_kelamin']; ?></td>
        <td class="align-middle"><?php echo $data['telp']; ?></td>
        <td class="align-middle"><?php echo $data['alamat']; ?></td>
         <?php
              echo "<td><a href='form_ubah.php?id=".$data['id']."'>Ubah</a></td>";
          ?>
      </tr>
      <?php
      $no++;
    }
    ?>
  </table>
  <button type="button" id="btn-delete">DELETE</button>
  <a href="form_simpan.php"><input type="button" value="Tambah Data"></a>
</form>
</div>
<?php
if($sql->rowCount() > 0){ // Jika datanya ada, tampilkan paginationnya
    ?>
    <!--
    -- Buat Paginationnya
    -- Dengan bootstrap, kita jadi dimudahkan untuk membuat tombol-tombol pagination dengan design yang bagus tentunya
    -->
    <ul class="pagination">
      <!-- LINK FIRST AND PREV -->
      <?php
      if($page == 1){ // Jika page adalah page ke 1, maka disable link PREV
      ?>
        <li class="disabled"><a href="#">First</a></li>
        <li class="disabled"><a href="#">&laquo;</a></li>
      <?php
      }else{ // Jika page bukan page ke 1
        $link_prev = ($page > 1)? $page - 1 : 1;
      ?>
        <li><a href="javascript:void(0);" onclick="searchWithPagination(1, false)">First</a></li>
        <li><a href="javascript:void(0);" onclick="searchWithPagination(<?php echo $link_prev; ?>, false)">&laquo;</a></li>
      <?php
      }
      ?>
      
      <!-- LINK NUMBER -->
      <?php
      $jumlah_page = ceil($get_jumlah['jumlah'] / $limit); // Hitung jumlah halamannya
      $jumlah_number = 3; // Tentukan jumlah link number sebelum dan sesudah page yang aktif
      $start_number = ($page > $jumlah_number)? $page - $jumlah_number : 1; // Untuk awal link number
      $end_number = ($page < ($jumlah_page - $jumlah_number))? $page + $jumlah_number : $jumlah_page; // Untuk akhir link number
      
      for($i = $start_number; $i <= $end_number; $i++){
        $link_active = ($page == $i)? ' class="active"' : '';
      ?>
        <li<?php echo $link_active; ?>><a href="javascript:void(0);" onclick="searchWithPagination(<?php echo $i; ?>, false)"><?php echo $i; ?></a></li>
      <?php
      }
      ?>
      
      <!-- LINK NEXT AND LAST -->
      <?php
      // Jika page sama dengan jumlah page, maka disable link NEXT nya
      // Artinya page tersebut adalah page terakhir 
      if($page == $jumlah_page){ // Jika page terakhir
      ?>
        <li class="disabled"><a href="#">&raquo;</a></li>
        <li class="disabled"><a href="#">Last</a></li>
      <?php
      }else{ // Jika Bukan page terakhir
        $link_next = ($page < $jumlah_page)? $page + 1 : $jumlah_page;
      ?>
        <li><a href="javascript:void(0);" onclick="searchWithPagination(<?php echo $link_next; ?>, false)">&raquo;</a></li>
        <li><a href="javascript:void(0);" onclick="searchWithPagination(<?php echo $jumlah_page; ?>, false)">Last</a></li>
      <?php
      }
      ?>
    </ul>
    <?php
}
?>