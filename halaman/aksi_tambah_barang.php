<?php
    include('config/koneksi.php');

    $kode_barang       = $_POST['kode_barang'];
    $nama_barang       = $_POST['nama_barang'];
    $no_barang         = $_POST['no_barang'];
    $stok_submit       = $_POST['stok'];
    $rak               = $_POST['rak'];
    $jenis_barang      = $_POST['nama_jenis_barang'];

    if($_POST['barang_id'] != ''){
        $id_barang     = $_POST['barang_id'];
        $sql_id_barang = "SELECT * FROM barang WHERE id_barang=$id_barang";
        $query_barang  = mysqli_query($db,$sql_id_barang);
        $row_hasil     = mysqli_fetch_assoc($query_barang);
        $temp_stok     = $row_hasil['stok'];
        if($stok_submit < $temp_stok){
            // if($stok_submit < 0){
            //     $results = array(
            //         // 'error' => false,
            //         'response' => 'test',
            //         // 'data' => array(....results of request here ...)
            //      );
            //      echo json_encode($results);
            // }
            $stok           = $temp_stok - $stok_submit;
            $jenis_update   = 1; // untuk transaksi keluar
            $sql_keluar     = "INSERT INTO history(id_barang,kode_barang,no_barang,nama_barang,stok,rak,id_jenis,jenis_update) 
                               VALUES('$id_barang','$kode_barang','$no_barang','$nama_barang','$stok','$rak','$jenis_barang', '$jenis_update')";
            mysqli_query($db,$sql_keluar);
            $sql_update_barang = "UPDATE barang SET kode_barang='$kode_barang', no_barang='$no_barang',nama_barang='$nama_barang', stok='$stok_submit',rak='$rak', id_jenis='$jenis_barang' WHERE id_barang='$id_barang'";
            mysqli_query($db,$sql_update_barang);
        }else if($stok_submit > $temp_stok){
            $stok = $stok_submit - $temp_stok;
            $jenis_update = 2; // untuk transaksi masuk 
            $sql_masuk     = "INSERT INTO history(id_barang,kode_barang,no_barang,nama_barang,stok,rak,id_jenis,jenis_update) 
                               VALUES('$id_barang','$kode_barang','$no_barang','$nama_barang','$stok','$rak','$jenis_barang', '$jenis_update')";
            mysqli_query($db,$sql_masuk);
            $sql_update_barang = "UPDATE barang SET kode_barang='$kode_barang',no_barang='$no_barang',nama_barang='$nama_barang', stok='$stok_submit',rak='$rak', id_jenis='$jenis_barang' WHERE id_barang='$id_barang'";
            mysqli_query($db,$sql_update_barang);
        }else if($stok_submit == $temp_stok){
            $sql_update_barang    = "UPDATE barang SET kode_barang='$kode_barang',no_barang='$no_barang',nama_barang='$nama_barang', stok='$stok_submit',rak='$rak', id_jenis='$jenis_barang' WHERE id_barang='$id_barang'";
            mysqli_query($db,$sql_update_barang);
        }else{
            $stok = 0;
            // $message = "wrong answer";
            // echo "<script type='text/javascript'>alert('$message');</script>";
        }
        
    }else{
        mysqli_query($db,"INSERT INTO barang(kode_barang,no_barang,nama_barang,stok,rak,id_jenis) VALUES
        ('$kode_barang','$no_barang','$nama_barang', '$stok_submit',$rak,'$jenis_barang')");
        $jenis_update = 2; // transaksi masuk 
        $sql_masuk     = "INSERT INTO history(id_barang,kode_barang,no_barang,nama_barang,stok,rak,id_jenis,jenis_update) 
                            VALUES('$id_barang','$kode_barang','$no_barang','$nama_barang','$stok_submit','$rak','$jenis_barang', '$jenis_update')";
        mysqli_query($db,$sql_masuk);
    }
?>