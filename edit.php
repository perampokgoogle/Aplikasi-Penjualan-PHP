<?php 
include_once 'dbconfig.php';

if (isset($_POST['btn-update'])) {
	$id = $_GET['edit_id'];
	$nama_brg = $_POST['nama_brg'];
	$jenis = $_POST['jenis'];
	$suplier = $_POST['suplier'];
	$harga_modal = str_replace(",", "", $_POST['harga_modal']);
	$harga_jual = str_replace(",", "", $_POST['harga_jual']);
	$jumlah = $_POST['jumlah'];
	$sisa ='';
	if ($barang->update($id,$nama_brg,$jenis,$suplier,$harga_modal,$harga_jual,$jumlah,$sisa)) {
		$msg = "<div class='alert alert-success'>
		<strong>Data berhasi di perbarui !</strong>
		</div>";
	}else{
		$msg = "<div class='alert alert-warning'>
		<strong>Data gagal di perbarui!</strong>
		</div>";
	}
}

if (isset($_GET['edit_id'])) {
	$id = $_GET['edit_id'];
	$table = 'tb_barang';
	extract($barang->getID($id,$table));
}

?>

<?php include_once 'header.php'; ?>
<div class="clearfix"></div>

<div class="container">

<?php 
if (isset($msg)) {
	echo $msg;
}
?>

<div class="panel panel-primary">
<div class="panel-heading"><h4><i class="glyphicon glyphicon-edit"></i> Ubah Data Barang</h4></div>
	<div class="panel-body">


		<form class="form-horizontal" role="form" method="post">
		<div class="form-group">
			<label class="control-label col-sm-3">Nama Barang</label>
			<div class="col-sm-5">
			<input type="text" name="nama_brg" class="form-control" placeholder="Nama Barang .." value="<?php echo $nama_brg; ?>">				
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-3">Jenis</label>
			<div class="col-sm-5">
			 <input type="text" name="jenis" class="form-control" placeholder="Jenis .." value="<?php echo $jenis; ?>">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-3">Suplier</label>
			<div class="col-sm-5">
			<input type="text" name="suplier" class="form-control" placeholder="Suplier .." value="<?php echo $suplier; ?>">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-3">Harga Modal</label>
			<div class="col-sm-4">
			<input type="text" name="harga_modal" class="form-control" placeholder="harga Modal .." value="<?php echo number_format($harga_modal); ?>">
			</div>	
		</div>
		<div class="form-group">
			<label class="control-label col-sm-3">Harga Jual</label>
			<div class="col-sm-4">
			 <input type="text" name="harga_jual" class="form-control" id="" placeholder="Harga Jual .." value="<?php echo number_format($harga_jual); ?>">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-3" for="jumlah">Jumlah :</label>
			<div class="col-sm-4">				
			 <input type="text" name="jumlah" class="form-control" id="jumlah" placeholder="Jumlah Barang .." value="<?php echo $jumlah; ?>">
			</div>
		</div>

		<div class="form-group" align="center">
			<label class="control-label col-sm-3"></label>
			<div class="col-sm-4">
				<button type="submit" name="btn-update" class="btn btn-primary"><i class="glyphicon glyphicon-edit"></i> Update</button>
				<a href="barang.php" class="btn btn-large btn-warning"><i class="glyphicon glyphicon-backward"></i> Cancel</a>
			</div>			
		</div>

	</form>
		
	</div>
</div>
	
</div>