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

$sql="SELECT * FROM dbo.vEmployee_data WHERE EmployeeNumber='$ID'";
$hasil = $conn->query($sql);
$r= $hasil->fetch();


$IDpegawai = $r['IDpegawai'];

$sql2="SELECT FirstName,CONVERT(char(10), BirthDate,103) BirthDate,Gender,BirthPlace FROM dbo.Person WHERE OID='$IDpegawai'";
$hasil2 = $conn->query($sql2);

$r2= $hasil2->fetch();


?>


<div class="container-fluid">
	
<center>
	<h3>FOTO KARYAWAN</h3>
</center>
<!-- 	<table class="table table-striped table-hover">
		<tr>
			<th>ID PEGAWAI</th>
			<td><?php echo $r['EmployeeNumber']; ?></td>
		</tr>
		<tr>
			<th>NAMA LENGKAP</th>
			<td><?php echo $r['FirstName']." ".$r['MiddleName']." ".$r['LastName'] ?></td>
		</tr>
	</table> -->
	<img src="../assets/images/ava.jpg" style="width: 100%">
		
	

</div>