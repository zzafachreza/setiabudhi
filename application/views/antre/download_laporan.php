<?php


function IndonesiTGL($TGL){
	$TGL = explode("-", $TGL);
	return $TGL[2]."/".$TGL[1]."/".$TGL[0];
}

date_default_timezone_set("Asia/Jakarta");

$NOW= date('Y-m-d');

$GROUP_PO = $_POST['GROUP_PO'];


function tglSql($tgl){
	$tgl = explode("/", $tgl);
	return $tgl[2]."-".$tgl[1]."-".$tgl[0];
}

 $awal = tglSql($_POST['awal']);
$akhir = tglSql($_POST['akhir']);



header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=BR ".$GROUP_PO."_".$awal."_".$akhir.".xls");//ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");
error_reporting(0);


$host="localhost";
$db="ci";
$user="root";
$pass="";
$conn=new PDO("mysql:host=$host;dbname=$db",$user,$pass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



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



if ($GROUP_PO==='ALL') {
	# code...
	$sql="SELECT * FROM data_antrian WHERE TANGGAL_ANTRIAN BETWEEN '$awal' AND '$akhir'";

}else{
	$sql="SELECT * FROM data_antrian WHERE GROUP_PO='$GROUP_PO' AND TANGGAL_ANTRIAN BETWEEN '$awal' AND '$akhir'";
}


		$hasil = $conn->query($sql);

?>
<style type="text/css">
  
.num {
  mso-number-format:General;
}
.text{
  mso-number-format:"\@";/*force text*/
}
</style>

<table class="table" style="width: 100%;font-size:xx-small; border-collapse: collapse;" border="1">
	<tr>
		<th colspan="12"><center><h1><?php echo $GROUP_PO ?></h1></center></th>
	</tr>
	<tr>
		<td colspan="12"><center><h3>BUKTI SERAH TERIMA FAKTUR</h3></center></td>
	</tr>
	<tr>
		<td colspan="12"><center><h3><?php echo $_POST['awal']." - ".$_POST['akhir'] ?></h3></center></td>
	</tr>
	<tr>
		<td style="width:30px;font-weight:bold;text-align:center;">NO</td>
		<td style="width:250px;font-weight:bold;text-align:center;">SUPPLIER_NAME</td>
		<td style="width:60px;font-weight:bold;text-align:center;">SUPPID</td>

		<td style="width:100px;font-weight:bold;text-align:center;">NO_PO</td>
		<td style="width:100px;font-weight:bold;text-align:center;">NO_GRN</td>
		<td style="width:50px;font-weight:bold;text-align:center;">INV</td>

		<td style="width:60px;font-weight:bold;text-align:center;">SALES_ID</td>
		<td style="width:100px;font-weight:bold;text-align:center;">TGL_JAM_ANTRI</td>
		<td style="width:100px;font-weight:bold;text-align:center">TGL_JAM_INPUT</td>
		<td style="width:100px;font-weight:bold;text-align:center;">PENGINPUT</td>
		<td style="width:100px;font-weight:bold;text-align:center;">CHECKER</td>
		<td style="width:100px;font-weight:bold;text-align:center;">JUMLAH_ITEM</td>


	</tr>
	<?php
	while ($r = $hasil->fetch()) {

			  $NO_PO = $r['NO_PO'];

		  $sqlPO="SELECT top 1 PRGrnDt.GRNNmbr,GRNRefNmbr,convert(varchar,PRGrnHd.GRNDate,103) GRNDate,PRGrnHd.UpdDate,PRGrnHd.GRNDesc,PRGrnHd.UpdUser FROM PRGrnDt INNER JOIN PRGrnHd ON PRGrnHd.GRNNmbr = PRGrnDt.GRNNmbr  WHERE PRGrnDt.PONmbr='$NO_PO'";
			$jml = $conn2->query($sqlPO)->fetch();



			$NO_GRN = $jml['GRNNmbr'];
			$NO_INV = $jml['GRNRefNmbr'];
			$TANGGAL_INPUT = $jml['GRNDate'];
			$JAM_INPUT = $jml['UpdDate'];
			$PENGINPUT = $jml['UpdUser'];
			$CHECKER = $jml['GRNDesc'];

						$sqlItems = "select count(GRNProduct) items from PRGrnDt WHERE GRNNmbr='$NO_GRN'";
						$dItem= $conn2->query($sqlItems)->fetch();

						$JUMLAH_ITEM_BARANG = $dItem['items'];

	?>
	<tr>
		<td>
			<?php echo $r['NO_ANTRIAN'] ?>
		</td>

		<td>
			<?php echo $r['SUPPLIER_NAME'] ?>
		</td>
				<td>
			<?php echo $r['SUPPLIER_ID'] ?>
		</td>

		<td>
			<?php echo $NO_PO ?>
		</td>
		<td>
			<?php echo $NO_GRN ?>
		</td>
		<td class="text">
			<?php echo $NO_INV ?>
		</td>
	
		<td>
			<?php echo $r['SALES_ID'] ?>
		</td>
		
		<td>
			<?php echo IndonesiTGL($r['TANGGAL_ANTRIAN']) ?>
			<?php echo substr($r['JAM_ANTRI'], 0,5) ?>
		</td>
		<td>
			<?php echo $TANGGAL_INPUT." ".substr($JAM_INPUT,10,6) ?>
		</td>
		<td>
			<?php echo $PENGINPUT ?>
		</td>
		<td>
			<?php $C = explode(	"-", $CHECKER);
						echo $C[3];
			 ?>
		</td>
		<td>
			<?php echo $JUMLAH_ITEM_BARANG ?>
		</td>
	
	</tr>

	<?php } ?>
</table>


