
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


$sqlSup = "SELECT SupId,SupName FROM SMSupplierMs WHERE SupId NOT LIKE '%TR%' AND SupId NOT LIKE '%31%'";
$hasilSup = $conn2->query($sqlSup);

?>

<form method="POST" action="insert_alias">
	<div class="container-fluid">
	<hr/>


	<table class="table table-bordered table-hovertable-striped" >

		
			<tr>
				<th>SUPPLIER</th>
				<td>
					<select name="SUPPLIER_ID" id="SUPPLIER_ID" class="form-control selectza">
					<option></option>
						<?php

							while ($dataSup = $hasilSup->fetch()) {
								# code...
							
						?>
							<option value="<?php echo $dataSup['SupId'] ?>"><?php echo $dataSup['SupId'] ?> - <?php echo $dataSup['SupName'] ?></option>

						<?php 

								}
						?>
					</select>
				</td>
			</tr>
			
			<tr>
				<th>SUPPLIER_ALIAS</th>

				<td><input type="text" name="SUPPLIER_ALIAS" id="SUPPLIER_ALIAS" class="form-control"></td>
			</tr>
		</tr>
		

			<tr>
			<td></td>
				<td colspan="1">
				<center>
										<button class="btn btn-success col-sm-12">SIMPAN</button>
				</center>
				</td>
			</tr>
</div>
</form>

