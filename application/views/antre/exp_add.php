
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


$sqlSup = "SELECT SupId,SupName FROM SMSupplierMs";
$hasilSup = $conn2->query($sqlSup);

?>

<form method="POST" action="insert">
	<div class="container-fluid">
	<hr/>


	<table class="table table-bordered table-hovertable-striped" >

			<tr>
				<th>TANGGAL_DATANG</th>
				<td>
					<input type="text" name="TANGGAL_DATANG" class="form-control tgl" value="<?php echo date('d/m/Y') ?>">
				</td>
			</tr>
			<tr>
				<th>SUPPLIER</th>
				<td>
					<select name="SUPPLIER" id="SUPPLIER" class="form-control selectza">
					<option></option>
						<?php

							while ($dataSup = $hasilSup->fetch()) {
								# code...
							
						?>
							<option><?php echo $dataSup['SupId'] ?> | <?php echo $dataSup['SupName'] ?></option>

						<?php 

								}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<th>SKU</th>
				<td id="dataSKU">
					
				</td>
			</tr>
			<tr>
				<th>JUMLAH</th>

				<td><input type="number" name="JUMLAH" id="JUMLAH" class="form-control"></td>
			</tr>
					<tr>
				<th>TANGGAL_EXPIRED</th>
			<td>
					<input type="text" name="TANGGAL_EXPIRED" class="form-control tgl" value="<?php echo date('d/m/Y') ?>">	
				</td>
			</tr>
			<tr>
				<th>CHECKER</th>

				<td><input type="text" name="CHECKER" id="CHECKER" class="form-control"></td>
			</tr>
			<tr>
				<th>PURCHASING</th>

				<td><input type="text" name="PURCHASING" id="PURCHASING" class="form-control"></td>
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

<script type="text/javascript">
	$("#SUPPLIER").change(function(e){
		e.preventDefault();

		var supid = $(this).val();



		$.ajax({
			url:'get_sku',
			type:'post',
			data:{
				supid:supid
			},success:function(data){
				$("#dataSKU").html(data);
				$("#PRODUCT").selectize();
			}
		})
	})
</script>