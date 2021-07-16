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

$ID_KONTRABON ="";


	for ($i=0; $i < count($_POST['id']); $i++) { 

			$jml = $_POST['id'][$i]+1;
			$ID_KONTRABON .= "'".$_POST['KONTRA'.$jml]."',";
		}


$panjang = strlen($ID_KONTRABON);

$DATA_KONTRABON = substr($ID_KONTRABON, 0,-1);


//cek jumlah payment
 $sql0 = "select CMTTTdt.TTTNmbr,TTTSupId, GRNNmbr, TTTAmountPmt from CMTTTdt inner join
CMTTTHd On CMTTTHd.TTTNmbr = CMTTTdt.TTTNmbr
 where CMTTTdt.TTTNmbr in($DATA_KONTRABON)";

 $TotalPaymentKontra = $conn->query($sql0);

 // while ($r = $TotalPaymentKontra->fetch()) {
 // 	# code...
 // 	 $totalAmountOK = $r['TTTAmountPmt'];
 // 	 $NO_GRN = $r['GRNNmbr'];
 // 	 $NO_KONTRABON = $r['TTTNmbr'];

	//   $sqlPenyesuaian = "UPDATE CMTTTdt SET TTTAmountPmt='$totalAmountOK' WHERE TTTNmbr='$NO_KONTRABON' AND GRNNmbr='$NO_GRN'";

	//  $conn->query($sqlPenyesuaian);

 // }








// ambil data total harus paymnet 1
 $sql1 = "select convert(float,SUM(TTTAmountPmt)) AMOUNT
from CMTTTHd inner join CMTTTdt on CMTTTdt.TTTNmbr = CMTTTHd.TTTNmbr
 WHERE CMTTTdt.TTTNmbr in($DATA_KONTRABON)";

 $TotalPayment = $conn->query($sql1)->fetch();

 $TOTAL =  $TotalPayment['AMOUNT'];



 // ambil data notepad 2
 $sql2="select CMTTTHd.AccBank,BranchName ,BranchBank from CMTTTHd inner join CMBankBranch
ON CMBankBranch.BranchCode = CMTTTHd.AccBank
  WHERE TTTNmbr in($DATA_KONTRABON)";
 $bank = $conn->query($sql2)->fetch();
 $BANK =  $bank['BranchBank'];

 if ($BANK ==='004') {
 	# code...
 	$NOTEPAD = 'L';
 }else{
 	$NOTEPAD = 'N';
 }


//cek nomor payment trakhir 3
 $sql3="select top 1 PmtNmbr from CMTTTPmt ORDER BY PmtNmbr DESC";
 $paymentTerakhir = $conn->query($sql3)->fetch();
  $PAYMENTAKHIR = $paymentTerakhir['PmtNmbr'];

  $PAYMENTJMLAWAL = strlen($PAYMENTAKHIR + 1);
  $PAYMENTJMLAKHIR = strlen($PAYMENTAKHIR);
 $PAYMNETYANGDITAMBAH = $PAYMENTJMLAKHIR-$PAYMENTJMLAWAL;

if ($PAYMNETYANGDITAMBAH==10) {
	# code...
 $NEWPAYMNET = "0000000000".($PAYMENTAKHIR + 1);
}

 $NEWPAYMNET;
  //// buat nomor paymnet baru




//cek nomor CSV TERAKHIR 4
  $sql4="select top 1 GiroNmbr from CMGiroCr WHERE GiroNmbr like 'CSV%' AND crSubLedg='1111.103' ORDER BY GiroNmbr DESC";
 $csvTerakhir = $conn->query($sql4)->fetch();
  $CSVAKHIR = $csvTerakhir['GiroNmbr'];

  $ARRAYSCV = explode("CSV",  $CSVAKHIR);



   $CSVJMLAWAL = strlen($ARRAYSCV[1] + 1);
   $CSVJMLAKHIR = strlen($ARRAYSCV[1]);
   $CSVYANGDITAMBAH = $CSVJMLAKHIR-$CSVJMLAWAL;

   if ($CSVYANGDITAMBAH==6) {
	# code...
	 $NEWCSV = "CSV000000".($ARRAYSCV[1] + 1);
	}

 $NEWCSV;



 $TANGGAL_PAYMENT = tglSql($_POST['awal']);
 $TANGGAL_JT = tglSql($_POST['akhir']);

//-------------> PROSES INPUT KE PROINT BISMILLAH

//tambah ke GiroCR langkah 1

$sql5 ="insert into CMGiroCr(GiroNmbr,GiroDate,GiroJTdate,CrSubLedg,CrRespCode,GiroCurrency,GiroHCAmount,FgCp,UpdUser,UpdFlag,GiroStatus,FgTransSource) 
values('$NEWCSV','$TANGGAL_PAYMENT','$TANGGAL_JT','1111.103','000','IDR','$TOTAL','1','SYSTEM2','Y','O','01')";


