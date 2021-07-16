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
		<h3>Print Alamat Supplier</h3>
	</center>
 <img src="<?php echo base_url() ?>assets/images/alamat.svg" width="100%" height="300" class="img">
	<form id="myForm" action="kirim_print" method="POST">
		<div class="row">
	
		<div class="col col-sm-12">
			<div class="from-group">
				
				<label style="color:#DC3545">Pilih Supplier terlebih dahulu</label>
				<select id="selectID" style="border: 1px solid #DC3545" class="form-control" required="required" name="supid">
					<option></option>
					<?php
							$sql="SELECT SupId,SupName FROM SMSupplierMs WHERE SupId NOT LIKE 'TR%'";
							$hasil = $conn->query($sql);
							while ($r = $hasil->fetch()) {
								# code...
							
					?>

					<option value="<?php  echo $r['SupId'] ?>"><?php  echo $r['SupId'] ?> - <?php  echo $r['SupName'] ?></option>
		
					<?php
						}

					?>
				</select>
				
			</div>
		</div>

	

		<!-- <div class="col col-sm-12" style="margin-top: 5%">
			<center>
				<button class="btn btn-danger btn-lg"><i class="flaticon2-printer"></i> Print Alamat Supplier</button>	
			</center>
		</div> -->
	</div>
	</form>
</div>
<script type="text/javascript">

	$("#selectID").selectize()
	$("#selectID")[0].selectize.focus();

	$("#selectID").change(function(){
		$("#myForm").submit();
	})
</script>