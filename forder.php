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
<div class="col" style="margin-top: -5px; margin-left: -15px; width: 110%; ">
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
<div class="detail">
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
	          <h3>Jumlah : <?= $jlh; ?></h3>

        
</div></div>

	<?php  $sub += $total; $keranjang += 1; }$grandtotal = $sub + $ongkir; ?> 
<br><br><hr />

    <div class="bawah">
	    <a href="home.php" style="color: black; font-size: 20px; text-decoration: underline; margin-top: 140px; position: absolute; margin-left: -780px;">< Kembali</a>
	</div>
	<div class="terlaris">
		<div class="text">Alamat</div>
		<div class="row">
			<div class="input-group mb-3" style="width: 40%; margin-left: 35px;">
			  	<input type="text" class="form-control" placeholder="Nama Penerima" aria-label="Username" aria-describedby="basic-addon1" id="namapenerima">
			</div>
			<div class="input-group mb-3" style="width: 40%;">
			  	<input type="text" class="form-control" placeholder="Nomor Telepon" aria-label="Username" aria-describedby="basic-addon1" id="notelp">
			</div>
		</div>
		<div class="row">
			<div class="input-group mb-3" style="width: 30%; margin-left: 35px;">
			  	<input type="text" class="form-control" placeholder="Provinsi" aria-label="Username" aria-describedby="basic-addon1" id="provinsi">
			</div>
			<div class="input-group mb-3" style="width: 35%;">
			  	<input type="text" class="form-control" placeholder="Kota atau Kecamatan" aria-label="Username" aria-describedby="basic-addon1" id="kota">
			</div>
			<div class="input-group mb-3" style="width: 25%;">
			  	<input type="text" class="form-control" placeholder="Kode Pos" aria-label="Username" aria-describedby="basic-addon1" id="kodepos">
			</div>
		</div>
		<div class="mb-3" style="width: 59.5%; margin-left: 47px;">
 			<textarea class="form-control" rows="3" placeholder="Alamat Lengkap" id="alamat"></textarea>
		</div>

		<div class="akhir" style="height: 270px; margin-top: -265px;">
			<h3 style="margin-top: 10px; margin-left: 20px; font-weight: bold; font-size: 23px;">Ringkasan Belanja</h3>
			<h2 style="font-size: 20px; margin-top: 30px; margin-left: 30px; font-size: 21px;">Subtotal : &nbsp; Rp. <input disabled="disabled" id="sub" name="sub" value="<?= $sub; ?>" style="background-color: white; color: black;border: none; padding-top: 10px; padding-left: 10px; margin-left: 1px; margin-top: -10px; width: 120px; position: absolute; font-size: 21px;"></h2>
			<h2 style="font-size: 20px; margin-top: 15px; margin-left: 30px; font-size: 21px;">Ongkir : &nbsp; Rp. <input disabled="disabled" value="<?= $ongkir; ?>" style="background-color: white; color: black;border: none; padding-top: 10px; padding-left: 10px; margin-left: 1px; margin-top: -10px; width: 150px; position: absolute; font-size: 21px;" id="ongkir"></h2>
			<h2 style="font-size: 20px; margin-top: 15px; margin-left: 30px; font-size: 21px;">Total : &nbsp; Rp. <input disabled="disabled" value="<?= $grandtotal; ?>" style="background-color: white; color: black;border: none; padding-top: 10px; padding-left: 10px; margin-left: 1px; margin-top: -10px; width: 150px; position: absolute; font-size: 21px;" id="grandtotal"></h2>
	   
	    	<input type="button" class="btn btn-success"  value="Beli" style="font-size: 20px; float: right; margin-top: 20px; margin-left: 20px; position: absolute; width: 300px;" data-bs-toggle="modal" data-bs-target="#exampleModal">
		</div>
	</div>
</div>
</div>
<br><br>

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
        <input type="button" class="btn btn-success" id="proses" value="Proses" style="font-weight: bold;" onclick="f_proses(<?= $no;?>, <?= $tgl; ?>, <?= $kodeuser; ?>, <?= $kodebarang; ?>, <?= $sub; ?>, <?= $ongkir; ?>, <?= $grandtotal; ?>)" data-bs-dismiss="modal">
      </div>
    </div>
  </div>
</div>
<br><br>