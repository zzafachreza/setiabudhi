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

$sku = $_GET['key'];
$SqlData ="SELECT top 1 * FROM SMProductMs WHERE ProdCode like '%$sku%' OR ProdName like '%$sku%'";
$dataDetail = $conn->query($SqlData)->fetch();

// print_r($dataDetail);
?>
<style type="text/css">
	.sudah{
		background-color: #e84393;
		color: #FFF;
	}
</style>
<table id="tabzza" class="table table-bordered">
	<tr>
		<td><?php echo $dataDetail['ProdCode'] ?></td>
		<td><?php echo $dataDetail['ProdName'] ?></td>
		<td><?php echo $dataDetail['ProdUOM'] ?></td>
		<td><a id="pilih" style="color:#FFF" data-sku="<?php echo $dataDetail['ProdCode'] ?>" class="btn btn-success">PILIH</a></td>
	</tr>
</table>

