<?php 
	include 'koneksi.php';

	function make_query($conn){
    $baner = "SELECT * FROM tbbaner ORDER BY id";
    $qbaner = mysqli_query($conn, $baner);
    return $qbaner;
  }

  function make_slide_indicators($conn){
    $output = '';
    $count = 0;
    $result = make_query($conn);
    while($row = mysqli_fetch_array($result)){
      if($count == 0){
        $output .= '<li data-target="#dynamic_slide" data-slide-to="'.$count.'" class="active"></li>';
      }else{
        $output .= '<li data-target="#dynamic_slide" data-slide-to="'.$count.'"></li>';
      }

      $count = $count + 1;
    }
    return $output;
  }

  function make_slide($conn){
    $output = '';
    $count = 0;
    $result = make_query($conn);
    while($row = mysqli_fetch_array($result)){
      if($count == 0){
        $output .= '<div class="carousel-item active" data-ride="carousel" data-interval="3000">';
      }else{
        $output .= '<div class="carousel-item" data-ride="carousel" data-interval="3000">';
      }
      $output .= '
          <img src="'.$row['nama_file'].'" alt="'.$row['nama_file'].'">
        </div>
      ';
      $count = $count + 1;
    }
    return $output;
  }
?>

<!DOCTYPE html>
<html id="top">
<head>
	<title>Tokopedia</title>
	<link rel="stylesheet"  href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css" integrity="sha384-VCmXjywReHh4PwowAiWNagnWcLhlEJLA5buUprzK8rxFgeH0kww/aWY76TfkUoSX" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Yellowtail&display=swap" rel="stylesheet">
  	 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  	 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
 	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300;400&display=swap" rel="stylesheet">

