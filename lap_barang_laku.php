<?php

include 'dbconfig.php';
require('pdf/fpdf.php');

$pdf = new FPDF("L","cm","A4");

$pdf->SetMargins(2,1,1);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','B',11);
$pdf->Image('logo/logo.png',1,1,2,2);
$pdf->SetX(4);            
$pdf->MultiCell(19.5,0.5,'Perampok Google',0,'L');
$pdf->SetX(4);
$pdf->MultiCell(19.5,0.5,'Telpon : 082285690595**',0,'L');    
$pdf->SetFont('Arial','B',10);
$pdf->SetX(4);
$pdf->MultiCell(19.5,0.5,'JL. Lintas Sumatera, Bengkulu Utara',0,'L');
$pdf->SetX(4);
$pdf->MultiCell(19.5,0.5,'website : perampokgoogle.blogspot.com email : marconusivera@gmail.com',0,'L');
$pdf->Line(1,3.1,28.5,3.1);
$pdf->SetLineWidth(0.1);      
$pdf->Line(1,3.2,28.5,3.2);   
$pdf->SetLineWidth(0);
$pdf->ln(1);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(0,0.7,'Laporan Data Penjualan Barang',0,0,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(5,0.7,"Di cetak pada : ".date("D-d/m/Y"),0,0,'C');
$pdf->ln(1);
if (isset($_GET['tanggal'])) {
$pdf->Cell(6,0.7,"Laporan Penjualan pada : ".$_GET['tanggal'],0,0,'C');
}
$pdf->ln(1);
$pdf->Cell(1, 0.8, 'NO', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Tanggal', 1, 0, 'C');
$pdf->Cell(6, 0.8, 'Nama Barang', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Jumlah', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'harga', 1, 0, 'C');
$pdf->Cell(4.5, 0.8, 'Total harga', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'laba', 1, 1, 'C');

$no=1;
if (isset($_GET['tanggal'])) {
$tanggal=$_GET['tanggal'];
	$query="select * from barang_terjual where tanggal=" . $tanggal;
$stmt = $DB_con->prepare($query);
$stmt->execute();
while($lihat=$stmt->fetch(PDO::FETCH_ASSOC)){
	$pdf->Cell(1, 0.8, $no , 1, 0, 'C');
	$pdf->Cell(3, 0.8, $lihat['tanggal'],1, 0, 'C');
	$pdf->Cell(6, 0.8, $lihat['nama'],1, 0, 'C');
	$pdf->Cell(3, 0.8, $lihat['jumlah'], 1, 0,'C');
	$pdf->Cell(4, 0.8, "Rp. ".number_format($lihat['harga'])." ,-", 1, 0,'C');
	$pdf->Cell(4.5, 0.8, "Rp. ".number_format($lihat['total_harga'])." ,-",1, 0, 'C');
	$pdf->Cell(4, 0.8, "Rp. ".number_format($lihat['laba'])." ,-", 1, 1,'C');	
	
	$no++;
}
$q="select sum(total_harga) as total from barang_terjual where tanggal=".$tanggal;
// select sum(total_harga) as total from barang_terjual where tanggal='$tanggal'
$stmt = $DB_con->prepare($q);
$stmt->execute();
while($total=$stmt->fetch(PDO::FETCH_ASSOC)){
	$pdf->Cell(17, 0.8, "Total Pendapatan", 1, 0,'C');		
	$pdf->Cell(4.5, 0.8, "Rp. ".number_format($total['total'])." ,-", 1, 0,'C');	
}
$qu="select sum(laba) as total_laba from barang_terjual where tanggal=".$tanggal;
// select sum(total_harga) as total from barang_terjual where tanggal='$tanggal'
$stmt = $DB_con->prepare($qu);
$stmt->execute();
while($tl=$stmt->fetch(PDO::FETCH_ASSOC)){
	$pdf->Cell(4, 0.8, "Rp. ".number_format($tl['total_laba'])." ,-", 1, 1,'C');	
}
}else{
$query="select * from barang_terjual where tanggal";
$stmt = $DB_con->prepare($query);
$stmt->execute();
while($lihat=$stmt->fetch(PDO::FETCH_ASSOC)){
	$pdf->Cell(1, 0.8, $no , 1, 0, 'C');
	$pdf->Cell(3, 0.8, $lihat['tanggal'],1, 0, 'C');
	$pdf->Cell(6, 0.8, $lihat['nama'],1, 0, 'C');
	$pdf->Cell(3, 0.8, $lihat['jumlah'], 1, 0,'C');
	$pdf->Cell(4, 0.8, "Rp. ".number_format($lihat['harga'])." ,-", 1, 0,'C');
	$pdf->Cell(4.5, 0.8, "Rp. ".number_format($lihat['total_harga'])." ,-",1, 0, 'C');
	$pdf->Cell(4, 0.8, "Rp. ".number_format($lihat['laba'])." ,-", 1, 1,'C');	
	
	$no++;
}
$q="select sum(total_harga) as total from barang_terjual";
// select sum(total_harga) as total from barang_terjual where tanggal='$tanggal'
$stmt = $DB_con->prepare($q);
$stmt->execute();
while($total=$stmt->fetch(PDO::FETCH_ASSOC)){
	$pdf->Cell(17, 0.8, "Total Pendapatan", 1, 0,'C');		
	$pdf->Cell(4.5, 0.8, "Rp. ".number_format($total['total'])." ,-", 1, 0,'C');	
}
$qu="select sum(laba) as total_laba from barang_terjual";
// select sum(total_harga) as total from barang_terjual where tanggal='$tanggal'
$stmt = $DB_con->prepare($qu);
$stmt->execute();
while($tl=$stmt->fetch(PDO::FETCH_ASSOC)){
	$pdf->Cell(4, 0.8, "Rp. ".number_format($tl['total_laba'])." ,-", 1, 1,'C');	
}

}
$pdf->Output("laporan_barang_laku.pdf","I");

?>

