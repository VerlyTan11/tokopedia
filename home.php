<?php 
	include 'koneksi.php';
	include 'secure.php';

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
 if(isset($_SESSION['kodeuser'])){
    $kodeuser = $_SESSION['kodeuser'];
  }else{
    $kodeuser = '';
  }

$sqljual = "select * from tbjual";
$queryjual = mysqli_query($conn,$sqljual);
$numjual = mysqli_num_rows($queryjual)+1;
$no = "$numjual";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Lapak Kita</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Yellowtail&display=swap" rel="stylesheet">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300;400&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@500&family=Dosis:wght@300&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&display=swap" rel="stylesheet">

</head>
<style>
	body {font-family: 'Roboto Condensed', sans-serif; overflow-x: hidden;}

	p {font-size: 12px;}

	html {scroll-behavior: smooth;}

	.line {
		border-left: 3px solid grey;
		height: 40px;
		margin-left: 35px;
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

	 .detail {
	 	width: 1360px;
	 	height: 190px;
	 	background-color: #eee;
	 	padding: 5px;
	 }

	.detail img {
	 	width: 400px;
	 	height: 400px;
	 	margin-top: 80px;
	 	margin-left: 70px;
	 }

	 .bawah {
	 	color: black;
	 	display: flex;
	 	flex-direction: column;
	 	margin-top: 120px;
	 	width: 500px;
	 	float: right;
	 	margin-left: 100px;
	 }

	 .bawah input {
	 	font-size: 20px;
	 	border: none;
	 }

	.box {
	 	width: 95%;
	 	height: 560px;
	 	background-color: white;
	 	margin-left: 30px;
	 	margin-top: 20px;
	 	position: absolute;
	 }

	h1 {
		font-family: 'Comfortaa', cursive;
	 	margin-left: 600px;
	 	margin-top: -400px;
	 	font-size: 40px;
	}

	.bintang {
		width: 500px;
		height: 500px;
		display: flex;
		direction: row;
		margin-left: 550px;
	}

	.bintang p {
		font-family: 'Dosis', sans-serif;
		font-size: 20px;
		margin-left: 54px;
		margin-top: -10px;
		display: flex;
		direction: row;
		height: 50px;
		width: 100px;
	}

	.bintang h2 {
		margin-top: 280px;		
		color: #03AC0E;
		font-size: 35px;
		margin-left: -300px;
		position: relative;
	}

	.desk h3 {
		font-family: 'Dosis', sans-serif;
		margin-left: -170px;
		font-size: 20px;
		display: flex;
		direction: column;
	}

	.tambah img{
		width: 25px;
		height: 25px;
		margin-top: 290px;
		cursor: pointer;
	}

	.btn-outline-success:hover{
		background-color: #eee;
		color : black;
		cursor: pointer;
	}

	.back {
		width: 100px;
		height: 50px;
		margin-top: -150px;
		margin-left: 100px;
		z-index: 100;
		position: fixed;
	}

	.kotak {
		width: 96%;
		height:150px;
		background-color: white;
		margin-left: 30px;
		margin-top: 20px;
		border-radius: 15px;
	}

	.kotak img {
		width: 115px;
		height: 120px;
		margin-top: 13px;
	}

	.samping {
		height: 150px;
		width: 1070px;
		background-color: transparent;
		margin-left: 225px;
		margin-top: -125px;
		border-radius: 15px;
	}

	.samping h2 {
		font-family: 'Dosis', sans-serif;
		font-weight: bold;
		font-size: 25px;
		margin-top: 55px;
		position: absolute;
		margin-left: 30px;
	}

	.akhir {
		float: right;
		width: 350px;
		height: 250px;
		margin-right: 50px;
		margin-top: -250px;
		border-radius: 10px;
		box-shadow: 2px 3px 3px 3px #ddd;
		padding: 5px;
		font-family: 'Noto Sans JP', sans-serif;
	}

	.borderkotak {
		align-items: center;
		width: 800px;
		height: 500px;
		box-shadow: 2px 3px 3px 3px #108f18;
		border-radius: 10px;
		margin-left: 300px;
	}
</style>
<script>
	function view(kodeuser,kodebarang,nama) {
	  var nama = document.getElementById('nama').value;
	  var cmd = document.getElementById('cmd').value;
	  var url = "cari.php?kodeuser="+kodeuser+"&kodebarang="+kodebarang+"&nama="+nama+"&cmd=view";

	  var xhttp;
	    if (window.XMLHttpRequest) {
	      xhttp = new XMLHttpRequest();
	    }else{
	      xhttp = new ActiveXObject("Microsoft.XMLHTTP");
	    }

	  xhttp.onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
	      var data = this.responseText;
	      data = data.split("#");
	      document.getElementById('div_data').innerHTML = data;
	      
	    }
	  };
	  xhttp.open("GET", url, true);
	  xhttp.send();
	}

	function histori(kodeuser, kodebarang) {
	  var url = "histori.php?kodeuser="+kodeuser+"&kodebarang="+kodebarang;

	  var xhttp;
	    if (window.XMLHttpRequest) {
	      xhttp = new XMLHttpRequest();
	    }else{
	      xhttp = new ActiveXObject("Microsoft.XMLHTTP");
	    }

	  xhttp.onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
	      var data = this.responseText;
	      document.getElementById('div_data').innerHTML = data;
	    }
	  }
	  xhttp.open("GET", url, true);
	  xhttp.send();
	}

	function plus(kodebarang, keranjang,jlh_stok){
		var jumlah = document.getElementsByName('jumlah')[keranjang];
		jumlah.value++;
 	 	if (jumlah.value >= jlh_stok) {
  		jumlah.value = jlh_stok;
		}
		var hargajual = document.getElementsByName('hargajual')[keranjang].value;
  		var disc = document.getElementsByName('disc')[keranjang].value;
  		var total = (jumlah.value * hargajual) - (hargajual * disc/100);
  		var total = total.toFixed(0);
  		document.getElementsByName('total')[keranjang].value = total;

  		var jmlh = jumlah.value;

  		var url = "tambah.php?jmlh="+jmlh+"&kodebarang="+kodebarang+"&hargajual="+hargajual+"&total="+total;

	  var xhttp;
	    if (window.XMLHttpRequest) {
	      xhttp = new XMLHttpRequest();
	    }else{
	      xhttp = new ActiveXObject("Microsoft.XMLHTTP");
	    }

	  xhttp.onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
	      var data = this.responseText;
	      document.getElementById('sub').value = data;

	       
	    }
	  }
	  xhttp.open("GET", url, true);
	  xhttp.send();
	}

	function min(kodebarang, keranjang){
		var jumlah = document.getElementsByName('jumlah')[keranjang];
		jumlah.value-=1;
		if (jumlah.value <= 1) {
			jumlah.value = 1;
		}
		var hargajual = document.getElementsByName('hargajual')[keranjang].value;
  		var disc = document.getElementsByName('disc')[keranjang].value;
  		var total = (jumlah.value * hargajual) - (hargajual * disc/100);
  		var total = total.toFixed(0);
  		document.getElementsByName('total')[keranjang].value = total;

  		var jmlh = jumlah.value;

  		var url = "tambah.php?jmlh="+jmlh+"&kodebarang="+kodebarang+"&hargajual="+hargajual+"&total="+total;

	  var xhttp;
	    if (window.XMLHttpRequest) {
	      xhttp = new XMLHttpRequest();
	    }else{
	      xhttp = new ActiveXObject("Microsoft.XMLHTTP");
	    }

	  xhttp.onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
	      var data = this.responseText;
	      document.getElementById('sub').value = data;
	    }
	  }
	  xhttp.open("GET", url, true);
	  xhttp.send();
	}

