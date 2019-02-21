<?php
    include('config/koneksi.php');
    $id_hapus_barang = $_POST['hapus_barang_id'];
    $query_hapus = "DELETE FROM barang where id_barang=$id_hapus_barang";
    $hasil_hapus = mysqli_query($db,$query_hapus);
    
?>