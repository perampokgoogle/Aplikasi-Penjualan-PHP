<?php
include_once 'dbconfig.php';

if(isset($_POST['btn-del']))
{
 $id = $_GET['hapus_id'];
 $table = 'tb_barang';
 $barang->delete($id,$table);
 header("Location: hapus.php?terhapus"); 
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
  if(isset($_GET['hapus_id']))
  {
   ?>
         <table class='table table-bordered'>
         <tr>
         <th>ID</th>
         <th>Nama</th>
         <th>Jenis</th>
         <th>Suplier</th>
         <th>Harga Modal</th>
         <th>Harga Jual</th>
         <th>Jumlah Sisa</th>
         </tr>
         <?php
         $stmt = $DB_con->prepare("SELECT * FROM tb_barang WHERE id_barang=:id_barang");
         $stmt->execute(array(":id_barang"=>$_GET['hapus_id']));
         while($row=$stmt->fetch(PDO::FETCH_BOTH))
         {
             ?>
             <tr>
             <td><?php print($row['id_barang']); ?></td>
             <td><?php print($row['nama_brg']); ?></td>
             <td><?php print($row['jenis']); ?></td>
             <td><?php print($row['suplier']); ?></td>
             <td><?php print($row['harga_modal']); ?></td>
             <td><?php print($row['harga_jual']); ?></td>
             <td><?php print($row['jumlah']); ?></td>
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
    <input type="hidden" name="id" value="<?php echo $row['id_barang']; ?>" />
    <button class="btn btn-large btn-primary" type="submit" name="btn-del"><i class="glyphicon glyphicon-trash"></i> &nbsp; YES</button>
    <a href="barang.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; NO</a>
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