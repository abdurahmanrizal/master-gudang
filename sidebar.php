<!-- Sidebar -->
<ul class="sidebar navbar-nav">
      <li class="nav-item">
          <br>
          <h6 class="text-light text-center">MENU</h6>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="#" id="<?php echo "home";?>">
          <i class="fas fa-home"></i>
          <span>Beranda</span>
        </a>
      </li>
      <!-- Data master -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="far fa-folder"></i>
            <span>Data Master</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <a href="#" class="dropdown-item" id="<?php echo "data_barang";?>">
            <i class="fas fa-table"></i>
            <span>Data Barang</span>
          </a>
          <a href="#" class="dropdown-item" id="<?php echo "rak";?>">
            <i class="fas fa-table"></i>
            <span>Data Rak</span>
          </a>
          <a href="#" class="dropdown-item" id="<?php echo "jenis_barang"?>">
            <i class="fab fa-elementor"></i>
            <span>Data Jenis Barang</span>
          </a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#" id="<?php echo "transaksi_peminjaman"; ?>">
          <i class="fas fa-book"></i>
          <span>Transaksi Peminjaman</span>
        </a>
      </li>
      <!-- list data transaksi -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="far fa-folder-open"></i>
            <span>History Transaksi</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <a href="#" class="dropdown-item" id="<?php echo "barang_masuk";?>">
            <i class="fas fa-upload"></i>
            <span>Barang Masuk</span>
          </a>
          <a href="#" class="dropdown-item" id="<?php echo "barang_keluar";?>">
            <i class="fas fa-download"></i>
            <span>Barang Keluar</span>
          </a>
          <a href="#" class="dropdown-item" id="<?php echo "history_peminjaman";?>">
            <i class="fas fa-download"></i>
            <span>Peminjaman</span>
          </a>
          <a href="#" class="dropdown-item" id="<?php echo "history_pengembalian";?>">
            <i class="fas fa-download"></i>
            <span>Pengembalian</span>
          </a>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="#" id="<?php echo "user"; ?>">
          <i class="fas fa-users-cog"></i>
          <span>Manajemen User</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="halaman/logout.php" onclick="confirm('Anda yakin untuk keluar ?');">
          <i class="fas fa-power-off"></i>
          <span>logout</span></a>
      </li>
</ul>