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


function tglSql($tgl){
	$tgl = explode("/", $tgl);
	return $tgl[2]."-".$tgl[1]."-".$tgl[0];
}


$data = explode("ABUHANIF", $_POST['pay']);

 $PmtNmbr = $data[0];
 $NotePad = $data[1];
 $NotePadType = $data[2];
 $PmtDueDate = $data[3];


$TGL = explode("/",$PmtDueDate);

 $TANGGAL_JT = $TGL[2].$TGL[1].$TGL[0];

	$FROM_REK = '2050100881006';
	$FORM_NAME='PT SETIABUDHI JAYA ABADI';


// header("Content-type: application/octet-stream");
// header("Content-Disposition: attachment; filename=". $NotePad.".csv");//ganti nama sesuai keperluan
// header("Pragma: no-cache");
// header("Expires: 0");
error_reporting(0);

$SQL = "select CMTTTdt.TTTNmbr, convert(varchar,TTTDate,103) TANGGAL_KONTRA,convert(varchar,TTTDueDate,103) JATUH_TEMPO ,convert(float,SUM(TTTAmountPmt)) AMOUNT ,CMTTTHd.TTTSupid SUPPLIER_ID,SupName SUPPLIER_NAME, 
AccNmbr SUPPLIER_ACC,AccName SUPPLIER_ACCNAME,CMTTTHd.AccBank,BranchName,SupEmail
from (
(dbo.CMTTTHd inner join SMSupplierMs ON SMSupplierMs.supid = CMTTTHd.TTTSupid )
inner join CMTTTdt on CMTTTdt.TTTNmbr = CMTTTHd.TTTNmbr)
inner join CMBankBranch on CMTTTHd.AccBank = CMBankBranch.BranchCode
 WHERE PmtNmbr in('$PmtNmbr') GROUP BY 
CMTTTdt.TTTNmbr,TTTDate,TTTDueDate,CMTTTHd.TTTSupid,SupName,AccNmbr,AccName,AccBank,
BranchName,SupEmail";


$SQLJML = "select count(TTTNmbr) jml from CMTTTHd WHERE PmtNmbr in('$PmtNmbr')";


$SQLTOTAL = "select convert(float,SUM(TTTAmountPmt)) AMOUNT
from ( (dbo.CMTTTHd inner join SMSupplierMs ON SMSupplierMs.supid = CMTTTHd.TTTSupid ) 
inner join CMTTTdt on CMTTTdt.TTTNmbr = CMTTTHd.TTTNmbr) 
inner join CMBankBranch on CMTTTHd.AccBank = CMBankBranch.BranchCode 
WHERE PmtNmbr in('$PmtNmbr') GROUP BY PmtNmbr";
$TOTAL = $conn->query($SQLTOTAL)->fetch();
$JML = $conn->query($SQLJML)->fetch();
$hasil =  $conn->query($SQL);
///////////////

///////////

//////
$JumlahSupplier = $JML['jml'];
$TotalBayar = $TOTAL['AMOUNT'];

$BIAYA = explode(" ", $NotePad);

$BIAYA2 = explode("-", $BIAYA[0]);

$TIPE = $BIAYA2[2];

if ($TIPE==='MO') {
	# code...
	$MATERAI = 5000;
}elseif($TIPE==='ML'){
	$MATERAI = 3000;
}

?>
	
	<center>
		<a href="download?pay=<?php echo $_POST['pay'] ?>">DOWNLOAD</a>
		<hr>
	</center>

<?php

echo $FROM_REK.",".$FORM_NAME.",IDR,".(round($TotalBayar,0)-($MATERAI*$JumlahSupplier)).",".$NotePad.",".$JumlahSupplier.",".$TANGGAL_JT.",<br/>";


while ($r = $hasil->fetch()) {
	# code...633060701,WIDYAPRATAMA,IDR,5895000,000000000018690,BCA (BANK CENTRAL ASIA),Y,Y,

	if (strlen($r['SupEmail']) > 0) {
		# code...
		$email = ",".str_replace(",", ";", $r['SupEmail']);
	}else{
		$email="";
	}


	echo "".$r['SUPPLIER_ACC'].",".str_replace(",", ".", $r['SUPPLIER_ACCNAME']).",IDR,".(round($r['AMOUNT'],0)-$MATERAI).",".$PmtNmbr.",".$r['BranchName'].",Y,Y"."<br/>";
}


