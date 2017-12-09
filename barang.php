<?php include_once 'dbconfig.php';
if (isset($_POST['btn-save'])) {
	$nama_brg = $_POST['nama_brg'];
	$jenis = $_POST['jenis'];
	$suplier = $_POST['suplier'];
	$harga_modal = $_POST['harga_modal'];
	$harga_jual = $_POST['harga_jual'];
	$jumlah = $_POST['jumlah'];

	if ($barang->tambah($nama_brg,$jenis,$suplier,$harga_modal,$harga_jual,$jumlah)) {
		header("Location: barang.php?inserted");
	}else{
		header("Location: barang.php?failure");
	}
}
?>
<?php include_once 'header.php'; ?>

<div class="clearfix"></div>

<?php 
if (isset($_GET['inserted'])) {
	?>
	<div class="container">
	 <div class="alert alert-info">
	 <strong>Data Berhasil di Tambah</strong>
	 </div>
	</div>
	<?php
}else if(isset($_GET['failure'])){
	?>
	<div class="container">
	 <div class="alert alert-warning">
	 <strong>Data gagal Di input</strong>
	 </div>
	</div>
	<?php
}
?>


<div class="container">
	<!-- <div class="row"> -->
		
			<h3><i class="glyphicon glyphicon-briefcase"></i> Data Barang</h3>
			<button type="button" class="btn btn-info col-md-2" data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-plus"></i>Tambah Barang</button>
			<br/><br/>
			<?php 
			$query = "SELECT * FROM tb_barang WHERE jumlah <= 5";
			$stmt = $DB_con->prepare($query);
			$stmt->execute();
			while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
				if ($row['jumlah']<=5) {
			echo "<div style='padding:5px' class='alert alert-warning'><span class='glyphicon glyphicon-info-sign'></span> Stok  <a style='color:red'>". $row['nama_brg']."</a> yang tersisa sudah kurang dari 5 . silahkan pesan lagi !!</div>";
				}
			}
			?>

			<?php 
			$query = "SELECT * FROM tb_barang";
			$stmt = $DB_con->prepare($query);
			$stmt->execute();
			// echo "Jumlah data : ". $stmt->rowCount();
			?>
			<div class="col-md-12">
				<table class="col-md-2">
					<tr>
						<td>Jumlah Records</td>
						<td><?php echo $stmt->rowCount(); ?></td>
					</tr>
				</table>
				<a style="margin-bottom:10px;" href="lap_barang.php" target="_blank" class="btn btn-default pull-right"><span class="glyphicon glyphicon-print"></span> Cetak</a>
			</div>
			
		<form method="get">
			<div class="input-group col-md-5 col-md-offset-7">
				<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-search"></span></span>
				<input type="text" class="form-control" placeholder="Cari barang di sini .." aria-describedby="basic-addon1" name="cari">
			</div>
		</form>
		<br>
		<table class="table table-hover">
    <thead>
     <tr>
     	<th class="col-md-1">no</th>
     	<th class="col-md-4">Nama Barang</th>
     	<th class="col-md-3">Harga Jual</th>
     	<th class="col-md-1">Jumlah</th>
     	<th class="col-md-3">Opsi</th>
     </tr>
    </thead>
     <?php 
     $table = 'tb_barang';
     $query = "SELECT * FROM $table";
     $records_per_page=10;
     $newquery = $barang->paging($query,$records_per_page);
     if (isset($_GET['cari'])) {
     	$cari = mysql_real_escape_string($_GET['cari']);
     	$barang->caridata($query,$cari);
     }else{
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

	<!-- </div> -->
</div>

<?php include 'footer.php'; ?>