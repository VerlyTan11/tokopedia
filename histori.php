<?php
session_start();
date_default_timezone_set("Asia/Bangkok");

include 'koneksi.php';

$kodeuser = $_GET['kodeuser'];
$kodebarang = $_GET['kodebarang'];


if($kodeuser != ''){
  $sql = "SELECT * from tbhistori where kodebarang = '$kodebarang' and kodeuser = '$kodeuser'";
  $query = mysqli_query($conn,$sql)or die($sql);
  $num = mysqli_num_rows($query);
  $date = date('Y-m-d H:i:s');

  if($num == 0){
    $sql2 = "INSERT into tbhistori(kodeuser, kodebarang, created_at, updated_at) values('$kodeuser', '$kodebarang', '$date', '$date')";
  }else{
    $sql2 = "UPDATE tbhistori set updated_at = '$date' where kodebarang = '$kodebarang'";
  }
    $query = mysqli_query($conn,$sql2)or die($sql2);
  }


$sqljual = "select * from tbjual";
$queryjual = mysqli_query($conn,$sqljual);
$numjual = mysqli_num_rows($queryjual)+1;
$no = "$numjual";

  $sql4 = "SELECT * from tbbarang where kodebarang = '$kodebarang'";
  $query4 = mysqli_query($conn,$sql4);
  $num4 = mysqli_num_rows($query4);
  for($x = 1; $x <= 1; $x++){
    $result = mysqli_fetch_array($query4);
    $nama = $result['nama'];
    $kodebarang = $result['kodebarang'];
    $jenis = $result['jenis'];
    $merk = $result['merk'];
    $hargajual = $result['hargajual'];
    $hargabeli = $result['hargabeli'];
    $disc = $result['disc'];
    $jlh_stok = $result['jlh_stok'];
    $satuan = $result['satuan'];
    $image = $result['image'];
    $ket = $result['ket'];
    $trending = $result['trending'];
?>
<div class="detail" style="height : 600px;">
    <div class="box">
      <img src="<?= $image;?>">
      <h1><?= $nama;?></h1>
        <?php 
      $sql5 = "select sum(tbjualdetil.jlh) as jlh from tbjualdetil where kodebarang='$kodebarang'";
      $query5 = mysqli_query($conn,$sql5);
      $num5 = mysqli_num_rows($query5);
      for ($x = 1; $x <= $num5 ; $x++) { 
      $result = mysqli_fetch_array($query5);
      $jlh = $result['jlh'];
                if($jlh <= 5){
                  $kali = '<img src="star.png" style="width: 20px; height: 20px;">';
                }elseif ($jlh <= 10) {
                  $kali = '
                  <img src="star.png" style="width: 20px; height: 20px; margin-left: -1px;">
                  <img src="star.png" style="width: 20px; height: 20px; margin-left: -1px;">
                  ';
                }elseif ($jlh <= 20) {
                  $kali = '
                  <img src="star.png" style="width: 20px; height: 20px; margin-left: -1px;">
                  <img src="star.png" style="width: 20px; height: 20px; margin-left: -1px;">
                  <img src="star.png" style="width: 20px; height: 20px; margin-left: -1px;">
                  ';
                }elseif ($jlh <= 50) {
                  $kali = '
                  <img src="star.png" style="width: 20px; height: 20px; margin-left: -1px;">
                  <img src="star.png" style="width: 20px; height: 20px; margin-left: -1px;">
                  <img src="star.png" style="width: 20px; height: 20px; margin-left: -1px;">
                  <img src="star.png" style="width: 20px; height: 20px; margin-left: -1px;">
                  ';
                }elseif ($jlh >= 50) {
                  $kali = '
                  <img src="star.png" style="width: 20px; height: 20px; margin-left: -1px;">
                  <img src="star.png" style="width: 20px; height: 20px; margin-left: -1px;">
                  <img src="star.png" style="width: 20px; height: 20px; margin-left: -1px;">
                  <img src="star.png" style="width: 20px; height: 20px; margin-left: -1px;">
                  <img src="star.png" style="width: 20px; height: 20px; margin-left: -1px;">
                  ';  
                }
              }
            ?>
      <div class="bintang">
        <p style="margin-top: -85px;"><?= $kali;?></p>
        <p style="margin-left: -5px;">|</p>
        <p style="margin-left: -75px;"><?= $jlh;?> Terjual</p>
        <div class="desk" style="margin-left: -20px;">
          <h3 style="font-weight: bold; font-size: 23px; margin-top: 50px; margin-left: -200px;">Deskripsi Produk :</h3>
          <h3>Jenis : <?= $jenis;?></h3>
          <h3>Merk : <?= $merk;?></h3>
          <h3>Satuan : <?= $satuan;?></h3>
          <h3>Keterangan : <?= $ket;?></h3>
          
          <h3>Diskon : &nbsp;<input type="text" name="disc" id="disc" value="<?= $disc;?>" style="border: hidden; background-color: white;">
            <h4 style="margin-top: -30px; margin-left: -86px; position: relative; font-size: 20px;">&nbsp;%</h4>
          </h3>
          <h3>Harga : Rp. &nbsp;<input type="text" name="hargajual" id="hargajual" value="<?= $hargajual;?>" style="border: hidden; background-color: white; color: "></h3>
        </div>
        <h2 style="height: 50px;">Rp. &nbsp;<input id="total" name="total" disabled="disabled"></h2> 
        
        <div class="tambah"> 
          <img src="minus.png" onclick="mins()" style="margin-left: 35px;">
          <h3><input type="text" class="form-control" id="jumlah" name="jumlah" style="width: 50px; text-align: center; font-size: 13px; margin-left: 66px; margin-top: -28px;" value="0"></h3>
          <img src="add.png" style="margin-top: -74px; margin-left: 123px;" onclick="pluss()">
        </div>
        <?php } ?>
        <h4 style="margin-top: 260px; margin-left: -87px; font-size: 15px;">Stok : <?= $jlh_stok;?></h4>

        <button type="button" class="btn btn-outline-success" id="add" name="add" data-toggle="modal" data-target="#exampleModalCenter" onclick="add(<?= $kodebarang; ?>)" style="font-size: 20px; height: 40px; width: 230px; margin-top: 350px; border-radius: 10px;padding-top: 4px; margin-left: -400px;">Masukkan Keranjang &nbsp;<img src="cart.png" style="width: 25px; height: 25px; margin-top: -7px; margin-left: -5px;"></button>



<div class="back">
  <a href="home.php" style="color: black; font-size: 20px; text-decoration: underline; margin-top: 480px; position: absolute; margin-left: -600px;">< Kembali</a>
</div>
<input type="hidden" id="kodeuser" name="kodeuser">
<input type="hidden" id="no" value="<?= $no; ?>">