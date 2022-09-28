<?php 

include 'koneksi.php';

$kodeuser = $_GET['kodeuser'];
$nama = $_GET['nama'];
$status = $_GET['status'];
$pass = md5($_GET['pass']);
$cmd = $_GET['cmd'];

if ($cmd == 'save') {
	$sql = "insert into tbuser(kodeuser, nama, status, pass) values('$kodeuser','$nama','$status','$pass')";
	$query = mysqli_query($conn,$sql) or die($sql);	
}

header("location:regist.php");

 ?>