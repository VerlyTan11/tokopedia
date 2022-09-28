<?php 

session_start();
$kodeuser = $_SESSION['kodeuser'];

if ($kodeuser == "") {
	 header("location:regist1.php");
}

 ?>