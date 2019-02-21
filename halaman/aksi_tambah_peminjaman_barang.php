<?php
    include('config/koneksi.php');
    $barang_id              = $_POST['barang_id'];
    $jumlah_peminjaman      = $_POST['stok'];
    $id_user                = $_POST['id_user'];
    $status                 = 1; // untuk status peminjaman
    $sql_id_barang          = "SELECT * FROM barang WHERE id_barang=$barang_id";
    $query_barang           = mysqli_query($db,$sql_id_barang);
    $row_hasil              = mysqli_fetch_assoc($query_barang);
    $temp_stok              = $row_hasil['stok'];

    $stok                   = $temp_stok - $jumlah_peminjaman;
    $sql_peminjaman         = "INSERT INTO peminjaman(id_peminjaman,id_barang,jumlah_peminjaman,tanggal_peminjaman,tanggal_pengembalian,status,id_user) 
                               VALUES(NULL,'$barang_id','$jumlah_peminjaman',now(),NULL,'$status','$id_user')";
    mysqli_query($db,$sql_peminjaman);
    $sql_update_barang = "UPDATE barang SET stok ='$stok'  WHERE id_barang='$barang_id'";
    mysqli_query($db,$sql_update_barang);
    // $last_id = mysqli_insert_id($db);
    $sql_history_peminjaman         = "INSERT INTO history_peminjaman(id_peminjaman,status) 
                               VALUES(LAST_INSERT_ID(),'$status')";
    mysqli_query($db,$sql_history_peminjaman);

?>