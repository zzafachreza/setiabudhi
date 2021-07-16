<?php

$serverName = "server";  
/* Connect using Windows Authentication. */  
try  
{  
$conn = new PDO( "sqlsrv:server=$serverName ; Database=DEMOHRMS", "sa", "stb@12345");  
$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );  
}  
catch(Exception $e)  
{   
die( print_r( $e->getMessage() ) );   
}

$sql="SELECT * FROm dbo.vEmployee_data";
$hasil = $conn->query($sql);

// print_r($hasil->fetch());
?>

<center>
	<h3>DATA KARYAWAN</h3>
</center>

<div class="container-fluid">
		
		<table class="table tabza">
			<thead>
				<tr>
					<th>No</th>
					<th>NAMA</th>
					<th>ID PEGAWAI</th>
					<th>AKSI</th>
				</tr>
			</thead>
			<tbody>
			<?php

			$no=1;

			while ($r = $data = $hasil->fetch()) {
				# code...
	
			?>
			<tr>
				<td><?php echo $no ?></td>
				<td><?php echo $r['FirstName']." ".$r['MiddleName']." ".$r['LastName'] ?></td>
				<td><?php echo $r['EmployeeNumber'] ?></td>
				<td>

					<a href="<?php echo site_url()."hrms/view_karyawan/".$r['IDpegawai'] ?>" class="btn btn-success"><i class="flaticon-search"></i> DETAIL</a>

					
					

				</td>
			</tr>


			<?php $no++; } ?>
			</tbody>
		</table>

</div>