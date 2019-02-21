<?php
    // $server   = "lumpia";
    // $user     = "akpolac";
    // $passowrd = "w84x3E3wSm";
    // $nama_db  = "akpolac_gudang_baru";
    $server   = "localhost";
    $user     = "root";
    $passowrd = "";
    $nama_db  = "gudang_baru";

    $db       = mysqli_connect($server,$user,$passowrd,$nama_db);

    if(!$db){
        die("Gagal terhubung dengan database: ".mysqli_connect_error());
    }

?>