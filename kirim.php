<?php
session_start();
include 'koneksi.php';

$kodeuser = $_SESSION['kodeuser'];
$foto = $_GET['foto'];
$no = $_GET['no'];

$sql = "update tbjual set bukti='$foto' where kodeuser = '$kodeuser' and no = '$no'";
$query = mysqli_query($conn,$sql) or die($sql);



?>