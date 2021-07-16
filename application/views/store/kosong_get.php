<?php

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

$host="localhost";
$db="ci";
$user="root";
$pass="";
$connMy=new PDO("mysql:host=$host;dbname=$db",$user,$pass);



$sku = $_GET['sku'];

$sqlSKU = "SELECT top 1 SMProductMs.ProdCode,ProdName,ProdUOM FROM SMProductMs INNER JOIN SMProdBarcode ON SMProdBarcode.ProdCode = SMProductMs.ProdCode WHERE SMProdBarcode.ProdBarcode like '%$sku%' OR SMProductMs.ProdCode like '%$sku%' OR ProdName like '%$sku%'";
$hasilSKU = $conn->query($sqlSKU);

$jml = $conn->query($sqlSKU)->rowCount();

if ($jml==0) {
	# code...
	echo "product tidak ditemukan !";
	die();
}

$dataSKU = $hasilSKU->fetch();

$ProdCode = $dataSKU['ProdCode'];
$ProdName = $dataSKU['ProdName'];
$ProdUOM = $dataSKU['ProdUOM'];

$sqlSTOK_TOKO = "SELECT convert(float,ProdQty) STOK_TOKO FROM WHCurrentStock WHERE ProdCode='$ProdCode' AND WrhsCode='001'";
$hasilSTOK_TOKO = $conn->query($sqlSTOK_TOKO);
$dataSTOK_TOKO = $hasilSTOK_TOKO->fetch();
$STOK_TOKO = $dataSTOK_TOKO['STOK_TOKO'];

$sqlSTOK_GUDANG = "SELECT convert(float,ProdQty) STOK_GUDANG FROM WHCurrentStock WHERE ProdCode='$ProdCode' AND WrhsCode='002'";
$hasilSTOK_GUDANG = $conn->query($sqlSTOK_GUDANG);
$dataSTOK_GUDANG = $hasilSTOK_GUDANG->fetch();
$STOK_GUDANG = $dataSTOK_GUDANG['STOK_GUDANG'];

$sqlPO = "SELECT top 1 PrPodt.PONmbr,convert(char(10),POdate,126) LAST_PO_DATE,convert(float,POStdQty) QTY_ORDER FROM PrPodt INNER JOIN PrPoHd ON PrPodt.PONmbr = PrPoHd.PONmbr WHERE PrPodt.POProduct='$ProdCode' ORDER BY POdate DESC";
$hasilPO = $conn->query($sqlPO);
$dataPO = $hasilPO->fetch();

function tglIndonesia($tanggal){
  $namaBln = array("01" => "Januari", "02" => "Februari", "03" => "Maret", "04" => "April", "05" => "Mei", "06" => "Juni", 
           "07" => "Juli", "08" => "Agustus", "09" => "September", "10" => "Oktober", "11" => "November", "12" => "Desesmber");
           
  $tgl=substr($tanggal,8,2);
  $bln=substr($tanggal,5,2);
  $thn=substr($tanggal,0,4);
  $tanggal ="$tgl ".$namaBln[$bln]." $thn";
  return $tanggal;
}




$LAST_PO_DATE = $dataPO['PONmbr']."( ".tglIndonesia($dataPO['LAST_PO_DATE'])." )";



?>

<form id="dataForm" method="POST">
	<div class="row">
	<div class="col col-sm-3">
	<div class="form-group">

		<label>SKU</label>
		<input type="hidden" name="kode" class="form-control" value="<?php echo $_GET['kode'] ?>" />
		<input type="hidden" name="tgl" class="form-control" value="<?php echo $_GET['tgl'] ?>" />
		<input type="hidden" name="member" class="form-control" value="<?php echo $_GET['member'] ?>" />

		<input readonly="readonly"  name="sku" class="form-control" value="<?php echo $ProdCode ?>" />
	</div>
</div>

<div class="col col-sm-6">
	<div class="form-group">
		<label>NAMA</label>
		<input readonly="readonly"  name="nama" class="form-control" value="<?php echo $ProdName ?>" />
	</div>
</div>

<div class="col col-sm-3">
	<div class="form-group">
		<label>&nbsp;</label>
		<input readonly="readonly"  name="uom" class="form-control" value="<?php echo $ProdUOM ?>" />
	</div>
</div>

<div class="col col-sm-3">
	<div class="form-group">
		<label>STOK TOKO</label>
		<input readonly="readonly"  name="qty_toko" class="form-control" value="<?php echo number_format($STOK_TOKO) ?>" />
	</div>
</div>
<div class="col col-sm-3">
	<div class="form-group">
		<label>STOK GUDANG</label>
		<input readonly="readonly"  name="qty_gudang" class="form-control" value="<?php echo number_format($STOK_GUDANG) ?>" />
	</div>
</div>

<div class="col col-sm-6">
	<div class="form-group">
		<label>PO TERAKHIR</label>
		<input readonly="readonly"  name="po" class="form-control" value="<?php echo $LAST_PO_DATE ?>" />
		<input type="text" style="background-color:white;width:200px;float:right;color:white" id="qty" placeholder="tekan enter untuk simpan">
	</div>
</div>
	
<div class="col-sm-12">
		<button class="btn btn-danger col-sm-12">
			SIMPAN
		</button>
</div>

</div>


</form>

