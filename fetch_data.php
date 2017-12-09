<?php 
include_once 'dbconfig.php'; 
$state = $_POST['get_option'];
$query = "SELECT harga_jual from tb_barang WHERE nama_brg='$state'";
$stmt = $DB_con->prepare($query);
$stmt->execute();
while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
	echo "<option value='".$row['harga_jual']."'>".$row['harga_jual'] ."</option>";
}
// $barang->select($state);
?>