</head>
<style>
	body {
		font-family: 'Roboto Condensed', sans-serif;
		overflow-x: hidden;
	}

	p {font-size: 12px;}

	html {scroll-behavior: smooth;}

	.line {
		border-left: 3px solid grey;
		height: 40px;
		margin-left: 45px;
		margin-top: 8px;
	}

	.judul {
		font-size: 40px;
		font-family: 'Yellowtail', cursive;
		color: #03AC0E;
	}

	.carousel-inner img {
    	width: 100%;
    	height: 100%;
  	}

  	.text {
	  	font-family: 'Roboto Condensed', sans-serif;
	  	font-weight: bold;
	  	font-size: 30px;
	  	margin-left: 30px;
	  	margin-bottom: 10px;
	  }

	 .pull-right {color: #03AC0E;}

	 .kontainer {
	 	width: 220px;
	 	height: 310px;
	 	margin-left: 60px;
	 	display: flex;
	 	flex-direction: row;
	 	border: 1px solid #ddd;
	 	border-radius: 5px;
	 	cursor: pointer;
	 	margin-right: -30px;
	 }

	 .kontainer:hover {
	 	box-shadow: 2px 2px 2px 2px #03AC0E;
	 	width: 225px;
	 	height: 315px;
	 	position: absolute;
	 }

	 .thumbnail {border: none;}

	 .footer {background-color: #ddd;}
</style>
<body>
	<div class="nav" style="margin-left: 40px; margin-top: 15px;">
		<div class="judul">Lapak Kita</div>
		<nav class="navbar navbar-light" style="margin-left: 35px; margin-right: 35px;">
			<div class="container-fluid">
			<form class="d-flex" style="width: 750px;">
			    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" style="height: 35px; font-size: 18px; margin-top: 7px;">
			    <button class="btn btn-outline-success" type="submit" style="margin-left: 5px; border-radius: 5px; width: 35px; height: 35px; margin-top: 7px; font-size: 15px;"><i class="fa fa-search"></i></button>
			</form>
		</div>
		</nav>
		<img src="cart.png" style="width: 35px; height: 30px; margin-top: 13px; margin-left: -15px; cursor: pointer;">
		<div class="line"></div>
		<a href="regist1.php" type="button" class="btn btn-outline-success" style="font-size: 15px; margin-left: 45px; height: 40px; width: 100px; margin-top: 10px; border-radius: 10px;padding-top: 8px;">REGISTER</a>
	</div>
<div id="dynamic_slide" class="carousel slide" data-ride="carousel">

          <!-- Indicators -->
          <ul class="carousel-indicators">
            <?= make_slide_indicators($conn); ?>
          </ul>
          
          <!-- The slideshow -->
          <div class="carousel-inner">
              <?= make_slide($conn); ?>
          </div>
          
          <!-- Left and right controls -->
          <a class="carousel-control-prev" href="#dynamic_slide" data-slide="prev">
            <span class="carousel-control-prev-icon"></span>
          </a>
          <a class="carousel-control-next" href="#dynamic_slide" data-slide="next">
            <span class="carousel-control-next-icon"></span>
          </a>
  </div>

	<div class="terlaris">
		<br><hr />
		<div class="text">Terlaris</div>
			<div class="row">
					<?php
			        $sql = "SELECT tbjualdetil.kodebarang, tbbarang.nama, tbbarang.hargajual, tbbarang.jlh_stok, tbbarang.satuan, tbbarang.image, tbbarang.ket, sum(tbjualdetil.jlh) from tbjualdetil left join tbbarang on tbjualdetil.kodebarang = tbbarang.kodebarang group by tbbarang.kodebarang order by sum(jlh) desc";
			        $query = mysqli_query($conn,$sql);
			        $num = mysqli_num_rows($query);
			          for($x = 1; $x <= $num; $x++){
				          $result = mysqli_fetch_array($query);
				          $image = $result['image'];
				          $nama = $result['nama'];
				          $jlh_stok = $result['jlh_stok'];
				          $hargajual = $result['hargajual'];
				          $ket = $result['ket'];
			        ?>
			<div class="kontainer" style="position: relative;">
				<div class="thumbnail">
					<img src="<?= $image;?>" alt="">
					<div class="add-to-cart">
				</div>
				<div class="caption">
					<h3 class="pull-right" style="color: black; margin-top: 4px;">Rp. <?= $hargajual;?></h3>
					<h4 style="color: #03AC0E; font-size: 20px; font-weight: bold;"><?= $nama;?></h4>
					<p><?= $ket;?></p>
						<div class="ratings">
							<p class="pull-right">192 Terjual</p>
							<p>
								<img src="star.png">
								<img src="star.png">
								<img src="star.png">
								<img src="star.png">
							</p>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>
		</div>
	</div>

	<div class="terlaris">
		<br><hr />
		<div class="text">Tranding</div>
			<div class="row">
					<?php
			        $sql = "SELECT DISTINCT tbbarang.jenis, tbbarang.image FROM tbjualdetil LEFT JOIN tbbarang ON tbjualdetil.kodebarang = tbbarang.kodebarang WHERE trending='Y' order by tbjualdetil.jlh desc";
			        $query = mysqli_query($conn,$sql);
			        $num = mysqli_num_rows($query);
			          for($x = 1; $x <= $num; $x++){
				          $result = mysqli_fetch_array($query);
				          $jenis = $result['jenis'];
			        ?>
			<div class="kontainer" style="position: relative;">
				<div class="thumbnail">
					<img src="<?= $image;?>" alt="">
					<div class="add-to-cart">
				</div>
				<div class="caption">
					<h3 class="pull-right" style="color: black; margin-top: 4px;">Rp. <?= $hargajual;?></h3>
					<h4 style="color: #03AC0E; font-size: 20px; font-weight: bold;"><?= $nama;?></h4>
					<p><?= $ket;?></p>
						<div class="ratings">
							<p class="pull-right">192 Terjual</p>
							<p>
								<img src="star.png">
								<img src="star.png">
								<img src="star.png">
								<img src="star.png">
							</p>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>
		</div>
	</div>

	<div class="terlaris">
		<br><hr />
		<div class="text">Produk Saya</div>
			<div class="row">
					<?php
			        $sql = "SELECT * from tbbarang";
			        $query = mysqli_query($conn,$sql);
			        $num = mysqli_num_rows($query);
			          for($x = 1; $x <= $num; $x++){
				          $result = mysqli_fetch_array($query);
				          $jenis = $result['jenis'];
				          $nama = $result['nama'];
				          $image = $result['image'];
				          $hargajual = $result['hargajual'];
				          $ket = $result['ket'];
				          $jlh_stok = $result['jlh_stok'];
			        ?>
			<div class="kontainer" style="position: relative;">
				<div class="thumbnail">
					<img src="<?= $image;?>" alt="">
					<div class="add-to-cart">
				</div>
				<div class="caption">
					<h3 class="pull-right" style="color: black; margin-top: 4px;">Rp. <?= $hargajual;?></h3>
					<h4 style="color: #03AC0E; font-size: 20px; font-weight: bold;"><?= $nama;?></h4>
					<p><?= $ket;?></p>
						<div class="ratings">
							<p class="pull-right">192 Terjual</p>
							<p>
								<img src="star.png">
								<img src="star.png">
								<img src="star.png">
								<img src="star.png">
							</p>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>
		</div>
	</div>

	<br><hr />

	<div class="footer">
		<div class="judul" style="margin-left: 70px; font-size: 50px;">Lapak Kita</div>
		<div class="text" style="margin-left: 500px; font-size: 20px; margin-top: -50px;">&copy;2009 - 2021 | PT. Lapak Kita.</div>
		<img src="android.png" style="width: 200px; margin-left: 900px; margin-top: -70px;">
		<img src="app.png" style=" width: 170px; margin-top: -70px;">
	</div>
</body>
</html>