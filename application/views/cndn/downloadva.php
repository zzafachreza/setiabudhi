<?php 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=VOUCHER"."_FROM_".$_POST['awal']."_".$_POST['akhir'].".xls");//ganti nama sesuai keperluan
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

      $sql="select VoucherNo, SerialStart,SerialEnd,convert(float,Nominal) Nominal,convert(varchar,CreateDate,103)  CreateDate, convert(varchar,ExpDate,103) ExpDate,VocDesc from dbo.SLVoucherMs
 WHERE CreateDate between '$awal' and '$akhir'";

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

            <table class="table" width="100%" border="1" style="border-collapse: collapse;  border-spacing: 0;">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>NOMOR VOUCHER</th>
                        <th>Start NO</th>
                        <th>Start End</th>
                        <th>Jumlah</th>
                        <th>Nominal</th>
                        <th>TGL BUAT</th>
                        <th>TGL EXP</th>
                        <th>DESC</th>
                        <th>SALDO AWAL</th>
           

                        <?php
                        // dari CR
                          $start = $month = strtotime($awal);
                            $end = strtotime($akhir);
                            while($month < $end)
                            { 
                              ?>
                               <th><?php echo date('Y M', $month), PHP_EOL;
                                 $month = strtotime("+1 month", $month); ?></th>
                                 
                      <?php } ?>

                      <th>SALDO AKHIR</th>
                      <th>BALANCE</th>
                      <!-- <th>VOUCER TIDAK TERPAKAI</th> -->

                      

                </thead>
                <tbody>
                      <?php 
                           $no=1;
                          while ($row = $data1->fetch()) {

                            $ID = $row['VoucherNo'];
                      ?>
                      <tr style="background-color:#bdc3c7">
                        <td><?php echo $no ?></td>
                        <td><?php echo $ID ?></td>
                         <td><?php echo $row['SerialStart'] ?></td>
                         <td><?php echo $row['SerialEnd'] ?></td>
                           <td><?php 

                            $JMLend =  explode(" ", $row['SerialEnd']);
                            $JMLstart =  explode(" ", $row['SerialStart']);

                            echo $JMLVOUCHER = ((int)end($JMLend) - (int)end($JMLstart))+1 ;

                            ?></td>
                           <td><?php echo number_format($row['Nominal']) ?></td>
                         <td><?php echo $row['CreateDate'] ?></td>
                          <td><?php echo $row['ExpDate'] ?></td>
                          <td><?php echo $row['VocDesc'] ?></td>

                            <td><?php 

                             $SALDO_AWAL = $JMLVOUCHER * $row['Nominal'];
                             echo number_format($SALDO_AWAL);

                               ?></td>

                           <?php
                           $SALDO_AKHIR=0;
                          $start = $month = strtotime($awal);
                            $end = strtotime($akhir);
                            while($month < $end)
                            { 
                              ?>
                               <td style="background-color: #C4E538">
                                <?php 

                                     $MM = date('m', $month);
                                     $YY = date('y', $month);

                                     $MM = $MM;
                                     $YY = $YY;

                                     $month = strtotime("+1 month", $month);

                                     $sql="select VoucherNo,convert(float,sum(Nominal)) total  from dbo.SLVoucherTransB WHERE VoucherNo='$ID' and SUBSTRING(SONmbrUsed,3,2)='$MM' and SUBSTRING(SONmbrUsed,0,3) ='$YY' AND SONmbrUsed!='NULL' GROUP BY VoucherNo";

                                       $hasil2 = $conn->query($sql)->fetch();

                                       $SALDO_AKHIR +=$hasil2['total'];

                                echo number_format($hasil2['total'],0);
                                   

                                 ?>
                                   
                                 </td> 
                               <?php   } ?>

                               <td><?php echo number_format($SALDO_AKHIR,0) ?></td>

                                 <td><?php echo number_format($SALDO_AWAL - $SALDO_AKHIR,0) ?></td>
                            
                            <!-- <td> -->
                              
                              <?php
                                  // $sqlVO = "SELECT serialNo from dbo.SLVoucherTransB WHERE VoucherNo='$ID' AND SONmbrUsed IS NULL";

                                  // $hasilVO = $conn->query($sqlVO);
                                  // if ($hasilVO->rowCount() <> 0) {
                                  //   while ($rVO = $hasilVO->fetch()) {
                                  //     echo $rVO['serialNo']." / ";
                                  //   }
                                  // }else{
                                  //   echo "VOUCER TERPAKAI SEMUA";
                                  // }
                              ?>
                            <!-- </td> -->

                             </tr>

         <?php  $no++; } ?>

                </tbody>
            </table>