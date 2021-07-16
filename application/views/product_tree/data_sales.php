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

$sql="select top 10 SupId,SalesId,SalesName,SalesDesc,SalesTOP,SalesTOP2 from SMSupSales";
?>



				<label>Select Supplier</label>
				<select id="salesid" class="form-control selectza" required="required" name="salesid">
					<option></option>
					<?php
						
							$hasil = $conn->query($sql);
							while ($r = $hasil->fetch()) {
								# code...
							
					?>

					<option value="<?php  echo $r['SalesId'] ?>#<?php  echo $r['SalesName'] ?>#<?php  echo $r['SalesTOP'] ?>"><?php  echo $r['SalesId'] ?> - <?php  echo $r['SalesName'] ?> - <?php  echo $r['SalesDesc'] ?> </option>
		
					<?php
						}

					?>
				</select>
		