<div class="container-fluid">

  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Overview</li>
  </ol>

  <!-- Icon Cards-->
  <div class="row">
    <div class="col-xl-4 col-sm-6 mb-3">
      <div class="card text-white bg-primary o-hidden h-100">
        <div class="card-body">
          <div class="card-body-icon">
            <i class="fas fa-box-open"></i>
          </div>
          <div class="mr-5">JUMLAH BARANG</div>
          <div class="mr-5">Tanggal : <?php echo date("d-m-Y");?></div>
        </div>
        <a class="card-footer text-white clearfix small z-1" href="#" id="<?php echo "data_barang";?>">
          <!-- nanti berdasarkan mysqli_num_rows basis data -->
          <?php
            include('config/koneksi.php');
            $sql_barang = "SELECT * FROM barang";
            $query_barang = mysqli_query($db,$sql_barang);
          ?>
          <h6 class="float-left"><?php echo mysqli_num_rows($query_barang);?></h6>
        </a>
      </div>
    </div>
    <div class="col-xl-4 col-sm-6 mb-3">
      <div class="card text-white bg-success o-hidden h-100">
        <div class="card-body">
          <div class="card-body-icon">
            <i class="fas fa-download"></i>
          </div>
          <div class="mr-5">JUMLAH BARANG MASUK</div>
          <div class="mr-5">Tanggal : <?php echo date("d-m-Y");?></div>
        </div>
        <a class="card-footer text-white clearfix small z-1" href="#" id="<?php echo "barang_masuk";?>">
          <!-- nanti berdasarkan mysqli_num_rows basis data -->
          <?php
            include('config/koneksi.php');
            $sql_jenis_barang = "SELECT * FROM history WHERE jenis_update=2";
            $query_jenis_barang = mysqli_query($db,$sql_jenis_barang);
            $tes = 0;
            while($row_jumlah = mysqli_fetch_array($query_jenis_barang)){
                $tes += $row_jumlah['stok'];
            }
          ?>
          <h6 class="float-left"><?php echo $tes;?></h6>
        </a>
      </div>
    </div>
    <div class="col-xl-4 col-sm-6 mb-3">
      <div class="card text-white bg-warning o-hidden h-100">
        <div class="card-body">
          <div class="card-body-icon">
            <i class="fas fa-inbox"></i>
          </div>
          <div class="mr-5">JUMLAH JENIS BARANG</div>
          <div class="mr-5">Tanggal : <?php echo date("d-m-Y");?></div>
        </div>
        <a class="card-footer text-white clearfix small z-1" href="#" id="<?php echo "jenis_barang";?>">
          <!-- nanti berdasarkan mysqli_num_rows basis data -->
          <?php
            include('config/koneksi.php');
            $sql_jenis_barang = "SELECT * FROM jenis_barang";
            $query_jenis_barang = mysqli_query($db,$sql_jenis_barang);
          ?>
          <h6 class="float-left"><?php echo mysqli_num_rows($query_jenis_barang);?></h6>
          
        </a>
      </div>
    </div>
    <div class="col-xl-6 col-sm-6 mb-3">
      <div class="card text-white bg-danger o-hidden h-100">
        <div class="card-body">
          <div class="card-body-icon">
            <i class="fas fa-upload"></i>
          </div>
          <div class="mr-5">JUMLAH BARANG KELUAR</div>
          <div class="mr-5">Tanggal : <?php echo date("d-m-Y");?></div>
        </div>
        <a class="card-footer text-white clearfix small z-1" href="#" id="<?php echo "barang_keluar";?>">
          <!-- nanti berdasarkan mysqli_num_rows basis data -->
          <?php
            include('config/koneksi.php');
            $sql_jenis_barang = "SELECT * FROM history WHERE jenis_update=1";
            $query_jenis_barang = mysqli_query($db,$sql_jenis_barang);
            $tes = 0;
            while($row_jumlah = mysqli_fetch_array($query_jenis_barang)){
                $tes += $row_jumlah['stok'];
            }
          ?>
          <h6 class="float-left"><?php echo $tes;?></h6>
        </a>
      </div>
    </div>
    <div class="col-xl-6 col-sm-6 mb-3">
      <div class="card text-white bg-info o-hidden h-100">
        <div class="card-body">
          <div class="card-body-icon">
            <i class="fas fa-users"></i>
          </div>
          <div class="mr-5">JUMLAH USER</div>
          <div class="mr-5">Tanggal : <?php echo date("d-m-Y");?></div>
        </div>
        <a class="card-footer text-white clearfix small z-1" href="#" id="<?php echo "user";?>">
          <!-- nanti berdasarkan mysqli_num_rows basis data -->
          <?php
            include('config/koneksi.php');
            $sql_user = "SELECT * FROM users";
            $query_user = mysqli_query($db,$sql_user);
          ?>
          <h6 class="float-left"><?php echo mysqli_num_rows($query_user);?></h6>
        </a>
      </div>
    </div>
  </div>
  
</div>