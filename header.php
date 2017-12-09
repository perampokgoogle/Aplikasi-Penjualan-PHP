<!DOCTYPE html>
<html lang="en">
<head>
	<title>Aplikasi Penjualan</title>
<meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
 	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui.js"></script>
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
</head>
<body>

<!-- Fixed navbar -->
<nav class="navbar navbar-default">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="index.php">Aplikasi Penjualan</a>
		</div>
		<div id="navbar" class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li class=""><a href="#"><i class="glyphicon glyphicon-home"></i> Home</a></li>
				<li><a href="barang.php"><i class="glyphicon glyphicon-bookmark"></i> Barang</a></li>
				<li><a href="terjual.php"><i class="glyphicon glyphicon-shopping-cart"></i> Entry Penjualan</a></li>
			</ul>

			<ul class="nav navbar-nav navbar-right">
				<li><a id="pesan_sedia" href="#" data-toggle="modal" data-target="#modalpesan"><span class='glyphicon glyphicon-comment'></span>  Pesan</a></li>
<!-- 				<li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
				<li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li> -->
			</ul>

		</div>
	</div>
</nav>

<!-- modal input -->
<div id="modalpesan" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Pesan Notification</h4>
			</div>
			<div class="modal-body">
			<?php 
			$query="SELECT * FROM tb_barang where jumlah<=5";
			$barang->pesan($query);
			?>
			</div>
		</div>
	</div>
</div>
