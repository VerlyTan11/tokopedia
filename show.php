<?php
session_start();
include 'koneksi.php';

$sql2 = "SELECT tbbarang.nama, tbbarang.image, tbbarang.hargajual, tbbarang.satuan, tbbarang.kodebarang, tbbarang.disc, tbbarang.ket, tbbarang.merk,tbbarang.jenis, tbbarang.jlh_stok, tempjualdetil.jlh, tempjualdetil.total FROM tempjualdetil LEFT JOIN tbbarang ON tempjualdetil.kodebarang = tbbarang.kodebarang order by tempjualdetil.jlh desc";
$query2 = mysqli_query($conn,$sql2);
$num2 = mysqli_num_rows($query2);

?>

<div class="terlaris">
	<div class="text">Keranjang</div>
</div>
<div class="col" style="margin-top: -5px; margin-left: -15px;">
	<?php
		$sqljual = "select * from tbjual";
        $queryjual = mysqli_query($conn,$sqljual);
        $numjual = mysqli_num_rows($queryjual)+1;
        $no = "$numjual";

        date_default_timezone_set("Asia/Bangkok");
        $tgl = date('Y-m-d');
        $kodeuser = $_SESSION['kodeuser'];

        $sub = 0;
        $keranjang = 0;
		$query2 = mysqli_query($conn,$sql2);
		$num2 = mysqli_num_rows($query2);
		for($x = 1; $x <= $num2; $x++){
		$result = mysqli_fetch_array($query2);
		$kodebarang = $result['kodebarang'];
		$image = $result['image'];
		$nama = $result['nama'];
		$jlh_stok = $result['jlh_stok'];
		$hargajual = $result['hargajual'];
		$ket = $result['ket'];
		$jenis = $result['jenis'];
		$jlh = $result['jlh'];
		$disc = $result['disc'];
		$merk = $result['merk'];
		$satuan = $result['satuan'];
		$total = $result['total'];
	?>
<div class="detail" style="margin-left: -3px;">
	<div class="kotak">
		<img src="<?= $image;?>" style="cursor: pointer;" onclick="histori(<?= $kodeuser ?> , <?= $kodebarang ?>)">
		<div class="samping" style="position: absolute;">
			<h2><?= $nama;?></h2>
			<h2 style=" color: grey; font-size: 23px; margin-left: 165px;"><?= $merk;?></h2>
			<h2 style=" color: grey; font-size: 23px; margin-left: 300px;">&nbsp;<?= $jenis;?></h2>
			<h3 style="margin-left: 530px; margin-top: 10px; font-size: 20px;">Harga Jual : Rp. &nbsp;<input type="text" name="hargajual"  value="<?= $hargajual; ?>" style="border: hidden; background-color: white; color: black;" disabled="disabled"></h3>
			<h3 style="margin-left: 530px; margin-top: 20px; font-size: 20px;">Diskon : &nbsp;<input type="text" name="disc" value="<?= $disc;?>" style="border: hidden; background-color: white; color: black;" disabled="disabled"><h3 style="margin-left: 640px; margin-top: -33px; font-size: 20px;">%</h3></h3>
			<h3 style="margin-left: 530px; margin-top: 20px; font-size: 20px;">Total : Rp. &nbsp;<input type="text" name="total"  value="<?= $total;?>" style="border: hidden; background-color: white; color: black;" disabled="disabled"></h3></div>

	        <div class="tambah" style="margin-left: 1030px; margin-top: -73px; position: absolute;"> 
	          <img src="minus.png" style="margin-left: 35px; width: 25px; height: 25px;" onclick="min(<?= $kodebarang; ?>,<?= $keranjang; ?>)">
	          <h3><input type="text" class="form-control" name="jumlah" style="width: 50px; text-align: center; font-size: 13px; margin-left: 67px; margin-top: -28px;" value="<?= $jlh; ?>"></h3>
	          <img src="add.png" style="margin-top: -74px; margin-left: 125px; width: 25px; height: 25px;" onclick="plus(<?= $kodebarang; ?>,<?= $keranjang; ?>)">

        
</div></div>

	<?php  $sub += $total; $keranjang += 1; } ?> 
<br><br>

    <div class="bawah">
	    <a href="home.php" style="color: black; font-size: 20px; text-decoration: underline; margin-top: 140px; position: absolute; margin-left: -780px;">< Kembali</a>
	</div></div>

	<div class="akhir" style="margin-top: -100px; margin-left: 500px; height: 200px;">
			<h3 style="margin-top: 10px; margin-left: 20px; font-weight: bold; font-size: 23px;">Ringkasan Belanja</h3>
			<h2 style="font-size: 20px; margin-top: 30px; margin-left: 25px; font-size: 21px;">Subtotal : &nbsp; Rp. <input disabled="disabled" id="sub" name="sub" value="<?= $sub; ?>" style="background-color: white; color: black;border: none; padding-top: 10px; padding-left: 10px; margin-left: 2px; margin-top: -10px; width: 120px; position: absolute; font-size: 21px;"></h2>
	    	<input type="button" class="btn btn-success" value="Beli" style="font-size: 20px; float: right; margin-top: 35px; margin-left: 20px; position: absolute; width: 300px; margin-bottom: 1px;" onclick="f_order()">
		</div>
	</div>
</div>
</div><br><br>