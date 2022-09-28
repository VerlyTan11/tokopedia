<?php  ?>
<!DOCTYPE html>
<html>
<head>
	<title>SIGN UP</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Yellowtail&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300;400&display=swap" rel="stylesheet">
</head>
<style type="text/css">
	* {font-family: 'Poppins', sans-serif;}

	.container {
		width: 700px;
		height: 450px;
		border: 1px solid #ddd;
		border-radius: 10px;
		box-shadow: 2px 2px 2px 2px #03AC0E;
		margin-top: 30px;
		padding-top: 30px;
	}

	.judul {
		font-size: 40px;
		font-family: 'Yellowtail', cursive;
		color: #03AC0E;
		margin-left: 30px;
	}

	.text {
		font-family: 'Poppins', sans-serif;
		font-size: 30px;
		font-weight: bold;
		text-decoration: none;
		color: black;
	}

	.text:hover {
		text-decoration: none;
		color: #03AC0E;
	}

	.active {
		border-bottom: 2px solid #03AC0E;
		text-decoration: none;
		color: black;
	}

	.text1 {
		border-bottom: 1px solid #03AC0E;
		width: 500px;
		margin-top: 20px;
		margin-left: 100px;
	}

	.btn-success {
		border-radius: 5px;
		margin-top: 40px;
		margin-left: 300px;
	}

	.btn-success:hover {
		color: #03AC0E;
		background-color: white;
	}

	.form-check-inline {
		margin-top: 20px;
		margin-left: 155px;
	}

	.footer {
	  	font-family: 'Roboto Condensed', sans-serif;
	  	font-weight: bold;
	  	font-size: 30px;
	  	margin-left: 30px;
	  	margin-bottom: 10px;
	  }

	  input {
	  	width: 500px;
	  }

	input {border: none;}
</style>
<body>
	<form action="regist1save.php" method="GET">
		<div class="judul">Lapak Kita</div>
		<div class="container">
			<center>
				<a href="regist1.php" class="text active" style="margin-top: 50px;">SIGN UP   </a>
				<a href="regist.php" class="text">|   SIGN IN</a>
			</center>
			<div class="text1" style="margin-top: 80px;">
				<input type="text" name="kodeuser" id="kodeuser" placeholder="Masukkan Kode User Anda">
			</div>
			<div class="text1">
				<input type="text" name="nama" id="nama" placeholder="Masukkan Nama Anda">
			</div>
			<div class="form-check form-check-inline" style="padding-left: 20px;">
				<input class="form-check-input" type="radio" name="status" id="status" value="wanita">
				<label class="form-check-label" for="status">Wanita</label>
			</div>
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" name="status" id="status" value="pria">
				<label class="form-check-label" for="status">Pria</label>
			</div>
			<div class="text1">
				<input type="password" name="pass" id="pass" placeholder="Masukkan Password Anda">
			</div>
			<button type="submit" class="btn btn-success" id="cmd" name="cmd" value="save">SIGN UP</button>
		</div>
		<center>
			<div class="footer" style="font-size: 20px; margin-top: 50px;">&copy;2009 - 2021 | PT. Lapak Kita.</div>
		</center>
	</form>
</body>
</html>