function add(kodebarang, hargajual, no){
  var no = document.getElementById('no').value;
  var jumlah = document.getElementById('jumlah').value;
  var total = document.getElementById('total').value;
  var hargajual = document.getElementById('hargajual').value;

  var url = "add.php?no="+no+"&kodebarang="+kodebarang+"&jumlah="+jumlah+"&hargajual="+hargajual+"&total="+total;

  var xhttp;
    if (window.XMLHttpRequest) {
      xhttp = new XMLHttpRequest();
    }else{
      xhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    alert('Berhasil Menambahkan Item Ke Keranjang');
    document.getElementById('jumlah').value = 0;
    document.getElementById('total').value = 0;
      
    }
  }
  xhttp.open("GET", url, true);
  xhttp.send();
  
}

function show(kodebarang,no){
  var no = document.getElementById('no').value;

  var url = "show.php?no="+no+"&kodebarang="+kodebarang;

  var xhttp;
    if (window.XMLHttpRequest) {
      xhttp = new XMLHttpRequest();
    }else{
      xhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var data = this.responseText;
      data = data.split("#");
      document.getElementById('div_data').innerHTML = data[0];
      
    }
  }
  xhttp.open("GET", url, true);
  xhttp.send();
}

function pluss(jlh_stok) {
  var jumlah = document.getElementById('jumlah');

  jumlah.value ++;
  if (jumlah.value >= jlh_stok) {
  jumlah.value = jlh_stok;
}
  var harga = document.getElementById('hargajual').value;
  var disc = document.getElementById('disc').value;
  var total = (jumlah.value * harga) - (harga * disc/100);
  var total = total.toFixed(0);
  document.getElementById('total').value = total;
}

