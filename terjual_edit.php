<?php 
include_once 'dbconfig.php';

if (isset($_POST['btn-update'])) {
	// $nama_brg = $_POST['nama'];
	// $nama_brg1 = $_POST['nama1']."<br>";
	// $harga = $_POST['harga'];
	// $harga1 = $_POST['harga1'];
	// $jml = $_POST['jumlah'];
	$edit_id = $_GET['edit_id'];
	$table = 'barang_terjual';
	extract($barang->getID($edit_id,$table));
	if ($_POST['nama1']=="null") {

		if ($_POST['jumlah']==$jumlah) {
			$_POST['nama'] . "<br>";
			$_POST['harga'] . "<br>";
			$jml = $_POST['jumlah']. "<br>";			
			$table = 'tb_barang';			
			if ( extract($barang->getID($id_barang,$table)) ) {
				$laba = $_POST['harga']-$harga_modal . "<br>";
				$labaa = $laba*$jml;
				$sisa = $_POST['jumlah']-$jml . "<br>";
				$total_harga = $_POST['harga']*$jml ."<br>";			
				if ($barang->update($id_barang,$nama_brg,$jenis,$suplier,$harga_modal,$harga_jual,$jumlah,$sisa)) {
					$barang->update_entry($edit_id,$id_barang,$_POST['nama'],$jml,$_POST['harga'],$total_harga,$labaa);
				}
			}
		}elseif($_POST['jumlah']>$jumlah){
			$_POST['jumlah']." > ".$jumlah  ."<br>";
			$jml = $_POST['jumlah']-$jumlah ." = ".$_POST['jumlah']. " - $jumlah<br>";
			$table = 'tb_barang'; /* pilih table */
			if ( extract($barang->getID($id_barang,$table)) ) { /* mengambil data dari tb_barang */
				$sisa = $jumlah-$jml . "<br>";
				$total_harga = $harga_jual*$_POST['jumlah'] . "<br>";
				$laba = $_POST['harga']-$harga_modal . "<br>";
				$labaa = $laba*$_POST['jumlah'];
				if ($barang->update($id_barang,$nama_brg,$jenis,$suplier,$harga_modal,$harga_jual,$jumlah,$sisa)) {
					$barang->update_entry($edit_id,$id_barang,$nama_brg,$_POST['jumlah'],$_POST['harga'],$total_harga,$labaa);
				}
			}
		}elseif ($_POST['jumlah']<$jumlah) {
			// echo $_POST['jumlah'] ." < ". $jumlah ."<br>";
			$jml = $jumlah-$_POST['jumlah'] ." = $jumlah-".$_POST['jumlah']. "<br>";
			$table = 'tb_barang'; /* pilih table */
			if ( extract($barang->getID($id_barang,$table)) ) { /* mengambil data dari tb_barang */
				$sisa = $jumlah+$jml . "<br>";
				$total_harga = $harga_jual*$_POST['jumlah'] . "<br>";
				$laba = $_POST['harga']-$harga_modal . "<br>";
				$labaa = $laba*$_POST['jumlah'];
				if ($barang->update($id_barang,$nama_brg,$jenis,$suplier,$harga_modal,$harga_jual,$jumlah,$sisa)) {
					$barang->update_entry($edit_id,$id_barang,$nama_brg,$_POST['jumlah'],$_POST['harga'],$total_harga,$labaa);
				}
			}
		}

	}elseif ($_POST['nama1']!="null"){
		if ($_POST['jumlah']==$jumlah) {
			if (isset($_POST['nama'])) {				
				$table = 'tb_barang';
				if (extract($barang->getID($id_barang,$table))) {
					$sisa = ($jumlah+$_POST['jumlah']);
					// echo "<br>".$nama_brg;
					if ($barang->update($id_barang,$nama_brg,$jenis,$suplier,$harga_modal,$harga_jual,$jumlah,$sisa)) {
						/*echo "<br>update jumlah nama";
						echo "<br> Nama = ". $_POST['nama'];*/
						$table = 'tb_barang';
						if (extract($barang->getName($_POST['nama1'],$table))) {
							$sisa = $jumlah-$_POST['jumlah'];
							if ($barang->update($id_barang,$nama_brg,$jenis,$suplier,$harga_modal,$harga_jual,$jumlah,$sisa)) {
							$total_harga=$harga_jual*$_POST['jumlah'];
								$laba = $harga_jual-$harga_modal;
								$labaa = $laba*$_POST['jumlah'];
							$barang->update_entry($edit_id,$id_barang,$nama_brg,$_POST['jumlah'],$harga_jual,$total_harga,$labaa);
							}
						}
					}
				}
			}

		}elseif ($_POST['jumlah']>$jumlah) {
			// echo "jumlah data bertambah";
			// echo "<br>Nama=> ".$_POST['nama1'];
			// echo "<br>harga=> ".$_POST['harga1'];
			// echo "<br>Jumlah baru=> ".$_POST['jumlah'];
			// echo "<br>============ubah data ke========================";
			if (isset($_POST['nama'])) {
				$jml = $jumlah;
				$table = 'tb_barang';
				if (extract($barang->getID($id_barang,$table))) {
				/*	echo "<br>ID -> ".$id_barang;
					echo "<br>Jumlah => ".$jumlah;*/
					$sisa=($jumlah+$jml);
					if ($barang->update($id_barang,$nama_brg,$jenis,$suplier,$harga_modal,$harga_jual,$jumlah,$sisa)) {
						$table = 'tb_barang';
						if (extract($barang->getName($_POST['nama1'],$table))) {
					/*		echo "<br> Nama=> ".$nama_brg;
							echo "<br> Id=> ".$id_barang;*/
							$sisa = $jumlah-$_POST['jumlah'];
							if ($barang->update($id_barang,$nama_brg,$jenis,$suplier,$harga_modal,$harga_jual,$jumlah,$sisa)) {
								$total_harga=$harga_jual*$_POST['jumlah'];
								$laba = $harga_jual-$harga_modal;
								$labaa = $laba*$_POST['jumlah'];
								$barang->update_entry($edit_id,$id_barang,$nama_brg,$_POST['jumlah'],$harga_jual,$total_harga,$labaa);
							}
						}
					}
				}
			}
		}elseif ($_POST['jumlah']<$jumlah) {
			if (isset($_POST['nama'])) {				
				$id_barang;
				$jml = $jumlah;
				$table = 'tb_barang';
				if (extract($barang->getID($id_barang,$table))) {
					$sisa=($jumlah+$jml);
					if ($barang->update($id_barang,$nama_brg,$jenis,$suplier,$harga_modal,$harga_jual,$jumlah,$sisa)) {
						// echo "<br> update jumlah nama";
						$table = 'tb_barang';
						if (extract($barang->getName($_POST['nama1'],$table))) {
							$nama_brg;
							$id_barang;
							$sisa = $jumlah-$_POST['jumlah'];
							if ($barang->update($id_barang,$nama_brg,$jenis,$suplier,$harga_modal,$harga_jual,$jumlah,$sisa)) {
								$total_harga=$harga_jual*$_POST['jumlah'];
								$laba = $harga_jual-$harga_modal;
								$labaa = $laba*$_POST['jumlah'];
								$barang->update_entry($edit_id,$id_barang,$nama_brg,$_POST['jumlah'],$harga_jual,$total_harga,$labaa);
							}
						}
					}
				}
			}
		}
	}

}