//tambah ke Payment langkah 2
$sql6 = "insert into CMTTTPmt(PmtNmbr,PmtDate,UpdUser,UpdFlag,PmtDueDate,SubLedgAcnt,RespCode,NotePadType)
values('$NEWPAYMNET','$TANGGAL_PAYMENT','SYSTEM2','Y','$TANGGAL_JT','1111.103','000','$NOTEPAD')";


//update di kontranon langkah 3
$sql7 = "update CMTTTHd SET  giroNmbr='$NEWCSV',PmtNmbr='$NEWPAYMNET',FgStatus='P' WHERE TTTNmbr in($DATA_KONTRABON)";


//tambah ke GiroDB langkah 4

 $sql8 = "select APSubLedg APL,convert(float,sum(TTTAmountPmt)) AMOUNT
from (CMTTTHd inner join CMTTTdt on CMTTTdt.TTTNmbr = CMTTTHd.TTTNmbr)
inner join SMSupplierMs on SMSupplierMs.supid = CMTTTHd.TTTSupid
 WHERE CMTTTdt.TTTNmbr in ($DATA_KONTRABON) GROUP BY APSubLedg";



 // masukan ke AP GIro

  $sql0s = "select top 1 CMTTTdt.TTTNmbr,TTTSupId, GRNNmbr, TTTAmountPmt from CMTTTdt inner join
CMTTTHd On CMTTTHd.TTTNmbr = CMTTTdt.TTTNmbr
 where CMTTTdt.TTTNmbr in($DATA_KONTRABON)";
 $TotalPaymentKontras = $conn->query($sql0s);

 while ($s = $TotalPaymentKontras->fetch() ) {

 	$totalAmountOKS = round($s['TTTAmountPmt'],0);
 	 $NO_GRNS = $s['GRNNmbr'];
 	 $NO_KONTRABONS = $s['TTTNmbr'];
 	 $SUPPLIER_ID = $s['TTTSupId'];
 	  $ApGiroHd = "INSERT INTO APGiroHd(GiroNmbr,GiroDate,GiroDueDate,GiroSuplier,FgTransSource,UpdUser,UpdFlag)
VALUES('$NEWCSV','$TANGGAL_PAYMENT','$TANGGAL_JT','$SUPPLIER_ID','D','SYSTEM2','Y')";
 	# code...

	// $conn->query($ApGiroHd);
 }



   $sql0t = "select CMTTTdt.TTTNmbr,TTTSupId, GRNNmbr, TTTAmountPmt from CMTTTdt inner join
CMTTTHd On CMTTTHd.TTTNmbr = CMTTTdt.TTTNmbr
 where CMTTTdt.TTTNmbr in($DATA_KONTRABON)";
 $TotalPaymentKontrat = $conn->query($sql0t);

 while ($t = $TotalPaymentKontrat->fetch() ) {

 	$totalAmountOKT = round($t['TTTAmountPmt'],0);
 	 $NO_GRNT = $t['GRNNmbr'];
 	 $NO_KONTRABONT = $t['TTTNmbr'];
 	 $SUPPLIER_IDT = $t['TTTSupId'];

 	 $ApGiroDt="insert into APGiroDt(GiroNmbr,GRNNmbr,GRNSupId,GRNCurrency,HCAmount,UpdUser,UpdFlag)
values('$NEWCSV','$NO_GRNT','$SUPPLIER_IDT','IDR','$totalAmountOKT','SYSTEM2','Y')";
// $conn->query($ApGiroDt);
 	# code...
 }




if ($conn->query($sql5)) {
	# code...
		if ($conn->query($sql6)) {
		# code...
			if ($conn->query($sql7)) {
			# code...

				//  $hasil8 = $conn->query($sql8);
				// $no8 = 1;
				//  while ($r8 = $hasil8->fetch() ) {
				//  	# code...

				// $APL = $r8['APL'];

				// $AMOUNTAPL = round($r8['AMOUNT'],2);

				// 	 $sql9="insert into CMGiroDb(GiroNmbr,GiroSeq,DbSubLedgAcnt,DbRespCode,GiroCurrency,GiroHCAmount,GiroVocAmount,FgType,FgDK,UpdUser,UpdFlag,GiroVocCurr)
				// values('$NEWCSV','$no8','$APL','000','IDR','$AMOUNTAPL','$AMOUNTAPL','A','D','SYSTEM2','Y','IDR')";
				 	
				//  	$conn->query($sql9);

				// 	$no8++;
				//  }

				echo "NOMOR PAYMENT $NEWPAYMNET DAN $NEWCSV\nBERHASIL DIBUAT CEK DIPROINT YA";
				die();
		}
	}
}
?>