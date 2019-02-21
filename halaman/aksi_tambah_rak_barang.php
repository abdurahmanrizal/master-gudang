<?php
    include('config/koneksi.php');

    $rak      = $_POST['rak'];
  

   
    if($_POST['barang_id_rak'] != ''){
        // $id_jenis     = $_POST['barang_id_jenis'];
        $sql_id_rak = "UPDATE rak SET nama_rak = '$rak' WHERE id_rak = '".$_POST["barang_id_rak"]."'";
        $query_rak  = mysqli_query($db,$sql_id_rak);

        
    }else{
        mysqli_query($db,"INSERT INTO rak(nama_rak) VALUES
        ('$rak')");
        
    }
?>