if (isset($_GET['edit_id'])) {
	$id = $_GET['edit_id'];
	$table = 'barang_terjual';
	extract($barang->getID($id,$table));
}

?>
<?php include_once 'header.php'; ?>
<script type="text/javascript">

function fetch_select(val)
{
   $.ajax({
     type: 'post',
     url: 'fetch_data.php',
     data: {
       get_option:val
     },
     success: function (response) {
       document.getElementById("new_select").innerHTML=response; 
     }
   });
}

</script>

<div class="clearfix"></div>

<div class="container">
	
<div class="panel panel-primary">
	<div class="panel-heading"><h4><i class="glyphicon glyphicon-edit"></i> Ubah Entry Data</h4></div>
	<div class="panel-body">
		
	<form class="form-horizontal" role="form" method="post">
		<div class="form-group">
			<label class="control-label col-sm-3">Nama Barang</label>
			<div class="col-sm-2">
			<input type="hidden" name="nama" value="<?php echo $nama; ?>">
				<input type="text" class="form-control" placeholder="Nama Barang .." value="<?php echo $nama; ?>"  disabled>
			</div>
			<div class="col-sm-3">
				<select class="form-control" name="nama1" onchange="fetch_select(this.value);">
					<option value="null">Nama Barang</option>
					<?php 
					$query = "SELECT * FROM tb_barang group by nama_brg";
					$data = "nama_brg";
					$barang->option($query,$data);
					?>
				</select>
				</div>
		</div>
		<div class="form-group">
		<label class="control-label col-sm-3">Harga Jual</label>
			<div class="col-sm-2">
			<input type="hidden" name="harga" value="<?php echo $harga; ?>">
				<input type="" class="form-control" value="<?php echo $harga; ?>" disabled>
			</div>
			<div class="col-sm-2">
			<select class="form-control" name="harga1" id="new_select"></select>
   </div>
		</div>
		<div class="form-group">
		<label class="control-label col-sm-3">Jumlah</label>
			<div class="col-sm-5">
				<input type="text" name="jumlah" class="form-control" placeholder="Jumlah .." value="<?php echo $jumlah; ?>">

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
