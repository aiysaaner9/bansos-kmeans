<?php
$host = "localhost";
$user = "anerstco_admin";
$pass = "7OaMZO1Vjlb)PY8l";
$db   = "anerstco_db_bansos_kmeans";
$conn = mysqli_connect($host,$user,$pass,$db);
if(!$conn){
    die("Koneksi gagal : ".mysqli_connect_error());
}
date_default_timezone_set('Asia/Jakarta');
?>