function mins() {
  var jumlah = document.getElementById('jumlah');

  jumlah.value -= 1;
  if (jumlah.value <= 1){
  jumlah.value = 1;
	}
  var harga = document.getElementById('hargajual').value;
  var disc = document.getElementById('disc').value;
  var total = (jumlah.value * harga) - (harga * disc/100);
  var total = total.toFixed(0);
  document.getElementById('total').value = total;
}

function f_beli(){
  var url = "fbeli.php";

  var xhttp;
    if (window.XMLHttpRequest) {
      xhttp = new XMLHttpRequest();
    }else{
      xhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var data = this.responseText;
      document.getElementById('div_data').innerHTML = data;
      
    }
  }
  xhttp.open("GET", url, true);
  xhttp.send();
}

function f_order(){
  var url = "forder.php";

  var xhttp;
    if (window.XMLHttpRequest) {
      xhttp = new XMLHttpRequest();
    }else{
      xhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var data = this.responseText;
      document.getElementById('div_data').innerHTML = data;
      
    }
  }
  xhttp.open("GET", url, true);
  xhttp.send();
}
function f_proses(no,tgl,kodeuser,kodebarang,sub,ongkir,grandtotal){
  var namapenerima = document.getElementById('namapenerima').value;
  var notelp = document.getElementById('notelp').value;
  var provinsi = document.getElementById('provinsi').value;
  var kota = document.getElementById('kota').value;
  var kodepos = document.getElementById('kodepos').value;
  var alamat = document.getElementById('alamat').value;
  var metode = document.querySelector('input[name ="metode"]:checked');
  var pilih = metode.value;
  var cmd = document.getElementById('proses').value;
  var url = "";

  if(pilih == 'COD'){
    var url = "beli.php?no="+no+"&tgl="+tgl+"&kodeuser="+kodeuser+"&kodebarang="+kodebarang+"&sub="+sub+"&namapenerima="+namapenerima+"&notelp="+notelp+"&provinsi="+provinsi+"&kota="+kota+"&kodepos="+kodepos+"&alamat="+alamat+"&sub="+sub+"&ongkir="+ongkir+"&pilih="+pilih+"&grandtotal="+grandtotal+"&cmd=Proses";
  }
  if(pilih == 'Transfer'){
    var url = "transfer.php?no="+no+"&tgl="+tgl+"&kodeuser="+kodeuser+"&kodebarang="+kodebarang+"&sub="+sub+"&namapenerima="+namapenerima+"&notelp="+notelp+"&provinsi="+provinsi+"&kota="+kota+"&kodepos="+kodepos+"&alamat="+alamat+"&sub="+sub+"&ongkir="+ongkir+"&pilih="+pilih+"&grandtotal="+grandtotal+"&cmd=Proses";
  }

  var xhttp;
    if (window.XMLHttpRequest) {
      xhttp = new XMLHttpRequest();
    }else{
      xhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var data = this.responseText;
      alert('Berhasil Melakukan Pembelian');
      document.getElementById('div_data').innerHTML = data;
      
    }
  }
  xhttp.open("GET", url, true);
  xhttp.send();
}

