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

$sql="SELECT * FROM dbo.vEmployee_data WHERE IDPegawai='$IDPegawai'";
$hasil = $conn->query($sql);

$sql2="SELECT FirstName,CONVERT(char(10), BirthDate,103) BirthDate,Gender,BirthPlace FROM dbo.Person WHERE OID='$IDPegawai'";
$hasil2 = $conn->query($sql2);


$r= $hasil->fetch();
$r2= $hasil2->fetch();


?>


<div class="container-fluid">
	<a href="../data_karyawan" class="btn btn-warning col-sm-2" style="margin-top: 2%;">KEMBALI</a>
	<a href="../print_karyawan/<?php echo $IDPegawai ?>" class="btn btn-danger col-sm-2" style="margin-top: 2%;">PRINT KARTU</a>
<center>
	<h3>DATA KARYAWAN DETAIL</h3>
</center>


	<table class="table table-striped table-hover">
		<tr>
			<th>ID PEGAWAI</th>
			<td><?php echo $r['EmployeeNumber']; ?></td>
		</tr>
		<tr>
			<th>NAMA LENGKAP</th>
			<td><?php echo $r['FirstName']." ".$r['MiddleName']." ".$r['LastName'] ?></td>
		</tr>
		<tr>
			<th>TEMPAT LAHIR</th>
			<td><?php echo $r2['BirthPlace']?></td>
		</tr>
		<tr>
			<th>TANGGAL LAHIR</th>
			<td><?php echo $r2['BirthDate']?></td>
		</tr>
		<tr>
			<th>JENIS KELAMIN</th>
			<td><?php echo $r2['Gender']==="M"?"LAKI_LAKI":"PEREMPUAN"?></td>
		</tr>
	</table>
		
	

</div>