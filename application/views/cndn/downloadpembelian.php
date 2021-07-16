<?php 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=ANALISA_PEMBELIAN_FROM_".$_POST['awal']."_".$_POST['akhir'].".xls");//ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");


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





// print_r($_POST);

function tglSql($tgl){
	$tgl = explode("/", $tgl);
	return $tgl[2]."-".$tgl[1]."-".$tgl[0];
}



if(!empty($_POST)){

	   $awal = tglSql($_POST['awal']);
	   $akhir = tglSql($_POST['akhir']);




      $sql="select PRGRNDt.GRNNmbr NO_GRN,PONmbr NO_PO, convert(varchar,GRNDate,103) TANGGAL_GRN,convert(varchar,DATEADD(day, GRNTOC, GRNDate),103) AS GRN_DUEDATE,
PRGRNHd.GRNSupplier SUPPLIER_ID,Supname SUPPLIER_NAME,SalesId SALES_ID,convert(float,SUM(GRNNetto)) TOTAL_GRN from (PRGRNDt INNER JOIN PRGRNHd on PRGRNDt.grnnmbr = PRGRNHd.grnnmbr)
inner join SMSupplierMs on SMSupplierMs.supid = PRGRNHd.GRNSupplier
WHERE   PRGRNHd.GRNDate between '$awal' and '$akhir'  GROUP BY PRGRNDt.GRNNmbr,PONmbr,GRNDate,DATEADD(day, GRNTOC, GRNDate),PRGRNHd.GRNSupplier,Supname,SalesId
          
           ORDER BY PRGRNDt.GRNNmbr ASC";






		$data1 = $conn->query($sql);

    

		// $hasil = $data1->fetch();
  //   print_r($hasil);
  //   die();
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

            <table width="100%" border="1">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>NOMOR GRN</th>
                        <th>NOMOR PO</th>
                        <th>TANGGAL_GRN</th>
                        <th>GRN_DUEDATE</th>
                        <th>SUPPLIER_ID</th>
                        <th>SUPPLIER_NAME</th>
                        <th>SALES ID</th>
                        <th>TOTAL GRN</th>
                        <th>TIPE</th>
                        <th>NOMOR_KONTRABON</th>
                        <th>TANGGAL_KONTRA</th>
                        <th>DUEDATE_KONTRA_1</th>
                        <th>DUEDATE_KONTRA_2</th>
                        <th>FAKTUR_MASUKAN</th>
                        <th>TOTAL_KONTRA</th>
                        <th>NOMOR_CSV</th>
                        <th>NOMOR_CP</th>
                        <th>NOMOR_PAYMENT</th>
                        <th>TOTAL_PAYMENT</th>
                        <th>TOTAL_KLIRING</th>
                         <?php
                        // dari CR
                          $start = $month = strtotime($awal);
                            $end = strtotime(date('Y-m-d'));
                            while($month < $end)
                            { 
                              ?>
                               <th><?php echo date('Y M', $month), PHP_EOL;
                                 $month = strtotime("+1 month", $month); ?></th>
                                 
                      <?php } ?>



                </thead>
                <tbody>
                      <?php 
                           $no=1;
                           $TotalNetto=0;
                           $TotalKontra=0;
                           $TotalPayment=0;
                            $TotalKliring=0;

                          while ($row = $data1->fetch()) {

                          		$NO_GRN = $row['NO_GRN'];

                             $TotalNetto+= $row['TOTAL_GRN'];

                      ?>
                      <tr>
                          <td><?php echo $no;?></td>
                          <td class="text"><?php echo $row['NO_GRN'] ?></td>
                          <td class="text"><?php echo $row['NO_PO'] ?></td>
                          <td><?php echo $row['TANGGAL_GRN'] ?></td>
                          <td class="text"><?php echo $row['GRN_DUEDATE'] ?></td>                 
                          <td class="text"><?php echo $row['SUPPLIER_ID'] ?></td>
                          <td class="text"><?php echo $row['SUPPLIER_NAME'] ?></td>
                          <td class="text"><?php echo $row['SALES_ID'] ?></td>
                          <td><?php echo number_format($row['TOTAL_GRN'],2) ?></td>
                          <?php
                          	$sqlKontra = "select CMTTTdt.TTTNmbr NO_KONTRA,convert(varchar,TTTDate,103) TANGGAL_KONTRA ,convert(varchar,TTTDueDate,103) DUEDATE_KONTRA_1,convert(varchar,TTTDueDate2,103) DUEDATE_KONTRA_2 ,FgStatus,convert(float,TTTAmount) TOTAL_KONTRA,convert(float,TTTAmountPmt) TOTAL_PAYMENT,FPMasukan FAKTUR_MASUKAN,GiroNmbr NO_CSV,CpNmbr NO_CP,PmtNmbr NO_PAYMENT from CMTTTdt INNER JOIN CMTTThd
								ON CMTTTdt.TTTNmbr = CMTTThd.TTTNmbr
								 WHERE GRNNmbr='$NO_GRN'";
							$dataKontra = $conn->query($sqlKontra)->fetch();

							$jmlKontra = $conn->query($sqlKontra)->rowCount();



							if ($jmlKontra <> 0) {
								# code...

								$TIPE="TRANSFER";
								$NO_CP =  $dataKontra['NO_CP'];
							

									$TotalKontra +=$dataKontra['TOTAL_KONTRA'];
								
									

									if ($dataKontra['NO_CSV']==NULL) {
										# code...
										$NO_CSV = "";
										$TOTAL_PAYMENT=0;
										$TotalPayment +=0;
										$TOTAL_KLIRING = 0;
										$TotalKliring +=0;
										
									}else{

										$NO_CSV = $dataKontra['NO_CSV'];
										$TOTAL_PAYMENT = $dataKontra['TOTAL_PAYMENT'];
										$TotalPayment += $dataKontra['TOTAL_PAYMENT'];
										if ($dataKontra['NO_CP']==NULL) {
											# code...
											$TOTAL_KLIRING = 0;
											$TotalKliring +=0;
										}else{
											$TOTAL_KLIRING = $dataKontra['TOTAL_PAYMENT'];
											 $TotalKliring +=$dataKontra['TOTAL_PAYMENT'];
										}
										
									}

								}else{

									$TIPE="CASH";
									$sqlCariCP = "select top 1 CpNmbr from dbo.APCPDt WHERE GRNNmbr='$NO_GRN'";
									$NO_CPHasil = $conn->query($sqlCariCP)->fetch();
									$NO_CP =  $NO_CPHasil['CpNmbr'];

									if (substr($NO_CP, 0,3)=="CPJ") {
										# code...
										$TIPE="TRANSFER KHUSUS";
									}else{
										$TIPE="CASH";
									}

									$NO_CSV = "";
									$TOTAL_PAYMENT=0;
									$TotalPayment +=0;


									if ($conn->query($sqlCariCP)->rowCount() <> 0) {
										# code...
										$TOTAL_KLIRING = $row['TOTAL_GRN'];
									$TotalKliring +=$row['TOTAL_GRN'];
									}else{
										$TOTAL_KLIRING = 0;
										$TotalKliring +=0;
									}
									
								}
							
                          ?>
                          <td><?php echo $TIPE  ?></td>
                          <td class="text"><?php echo $NO_KONTRA = $dataKontra['NO_KONTRA']  ?></td>
                          <td><?php echo $dataKontra['TANGGAL_KONTRA']  ?></td>
                          <td><?php echo $dataKontra['DUEDATE_KONTRA_1']  ?></td>
                          <td><?php echo $dataKontra['DUEDATE_KONTRA_2']  ?></td>
                          <td><?php echo $dataKontra['FAKTUR_MASUKAN']  ?></td>
                          <td><?php echo number_format($dataKontra['TOTAL_KONTRA'] ,2) ?></td>
                          <td class="text"><?php echo $NO_CSV  ?></td>
                          <td><?php echo $NO_CP;  ?></td>
                          <td class="text"><?php echo $dataKontra['NO_PAYMENT']  ?></td>
                          <td><?php echo number_format($TOTAL_PAYMENT,2) ?></td>
                          <td><?php echo number_format($TOTAL_KLIRING,2) ?></td>
                            <?php

                           // dari CR 

                          $start = $month = strtotime($awal);
                            $end = strtotime(date('Y-m-d'));
                            while($month < $end)
                            { 
                              ?>
                               <td style="background-color: #C4E538">
                                <?php 

                                     $MM = date('m', $month);
                                     $YY = date('Y', $month);

                                     $MM = $MM;
                                     $YY = $YY;

                                     $month = strtotime("+1 month", $month);

                                     $sql="select top 1 * from dbo.CMCPDb WHERE TransNmbr='$NO_CP' and Month(UpdDate)='$MM' and Year(UpdDate)='$YY'";
                                                          

                                 	$hasil2 = $conn->query($sql)->rowCount();

                                 	if ($hasil2 <> 0) {
                                 		# code...
                                 		echo number_format($TOTAL_KLIRING,2);
                                 	}

                                	

                                 ?>
                                   
                                 </td> 
                               <?php   } ?>
                      </tr>
                    <?php $no++; } ?>

                    <tr>
                          <td colspan="8"></td>
                       
                          <td><?php echo number_format($TotalNetto,2) ?></td>
                          <td colspan="6"></td>
                          <td><?php echo number_format($TotalKontra,2) ?></td>
                           <td colspan="3"></td>
                          <td><?php echo number_format($TotalPayment,2) ?></td>
                           <td><?php echo number_format($TotalKliring,2) ?></td>
                   
                        
                      </tr>
                </tbody>
            </table>