var countDownDate = new Date("Feb 3, 2021").getTime();

var x = setInterval(function() {

  var now = new Date().getTime();
  
  var distance = countDownDate - now;
    
  // Time calculations for days, hours, minutes and seconds
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
  // Output the result in an element with id="demo"
  document.getElementById("demo").innerHTML = hours + "h "
  + minutes + "m " + seconds + "s ";
    
  // If the count down is over, write some text 
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("demo").innerHTML = "EXPIRED";
  }
}, 1000);

function kirim(no){
  var foto = document.getElementById("foto").files[0].name; 
  var url = "kirim.php?foto="+foto+"&no="+no;

  var xhttp;
    if (window.XMLHttpRequest) {
      xhttp = new XMLHttpRequest();
    }else{
      xhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var data = this.responseText;
      alert('Berhasil Mengirim Bukti Transfer');
      
    }
  }
  xhttp.open("GET", url, true);
  xhttp.send();
}
</script>
<body>
	<div class="nav" style="margin-left: 30px; margin-top: 12px;">
		<div class="judul">Lapak Kita</div>
		<nav class="navbar navbar-light" style="margin-left: 10px; margin-right: 35px;">
			<div class="container-fluid">
			<form class="d-flex" style="width: 750px;">
			    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" style="height: 35px; font-size: 18px; margin-top: 7px;" id="nama" name="nama" onkeyup="view()">
			    <button class="btn btn-outline-success" type="button" style="margin-left: 5px; border-radius: 5px; width: 38px; height: 35px; margin-top: 7px; font-size: 15px;" onclick="view()" id="cmd" name="cmd" value="Search"><i class="fa fa-search"></i></button>
			</form>
		</div>
		</nav>
		<?php
      $sqlbarang = "select * from tbbarang";
      $querybarang = mysqli_query($conn,$sqlbarang);
      $numbarang = mysqli_num_rows($querybarang);
      for($x = 1; $x <= 1; $x++){
      $result = mysqli_fetch_array($querybarang);
      $kodebarang = $result['kodebarang'];
      $nama = $result['nama'];

      ?>
		<img src="cart.png" style="width: 35px; height: 30px; margin-top: 17px; margin-left: -25px; cursor: pointer;" onclick="show(<?= $kodebarang; ?>)">
	<?php } ?>
		<div class="line" style="margin-top: 14px;"></div>

		<h3 style="font-size: 25px; margin-top: 18px; font-family: 'Roboto Condensed', sans-serif; margin-left: 35px;">
			<?php 
			$user = $_SESSION['kodeuser'];
			$sql = "SELECT * from tbuser where kodeuser='$user'";
			$query = mysqli_query($conn,$sql);
		    $num = mysqli_num_rows($query);
		    	for($x = 1; $x <= 1; $x++){
		    	$result = mysqli_fetch_array($query);
		    	$namauser = $result['nama'];
			 ?>

			 <?= $namauser; }?>
		</h3>

		<a href="logout.php"><img src="logout.png" style="width: 35px; height: 35px; margin-top: 16px; font-weight: bolder; margin-left: 35px;"></a>
	</div>
