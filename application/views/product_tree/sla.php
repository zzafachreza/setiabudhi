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



?>
<div class="container">
	<center>
		<h3>Service Level Supplier (%)</h3>
	</center>

	<form action="sla_excel" method="POST">
		<div class="row">
	
		<div class="col col-sm-12">
			<div class="from-group">
				
				<label>Select Supplier</label>
				<select class="form-control selectza" required="required" name="supid">
					<option></option>
					<?php
							$sql="SELECT SupId,SupName FROM SMSupplierMs WHERE SupId NOT LIKE 'TR%'";
							$hasil = $conn->query($sql);
							while ($r = $hasil->fetch()) {
								# code...
							
					?>

					<option value="<?php  echo $r['SupId'] ?>#<?php  echo $r['SupName'] ?>"><?php  echo $r['SupId'] ?> - <?php  echo $r['SupName'] ?></option>
		
					<?php
						}

					?>
				</select>
				
			</div>
		</div>

		<div class="col col-sm-6">
			<div class="from-group">
				<br/>	
				<label>From</label>
				<input type="text" name="awal" class="AppInput tgl" autocomplete="off" required="required">
			</div>
		</div>
		<div class="col col-sm-6">
			<div class="from-group">
				<br/>
				<label>to</label>
				<input type="text" name="akhir" class="AppInput tgl" autocomplete="off" required="required">
			</div>
		</div>

		<div class="col col-sm-12" style="margin-top: 5%">
			<center>
				<button class="btn btn-success btn-lg">Generate SLA (%)</button>	
			</center>
		</div>
	</div>
	</form>
</div>