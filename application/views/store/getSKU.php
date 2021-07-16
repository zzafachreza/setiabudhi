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

$id = $_GET['id']; 

$sql = "SELECT top 20 * FROM SMProductMs WHERE  ProdCode like '%$id%' OR ProdName like '%$id%'";

$hasil = $conn->query($sql);



?>

<table class="table table-bordered">
	<tr>
		<th>SKU</th>
		<th>NAMA</th>
		<th>AKSI</th>
	</tr>
	<?php

	while ($r = $hasil->fetch()) {
		# code...
	?>

		<tr>
			<td><?php echo $r['ProdCode'] ?></td>
			<td><?php echo $r['ProdName'] ?></td>
			<td>
				<a class="btn btn-success ambil" href="#" data-sku="@<?php echo $r['ProdCode'] ?>">AMBIL</a>
			</td>
		</tr>


	<?php } ?>

</table>