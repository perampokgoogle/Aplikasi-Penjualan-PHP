<?php 

class barang{

	private $db;

	function __construct($DB_con)
	{
		$this->db = $DB_con;
	}

	public function tambah($nama_brg,$jenis,$suplier,$harga_modal,$harga_jual,$jumlah)
	{
		try {
			$stmt = $this->db->prepare("INSERT INTO tb_barang(nama_brg,jenis,suplier,harga_modal,harga_jual,jumlah) VALUES (:nama_brg, :jenis, :suplier, :harga_modal, :harga_jual, :jumlah)");
			$stmt->bindparam(":nama_brg",$nama_brg);
			$stmt->bindparam(":jenis",$jenis);
			$stmt->bindparam(":suplier",$suplier);
			$stmt->bindparam(":harga_modal",$harga_modal);
			$stmt->bindparam(":harga_jual",$harga_jual);
			$stmt->bindparam(":jumlah",$jumlah);
			$stmt->execute();
			return true;
		} catch (PDOException $e) {
			echo $e->getMessage();
			return false;
		}
	}

	public function entry($id_barang,$tanggal,$nama_brg,$harga,$jumlah,$total_harga,$labaa)
	{
		try {
			$stmt = $this->db->prepare("INSERT INTO barang_terjual(id_barang,tanggal,nama,jumlah,harga,total_harga,laba) VALUES (:id_barang, :tanggal, :nama, :jumlah, :harga, :total_harga, :laba)");
			$stmt->bindparam(":id_barang",$id_barang);
			$stmt->bindparam(":tanggal",$tanggal);
			$stmt->bindparam(":nama",$nama_brg);
			$stmt->bindparam(":jumlah",$jumlah);
			$stmt->bindparam(":harga",$harga);
			$stmt->bindparam(":total_harga",$total_harga);
			$stmt->bindparam(":laba",$labaa);
			$stmt->execute();
			return true;
		} catch (PDOException $e) {
			echo $e->getMessage();
		}

	}

	public function update($id,$nama_brg,$jenis,$suplier,$harga_modal,$harga_jual,$jumlah,$sisa)
	{
		// $sisa = true;
		if ($sisa >=1) { /*jika sisa lebih besar atau sama dengan 1 maka yg di update hanya data jumlah*/
			try {
				$stmt = $this->db->prepare("UPDATE tb_barang SET jumlah=:sisa WHERE id_barang=:id_barang");
				$stmt->bindparam(":id_barang",$id);
				$stmt->bindparam(":sisa",$sisa);
				$stmt->execute();
				return true;
			} catch (PDOException $e) {
				echo $e->getMessage();
				return false;
			}
		}else{
			try {
			$stmt = $this->db->prepare("UPDATE tb_barang SET nama_brg=:nama_brg, jenis=:jenis, suplier=:suplier, harga_modal=:harga_modal, harga_jual=:harga_jual, jumlah=:jumlah WHERE id_barang=:id");
			$stmt->bindparam(":id",$id);
			$stmt->bindparam(":nama_brg",$nama_brg);
			$stmt->bindparam(":jenis",$jenis);
			$stmt->bindparam(":suplier",$suplier);
			$stmt->bindparam(":harga_modal",$harga_modal);
			$stmt->bindparam(":harga_jual",$harga_jual);
			$stmt->bindparam(":jumlah",$jumlah);
			$stmt->execute();
			return true;	
			} catch (PDOException $e) {
				echo $e->getMessage();
				return false;
			}			
		}
			
	}

	public function update_entry($edit_id,$id_barang,$nama,$jml,$harga,$total_harga,$labaa)
	{
		try {
			$stmt = $this->db->prepare("UPDATE barang_terjual SET id_barang=:id_barang, nama=:nama, jumlah=:jumlah, harga=:harga, total_harga=:total_harga, laba=:laba WHERE id_terjual=:id_terjual");
				$stmt->bindparam(":id_terjual",$edit_id);
				$stmt->bindparam(":id_barang",$id_barang);
				$stmt->bindparam(":nama",$nama);
				$stmt->bindparam(":jumlah",$jml);
				$stmt->bindparam(":harga",$harga);
				$stmt->bindparam(":total_harga",$total_harga);
				$stmt->bindparam(":laba",$labaa);
				$stmt->execute();
				return true;
		} catch (PDOException $e) {
			
		}
	}

