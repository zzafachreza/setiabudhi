<?php 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=INV_".$_POST['awal']."_".$_POST['akhir'].".xls");//ganti nama sesuai keperluan
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




      $sql="select INSODt.SONmbr,convert(varchar, SODate, 103) as date,inSohd.SOCusId,Cusname,
INSODt.prodcode,prodname,
convert(float, SOprice) as harga,convert(float, SOstdQty) as qty,
convert(float, SObruto) as bruto,SOStdUOM,
convert(float,(SOqtyPrice - SOafterDisc)) as disc, 
convert(float, SoNet) as netto,
convert(float, Soppn) as ppn,
convert(float,(SoNet + SoPPn)) as total
from INSODt inner join INsoHd ON inSohd.SONmbr = inSodt.SONmbr
inner join smCusms ON inSohd.SOCusId = smCusms.cusid
inner join smproductms on inSodt.prodcode = smproductms.prodcode

where Sodate between '$awal' and '$akhir' ORDER BY INSODt.SONmbr";






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
                        <th>NOMOR_INVOICE</th>
                        <th>TANGGAL_INVOICE</th>
                        <th>CUSTOMER_ID</th>
                        <th>CUSTOMER_NAME</th>
                        <th>SKU</th>
                        <th style="width: 500px">SKU_NAME</th>
                        <th>HARGA</th>
                        <th>QTY</th>
                        <th>BRUTO</th>
                        <th>UOM</th>
                        <th>DISCOUNT</th>
                        <th>NETTO</th>
                        <th>PPN</th>
                        <th>TOTAL_HC</th>
        

                </thead>
                <tbody>
                      <?php 
                           $no=1;

                          while ($row = $data1->fetch()) {

                      ?>
                      <tr>
                          <td><?php echo $no;?></td>
                          <td class="text"><?php echo $row['SONmbr'] ?></td>
                          <td><?php echo $row['date'] ?></td>
                           <td class="text"><?php echo $row['SOCusId'] ?></td>      
                          <td><?php echo $row['Cusname'] ?></td>
                                    
                          <td class="text"><?php echo $row['prodcode'] ?></td>
                          <td class="text"><?php echo $row['prodname'] ?></td>
                          <td><?php echo number_format($row['harga'],2) ?></td>
                          <td><?php echo number_format($row['qty'],2) ?></td>
                          <td><?php echo number_format($row['bruto'],2) ?></td>
                          <td><?php echo $row['SOStdUOM'] ?></td>
                          <td><?php echo number_format($row['disc'],2) ?></td>
                          <td><?php echo number_format($row['netto'],2) ?></td>
                          <td><?php echo number_format($row['ppn'],2) ?></td>
                          <td><?php echo number_format($row['total'],2) ?></td>
                    <?php $no++; } ?>

    
                </tbody>
            </table>