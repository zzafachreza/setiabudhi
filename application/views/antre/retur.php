<?php
date_default_timezone_set("Asia/Jakarta");
$host="localhost";
$db="serah_terima";
$user="root";
$pass="";
$conn=new PDO("mysql:host=$host;dbname=$db",$user,$pass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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


function IndonesiTGL($TGL){
	$TGL = explode("-", $TGL);
	return $TGL[2]."/".$TGL[1]."/".$TGL[0];
}

$SQL = "SELECT AppNumber,convert(varchar,AppDate,103) AppDate,AppSuplier,SupName FROM PRReturHd INNER JOIN SMSUpplierMs ON  SMSUpplierMs.supid = PRReturHd.AppSuplier WHERE AppSuplier='$SUPPLIER_ID' AND AppDate > '2020-07-01'";

$hasil = $conn2->query($SQL);

?>

<table width="100%" border="1" cellpadding="10">
	<tr>
		<th>NO</th>
		<th>NO_RETUR</th>
		<th>TANGGAL_RETUR</th>
		<th>SUPPLIER_ID</th>
		<th>SUPPLIER_NAME</th>
		<th></th>
	</tr>
	<?php

	$no=1;
	while ($data = $hasil->fetch()) {
		# code...
		$NO_RETUR = $data['AppNumber'];
		$sqlCek = "SELECT * FROM retur WHERE no_retur='$NO_RETUR'";

		$hasil2 = $conn->query($sqlCek)->fetch();

		if (isset($hasil2['no_retur'])) {
			# code...
			$ket="SUDAH DIAMBIL";
		}else{
			$ket="";
		}
	
	?>
	<tr>

	<td><?php echo $no. " ".$ket ?></td>
	<td><?php echo $data['AppNumber'] ?></td>
	<td><?php echo $data['AppDate'] ?></td>
	<td><?php echo $data['AppSuplier'] ?></td>
	<td><?php echo $data['SupName'] ?></td>
	<td>
		<a style="background-color:orange;padding:3%;text-decoration:none" href="../retur_detail/<?php echo $data['AppNumber'] ?>">DETAIL</a>
	</td>
	</tr>

	<?php
	$no++; }
	?>
</table>