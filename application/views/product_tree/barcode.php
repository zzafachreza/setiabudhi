<?php 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=PRODUCT_BARCODE ".date('ymd').".xls");//ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");
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


$sql = "SELECT ProdCode,ProdBarcode,FgBarcodeDefault  FROM SMprodBarcode";

$hasil = $conn->query($sql);

// $r = $hasil->fetch();
// print_r($r);
// die();

?>

<style type="text/css">
  
.num {
  mso-number-format:General;
}
.text{
  mso-number-format:"\@";/*force text*/
}
</style>


<table style="width: 100%" border="1">
	<tr style="background-color: #2ecc71">
		<th>NO</th>
		<th>SKU</th>
		<th>BARCODE</th>
		<th>DEFAULT</th>

		
	</tr>

	<?php

	$no=1;

	while ($r = $hasil->fetch()) {
	?>
	<tr>
		<td><?php echo $no ?></td>
		<td class="text"><?php echo $r['ProdCode'] ?></td>
		<td class="text"><?php echo $r['ProdBarcode'] ?></td>
		<td class="text"><?php echo $r['FgBarcodeDefault'] ?></td>

		
		
	</tr>


	<?php
	$no++; }
	?>
</table>
