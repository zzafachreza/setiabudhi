<?php
$key= $_POST['key'];

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




 $sql="select top 10 POnmbr NO_PO,convert(varchar, POdate, 103) TANGGAL_PO,POSuplier SUPPLIER_ID,supname SUPPLIER_NAME,
POSalesId SALES_ID,POGroup GROUP_PO,POWarehouse TUJUAN_LOKASI,POPPNType TIPE_PPN from PRPOhd
inner join SMSupplierMs on PRPOhd.POSuplier = SMSupplierMs.supid WHERE POnmbr like '%$key%'";

$hasil = $conn->query($sql);

$data = $hasil->fetch();

// print_r($data);

?>

<table class="table table-bordered">
	<tr>
		<td style="background-color: orange;font-weight: bold;">NO_PO (<?php echo $data['TIPE_PPN'] ?>)</td>
		<td><?php echo $data['NO_PO'] ?></td>
		<td style="background-color: orange;font-weight: bold;">SUPPLIER_ID</td>
		<td><?php echo $data['SUPPLIER_ID'] ?></td>
	</tr>
	<tr>
		<td style="background-color: orange;font-weight: bold;">TANGGAL_PO</td>
		<td><?php echo $data['TANGGAL_PO'] ?></td>
		<td style="background-color: orange;font-weight: bold;">SUPPLIER_NAME</td>
		<td><?php echo $data['SUPPLIER_NAME'] ?></td>
	</tr>
	<tr>
		<td style="background-color: orange;font-weight: bold;">TUJUAN_LOKASI</td>
		<td><?php echo $data['TUJUAN_LOKASI'] ?></td>
		<td style="background-color: orange;font-weight: bold;">SALES_ID</td>
		<td><?php echo $data['SALES_ID'] ?></td>
	</tr>	

</table>

<center>

	<?php

   $FILTER_PO = substr($data['NO_PO'], 2,1);

  	if ($FILTER_PO ==='B' OR $FILTER_PO==='D') {
  		# code...
  		 $GROUP_PO='FRESH';
  		 if ($data['TIPE_PPN']==='E') {
  		 	$PPN = '01';
  		 }else{
  		 	$PPN='02';
  		 }

  		 echo $FIX_GROUP= $GROUP_PO." - ".$PPN;



  	}else{
  		 $GROUP_PO='DRY';
  		 if ($data['TIPE_PPN']==='E') {
  		 	$PPN = '01';
  		 }else{
  		 	$PPN='02';
  		 }

  		 $FIX_GROUP= $GROUP_PO." - ".$PPN;
  	}


	?>

	<form id="dataForm">
		<input type="hidden" name="GROUP_PO" value="<?php echo $FIX_GROUP ?>">
		<input type="hidden" name="NO_PO" value="<?php echo $data['NO_PO'] ?>">
		<input type="hidden" name="SUPPLIER_ID" value="<?php echo $data['SUPPLIER_ID'] ?>">
		<input type="hidden" name="SUPPLIER_NAME" value="<?php echo $data['SUPPLIER_NAME'] ?>">
		<input type="hidden" name="SALES_ID" value="<?php echo $data['SALES_ID'] ?>">
		<button type="submit" class="btn btn-success btn-lg">MASUKAN KE ANTRIAN <?php echo $FIX_GROUP ?></button>
	</form>
	
</center>


<script type="text/javascript">
	$("#dataForm").submit(function(e){
		e.preventDefault();

		$("#loader").fadeIn();

		var data = $(this).serialize();
		$.ajax({
			url:'antre/insert_antrian',
			type:'POST',
			data:data,
			success:function(data){
				alert(data);
				// $("#key").val("");
				// $("#key").focus();

				$("#loader").fadeOut();
			}
		})
	})
</script>
