<?php 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=PA"."_FROM_".$_POST['awal']."_".$_POST['akhir'].".xls");//ganti nama sesuai keperluan
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





// print_r($hasil);

function tglSql($tgl){
	$tgl = explode("/", $tgl);
	return $tgl[2]."-".$tgl[1]."-".$tgl[0];
}

if(!empty($_POST)){

	   $awal = tglSql($_POST['awal']);
	   $akhir = tglSql($_POST['akhir']);

      $sql="select TransNmbr,convert(varchar,TransDate,103) TransDate,TransSupId,supname,TransDesc,TransHCAmount from dbo.PATrans
inner join SMSupplierMS on PATrans.TransSupId = SMSupplierMS.supid
 WHERE TransDate between '$awal' and '$akhir'";

		$data1 = $conn->query($sql);


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
                        <th>PA NUMBER</th>
                        <th>PA DATE </th>
                        <th>SUPPLIER ID</th>
                        <th>SUPPLIER NAME</th>
                        <th>DESCRIPTION</th>
                        <th>TOTAL</th>

                        <?php
                        // dari CR
                          $start = $month = strtotime($awal);
                            $end = strtotime($akhir);
                            while($month < $end)
                            { 
                              ?>
                               <th><?php echo "CASH<br/>".date('Y M', $month), PHP_EOL;
                                 $month = strtotime("+1 month", $month); ?></th>
                                 
                      <?php } ?>

                       <?php
                        // dari CNDN
                          $start = $month = strtotime($awal);
                            $end = strtotime($akhir);
                            while($month < $end)
                            { 
                              ?>
                               <th><?php echo "CNDN<br/>".date('Y M', $month), PHP_EOL;
                                 $month = strtotime("+1 month", $month); ?></th>
                                 
                      <?php } ?>

                </thead>
                <tbody>
                      <?php 
                           $no=1;
                          while ($row = $data1->fetch()) {

                            $ID = $row['TransNmbr'];
                      ?>
                      <tr style="background-color:#bdc3c7">
                          <td><?php echo $no;?></td>
                          <td class="text"><?php echo $row['TransNmbr'] ?></td>
                          <td><?php echo $row['TransDate'] ?></td>
                          <td class="text"><?php echo $row['TransSupId'] ?></td>
                          <td class="text"><?php echo $row['supname'] ?></td>
                          <td class="text"><?php echo $row['TransDesc'] ?></td>
                          <td><?php echo number_format($row['TransHCAmount'],2) ?></td>

                           <?php

                           // dari CR 

                          $start = $month = strtotime($awal);
                            $end = strtotime($akhir);
                            while($month < $end)
                            { 
                              ?>
                               <td style="background-color: #C4E538">
                                <?php 

                                      $MM = date('m', $month);
                                     $YY = date('Y', $month);

                                     $MM = (int)$MM;
                                     $YY = (int)$YY;

                                      $month = strtotime("+1 month", $month);

                                     $sql="select SettleSupId,
convert(float,sum(TransHCAmount)) total from (dbo.PASettlementHd 
inner join SMSupplierMS on PASettlementHd.SettleSupId = SMSupplierMS.supid) 
inner join PASettlementDt on PASettlementHd.SettleNmbr = PASettlementDt.SettleNmbr 
WHERE SATransNmbr='$ID' and Month(SettleDate)='$MM' and Year(SettleDate)='$YY' AND PASettlementHd.fgTransType='3' GROUP BY SettleSupId";
                

                                 $hasil2 = $conn->query($sql)->fetch();

                                echo number_format($hasil2['total'],2);

                                 ?>
                                   
                                 </td> 
                               <?php   } ?>

                            <?php

                           // dari CNDN 

                          $start = $month = strtotime($awal);
                            $end = strtotime($akhir);
                            while($month < $end)
                            { 
                              ?>
                               <td style="background-color: #FFC312">
                                <?php 

                                      $MM = date('m', $month);
                                     $YY = date('Y', $month);

                                     $MM = (int)$MM;
                                     $YY = (int)$YY;

                                      $month = strtotime("+1 month", $month);

                               $sql="select SettleSupId,
convert(float,sum(TransHCAmount)) total from (dbo.PASettlementHd 
inner join SMSupplierMS on PASettlementHd.SettleSupId = SMSupplierMS.supid) 
inner join PASettlementDt on PASettlementHd.SettleNmbr = PASettlementDt.SettleNmbr 
WHERE SATransNmbr='$ID' and Month(SettleDate)='$MM' and Year(SettleDate)='$YY' AND PASettlementHd.fgTransType='2' GROUP BY SettleSupId";
                              

                                 $hasil2 = $conn->query($sql)->fetch();

                                echo number_format($hasil2['total'],2);

                                 ?>
                                   
                                 </td> 
                               <?php   } ?>


                             </tr>



                      <?php

//                       $sql="select PASettlementDt.SettleNmbr,convert(varchar,SettleDate,103) SettleDate,SettleSupId,supname,SettleDesc, CNDNNmbr,CRNMbr,
// convert(float,TransHCAmount) total from (dbo.PASettlementHd 
// inner join SMSupplierMS on PASettlementHd.SettleSupId = SMSupplierMS.supid) inner join 
// PASettlementDt on PASettlementHd.SettleNmbr = PASettlementDt.SettleNmbr WHERE SATransNmbr='$ID'";
// $hasil2 = $conn->query($sql);
//    while ($row2 = $hasil2->fetch()) {

                      ?>
               <!--        <tr>
                          <td></td>
                          <td class="text"><?php echo $row2['SettleNmbr'] ?></td>
                          <td><?php echo $row2['SettleDate'] ?></td>
                          <td colspan="1">&nbsp;</td>
                           <td><?php echo $row2['SettleDesc'] ?></td>
                           <td><?php echo $row2['CNDNNmbr']==""?$row2['CRNMbr']:$row2['CNDNNmbr'] ?></td>
                            <td><?php echo number_format($row2['total'],2) ?></td>
                      </tr> -->

                      <?php 
                        // }
                      ?>
             

                    <?php  $no++; } ?>
                </tbody>
            </table>