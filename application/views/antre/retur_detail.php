<?php
date_default_timezone_set("Asia/Jakarta");
$host="localhost";
$db="serah_terima";
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



$sqlHP= "SELECT AppNumber,convert(varchar,AppDate,103) AppDate,AppSuplier,SupName,AppDesc FROM PRReturHd INNER JOIN SMSUpplierMs ON  SMSUpplierMs.supid = PRReturHd.AppSuplier WHERE AppNumber='$NO_RETUR'";;
$hasilHP = $conn2->query($sqlHP);
$dataHP = $hasilHP->fetch();


// detail

$sqlDT= "select GRNNmbr,PRReturDt.ProdCode,prodName,convert(float,ProdQty) ProdQty,PRReturDt.ProdUOM,convert(float,ProdPrice) ProdPrice,convert(float,ProdQtyPrice) ProdQtyPrice ,ProdPcPPN,convert(float,ProdBruto) bruto,convert(float,ProdPPN) ppn,convert(float,ProdNetto) netto,prodDesc from dbo.PRReturDt inner join SMProductMs on PRReturDt.ProdCode = SMProductMs.ProdCode WHERE AppNumber='$NO_RETUR'";
$hasilDT = $conn2->query($sqlDT);


?>
<table class="table table-bordered table-striped" style="font-size:large;margin-top:5%;width:100%">
	<tr>
		<td style="background-color:#ccc">NO_RETUR</td>
		<td><?php echo $NO_RETUR ?></td>
		<td style="background-color:#ccc">TANGAL_RETUR</td>
		<td><?php echo $dataHP['AppDate'] ?></td>
	</tr>
	<tr>
		<td style="background-color:#ccc">SUPPLIER_ID</td>
		<td><?php echo $dataHP['AppSuplier'] ?></td>
		<td style="background-color:#ccc">SUPPLIER_NAME</td>
		<td><?php echo $dataHP['SupName'] ?></td>
	</tr>
	<tr>
		<td colspan="3" style="background-color:#ccc">
			KETERANGAN
		</td>
		<td>
			<?php echo $dataHP['AppDesc'] ?>
		</td>
	</tr>
</table>
<table class="table table-bordered table-striped" style="font-size:large;margin-top:5%;width:100%">
																		<tr style="background-color:#ccc">
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

																	<table class="table table-borderd" style="font-size:small;width:35%;margin-left:65%;font-weight:bold">
																		<tr>
																			<td  align="right">Bruto Total</td>
																			<td  align="right"><?php echo number_format($brutoTotal,2) ?></td>
																		</tr>
																		<tr>
																			<td  align="right">PPN Total</td>
																			<td  align="right"><?php echo number_format($ppnTotal,2) ?></td>
																		</tr>
																		<tr>
																			<td  align="right">Netto Total</td>
																			<td  align="right"><?php echo number_format($nettoTotal,2) ?></td>
																		</tr>
																		
																	</table>
	