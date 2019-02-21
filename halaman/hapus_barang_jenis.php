<?php
    include('config/koneksi.php');
    $id_hapus_barang = $_POST['hapus_jenis_id'];
    $query_hapus = "DELETE FROM jenis_barang where id_jenis=$id_hapus_barang";
    $hasil_hapus = mysqli_query($db,$query_hapus);
    
?>