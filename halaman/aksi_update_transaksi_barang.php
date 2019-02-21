<?php
    include('config/koneksi.php');
    $id_barang          = $_POST['barang_id'];
    $id_peminjaman      = $_POST['barang_id_peminjaman'];
    $stok               = $_POST['stok'];
    $id_user            = $_POST['id_user'];
    $tanggal_create     = $_POST['tanggal_create'];
    $sql_id_peminjaman      = "SELECT * FROM peminjaman WHERE id_peminjaman =$id_peminjaman";
    $query_barang_pinjaman  = mysqli_query($db,$sql_id_peminjaman);
    $row_hasil              = mysqli_fetch_assoc($query_barang_pinjaman);
    $barang_pinjaman        = $row_hasil['jumlah_peminjaman'];
    $tmp_stok               = $row_hasil['temp_stok'];
    $status = 0; // status pengembalian
    $sql_jumlah_barang       = "SELECT * FROM barang WHERE id_barang =$id_barang";   
    $query_jumlah_barang     = mysqli_query($db,$sql_jumlah_barang);
    $row_hasil_jumlah_barang = mysqli_fetch_assoc($query_jumlah_barang);
    $jumlah_stok_barang      = $row_hasil_jumlah_barang['stok'];
    $hasil_jumlah_data_barang = $jumlah_stok_barang + $stok;
    $pengurangan = ($barang_pinjaman - $stok);
    if($stok == $barang_pinjaman){
        // $status = 0; // status pengembalian
        // $result = $tmp_stok + $stok;
        if($jumlah_stok_barang == 0){
            $sql_update_peminjaman  = "UPDATE peminjaman SET temp_stok='$stok',tanggal_pengembalian= now(), status=$status WHERE id_peminjaman=$id_peminjaman";
            mysqli_query($db,$sql_update_peminjaman);
            $sql_update_data_barang = "UPDATE barang SET stok=$stok WHERE id_barang=$id_barang";
            mysqli_query($db,$sql_update_data_barang);
            $sql_insert_history_peminjaman = "INSERT INTO history_peminjaman(id_peminjaman,status) VALUES('$id_peminjaman','0')";
        }else{
            $sql_update_peminjaman  = "UPDATE peminjaman SET temp_stok='$stok',tanggal_pengembalian= now(), status=$status WHERE id_peminjaman=$id_peminjaman";
            mysqli_query($db,$sql_update_peminjaman);
            $sql_update_data_barang = "UPDATE barang SET stok=$hasil_jumlah_data_barang WHERE id_barang=$id_barang";
            mysqli_query($db,$sql_update_data_barang);
            $sql_insert_history_peminjaman = "INSERT INTO history_peminjaman(id_peminjaman,status) VALUES('$id_peminjaman','0')";
        }
    }else if($stok < $barang_pinjaman){
        // $sql_update_peminjaman = "UPDATE peminjaman SET jumlah_peminjaman=($barang_pinjaman - $stok),temp_stok=$result,tanggal_pengembalian= now() WHERE id_peminjaman=$id_peminjaman";
        
       
        // jika hasil stok di data barang berjumlah 0 
        if($jumlah_stok_barang == 0){
            $sql_update_peminjaman = "UPDATE peminjaman SET temp_stok=$stok,tanggal_pengembalian= now(), status=$status 
                                  WHERE id_peminjaman=$id_peminjaman";
            mysqli_query($db,$sql_update_peminjaman);
            $sql_update_data_barang = "UPDATE barang SET stok= $stok WHERE id_barang=$id_barang";
            mysqli_query($db,$sql_update_data_barang);
            $sql_temp_insert_peminjaman = "INSERT INTO peminjaman(id_barang,jumlah_peminjaman,temp_stok,tanggal_peminjaman,tanggal_pengembalian, status, id_user)
                                       VALUES('$id_barang', '$pengurangan',0, '$tanggal_create', now(), 1,'$id_user')";
            mysqli_query($db,$sql_temp_insert_peminjaman);
            $sql_insert_history_peminjaman = "INSERT INTO history_peminjaman(id_peminjaman,status) VALUES('$id_peminjaman', 0)";
            mysqli_query($db,$sql_insert_history_peminjaman);
        }else{
            $sql_update_peminjaman = "UPDATE peminjaman SET temp_stok=$stok,tanggal_pengembalian= now(), status=$status 
                                  WHERE id_peminjaman=$id_peminjaman";
            mysqli_query($db,$sql_update_peminjaman);
            $sql_update_data_barang = "UPDATE barang SET stok=$hasil_jumlah_data_barang WHERE id_barang=$id_barang";
            mysqli_query($db,$sql_update_data_barang);
            $sql_temp_insert_peminjaman = "INSERT INTO peminjaman(id_barang,jumlah_peminjaman,temp_stok,tanggal_peminjaman,tanggal_pengembalian, status, id_user)
                                       VALUES('$id_barang', '$pengurangan','($barang_pinjaman - $stok)', '$tanggal_create', now(), 1,'$id_user')";
            mysqli_query($db,$sql_temp_insert_peminjaman);
            $sql_insert_history_peminjaman = "INSERT INTO history_peminjaman(id_peminjaman,status) VALUES('$id_peminjaman', 0)";
            mysqli_query($db,$sql_insert_history_peminjaman);
        }
    }
?>