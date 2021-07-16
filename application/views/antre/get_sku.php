<?php

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

$data = explode("|", $_POST['supid']);
$supid = $data[0];

$sql = "SELECT SupId,SMSUpSalesProd.ProdCode,ProdName,ProdUOM FROM SMSUpSalesProd INNER JOIN SMProductMs ON SMSUpSalesProd.ProdCode = SMProductMs.ProdCode  WHERE SupId='$supid'";

$hasil = $conn2->query($sql);



?>

<select name="PRODUCT" class="form-control" id="PRODUCT">
<option></option>
<?php
	while ($data = $hasil->fetch()) {
		# code...
	
?>
	<option><?php echo $data['ProdCode'] ?> | <?php echo $data['ProdName'] ?> | <?php echo $data['ProdUOM'] ?></option>

<?php } ?>
</select>

