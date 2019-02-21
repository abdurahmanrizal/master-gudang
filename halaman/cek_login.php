<?php
// mengaktifkan session pada php
session_start();
 
// menghubungkan php dengan koneksi database
include 'config/koneksi.php';
 
// menangkap data yang dikirim dari form login
$username = $_POST['username'];
$password = $_POST['password'];
// $devpass  = "abdurahman13"; 
 
// menyeleksi data user dengan username dan password yang sesuai
$login = mysqli_query($db,"select * from users where username='$username' and password='$password'");
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($login);
 
// cek apakah username dan password di temukan pada database
if($cek > 0){
 
	$data = mysqli_fetch_assoc($login);
 
	// cek jika user login sebagai admin
	if($data['level']=="admin" ){
		
		session_start();
		// buat session login dan username
		$_SESSION['username']   = $username;
		$data['level'] = "admin";
		$_SESSION['level'] = $data['level'];
		// $_SESSION['divisi'] = "gubernur";
		// alihkan ke halaman dashboard admin
		// header("location:http://akpol.ac.id/gudang-master/index_tampilan.php");
		header("location:http://localhost/gudang-master/index_tampilan.php");
		
 
	// cek jika user login sebagai pegawai
	}else if($data['level']=="user"){
		session_start();
		$data['level'] = "user";
		$_SESSION['level'] = $data['level'];
		// buat session login dan username
		$_SESSION['username'] = $username;
		// $_SESSION['divisi'] = "pegawai";
		// alihkan ke halaman dashboard pegawai
		// header("location:http://akpol.ac.id/gudang-master/index_tampilan.php");
		header("location:http://localhost/gudang-master/index_tampilan.php");
    }else{
 
		// alihkan ke halaman login kembali
		// header("location:http://akpol.ac.id/gudang-master/index.php?level=tidak ditemukan");
		header("location:http://localhost/gudang-master/index.php?level=tidak ditemukan");
	}	
}else{
	// header("location:http://akpol.ac.id/gudang-master/index.php?pesan=gagal");
	header("location:http://localhost/gudang-master/index.php?pesan=gagal");
	
}
 
?>