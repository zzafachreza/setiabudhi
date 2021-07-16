<?php
error_reporting(0);

$serverName = "proint";  
/* Connect using Windows Authentication. */  
try  
{  
$conn = new PDO( "sqlsrv:server=$serverName ; Database=PROINT_ERP", "sa", "aDmInSTB4246");  
$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );  
}  
catch(Exception $e)  
{   
die( print_r( $e->getMessage() ) );   
}


$key = trim($_POST['key']);
$sql="SELECT top 1 SmProdBarcode.prodcode,SmProdBarcode.prodbarcode  FROM SmProdBarcode inner join SMProductms ON SmProdBarcode.prodcode = SMProductms.prodcode  WHERE SmProdBarcode.prodcode like '%$key%' or SmProdBarcode.prodbarcode like '%$key%' or prodname like '%$key%'";
 


$data = $conn->query($sql)->fetch();

$sku = $data['prodcode'];


$sql2="select top 1 PriceProduct,convert(float,IDRPrice) harga,prodname,prodUom from dbo.SMCusPriceListDt inner join SMProductms ON SMCusPriceListDt.PriceProduct = SMProductms.prodcode  where priceProduct='$sku' order by PriceSeq DESC";
$data2 = $conn->query($sql2)->fetch();


$TOKO = $conn->query("select  top 1 convert(float, ProdQty) QTY_TOKO from dbo.WHCurrentStock where prodCode='$sku' and wrhsCode='001'")->fetch();
$GUDANG = $conn->query("select  top 1 convert(float, ProdQty) QTY_GUDANG from dbo.WHCurrentStock where prodCode='$sku' and wrhsCode='002'")->fetch();
$FRESH = $conn->query("select  top 1 convert(float, ProdQty) QTY_FRESH from dbo.WHCurrentStock where prodCode='$sku' and wrhsCode='015'")->fetch();

$CONVERSI = $conn->query("select  top 1 UOMCode,convert(float,QtyStd) QtyStd,convert(float,QtyConversion) QtyConversion from SMProdEquivalen where prodcode='$sku'")->fetch();










function tglSql($tgl){
	$tgl = explode("/", $tgl);
	return $tgl[2]."-".$tgl[1]."-".$tgl[0];
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
function hitungHari($myDate1, $myDate2){
        $myDate1 = strtotime($myDate1);
        $myDate2 = strtotime($myDate2);
 
        return ($myDate2 - $myDate1)/ (24 *3600);
}



 		$img  = code128BarCode(str_replace(".", "", $sku), 1);
        ob_start();
        imagepng($img);
		$output_img   = ob_get_clean();
       $barcode128 ='<img class="barcode"  src="data:image/png;base64,'.base64_encode($output_img).'" />'; 

        $isi_teks = $sku;
		$namafile = "coba.png";
		$quality = 'H'; //ada 4 pilihan, L (Low), M(Medium), Q(Good), H(High)
		$ukuran = 5; //batasan 1 paling kecil, 10 paling besar
		$padding = 0;
		$qr = QRCode::png($isi_teks,$tempdir.$namafile,$quality,$ukuran,$padding);
		$path = $tempdir.$namafile;
		$type = pathinfo($path, PATHINFO_EXTENSION);
		$data = file_get_contents($path);
		$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

		


$host="localhost";
$db="ci";
$user="root";
$pass="";
$connMy=new PDO("mysql:host=$host;dbname=$db",$user,$pass);



$sqlRetur = $connMy->query("SELECT * FROM retur WHERE sku='$sku'")->fetch();
$retur = $sqlRetur['retur'];


?>



<style type="text/css">
	table.table-bordered{
    border:1px solid black;
    margin-top:20px;
  }
table.table-bordered > thead > tr > th{
    border:1px solid black;
}
table.table-bordered > tbody > tr > td{
    border:1px solid black;
}
</style>
	


<table class="table table-bordered">
	<tr style="background-color: #6d77df;color:#FFF">
		<th>SKU</th>
		<th>NAME</th>
		<th>KONVERSI</th>
	</tr>
	<tr>
		<td style="font-size:18pt;" ><?php echo $data2['PriceProduct'] ?></td>
		<td style="font-size:18pt;" ><?php echo $data2['prodname'] ?></td>
		<td style="font-size:18pt;" >
			<span style="background-color: red;color: #FFF">
				1  <?php echo $CONVERSI['UOMCode'] ?>
			</span>
			<span style="background-color: green;color: #FFF">
				BERISI <?php echo number_format($CONVERSI['QtyStd']) ?>
			</span>
			
		</td>
	</tr>

		

	</table>

<hr/>

<table class="table table-bordered">
	<tr style="background-color: #f3548e;color:#FFF">
		<th align="center">TOKO</th>
		<th align="center">GUDANG/RECEIVING</th>
		<th align="center">GUDANG FRESH</th>
		<th align="center">TOTAL</th>
	</tr>
	<tr>
		<td align="center"><h3><?php echo number_format($TOKO['QTY_TOKO']) ?></h3></td>
		<td align="center"><h3><?php echo number_format($GUDANG['QTY_GUDANG']) ?></h3></td>
		<td align="center"><h3><?php echo number_format($FRESH['QTY_FRESH']) ?></h3></td>
		<td align="center"><h3><?php echo number_format($TOKO['QTY_TOKO'] + $GUDANG['QTY_GUDANG'] + $FRESH['QTY_FRESH']) ?></h3></td>
	</tr>


	




	</table>


<table class="table table-bordered table-striped">
	<tr class="bg bg-success" style="color:#FFF">
	<!-- 	<th align="center">ID SUPPLIER</th>
		<th align="center">NAMA SUPPLIER</th>
		<th align="center">SALES ID</th> -->
		<th align="center">APAKAH BISA RETUR ?</th>
	</tr>
	<?php

	$sqlSup ="SELECT top 1 SMSupSalesProd.SupId,SalesId,SupName FROM SMSupSalesProd inner join SMSupplierMs on SMSupSalesProd.SupId = SMSupplierMs.SupId  WHERE prodcode='$sku'";
	$datSup = $conn->query($sqlSup);

	$no=0;
	while ($rSup = $datSup->fetch()) {

		?>
		<tr>
	<!-- 		<td><?php echo $rSup['SupId'] ?></td>
			<td><?php echo $rSup['SupName'] ?></td>
			<td><?php echo $rSup['SalesId'] ?></td> -->
			<td><?php echo $retur ?></td>
		</tr>
		<?php
		# code...
	}
	?>

		
</table>