<br>
	<div id="div_data">
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

  	<input type="hidden" id="no" value="<?= $no; ?>">

	<div class="terlaris">
		<br><hr />
		<div class="text">Terlaris</div>
			<div class="row">
					<?php
			        $sql = "select tbjualdetil.kodebarang, tbjualdetil.jlh, tbbarang.nama, tbbarang.hargajual, tbbarang.jlh_stok, tbbarang.satuan, tbbarang.image, tbbarang.ket, tbbarang.kodebarang, tbbarang.disc, tbbarang.merk, sum(tbjualdetil.jlh) as jlh from tbjualdetil left join tbbarang on tbjualdetil.kodebarang = tbbarang.kodebarang group by tbbarang.kodebarang order by sum(jlh) desc";
			        $query = mysqli_query($conn,$sql);
			        $num = mysqli_num_rows($query);
			          for($x = 1; $x <= $num; $x++){
				          $result = mysqli_fetch_array($query);
				          $kodebarang = $result['kodebarang'];
				          $image = $result['image'];
				          $nama = $result['nama'];
				          $jlh_stok = $result['jlh_stok'];
				          $hargajual = $result['hargajual'];
				          $ket = $result['ket'];
				          $jlh = $result['jlh'];
				          $disc = $result['disc'];
				          $merk = $result['merk'];
				          $satuan = $result['satuan'];
			        ?>
			        <?php 
							$jlh = $result['jlh'];

							  if($jlh <= 5){
							  	$kali = '<img src="star.png">';
							  }elseif ($jlh <= 10) {
							  	$kali = '
							  	<img src="star.png">
							  	<img src="star.png">
							  	';
							  }elseif ($jlh <= 20) {
							  	$kali = '
							  	<img src="star.png">
							  	<img src="star.png">
							  	<img src="star.png">
							  	';
							  }elseif ($jlh <= 50) {
							  	$kali = '
							  	<img src="star.png">
							  	<img src="star.png">
							  	<img src="star.png">
							  	<img src="star.png">
							  	';
							  }elseif ($jlh >= 50) {
							  	$kali = '
							  	<img src="star.png">
							  	<img src="star.png">
							  	<img src="star.png">
							  	<img src="star.png">
							  	<img src="star.png">
							  	';  
							  }

			         ?>
			<div class="kontainer" style="position: relative; width: 18%; height: 50%;" onclick="histori(<?= $kodeuser; ?> , <?= $kodebarang; ?>)">
				<div class="thumbnail">
					<img src="<?= $image;?>" style="width: 100%; padding-bottom: 10px; padding-top: 10px;">
					<div class="add-to-cart">
				</div>
				<div class="caption">
					<h3 class="pull-right" style="color: black; margin-top: 4px;">Rp. <?= $hargajual;?></h3>
					<h4 style="color: #03AC0E; font-size: 20px; font-weight: bold;"><?= $nama;?></h4>
					<p><?= $ket;?></p>
						<div class="ratings">
							<p class="pull-right"><?= $jlh;?> Terjual</p>
							<p><?= $kali;?></p>
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
			        $sql = "select DISTINCT tbbarang.jenis, tbbarang.image,tbbarang.ket, tbbarang.kodebarang FROM tbjualdetil LEFT JOIN tbbarang ON tbjualdetil.kodebarang = tbbarang.kodebarang WHERE trending='Y' order by tbjualdetil.jlh desc";
			        $query = mysqli_query($conn,$sql);
			        $num = mysqli_num_rows($query);
			          for($x = 1; $x <= $num; $x++){
				          $result = mysqli_fetch_array($query);
				          $kodebarang = $result['kodebarang'];
				          $jenis = $result['jenis'];
				          $ket = $result['ket'];
				          $image = $result['image'];
				  
			        ?>
			       
			<div class="kontainer" style="position: relative; width: 18%; height: 50%;" onclick="histori(<?= $kodeuser; ?> , <?= $kodebarang; ?>)">
				<div class="thumbnail">
					<img src="<?= $image;?>" style="width: 100%; padding-bottom: 10px; padding-top: 10px;">
					<div class="add-to-cart">
				</div>
				<div class="caption">
					<h4 style="color: #03AC0E; font-size: 20px; font-weight: bold;"><?= $jenis;?></h4>
					<p><?= $ket;?></p>
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
			        $sql = "select * from tbbarang";
			        $query = mysqli_query($conn,$sql);
			        $num = mysqli_num_rows($query);
			          for($x = 1; $x <= $num; $x++){
				          $result = mysqli_fetch_array($query);
				          $kodebarang = $result['kodebarang'];
				          $jenis = $result['jenis'];
				          $nama = $result['nama'];
				          $image = $result['image'];
				          $hargajual = $result['hargajual'];
				          $ket = $result['ket'];
				          $jlh_stok = $result['jlh_stok'];				          
			        ?>
			        
			<div class="kontainer" style="position: relative; width: 18%; height: 50%;" onclick="histori(<?= $kodeuser; ?> , <?= $kodebarang; ?>)">
				<div class="thumbnail">
					<img src="<?= $image;?>" style="width: 100%; padding-bottom: 10px; padding-top: 10px;">
					<div class="add-to-cart">
				</div>
				<div class="caption">
					<h3 class="pull-right" style="color: black; margin-top: 4px;">Rp. <?= $hargajual;?></h3>
					<h4 style="color: #03AC0E; font-size: 20px; font-weight: bold;"><?= $nama;?></h4>
					<p><?= $ket;?></p>
						<div class="ratings">
							<p class="pull-right"><?= $jlh_stok;?> Stok</p>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>
		</div>
	</div>

	<div class="terlaris">
		<br><hr />
		<div class="text">Terakhir Dilihat</div>
			<div class="row">
					<?php
					if(isset($_SESSION['kodeuser'])){
					$user = $_SESSION['kodeuser'];
			        $sql = "select * from tbhistori left join tbbarang on tbhistori.kodebarang = tbbarang.kodebarang where tbhistori.kodeuser='$user' order by updated_at desc";

			        $query = mysqli_query($conn,$sql);
			        $num = mysqli_num_rows($query);
			          for($x = 1; $x <= $num; $x++){
				          $result = mysqli_fetch_array($query);
				          $kodebarang = $result['kodebarang'];
				          $jenis = $result['jenis'];
				          $nama = $result['nama'];
				          $image = $result['image'];
				          $hargajual = $result['hargajual'];
				          $ket = $result['ket'];
				          $jlh_stok = $result['jlh_stok'];
			        

						?>
			<div class="kontainer" style="position: relative; width: 18%; height: 50%;" onclick="histori(<?= $kodeuser; ?> , <?= $kodebarang; ?>)">
				<div class="thumbnail">
					<img src="<?= $image;?>" style="width: 100%; padding-bottom: 10px; padding-top: 10px;">
					<div class="add-to-cart">
				</div>
				<div class="caption">
					<h3 class="pull-right" style="color: black; margin-top: 4px;">Rp. <?= $hargajual;?></h3>
					<h4 style="color: #03AC0E; font-size: 20px; font-weight: bold;"><?= $nama;?></h4>
					<p><?= $ket;?></p>
						<div class="ratings">
							<p class="pull-right"><?= $jlh_stok;?> Stok</p>
						</div>
					</div>
				</div>
			</div>
		<?php } }?>
		</div>
	</div>

	<input type="hidden" id="kodeuser" name="kodeuser" value="<?= $kodeuser; ?>">

	<br><hr />

	<div class="footer">
		<div class="judul" style="margin-left: 70px; font-size: 50px;">Lapak Kita</div>
		<div class="text" style="margin-left: 500px; font-size: 20px; margin-top: -50px;">&copy;2009 - 2021 | PT. Lapak Kita.</div>
		<img src="android.png" style="width: 200px; margin-left: 900px; margin-top: -70px;">
		<img src="app.png" style=" width: 170px; margin-top: -70px;">
	</div>
	</div>
</body>
</html>