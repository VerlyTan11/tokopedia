<?php
session_start();
include 'koneksi.php';
date_default_timezone_set("Asia/Bangkok");

$sqljual = "select * from tbjual";
$queryjual = mysqli_query($conn,$sqljual);
$numjual = mysqli_num_rows($queryjual)+1;
$no = "$numjual";

$cmd = $_GET['cmd'];

if($cmd == 'Proses'){
$tgl = date('Y-m-d');
$no = $_GET['no'];
$kodeuser = $_GET['kodeuser'];
$kodebarang = $_GET['kodebarang'];
$sub = $_GET['sub'];
$namapenerima = $_GET['namapenerima'];
$notelp = $_GET['notelp'];
$provinsi = $_GET['provinsi'];
$kota = $_GET['kota'];
$kodepos = $_GET['kodepos'];
$alamat = $_GET['alamat'];
$ongkir = $_GET['ongkir'];
$pilih = $_GET['pilih'];
$grandtotal = $_GET['grandtotal'];
$sql = "INSERT INTO tbjual(no, tgl, kodeuser, kodebarang, subtotal, ongkir, grand_total, namapenerima, notelp, provinsi, kota, kodepos, alamat, metode) VALUES('$no', '$tgl', '$kodeuser', '$kodebarang', '$sub', '$ongkir', '$grandtotal', '$namapenerima', '$notelp', '$provinsi', '$kota', '$kodepos', '$alamat', '$pilih')";
$query = mysqli_query($conn,$sql) or die($sql);

$sqltemp = "SELECT * FROM tempjualdetil";
$querytemp = mysqli_query($conn, $sqltemp);
while($res = mysqli_fetch_array($querytemp)){
  $kodebarang = $res['kodebarang'];
  $jlh = $res['jlh'];
  $hargajual = $res['hargajual'];
  $total = $res['total'];

  $sqldetil = "INSERT INTO tbjualdetil(no, kodebarang, jlh, hargajual, total) VALUES('$no', '$kodebarang', '$jlh', '$hargajual', '$total')";
  $querydetil = mysqli_query($conn, $sqldetil);

  $sqlbrg = "SELECT * FROM tbbarang WHERE kodebarang='$kodebarang'";
  $querybrg = mysqli_query($conn,$sqlbrg);
  $resbrg = mysqli_fetch_array($querybrg);
  $jlh_stok = $resbrg['jlh_stok'];
  $upjmlh = $jlh_stok - $jlh;
  $upbrg = "UPDATE tbbarang SET jlh_stok='$upjmlh' WHERE kodebarang='$kodebarang'";
  $queryupbrg = mysqli_query($conn,$upbrg);
}

  $tempres = "DELETE FROM tempjualdetil where no='$no'";
  $qtempres = mysqli_query($conn,$tempres);
  
}
?>

<div class="terlaris">
    <br><hr />
    <div class="text">Transaksi</div>
    <?php

      $kodeuser = $_SESSION['kodeuser'];
      $sqltf = "select sum(tbjual.grand_total) as grandtotal, tbjual.kodebarang from tbjual where kodeuser='$kodeuser' and metode='transfer' and no='$no'";
      $querytf = mysqli_query($conn,$sqltf);
      $numtf = mysqli_num_rows($querytf);
      for($x = 1; $x <= 1; $x++){
      $result = mysqli_fetch_array($querytf);
      $kodebarang = $result['kodebarang'];
      $grandtotal = $result['grandtotal'];

      $grandtotal = "Rp " . number_format($grandtotal,0,',','.');

  
      ?>



    <div class="borderkotak">
      <h2 style="padding-top: 25px; padding-left: 75px; font-size: 30px; font-weight: bold; text-decoration: underline; color: red;">SILAHKAN KIRIM BUKTI TRANSFER ANDA SECEPATNYA!</h2>
      <h2 style="padding-left: 180px; margin-top: 50px; font-size: 28px;">Nomor Rekening</h2>
        <h2 style="font-size: 23px; padding-left: 300px;">BCA : 032 900 977 9</h2>
        <h2 style="font-size: 23px; padding-left: 300px;">BRI :  111 00 0459047 3</h2>
        <h2 style="font-size: 23px; padding-left: 300px;">BNI : 010 642 703 5</h2>
      <h2 style="padding-left: 260px; margin-top: 40px; font-size: 25px;"><?= $grandtotal; ?></h2>
      <h4 style="padding-left: 160px; font-size: 20px;">Transaksi akan dibatalkan jika bukti transfer dikirim lewat dari :</h4>
      <p style="padding-left: 310px;" id="demo"></p>
      <div class="mb-3" style="width: 70%; padding-left: 75px; margin-top: 30px;">
        <input class="form-control" type="file" id="foto">
      </div>
      <p style="padding-left: 150px; color: red; margin-top: -8px;">* bukti transaksi akan diperiksa dalam waktu kurang dari 48 jam.</p>
      <button type="button" class="btn btn-success" style="margin-left: 650px; margin-top: -150px; font-size: 15px;" onclick="kirim(<?= $no; ?>)">KIRIM</button>
    </div>
  </div>  <?php }?>