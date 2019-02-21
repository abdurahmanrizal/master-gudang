<?php
    include('config/koneksi.php');
    $id_hapus_user = $_POST['hapus_user'];
    $query_hapus = "DELETE FROM users where id_user=$id_hapus_user";
    $hasil_hapus = mysqli_query($db,$query_hapus);
    
?>