<?php 
	include 'koneksi.php';
	session_start();

	$kodeuser = $_SESSION['kodeuser'];
	$kodebarang = $_GET['kodebarang'];
	$jmlh = $_GET['jmlh'];
	$hargajual = $_GET['hargajual'];
	$total = $_GET['total'];


	$sql = "UPDATE tempjualdetil set jlh='$jmlh', hargajual='$hargajual', total='$total' where kodebarang='$kodebarang' and kodeuser='$kodeuser'";
	$query = mysqli_query($conn,$sql);

	$sql1 = "SELECT * from tempjualdetil where kodeuser='$kodeuser'";
	$query1 = mysqli_query($conn,$sql1);

	$sub = 0;
	while ($res = mysqli_fetch_array($query1)) {
		$total = $res['total'];
		$sub += $total;
	}
echo "$sub";
	
 ?>