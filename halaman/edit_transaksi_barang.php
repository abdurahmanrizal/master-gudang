<?php
    include('config/koneksi.php');
    $id_peminjaman     = $_POST['barang_transaksi_id'];
    $query_edit = "SELECT * FROM peminjaman p LEFT JOIN barang b ON p.id_barang = b.id_barang LEFT JOIN jenis_barang jb ON b.id_jenis = jb.id_jenis WHERE id_peminjaman =$id_peminjaman ";

    $hasil = mysqli_query($db,$query_edit);
    $row_hasil = mysqli_fetch_array($hasil);
    echo json_encode($row_hasil);

?>