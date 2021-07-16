<?php
$key = $_POST['key'];


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

$sql="SELECT top 20 PONmbr, convert(varchar,PODate,103) PODate,POSuplier,supname from PRPOhd INNER JOIN SMSupplierMs ON SMSupplierMs.supid = PRPOhd.POSuplier WHERE PODate >= '$effectiveDate' AND supname like '%$key%' OR PONmbr like '%$key%'";
$hasil = $conn->query($sql);

while ( $r = $hasil->fetch()) {
	# code...


	echo	'<label style="border:1px solid red;border-radius:10px;padding:20px;width:100%"><input value="'.$r['PONmbr'].'" name="PONmbr[]" type="checkbox" /> '.$r['PONmbr'].'  Tanggal '.$r['PODate'].' ( '.$r['POSuplier'].' - '.$r['supname'].' )</label><br/>';

	

}

?>