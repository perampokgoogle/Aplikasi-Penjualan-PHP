<?php 
include_once 'dbconfig.php';

if (isset($_POST['btn-del'])) {
	$id = $_GET['hapus_id'];
	$table = 'barang_terjual';
	$barang->delete($id,$table);
	header("Location: terjual_hapus.php?terhapus");
}
?>

<?php include_once 'header.php'; ?>
<br/><br/><br/><br/>
<div class="clearfix"></div>

<div class="container">
	<?php
 if(isset($_GET['terhapus']))
 {
  ?>
        <div class="alert alert-success">
     <strong>Success!</strong> record was deleted... 
  </div>
        <?php
 }
 else
 {
  ?>
        <div class="alert alert-danger">
     <strong>Sure !</strong> to remove the following record ? 
  </div>
        <?php
 }
 ?> 
</div>

<div class="clearfix"></div>

<div class="container">
<?php 
if (isset($_GET['hapus_id'])) {
	?>
	<table class='table table-bordered'>
         <tr>
         <th>ID</th>
         <th>Tanggal</th>
         <th>Nama</th>
         <th>Jumlah</th>
         <th>Harga Jual</th>
         <th>Total Harga</th>
         <th>Laba</th>
         </tr>
         <?php
         $stmt = $DB_con->prepare("SELECT * FROM barang_terjual WHERE id_terjual=:id_terjual");
         $stmt->execute(array(":id_terjual"=>$_GET['hapus_id']));
         while($row=$stmt->fetch(PDO::FETCH_BOTH))
         {
             ?>
             <tr>
             <td><?php print($row['id_terjual']); ?></td>
             <td><?php print($row['tanggal']); ?></td>
             <td><?php print($row['nama']); ?></td>
             <td><?php print($row['jumlah']); ?></td>
             <td><?php print($row['harga']); ?></td>
             <td><?php print(number_format($row['total_harga'])); ?></td>
             <td><?php print(number_format($row['laba'])); ?></td>
             </tr>
             <?php
         }
         ?>
         </table>
         <?php
}
?>
	
</div>



<div class="container">
<p>
<?php
if(isset($_GET['hapus_id']))
{
 ?>
   <form method="post">
    <input type="hidden" name="id" value="<?php echo $row['id_terjual']; ?>" />
    <button class="btn btn-large btn-primary" type="submit" name="btn-del"><i class="glyphicon glyphicon-trash"></i> &nbsp; YES</button>
    <a href="terjual.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; NO</a>
    </form>  
 <?php
}
else
{
 ?>
    <a href="barang.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; Back to index</a>
    <?php
}
?>
</p>
</div> 