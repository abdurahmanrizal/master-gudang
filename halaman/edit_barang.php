<?php
    include('config/koneksi.php');
    $query_edit = "SELECT * FROM barang LEFT JOIN jenis_barang ON barang.id_jenis = jenis_barang.id_jenis  WHERE id_barang='".$_POST["barang_id"]."'";
    // $query_edit = "SELECT * FROM barang WHERE id_barang='".$_POST["barang_id"]."'";

    $hasil = mysqli_query($db,$query_edit);
    $row_hasil = mysqli_fetch_array($hasil);
    echo json_encode($row_hasil);

?>