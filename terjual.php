<?php include_once 'dbconfig.php';

if (isset($_POST['btn-save'])) {
	// $id = ''; $jenis = ''; $suplier = ''; $harga_modal = ''; $harga_jual = '';
	$tanggal = $_POST['tanggal']."<br>";
	$nama_brg = $_POST['nama']."<br>";
	$harga = $_POST['harga']."<br>";
	$jml = $_POST['jumlah']."<br>";
	if (isset($nama_brg)) {
		$nama_brg = $_POST['nama'];
		$table = 'tb_barang';
		extract($barang->getName($nama_brg,$table));
	 $sisa=$jumlah-$_POST['jumlah']."<br>";		
		$barang->update($id_barang,$nama_brg,$jenis,$suplier,$harga_modal,$harga_jual,$jumlah,$sisa);
	}
 
 $laba = $_POST['harga']-$harga_modal."<br>";
 $labaa = $laba*$_POST['jumlah']."<br>";
 $total_harga = $harga*$jml."<br>";
	if ($barang->entry($id_barang,$tanggal,$nama_brg,$harga,$jml,$total_harga,$labaa)) {
		header("Location: terjual.php?inserted");
	}else{
		header("Location: terjual.php?failure");
	}

}

?>

<?php include_once 'header.php'; ?>

<?php 
if (isset($_GET['inserted'])) {
	?>
	<div class="container">
	 <div class="alert alert-info">
	  <strong>Entry Data Success!</strong>
	 </div>
	</div>
	<?php
}elseif (isset($_GET['failure'])) {
	?>
	<div class="container">
	 <div class="alert alert-warning">
	  <strong>Entry Data Failed!</strong>
	 </div>
	</div>
	<?php
}
?>

<div class="container">
	
	<h3><i class="glyphicon glyphicon-shopping-cart"></i>Data Barang Terjual</h3>
	<button type="button" class="btn btn-info col-md-2" data-toggle="modal" data-target="#myEntry"><i class="glyphicon glyphicon-share"></i> Entry</button>

	<form action="" method="get">
			<div class="input-group col-md-5 col-md-offset-7">
				<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-calendar"></span></span>
				<select type="submit" name="tanggal" class="form-control" onchange="this.form.submit()">
					<option>Pilih tanggal ..</option>
					<?php 
					$query = "SELECT distinct tanggal FROM barang_terjual ORDER BY tanggal DESC";
					$stmt = $DB_con->prepare($query);
					$stmt->execute();
					while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
						?>
						<option value="<?php echo $data['tanggal'] ?>"><?php echo $data['tanggal'] ?></option>
						<?php
					}
					?>
				</select>
			</div>
		</form>
	<br/>
	<?php 
	if (isset($_GET['tanggal'])) {
		$tanggal=mysql_real_escape_string($_GET['tanggal']);
		$tg="lap_barang_laku.php?tanggal='$tanggal'";
		?><a style="margin-bottom:10px" href="<?php echo $tg ?>" target="_blank" class="btn btn-default pull-right"><span class='glyphicon glyphicon-print'></span> Cetak</a><?php
	}else{
		$tg="lap_barang_laku.php";
		?><a style="margin-bottom:10px" href="<?php echo $tg ?>" target="_blank" class="btn btn-default pull-right"><span class='glyphicon glyphicon-print'></span> Cetak</a>
		<?php
	}
	?>
	<table class="table">
		<tr>
			<th>No</th>
			<th>Tanggal</th>
			<th>Nama Barang</th>
			<th>Harga Terjual</th>
			<th>Total Harga</th>
			<th>Jumlah</th>
			<th>Laba</th>
			<th>Opsi</th>
		</tr>
		<?php 
		$table = 'barang_terjual';
		$records_per_page=5;
		if (isset($tanggal)) {
			$query = "SELECT * FROM $table WHERE tanggal like '$tanggal' ORDER BY tanggal DESC";
			$barang->lihat_barang_tgl($query,$tanggal);
		}else{
		$query = "SELECT * FROM $table";
		$newquery = $barang->paging($query,$records_per_page);
		$barang->view_data_barang($newquery,$table);	
		?>
		<tr>
			<td colspan="7" align="center">
				<div class="pagination-wrap">
					<?php $barang->paginglink($query,$records_per_page); ?>
				</div>
			</td>
		</tr>
		<?php } ?>
	</table>

	<?php include_once 'modal.php'; ?>


</div>

<?php include 'footer.php'; ?>