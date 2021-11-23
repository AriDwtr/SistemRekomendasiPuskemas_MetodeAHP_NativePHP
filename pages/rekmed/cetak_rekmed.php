<?php
require('../api/fpdf.php');
include "../conn/koneksi.php";
session_start();
$id = $_GET['id'];
$data = mysqli_query($conn,"SELECT * FROM rekmed WHERE no_rekmed='$id'");
$row = mysqli_fetch_array($data);
$id_pasien = $row['no_pasien'];
$data2 = mysqli_query($conn,"SELECT * FROM pasien WHERE no_pasien='$id_pasien'");
$row2 = mysqli_fetch_array($data2);
$data3 = mysqli_query($conn,"SELECT * FROM spk WHERE no_rekmed='$id'");
$row3 = mysqli_fetch_array($data3);
$cov = round($row3['total'], 2);
$pen = $cov * 100;
switch ($pen) {
  case ($pen >= 25 && $pen<= 35):
  $hs='Rawat Inap';
  break;
  case ($pen < 25):
 $hs='Rawat Jalan';
    break;
  default: //default
  $hs='Rujuk';
  break;
};
if ($row2['jk']=="l") {
  $jk="Laki-Laki";
}else {
  $jk="Perempuan";
}
$tgl_rekam = new DateTime($row['tgl_rekam']);
$tanggal = new DateTime($row2['tgl_lahir']);
$today = new DateTime('today');
$y = $today->diff($tanggal)->y;
$m = $today->diff($tanggal)->m;
$d = $today->diff($tanggal)->d;
if($y > "6")
{
  $umur = $y.' TAHUN';
}elseif ($y == "0") {
  $umur = $m.' BULAN';
}elseif ($y > "0") {
  $umur = $y.' TAHUN';
};

$mala=$row['malaria'];
switch ($mala) {
  case ($mala == "Pf"):
  $detail = "Plasmodium falciparum (PF)";
  break;
  case ($mala == "Pv"):
  $detail = "Plasmodium vivax (PV)";
  break;
  case ($mala == "Po"):
  $detail = "Plasmodium ovale (PO)";
  break;
  case ($mala == "Pm"):
  $detail = "Plasmodium malariae (PM)";
  break;
  case ($mala == "Pk"):
  $detail = "Plasmodium knowlesi (PK)";
  break;
}
function tgl_indo($tanggal){
	$bulan = array (
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);
	$pecahkan = explode('-', $tanggal);

	// variabel pecahkan 0 = tanggal
	// variabel pecahkan 1 = bulan
	// variabel pecahkan 2 = tahun

	return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}
