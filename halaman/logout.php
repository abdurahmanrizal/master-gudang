<?php
session_start();
unset($_SESSION["username"]);  // where $_SESSION["nome"] is your own variable. if you do not have one use only this as follow session_unset();
// header("location:http://akpol.ac.id/gudang-master/index.php");
header("location:http://localhost/gudang-master/index.php");
?>