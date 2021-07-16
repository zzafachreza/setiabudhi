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

$now = date('Y-m-d');

$effectiveDate = date('Y-m-d', strtotime("-1 months", strtotime($now)));

$sql="SELECT  PONmbr, convert(varchar,PODate,103) PODate,POSuplier,supname from PRPOhd INNER JOIN SMSupplierMs ON SMSupplierMs.supid = PRPOhd.POSuplier WHERE PODate >= '$effectiveDate'";
							$hasil = $conn->query($sql);

							/*print_r($hasil->fetch());

							die();*/
?>
<div class="container">
	<center>
		<h3>Print Tolakan Barang</h3>
	</center>
 <img src="<?php echo base_url() ?>assets/images/tolak.svg" width="100%" height="200" class="img">
	<form id="myForm" action="tolak_print" method="POST">
		<div class="row">
	
		<div class="col col-sm-12">
			<div class="from-group">
				
				<label style="color:#DC3545">Pilih PO/	Supplier terlebih dahulu</label>
				<input type="text" name="key" class="form-control" id="key" autofocus="autofocus">
				<div id="dataPO">
					
				</div>
			</div>
		</div>

	

		<div class="col col-sm-12" style="margin-top: 5%">
			<center>
				<button class="btn btn-danger btn-lg"><i class="flaticon2-printer"></i> CEK TOLAKAN</button>	
			</center>
		</div>
	</div>
	</form>
</div>
<script type="text/javascript">


	$("#key").change(function(){
		var key = $(this).val();
		$("#loading").show();
		$.ajax({
			url:'data_po2',
			type:'POST',
			data:{
				key:key
			},success:function(data){
				console.log(data);
				$("#loading").hide();
				$("#dataPO").html(data);
			}
		})
	})

	// $("#selectID").change(function(){
	// 	$("#dataPO").append(
	// 			'<input value="' +$("#selectID").val()+ '" name="PONmbr[]"/>'
	// 		)
	// })
</script>