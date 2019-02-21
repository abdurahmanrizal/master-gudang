<?php
    include('config/koneksi.php');
    $id_jenis     = $_POST['barang_jenis_id'];
    $query_edit = "SELECT * FROM jenis_barang WHERE id_jenis = $id_jenis";

    $hasil = mysqli_query($db,$query_edit);
    $row_hasil = mysqli_fetch_array($hasil);
    echo json_encode($row_hasil);

?>