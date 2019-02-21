<?php
    include('config/koneksi.php');

    $jenis_barang_nama      = $_POST['jenis_barang_nama'];
  

   
    if($_POST['barang_id_jenis'] != ''){
        // $id_jenis     = $_POST['barang_id_jenis'];
        $sql_id_jenis = "UPDATE jenis_barang SET jenis_barang = '$jenis_barang_nama' WHERE id_jenis = '".$_POST["barang_id_jenis"]."'";
        $query_jenis  = mysqli_query($db,$sql_id_jenis);

        
    }else{
        mysqli_query($db,"INSERT INTO jenis_barang(jenis_barang) VALUES
        ('$jenis_barang_nama')");
        
    }
?>