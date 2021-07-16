<?php


$host="localhost";
$db="ci";
$user="root";
$pass="";
$conn=new PDO("mysql:host=$host;dbname=$db",$user,$pass);

$id = $_GET['id'];

$sqlHd = "SELECT * FROM serah WHERE id='$id'";

$dataHd = $conn->query($sqlHd)->fetch();



$serverName = "proint";  
  
/* Connect using Windows Authentication. */  
try  
{  
$conn2 = new PDO( "sqlsrv:server=$serverName ; Database=PROINT_ERP", "sa", "aDmInSTB4246");  
$conn2->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );  
}  
catch(Exception $e)  
{   
die( print_r( $e->getMessage() ) );   
}



function Indonesia3Tgl($tanggal){
  $namaBln = array("01" => "Januari", "02" => "Februari", "03" => "Maret", "04" => "April", "05" => "Mei", "06" => "Juni", 
           "07" => "Juli", "08" => "Agustus", "09" => "September", "10" => "Oktober", "11" => "November", "12" => "Desember");
           
  $tgl=substr($tanggal,8,2);
  $bln=substr($tanggal,5,2);
  $thn=substr($tanggal,0,4);
  $tanggal ="$tgl ".$namaBln[$bln]." $thn";
  return $tanggal;
}






//barcode QR
 
$id= $dataHd['id'];
$nama_supplier= $dataHd['nama_supplier'];
$pengambilan_barang= $dataHd['keterangan'];
$tanggal_ambil= Indonesia3Tgl($dataHd['tgl']);
$no_retur= $dataHd['no_retur'];

$isi_teks = $no_retur;
$namafile = "coba.png";
$quality = 'H'; //ada 4 pilihan, L (Low), M(Medium), Q(Good), H(High)
$ukuran = 5; //batasan 1 paling kecil, 10 paling besar
$padding = 0;
$tempdir =''; 
$qr = QRCode::png($isi_teks,$tempdir.$namafile,$quality,$ukuran,$padding);
 
$path = $tempdir.$namafile;
$type = pathinfo($path, PATHINFO_EXTENSION);
$data = file_get_contents($path);
$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
  $qrcode = '<img width="100" height="100" src="'.$base64.'" />';

//barcode Batang 128

               $img      = code128BarCode($isi_teks, 1);
              ob_start();
              imagepng($img);
           
              $output_img   = ob_get_clean();
              echo "";

 $barcode128 ='<img width="250" height="60" src="data:image/png;base64,'.base64_encode($output_img).'" />'; 



$sqlHP= "select AppNumber,Appdate tgl,Appdesc as keterangan from dbo.PRReturHd WHERE AppNumber='$no_retur'";
$hasilHP = $conn2->query($sqlHP);
$dataHP = $hasilHP->fetch();
$tgl_retur = Indonesia3Tgl(substr($dataHP['tgl'], 0,10));
$keterangan = $dataHP['keterangan'];

// detail

$sqlDT= "select GRNNmbr,PRReturDt.ProdCode,prodName,convert(float,ProdQty) ProdQty,PRReturDt.ProdUOM,convert(float,ProdPrice) ProdPrice,convert(float,ProdQtyPrice) ProdQtyPrice ,ProdPcPPN,convert(float,ProdBruto) bruto,convert(float,ProdPPN) ppn,convert(float,ProdNetto) netto,prodDesc from dbo.PRReturDt inner join SMProductMs on PRReturDt.ProdCode = SMProductMs.ProdCode WHERE AppNumber='$no_retur'";
$hasilDT = $conn2->query($sqlDT);
?>


<div class="container-fluid">
	<table class="table" style="margin-top: 2%">
		<tr>
			<th class="text-primary">Nomor Retur</th>
			<td><h4><?php echo $no_retur ?></h4></td>
			<th class="text-primary">Tanggal Retur</th>
			<td><h4><?php echo $tgl_retur ?></h4></td>
		</tr>
		<tr>
			<th class="text-primary">Supplier</th>
			<td><h4><?php echo $nama_supplier ?><h4></td>
			<th class="text-primary">Tanggal Ambil</th>
			<td><h4><?php echo $tanggal_ambil ?><h4></td>
		</tr>
		<tr>
			<th colspan="2"></th>
			
			<th class="text-primary">Diambil Oleh</th>
			<td><h4><?php echo $pengambilan_barang ?><h4></td>
		</tr>
	</table>
	<hr/>
	<table class="table table-bordered table-striped" style="font-size:small;margin-top:5%">
																		<tr class="bg bg-primary" style="color:#FFF">
																			<th>No</th>
																			<th>GRN no</th>
																			<th>SKU</th>
																			<th>Nama</th>
																			<th>Qty</th>
																			<th>UOM</th>
																			<th>Price</th>
																			<th>Total Price</th>
																			<th>Bruto</th>
																			<th>PPN (%)</th>
																			<th>PPN</th>
																			<th>Netto</th>
																		</tr>

																		<?php
																		$no=1;
																		$ppnTotal =0;
																		$brutoTotal=0;
																		$nettoTotal=0;

																		while ($dataDT = $hasilDT->fetch()) {
																		
																		?>

																		<tr>
																		<td><?php echo $no ?></td>
																		<td><?php echo $dataDT['GRNNmbr'] ?></td>
																		<td><?php echo $dataDT['ProdCode'] ?></td>
																		<td><?php echo $dataDT['prodName'] ?></td>
																		<td><?php echo number_format($dataDT['ProdQty']) ?></td>
																		<td><?php echo $dataDT['ProdUOM'] ?></td>
																		<td><?php echo number_format($dataDT['ProdPrice'],2) ?></td>
																		<td><?php echo number_format($dataDT['ProdQtyPrice'],2) ?></td>
																		<td><?php 
																		$brutoTotal += $dataDT['bruto'];

																		echo number_format($dataDT['bruto'],2) ?></td>
																		<td><?php echo number_format($dataDT['ProdPcPPN']) ?></td>
																		<td><?php 
																		$ppnTotal +=$dataDT['ppn'];
																		 echo number_format($dataDT['ppn'],2) ?></td>
																		<td><?php 
																		$nettoTotal +=$dataDT['netto'];
																		echo number_format($dataDT['netto'] ,2)?></td>
															
																		</tr>


																		<?php
																		$no++; }
																		?>
																		
																	</table>

																	<table class="table table-borderd" style="font-size:large;width:35%;margin-left:65%;font-weight:bold">
																		<tr>
																			<td style="color:#FFF"  align="right" class="bg-primary">Bruto Total</td>
																			<td  align="right"><?php echo number_format($brutoTotal,2) ?></td>
																		</tr>
																		<tr>
																			<td style="color:#FFF"  align="right" class="bg-primary">PPN Total</td>
																			<td  align="right"><?php echo number_format($ppnTotal,2) ?></td>
																		</tr>
																		<tr>
																			<td style="color:#FFF"  align="right" class="bg-primary">Netto Total</td>
																			<td  align="right"><?php echo number_format($nettoTotal,2) ?></td>
																		</tr>
																		
																	</table>

</div>