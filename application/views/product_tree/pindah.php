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





// print_r($hasil);

function tglSql($tgl){
	$tgl = explode("/", $tgl);
	return $tgl[2]."-".$tgl[1]."-".$tgl[0];
}

if(!empty($_GET['sku'])){


		$SupId = $_GET['supid'];
	$SalesId = $_GET['salesid'];
	$ProdCode = $_GET['sku'];

	 $sqlInsert = "INSERT INTO smsupsalesprod(SupId,SalesId,ProdCode,FgDefault,FgActive,UpdUSer) VALUES('$SupId','$SalesId','$ProdCode','Y','Y','ENAH')";
	if ($conn->query($sqlInsert)) {
	// 	# code...
		echo "<script>";
		echo "alert('Data berhasil disimpan !')";
		echo "</script>";
	 }

}

?>
<div class="container">
	<hr/>
	<form method="GET">
		<div class="row">
			<center><h4>PINDAH SUPPLIER</h4></center>

			<div class="col col-sm-12" style="margin-bottom: 10%">
				<div class="from-group">
					<label>Please Select Supplier</label>

					<select class="form-control selectza" name="supid" id="supid">
						<option></option>
						<?php
							$sqlSupplier ="SELECT supid,supname FROM SMSupplierMs";
							$dataSupplier = $conn->query($sqlSupplier);

							while ($rSupplier = $dataSupplier->fetch()) {
								# code...
							
						?>


							<option value="<?php echo $rSupplier['supid'] ?>"><?php echo $rSupplier['supid'] ?> - <?php echo $rSupplier['supname'] ?></option>
						<?php
							}
						?>
					</select>
				</div>
				<div class="from-group" id="dataSales">
					
				</div>
				<hr>
				<div class="from-group" id="dataSku">
			
				</div>
				<div class="from-group" id="dataSkuDetail">
			
				</div>
			</div>

		
		<div class="col col-sm-12 tombol" style="margin-top: 0%;display:none">
			<center>
				<button class="btn btn-success col-sm-12">Simpan</button>
			</center>
		</div>
	</div>
	</form>
</div>



<script type="text/javascript">
	$("#supid").change(function(e){
		e.preventDefault();
		var supid = $(this).val();
		$.ajax({
			url:'getSales',
			type:'GET',
			data:{
				supid:supid
			},
			success:function(data){
				$("#dataSales").html(data);

				$("#salesid").change(function(e){
					e.preventDefault();
					var salesid = $(this).val();
					$.ajax({
						url:'getSku',
						type:'GET',
						success:function(data){
							$("#dataSku").html(data);
							$("#key").focus();

							$("#key").keyup(function(e){
								e.preventDefault();
								var key = $(this).val();
								console.log(key);
									$.ajax({
									url:'getSkuDetail',
									type:'GET',
									data:{
										key:key
									},
									success:function(data){
										$("#dataSkuDetail").html(data);

										$("#pilih").click(function(e){
											e.preventDefault();
											var sku = $(this).attr('data-sku');
											console.log(sku)
											$("#sku").val(sku);
											$(".key").hide();
											$(".tombol").show();
											$("#tabzza").addClass('sudah');
										})
										
									}
								})
							})
						}
					})
				})
			}
		})
	})
</script>

