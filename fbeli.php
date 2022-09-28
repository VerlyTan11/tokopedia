<?php
session_start();
include 'koneksi.php';

$sql2 = "SELECT tbbarang.nama, tbbarang.image, tbbarang.hargajual, tbbarang.satuan, tbbarang.kodebarang, tbbarang.disc, tbbarang.ket, tbbarang.merk,tbbarang.jenis, tbbarang.jlh_stok, tempjualdetil.jlh, tempjualdetil.total FROM tempjualdetil LEFT JOIN tbbarang ON tempjualdetil.kodebarang = tbbarang.kodebarang order by tempjualdetil.jlh desc";
$query2 = mysqli_query($conn,$sql2);
$num2 = mysqli_num_rows($query2);


?>

<div class="terlaris">
	<div class="text">Keranjang Pembelian</div>
</div>
<div class="detail">
	<div class="row">
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
        $ongkir = 10000;
        $gtotal = 0;
		$query2 = mysqli_query($conn,$sql2);
		$num2 = mysqli_num_rows($query2);
		for($x = 1; $x <= $num2; $x++){
		$result = mysqli_fetch_array($query2);
		$kodebarang = $result['kodebarang'];
		$image = $result['image'];
		$nama = $result['nama'];
		$hargajual = $result['hargajual'];
		$ket = $result['ket'];
		$jenis = $result['jenis'];
		$jlh = $result['jlh'];
		$disc = $result['disc'];
		$merk = $result['merk'];
		$satuan = $result['satuan'];
		$total = $result['total'];
	?>

	<div class="kotak">
		<img src="<?= $image;?>" style="cursor: pointer;" onclick="histori(<?= $kodeuser ?> , <?= $kodebarang ?>)">
		<div class="samping" style="position: absolute;">
			<h2><?= $nama;?></h2>
			<h2 style=" color: grey; font-size: 23px; margin-left: 165px;"><?= $merk;?></h2>
			<h2 style=" color: grey; font-size: 23px; margin-left: 300px;">&nbsp;<?= $jenis;?></h2>
			<h3 style="margin-left: 530px; margin-top: 20px; font-size: 20px;">Harga Jual : Rp. &nbsp;<input type="text" name="hargajual"  value="<?= $hargajual; ?>" style="border: hidden; background-color: white; color: black;" disabled="disabled"></h3>
			<h3 style="margin-left: 530px; margin-top: 20px; font-size: 20px;">Diskon : &nbsp;<input type="text" name="disc" value="<?= $disc;?>" style="border: hidden; background-color: white; color: black;" disabled="disabled"><h3 style="margin-left: 640px; margin-top: -33px; font-size: 20px;">%</h3>
			<h3 style="margin-left: 530px; margin-top: 20px; font-size: 20px;">Total : Rp. &nbsp;<input type="text" name="total"  value="<?= $total;?>" style="border: hidden; background-color: white; color: black;" disabled="disabled"></h3>


</div></div>
<?php  $sub += $total; $keranjang += 1; } $grandtotal = $sub + $ongkir; ?>

<div class="bawah">
	    <h2 style="font-size: 20px;">Total : Rp. <input disabled="disabled" id="sub" name="sub" value="<?= $sub; ?>" style="background-color: white; color: black;"></h2>
	    <h2 style="font-size: 20px;">Ongkir: Rp. <input disabled="disabled" id="ongkir" name="ongkir" value="<?= $ongkir; ?>" style="background-color: white; color: black;"></h2>
	    <h2 style="font-size: 20px;">Grand Total : Rp. <input disabled="disabled" id="grandtotal" name="grandtotal" value="<?= $grandtotal; ?>" style="background-color: white; color: black;"></h2>
	  
	    
	    <input type="button" class="btn btn-success" value="Beli" style="font-size: 20px; float: right; margin-top: 50px; margin-left: 900px; position: absolute;" data-bs-toggle="modal" data-bs-target="#exampleModal">
	    <a href="home.php" style="color: black; font-size: 20px; text-decoration: underline; margin-top: 140px; position: absolute;">< Kembali</a>
	</div>
</div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Metode Pembayaran</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-check">
  			<input class="form-check-input" type="radio" name="metode" value="COD">
  			<label class="form-check-label" for="flexRadioDefault2">
    		COD
  			</label>
		</div>
		<div class="form-check">
  			<input class="form-check-input" type="radio" name="metode" value="Transfer">
  			<label class="form-check-label" for="flexRadioDefault2">
    		Transfer
  			</label>
		</div>
      </div>
      <div class="modal-footer">
      	<button class="btn btn-outline-success" style="font-size: 20px; width: 190px; margin-top: 40px; border-radius: 10px; padding-top: 4px; margin-left: 20px;" data-bs-dismiss="modal">Beli Sekarang &nbsp;&nbsp;<img src="bag.png" style="width: 25px; height: 25px; margin-top: -7px; margin-left: -5px; font-weight: bold;"></button>
      </div>
    </div>
  </div>
</div>

