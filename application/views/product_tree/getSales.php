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

$supid = $_GET['supid'];

?>

<label>Please Select SalesName</label>

					<select class="form-control selectza" name="salesid" id="salesid">
						<option></option>
						<?php
							$sqlSupplier ="SELECT * FROM SMSupSales WHERE supid='$supid'";
							$dataSupplier = $conn->query($sqlSupplier);

							while ($rSupplier = $dataSupplier->fetch()) {
								# code...
							
						?>


							<option value="<?php echo $rSupplier['SalesId'] ?>"><?php echo $rSupplier['SalesId'] ?> - <?php echo $rSupplier['SalesName'] ?> ( <?php echo $rSupplier['SalesDesc'] ?> ) </option>
						<?php
							}
						?>
					</select>