$tgl = tgl_indo(date('Y-m-d'));
class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    $this->Image('../../dist/img/puskesmas.png',165,23,25);
    // Logo
    $this->Image('../../dist/img/Flores Timur.png',18,23,39);
    $this->SetFont('times','B',14);
    // Move to the right
    $this->Cell(75);
    // Title
    $this->Cell(18,0,'PEMERINTAH KABUPATEN FLORES TIMUR',0,0,'C');
    // Line break
    $this->Ln(2);
    //
    $this->Cell(75);
    // Title
    $this->Cell(18,10,'DINAS KESEHATAN',0,0,'C');
    // Line break
    $this->Ln(7);
    //
    $this->Cell(75);
    // Title
    $this->Cell(18,10,'UPTD PUSKESMAS WAIWERANG',0,0,'C');
    // Line break
    $this->Ln(7);
    //Line Break
    $this->SetFont('times');
    //Font
    $this->Cell(75);
    //Titlw
    $this->SetFont('Times','',9);
    $this->Cell(18,10,'Jln. Pasar Inpres Waiwerang',0,0,'C');
    $this->Ln(5);
    $this->Cell(75);
    //Titlw
    $this->Cell(18,10,'Kecamatan Adonara Timur Kode Pos 86261',0,0,'C');
    $this->Ln(10);
    $this->Rect(25,55,165,0.1,'F');
    $this->Rect(25,56,165,1,'F');

}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Halaman '.$this->PageNo().'/{nb}',0,0,'C');
}
}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->SetMargins(25, 25, 20);
$pdf->SetAutoPageBreak(true,25);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','B',16);
$pdf->Cell(0,10,'REKAM MEDIS PASIEN MALARIA',0,0,'C');
$pdf->Ln(20);
//No pasien
$pdf->SetFont('Times','B',11);
$pdf->Cell(0);
$pdf->Write(0,'Nomor Pasien');
$pdf->Cell(8.2);
$pdf->Cell(20,0,': P - '.$row['no_pasien'],0,0);
$pdf->Ln(7);
//no pasien
//nama pasien
$pdf->Cell(0);
$pdf->Write(0,'Nama Pasien');
$pdf->Cell(10);
$pdf->Cell(20,0,': '.strtoupper($row2['nama']),0,0);
$pdf->Ln(7);
//nama pasien
//Tanggal Lahir
$pdf->Cell(0);
$pdf->Write(0,'Tanggal Lahir');
$pdf->Cell(7.5);
$pdf->Cell(20,0,': '.date("d/m/Y",strtotime($row2['tgl_lahir'])),0,0);
$pdf->Ln(7);
//Tanggal Lahir
//umur
$pdf->Cell(0);
$pdf->Write(0,'Umur');
$pdf->Cell(21.5);
$pdf->Cell(20,0,': '.$umur,0,0);
$pdf->Ln(7);
//umur
//Jenis Kelamin
$pdf->Cell(0);
$pdf->Write(0,'Jenis Kelamin');
$pdf->Cell(7.6);
$pdf->Cell(20,0,': '.strtoupper($jk),0,0);
$pdf->Ln(7);
//Jenis Kelamin
//Layanan
$pdf->Cell(0);
$pdf->Write(0,'Layanan');
$pdf->Cell(16.5);
$pdf->Cell(20,0,': '.strtoupper($row2['jenis_layanan']),0,0);
$pdf->Ln(7);
//layanan
//Alamat
$pdf->Cell(0);
$pdf->Write(0,'Alamat');
$pdf->Cell(19);
$pdf->Cell(20,0,': '.$row2['alamat'],0,0);
$pdf->Ln(7);
//Alamat
//keterangan Analisa
$pdf->SetFont('Times','UI',12);
$pdf->Cell(0);
$pdf->Write(0,'Detail Analisa');
$pdf->Cell(21);
$pdf->Cell(20,0,'',0,0);
$pdf->Ln(7);
//Keterangan Analisa
//border
$pdf->SetFont('Times','B',12);
$pdf->Cell(20,85,'Hasil',1,0,'C');
$pdf->Cell(40,5,'ANALISA',1,0,'C');
$pdf->Cell(108,5,'KETERANGAN',1,1,'C');

$pdf->SetFont('Times','',12);
$pdf->Cell(20);
$pdf->Cell(40,10,'Anamesa',1,0,'C');
$pdf->Cell(108,10,$row['anamnesa'],1,1,'C');

$pdf->Cell(20);
$pdf->Cell(40,10,'Tekanan Darah (TD)',1,0,'C');
$pdf->Cell(108,10,$row['td'],1,1,'C');

$pdf->Cell(20);
$pdf->Cell(40,10,'Heart Rate (HR)',1,0,'C');
$pdf->Cell(108,10,$row['hr'],1,1,'C');

$pdf->Cell(20);
$pdf->Cell(40,10,'Respiration Rate (RR)',1,0,'C');
$pdf->Cell(108,10,$row['rr'],1,1,'C');

$pdf->Cell(20);
$pdf->Cell(40,10,'Suhu',1,0,'C');
$pdf->Cell(108,10,$row['suhu'],1,1,'C');

$pdf->Cell(20);
$pdf->Cell(40,10,'Komplikasi',1,0,'C');
$pdf->Cell(108,10,$row['komplikasi'],1,1,'C');

$pdf->Cell(20);
$pdf->Cell(40,10,'Hemoglobin (HB)',1,0,'C');
$pdf->Cell(108,10,$row['hb'],1,1,'C');

$pdf->Cell(20);
$pdf->Cell(40,10,'Malaria',1,0,'C');
$pdf->Cell(108,10,$detail,1,1,'C');
//border
$pdf->SetFont('Times','',6);
$pdf->Cell(10,6,"* Tanggal Rekam Medis : ".date("d/m/Y",strtotime($row['tgl_rekam'])),0);

$pdf->Ln(5);
$pdf->SetFont('Times','',11);
$pdf->MultiCell(0,6,"Berdasarkan Analisa Di Atas Menjelaskan Bahwa Pasien Atas Nama : ".strtoupper($row2['nama'])." Harus Melakukan Tindakan Medis Secara ".strtoupper($hs),0);

$pdf->Cell(0,15,'Waiwerang, '.$tgl,0,0,'R');
$pdf->Ln(15);
$pdf->SetFont('Times','BU',11);
$pdf->Cell(166,15,$_SESSION['nama'],0,0,'R');
$pdf->Ln(1);
$pdf->Cell(166,22,"NIP :".$_SESSION['nip'],0,0,'R');
$pdf->Output();
?>
