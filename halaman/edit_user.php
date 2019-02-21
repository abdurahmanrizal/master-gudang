<?php
    include('config/koneksi.php');
    $id_user     = $_POST['edit_user_id'];
    $query_edit = "SELECT * FROM users WHERE id_user = $id_user";

    $hasil = mysqli_query($db,$query_edit);
    $row_hasil = mysqli_fetch_array($hasil);
    echo json_encode($row_hasil);

?>