	public function getID($id,$table)
	{
		if ($table=='barang_terjual') {
		$stmt = $this->db->prepare("SELECT * FROM $table WHERE id_terjual=:id_terjual");
		$stmt->execute(array(":id_terjual"=>$id));
		}else{
			$stmt = $this->db->prepare("SELECT * FROM $table WHERE id_barang=:id_barang");
		$stmt->execute(array(":id_barang"=>$id));
		}
		$editRow=$stmt->fetch(PDO::FETCH_ASSOC);
		return $editRow;
	}

	public function getName($nama_brg,$table)
	{
		if ($table=='tb_barang') {
		$stmt = $this->db->prepare("SELECT * FROM $table WHERE nama_brg=:nama_brg");
		$stmt->execute(array(":nama_brg"=>$nama_brg));
		$editRow= $stmt->fetch(PDO::FETCH_ASSOC);
		return $editRow;
		}elseif($table=='barang_terjual'){
			$stmt = $this->db->prepare("SELECT * FROM $table WHERE nama=:nama_brg");
		$stmt->execute(array(":nama_brg"=>$nama_brg));
		$editRow= $stmt->fetch(PDO::FETCH_ASSOC);
		return $editRow;
		}
	}

	public function option($query,$data)
	{
		$stmt = $this->db->prepare($query);
		$stmt->execute();
		while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
  ?>
   <option value="<?php print($row[$data]); ?>"> <?php print($row[$data]." (Rp.".number_format($row['harga_jual']).")"); ?></option>
  <?php
  }
		// return true;
	}

	public function view_data_barang($query,$table)
	{
		if ($table=='tb_barang') {
		$stmt = $this->db->prepare($query);
		$stmt->execute();
		$no = 1;
			while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
				$harga_jual = number_format($row['harga_jual']);
				?>
				<tr>
				<td><?php print($no++); ?></td>
				<td><?php print($row['nama_brg']); ?></td>
				<td><?php print("Rp ".$harga_jual.".-"); ?></td>
				<td><?php print($row['jumlah']) ?></td>
				<td>
					<a href="detail.php?id=<?php print($row['id_barang']); ?>"><button type="button" class="btn btn-info">Detail</button></a>
	    <a href="edit.php?edit_id=<?php print($row['id_barang']); ?>"><button type="button" class="btn btn-warning">Edit</button></a>
	    <a href="hapus.php?hapus_id=<?php print($row['id_barang']); ?>"><button type="button" class="btn btn-danger">Hapus</button></a>
				</td>
				</tr>
				<?php
			}
		}elseif ($table=='barang_terjual') {
			$stmt = $this->db->prepare($query);
		 $stmt->execute();
		 $no = 1;
			while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
				// $harga = number_format($row['harga']);
				?>
				<tr>
				<td><?php print($no++); ?></td>
				<td><?php print($row['tanggal']); ?></td>
				<td><?php print($row['nama']); ?></td>
				<td><?php print("Rp. ".number_format($row['harga'])).",-"; ?></td>
				<td><?php print("Rp. ".number_format($row['total_harga'])).",-"; ?></td>
				<td><?php print($row['jumlah']); ?></td>
				<td><?php print("Rp. ".number_format($row['laba'])).",-"; ?></td>
				<td>
	    <a href="terjual_edit.php?edit_id=<?php print($row['id_terjual']); ?>"><button type="button" class="btn btn-warning">Edit</button></a>
	    <a href="terjual_hapus.php?hapus_id=<?php print($row['id_terjual']); ?>"><button type="button" class="btn btn-danger">Hapus</button></a>
				</td>
				</tr>
				<?php
			}
		}
		 
	}

	public function lihat_barang_tgl($query,$tanggal)
	{
		$stmt = $this->db->prepare($query);
		$stmt->execute();
		$no=1;
		while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
			?>
			<tr>
				<td><?php print($no++); ?></td>
				<td><?php print($row['tanggal']); ?></td>
				<td><?php print($row['nama']); ?></td>
				<td><?php print("Rp. ".number_format($row['harga'])).",-"; ?></td>
				<td><?php print("Rp. ".number_format($row['total_harga'])).",-"; ?></td>
				<td><?php print($row['jumlah']); ?></td>
				<td><?php print("Rp. ".number_format($row['laba'])).",-"; ?></td>
				<td>
	    <a href="terjual_edit.php?edit_id=<?php print($row['id_terjual']); ?>"><button type="button" class="btn btn-warning">Edit</button></a>
	    <a href="terjual_hapus.php?hapus_id=<?php print($row['id_terjual']); ?>"><button type="button" class="btn btn-danger">Hapus</button></a>
				</td>
				</tr>
			<?php
		}
	}


	public function caridata($query,$cari)
	{
		$query2=$query." WHERE nama_brg like '%$cari%' OR jenis like '$cari%'";
		$stmt = $this->db->prepare($query2);
		$stmt->execute();
		$no = 1;
		$jumlah_data = $stmt->rowCount();
		if ($jumlah_data < 1) {
		echo "<tr>";
		echo "<td colspan='5'>";
			echo "data yang dicari ditak ada atau tidak sesuai";
			echo "</td>";
			echo "</tr>";
		}
		while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
			$harga_jual = number_format($row['harga_jual']);
			?>
			<tr>
			<td><?php print($no++); ?></td>
			<td><?php print($row['nama_brg']); ?></td>
			<td><?php print("Rp ".$harga_jual.".-"); ?></td>
			<td><?php print($row['jumlah']) ?></td>
			<td>
			 <a href="detail.php?id=<?php print($row['id_barang']); ?>"><button type="button" class="btn btn-info">Detail</button></a>
			 <a href="edit.php?edit_id=<?php print($row['id_barang']); ?>"><button type="button" class="btn btn-warning">Edit</button></a>
			 <a href="hapus.php?hapus_id=<?php print($row['id_barang']); ?>"><button type="button" class="btn btn-danger">Hapus</button></a>
			</td>
			</tr>
			<?php
		}
	}

	public function pesan($query)
	{
		$stmt = $this->db->prepare($query);
		$stmt->execute();
		while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
			if (isset($row['jumlah'])<=5) {
				?>
				<script>
				$(document).ready(function(){
					$('#pesan_sedia').css("color","red");
					$('#pesan_sedia').append("<span class='glyphicon glyphicon-asterisk'></spam>");
				});
				</script>
				<?php
				echo "<div style='padding:5px' class='alert alert-warning'><span class='glyphicon glyphicon-info-sign'></span> Stok <a style='color: red'>".$row['nama_brg']."</a> yang tersisa sudah kurang dari 5 . silahkan pesan lagi !! </div>";
			}elseif($row['jumlah']>=6) {
				echo "<div style='padding:5px' class='alert alert-info'><span class='glyphicon glyphicon-info-sign'></span> Tidak ada pesan ..	</div>";
			}
		}

	}


	public function paging($query,$records_per_page)
	{
		$starting_position = 0;
		if (isset($_GET["page_no"])) {
			$starting_position=($_GET["page_no"]-1)*$records_per_page;
		}
		$query2=$query." LIMIT $starting_position,$records_per_page";
		return $query2;
	}



	public function paginglink($query,$records_per_page)
	{
		$self = $_SERVER['PHP_SELF'];

		$stmt = $this->db->prepare($query);
		$stmt->execute();

		$total_no_of_records = $stmt->rowCount();

		if ($total_no_of_records > 0) {
			?><ul class="pagination"><?php
			$total_no_of_pages=ceil($total_no_of_records/$records_per_page);
			$current_page=1;

			if (isset($_GET["page_no"])) {
				$current_page=$_GET["page_no"];
			}

			if ($current_page!=1) {
				$previous = $current_page-1;
				echo "<li><a href='".$self."?page_no=1'>First</a></li>";
				echo "<li><a href='".$self."?page_no=".$previous."'>Previous</a></li>";
			}

			for ($i=1; $i<=$total_no_of_pages; $i++) { 
				if ($i==$current_page) {
					echo "<li><a href='".$self."?page_no=".$i."' style='color:red;'>".$i."</a></li>";
				}else{
					echo "<li><a href='".$self."?page_no=".$i."'>".$i."</a></li>";
				}
			}

			if ($current_page!=$total_no_of_pages) {
				$next = $current_page+1;
				echo "<li><a href='".$self."?page_no=".$next."'>Next</a></li>";
				echo "<li><a href='".$self."?page_no=".$total_no_of_pages."'>Last</a></li>";
			}
			?></ul><?php
		}
	}

	public function delete($id,$table)
 {
 	if ($table=='tb_barang') {
  $stmt = $this->db->prepare("DELETE FROM tb_barang WHERE id_barang=:id_barang");
  $stmt->bindparam(":id_barang",$id);
  $stmt->execute();
  return true;
 	}elseif ($table=='barang_terjual') {
 		$stmt = $this->db->prepare("DELETE FROM barang_terjual WHERE id_terjual=:id_terjual");
 		$stmt->bindparam(":id_terjual",$id);
  $stmt->execute();
  return true;
 	}
 }

}

?>
