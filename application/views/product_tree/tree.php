<?php 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=PRODUCT_SUPSALES ".date('ymd').".xls");//ganti nama sesuai keperluan
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


$sql = "select SMSupSalesProd.Supid as SupId,supName,SMSupSalesProd.SalesID,SMSupSalesProd.Prodcode,prodname,ProdUom,fgDefault from SMSupSalesProd 
inner join SMSupplierMS ON SMSupSalesProd.supid =  SMSupplierMS.supid inner join SmproductMs ON SMproductMs.prodcode = SmSupsalesProd.prodcode
inner join SmprodField ON SMproductMs.prodcode = SmprodField.prodcode";

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


<table style="width: 100%" border="1">
	<tr style="background-color: #3498db">
		<th>NO</th>
		<th>SUPPLIER ID</th>
		<th>SUPPLIER NAME</th>
		<th>SALES ID</th>
		<th>SKU</th>
		<th>SKU NAME</th>
		<th>UOM</th>
	</tr>

	<?php

	$no=1;

	while ($r = $hasil->fetch()) {
	?>
	<tr>
		<td><?php echo $no ?></td>
		<td class="text"><?php echo $r['SupId'] ?></td>
		<td><?php echo $r['supName'] ?></td>
		<td><?php echo $r['SalesID'] ?></td>
		<td class="text"><?php echo $r['Prodcode'] ?></td>
		<td><?php echo $r['prodname'] ?></td>
		<td><?php echo $r['ProdUom'] ?></td>
	</tr>


	<?php
	$no++; }
	?>
</table>
