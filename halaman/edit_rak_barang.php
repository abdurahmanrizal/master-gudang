<?php
    include('config/koneksi.php');
    $id_rak     = $_POST['barang_jenis_rak'];
    $query_edit_rak = "SELECT * FROM rak WHERE id_rak = $id_rak";

    $hasil = mysqli_query($db,$query_edit_rak);
    $row_hasil = mysqli_fetch_array($hasil);
    echo json_encode($row_hasil);

?>