<?php
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


function IndonesiTGL($TGL){
	$TGL = explode("-", $TGL);
	return $TGL[2]."/".$TGL[1]."/".$TGL[0];
}


$key=$_POST['key'];

$sql="SELECT * FROM data_antrian WHERE NO_PO like '%$key%' limit 10";
$hasil= $conn->query($sql);
?>


<table class="table table-bordered table-hover table-striped" style="width: 100%;font-size:small; border-collapse: collapse;">
	<tr>
		<td style="width:30px;font-weight:bold">NO</td>
		<td style="width:180px;font-weight:bold">SUPPLIER_NAME</td>
		<td style="width:60px;font-weight:bold">SUPPID</td>

		<td style="width:100px;font-weight:bold">NO_PO</td>
		<td style="width:100px;font-weight:bold">NO_GRN</td>
		<td style="width:50px;font-weight:bold">INV</td>

		<td style="width:60px;font-weight:bold">SALES_ID</td>
		<td style="width:100px;font-weight:bold">TGL_JAM_ANTRI</td>
		<td style="width:100px;font-weight:bold">TGL_JAM_INPUT</td>
		<td style="width:60px;font-weight:bold">PENGINPUT</td>
		<td style="width:60px;font-weight:bold">CHECKER</td>
		<td style="width:100px;font-weight:bold">JUMLAH_ITEM</td>
		<td style="width:100px;font-weight:bold">AKSI</td>


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
		<td>
			<a  class="btn btn-danger hapus" data-id="<?php echo $NO_PO ?>" >HAPUS</a>
		</td>
	
	</tr>

	<?php } ?>
</table>


