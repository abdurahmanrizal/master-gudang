<?php
    include('config/koneksi.php');

    $nama_user      = $_POST['nama_user'];
    $username       = $_POST['username'];
    $level          = $_POST['level'];
    $password       = $_POST['password'];

    if($_POST['user_id'] != ''){
        // $id_jenis     = $_POST['barang_id_jenis'];
        $sql_id_user = "UPDATE users SET nama_user = '$nama_user',username ='$username',level='$level',password='password' WHERE id_user = '".$_POST["user_id"]."'";
        $query_user  = mysqli_query($db,$sql_id_user);

        
    }else{
        mysqli_query($db,"INSERT INTO users(nama_user,username,level,password) VALUES
        ('$nama_user', '$username', '$level', '$password')");
        
    }

  
?>