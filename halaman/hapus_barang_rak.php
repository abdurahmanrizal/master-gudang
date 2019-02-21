<?php
    include('config/koneksi.php');
    $id_hapus_rak = $_POST['hapus_rak_id'];
    $query_hapus = "DELETE FROM rak where id_rak=$id_hapus_rak";
    $hasil_hapus = mysqli_query($db,$query_hapus);
    
?>