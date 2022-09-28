<?php
session_start();
include 'koneksi.php';

$sqljual = "select * from tbjual";
$queryjual = mysqli_query($conn,$sqljual);
$numjual = mysqli_num_rows($queryjual)+1;
$no = "$numjual";

$kodeuser = $_SESSION['kodeuser'];
$kodebarang = $_GET['kodebarang'];
$no = $_GET['no'];
$total = $_GET['total'];
$jumlah = $_GET['jumlah'];
$hargajual = $_GET['hargajual'];

$sql = "insert into tempjualdetil(no, kodeuser, kodebarang, jlh, hargajual, total)values('$no', '$kodeuser', '$kodebarang', '$jumlah', '$hargajual', '$total')";
$query = mysqli_query($conn,$sql)or die($sql);

?>