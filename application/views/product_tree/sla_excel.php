<?php 


 $supid = explode("#", $_POST['supid']);
	   $NO_SUPPLIER = $supid[0];
	    $NAME_SUPPLIER = $supid[1];


// header("Content-type: application/octet-stream");
// header("Content-Disposition: attachment; filename=SERVICE_LEVEL_".$_POST['awal']."_".$_POST['akhir'].".xls");//ganti nama sesuai keperluan
// header("Pragma: no-cache");
// header("Expires: 0");
// // error_reporting(0);

// print_r($_POST);

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
// print_r($hasil);

function tglSql($tgl){
	$tgl = explode("/", $tgl);
	return $tgl[2]."-".$tgl[1]."-".$tgl[0];
}

if(!empty($_POST)){

	   $awal = tglSql($_POST['awal']);
	   $akhir = tglSql($_POST['akhir']);

	  

	   $sqlPO = "SELECT PONmbr,convert(char(11),PODate,113) PODate,POSuplier,POSalesId FROM PRPOhd WHERE POSuplier='$NO_SUPPLIER' AND POdate BETWEEN '$awal' AND '$akhir' ORDER BY POSalesId";
	   $hasilPO = $conn->query($sqlPO);

	   

}
?>

<style type="text/css">
  
.num {
  mso-number-format:General;
}
.text{
  mso-number-format:"\@";/*force text*/
}
</style>
  <table style="border-collapse: collapse;" cellspacing="0" width="100%" border="1">
  	<tr>
  		<td colspan="11" style="font-size: 30px">
  			<?php echo $NO_SUPPLIER." - ".$NAME_SUPPLIER ?>
  		</td>
  	</tr>
  	<tr>
  		<td colspan="11" style="font-size: 20px">
  			<?php echo $_POST['awal'] ?>
  		-
  			 <?php echo $_POST['akhir'] ?>
  		</td>
  	</tr>
  	<tr>
  		<th>NO</th>
  		<th>NO_PO</th>
  		<th>SALES</th>
  		<th>TANGGAL_PO</th>
  		<th>NO_GRN</th>
  		<th>TANGGAL_GRN</th>
  		<th>LEAD_TIME</th>
  		<th>ITEM PO</th>
  		<th>ITEM GRN</th>
  		<th>Item %</th>
  		<th>Status</th>
  	</tr>

  	<?php
  	$no=1;

  	while ($dataPO = $hasilPO->fetch()) {
  		# code...
  		$NO_PO = $dataPO['PONmbr'];
  		$SALES = $dataPO['POSalesId'];
  		$TANGGAL_PO = $dataPO['PODate'];

  		$jmlPO = $conn->query("SELECT count(POProduct) as JML FROM PRPOdt WHERE PONmbr='$NO_PO'")->fetch();
  				$jmlPO = $jmlPO['JML'];

  		$sqlGRN = "SELECT top 1 PRGRNdt.GRNNmbr,convert(char(11),GRNDate,113) GRNDate,PONmbr FROM PRGRNdt INNER JOIN PRGRNHd ON PRGRNdt.GRNNmbr = PRGRNHd.GRNNmbr WHERE PONmbr='$NO_PO'";

  			$hasilGRN = $conn->query($sqlGRN)->fetch();

  	
  			$NO_GRN = $hasilGRN['GRNNmbr'];
  			$TANGGAL_GRN = $hasilGRN['GRNDate'];

  			if ($NO_GRN !== null ) {
  				# code...


  				$jmlGRN = $conn->query("SELECT count(GRNProduct) as JML FROM PRGRNdt WHERE PONmbr='$NO_PO'")->fetch();
  				$jmlGRN = $jmlGRN['JML'];

  				
  				
  				$tgl1 = new DateTime($TANGGAL_PO);
				$tgl2 = new DateTime($TANGGAL_GRN);
				$d = $tgl2->diff($tgl1)->days;
				$LEAD_TIME = $d." Hari";
				 
  			}else{
  				$LEAD_TIME="";
  				$jmlGRN=0;
  			}
  			
  	?>
  		<tr>
  			<td><?php echo $no ?></td>
  			<td><?php echo $NO_PO ?></td>
  			<td><?php echo $SALES ?></td>
  			<td><?php echo $TANGGAL_PO;?></td>
  			<td><?php echo $NO_GRN ?></td>
  			<td><?php echo $TANGGAL_GRN ?></td>
  			<td style="text-align: center;"><?php echo $LEAD_TIME ?></td>
  			<td style="text-align: center;"><?php echo $jmlPO ?></td>
  			<td style="text-align: center;"><?php echo $jmlGRN ?></td>
  			<?php $persen = round(($jmlGRN/$jmlPO)*100);

  			if ($persen==100) {
  				# code...
  				$style="background-color:green";
  			}else{
  				$style="";
  			}


  			if ($jmlGRN > 0) {
  				# code...
  				$status="selesai";
  			}else{
  				$status="belum datang";
  			}
  			 	
  			

  			 ?>
  			<td style="text-align: center;<?php echo $style ?>"><?php echo $persen."%" ?></td>
  			<td style="text-align: center;"><?php echo $status ?></td>
  		</tr>
  		<tr>
  			<td colspan="11">&nbsp; DETAIL</td>
  		</tr>

  		<?php

  		$sqlPODt = "SELECT PRPODt.POProduct,convert(float,POStdQty) POStdQty,POStdUOM,ProdName FROM PRPODt INNER JOIN SMProductMs ON SMProductMs.prodcode = PRPODt.POProduct WHERE PONmbr='$NO_PO'";
  		$hasilPODt = $conn->query($sqlPODt);




  		$noo=1;
  		while ($dataPODt = $hasilPODt->fetch()) {
  			# code..

  			$SKU = $dataPODt['POProduct'];
  			$SKU_NAME = $dataPODt['ProdName'];
  			$UOM = $dataPODt['POStdUOM'];

  			$QTY_PO = $dataPODt['POStdQty'];

  		$sqlGRNdt = "SELECT top 1 convert(float,GRNStdQty) GRNStdQty FROM PRGRNdt WHERE PONmbr='$NO_PO' AND GRNProduct='$SKU'";

  			$dataQtyGrn = $conn->query($sqlGRNdt)->fetch();

  			$QTY_GRN = $dataQtyGrn['GRNStdQty'];

  		?>

  		<tr>
  			<td colspan="4"></td>
  			<td style="text-align: center;"><?php echo $noo; ?></td>
  			<td class="text"><?php echo $SKU; ?></td>
  			<td><?php echo $SKU_NAME; ?></td>
  			<td style="text-align: center;"><?php echo number_format($QTY_PO ) ?></td>
  			<td style="text-align: center;"><?php echo number_format($QTY_GRN ) ?></td>
  			<?php $persen = round(($QTY_GRN/$QTY_PO)*100);

  			if ($persen==100) {
  				# code...
  				$style="background-color:yellow";
  			}else{
  				$style="";
  			}


  			if ($QTY_GRN==0){
  				# code...
  				$status="tidak dikirim";
  			}
  			elseif ($QTY_GRN == $QTY_PO) {
  				# code...
  				$status="compelete";

  			}elseif ($QTY_GRN != $QTY_PO) {
  				# code...
  				$status="dikirim tidak sesuai PO";
  			}
  			else{
  				$status="belum datang";
  			}
  			 	
  			

  			 ?>
  			<td style="text-align: center;<?php echo $style ?>"><?php echo $persen."%" ?></td>
  			<td style="text-align: center;"><?php echo $status ?></td>
  			


  		</tr>



  		<?php

  			$noo++;
  	}

  		?>
  		<tr>
  			<th colspan="11">&nbsp;</th>
  		</tr>



  	<?php $no++; } ?>
  </table>