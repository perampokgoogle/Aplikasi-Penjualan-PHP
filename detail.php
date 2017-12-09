<?php include_once'dbconfig.php';

if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$table = 'tb_barang';
	extract($barang->getID($id,$table));
}
?>

<?php include_once 'header.php'; ?>

<div class="clearfic"></div>

<div class="container">
	<div class="panel-group">
		<div class="panel panel-info">
			<div class="panel-heading">Info Data Barang</div>
			<div class="panel-body">
				<table>
					<tr>
						<td>ID Barang</td>
						<td> : <?php echo $id_barang; ?></td>
					</tr>
					<tr>
						<td>Nama Barang</td>
						<td> : <?php echo $nama_brg; ?></td>
					</tr>
					<tr>
						<td>Jenis Barang</td>
						<td> : <?php echo $jenis; ?></td>
					</tr>
					<tr>
						<td>Suplier</td>
						<td> : <?php echo $suplier; ?></td>
					</tr>
					<tr>
						<td>Harga Modal</td>
						<td> : <?php echo $harga_modal; ?></td>
					</tr>
					<tr>
						<td>Harga Jual</td>
						<td> : <?php echo $harga_jual; ?></td>
					</tr>
					<tr>
						<td>Jumlah Barang</td>
						<td> : <?php echo $jumlah; ?></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>

<?php include_once 'footer.php'; ?>