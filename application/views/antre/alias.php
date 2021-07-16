<?php

$host="localhost";
$db="ci";
$user="root";
$pass="";
$conn=new PDO("mysql:host=$host;dbname=$db",$user,$pass);

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


?>

<div class="container-fluid">
	<center>
		<h3>Supplier Alias</h3>
		<a href="alias_add" class="btn btn-primary">TAMBAH</a>
	</center>
	<hr/>


	<table class="table table-bordered table-hovertable-striped tabza" >
		<thead>
			<tr>
			<th>NO</th>
			<th>SUPPLIER ID</th>
			<th>SUPPLIER NAME</th>
			<th>SUPPLIER ALIAS</th>
			<th></th>

		</tr>
		</thead>
		<tbody>
			<?php
			$no=1;
			$sql="SELECT * FROM data_alias";
			$hasil= $conn->query($sql);
				while ($r = $hasil->fetch()) {
					# code...

					$SUPPLIER_ID = $r['SUPPLIER_ID'];
					$sqlSup ="SELECT supName FROM SMSupplierMs WHERE supid='$SUPPLIER_ID'";
					$dataSup = $conn2->query($sqlSup)->fetch();

					$SUPPLIER_NAME = $dataSup['supName'];
				
			?>

					<tr onClick="hapus('HAPUS<?php echo $r['SUPPLIER_ID'] ?>')">
						<td><?php echo $no ?></td>
					
						<td><?php echo $r['SUPPLIER_ID'] ?></td>
						<td><?php echo $SUPPLIER_NAME ?></td>
						<td><?php echo $r['SUPPLIER_ALIAS'] ?></td>
						<td>
						<a onClick="return confirm('Apakah Anda yakin akan hapus ini ?')" href="hapus_alias/<?php echo $r['SUPPLIER_ID'] ?>" class="btn btn-danger btn-sm" id="HAPUS<?php echo $r['SUPPLIER_ID'] ?>" style="display:none">HAPUS</a></td>
					</tr>


			<?php $no++;} ?>

		</tbody>
	</table>
</div>

<script type="text/javascript">

		function hapus(x){
			$("#"+x).fadeToggle();
		}
	
</script>