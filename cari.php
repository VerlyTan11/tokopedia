<?php 
	include 'koneksi.php';

	$cmd = $_GET['cmd'];
	$nama = $_GET['nama'];
	$kodeuser = $_GET['kodeuser'];
	$kodebarang = $_GET['kodebarang'];

	if($nama != ''){
	$sql = "SELECT * FROM tbbarang WHERE nama like '%$nama%'";
	$query = mysqli_query($conn,$sql)or die($sql);
	$num = mysqli_num_rows($query);
		
?>
	<div class="terlaris">
		<br><hr />
			<div class="row">

<?php 
		if($num >= 1){ 
	    while($result = mysqli_fetch_array($query)){
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
					<img src="<?= $image;?>" style="width: 100%;">
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
		<?php 
			}
		}else if($num < 1){ ?>
	        
			<div class="kontainer" style="position: relative;">
				<div class="caption">
					<h4 style="color: #03AC0E; font-size: 20px; font-weight: bold;">Hasil pencarian tidak ditemukan</h4>
	            </div>
	          </div>
	<?php } ?>
	  </div>
	</div>
<?php } ?>