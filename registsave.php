<?php 

session_start();
include 'koneksi.php';

$kodeuser = $_POST['kodeuser'];
$pass = md5($_POST['pass']);

$sql = "select * from tbuser where kodeuser='$kodeuser' and pass='$pass'";
$query = mysqli_query($conn,$sql) or die($sql);
$num = mysqli_num_rows($query);
$result = mysqli_fetch_array($query);

echo $kodeuser;

if($num == 1) {
	$_SESSION['kodeuser'] = $kodeuser;
	$_SESSION['pass'] = $pass;

	header("location:home.php");
	
}else{
 ?>

 	<script type="text/javascript">
 		location.href = "regist.php";
 		alert("Maaf, anda tidak memiliki akses login");
 	</script>
<?php
}
?>