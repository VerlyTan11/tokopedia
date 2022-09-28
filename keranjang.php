<?php
session_start();
include 'koneksi.php';

$sql4 = "SELECT tbbarang.nama, tbbarang.image, tbbarang.hargajual, tbbarang.satuan,  tbbarang.kodebarang, tbbarang.disc, tempjualdetil.jlh, tempjualdetil.total FROM tempjualdetil LEFT JOIN tbbarang ON tempjualdetil.kodebarang = tbbarang.kodebarang order by tempjualdetil.jlh desc";
$query4 = mysqli_query($conn,$sql4);
$num4 = mysqli_num_rows($query4);

?>