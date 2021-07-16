<?php 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=AP_CNDN_".$_POST['CNDNtype']."_FROM_".$_POST['awal']."_".$_POST['akhir'].".xls");//ganti nama sesuai keperluan
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


	            $CNDNtype = $_POST['CNDNtype'];

      $sql="select APCNDNhd.CNDNNmbr,APCNDNdt.CNDNtype,CNDNTypeName,convert(varchar, CNDNDate, 103) as tanggal_cndn ,CNDNSuplier,supname,CNDNDesc,APCNDNdt.GRNNmbr,PRReturHd.fgcndn,
convert(float,cnhcamount) kredit, convert(float,dnhcamount) debit,CMTTTDt.TTTNmbr nomor_kontrabon,convert(varchar,TTTDate,103) tanggal_kontrabon,PRReturHd.AppNumber no_retur,convert(varchar,AppDate,103)  tanggal_retur,AppDesc keterangan_retur,VATInReturDt.TaxNmbr nota_retur
from (((((
(APCNDNdt inner join APCNDNhd  on APCNDNhd.CNDNNmbr = APCNDNdt.CNDNNmbr) 
inner join SmSupplierMS on APCNDNhd.CNDNSuplier = SmSupplierMS.supid) inner join CMTTTDt on CMTTTDt.GRNNmbr = APCNDNdt.GRNNmbr)
inner join CMTTTHd on CMTTTDt.TTTNmbr = CMTTTHd.TTTNmbr) inner join PRReturHd on PRReturHd.CNDNNmbr = APCNDNhd.CNDNNmbr)
inner join APCNDNType on APCNDNType.CNDNTypeCode = APCNDNdt.CNDNtype)
inner join VATInReturDt on VATInReturDt.ReturNmbr = PRReturHd.AppNumber
where APCNDNhd.CNDNDate between '$awal' and '$akhir' AND APCNDNdt.CNDNtype='$CNDNtype' order by APCNDNhd.CNDNNmbr ASC";






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
                        <th>NOMOR CNDN</th>
                        <th>TIPE</th>
                        <th>TANGGAL CNDN</th>
                        <th>ID SUPPLIER</th>
                        <th>SUPPLIER</th>
                        <th>KETERANGAN CNDN</th>
                        <th>NOMOR GRN</th>
                        <th>FLAG</th>
                        <th>KREDIT</th>
                        <th>DEBIT</th>
                        <th>NOMOR KONTRABON</th>
                        <th>TANGGAL KONTRABON</th>
                        <th>NOMOR RETUR</th>
                        <th>NOTA RETUR</th>
                        <th>TANGGAL RETUR</th>
                        <th>KETERANGAN RETUR</th>
                    </tr>
                </thead>
                <tbody>
                      <?php 
                           $no=1;
                          while ($row = $data1->fetch()) {
                      ?>
                      <tr>
                          <td><?php echo $no;?></td>
                          <td class="text"><?php echo $row['CNDNNmbr'] ?></td>
                          <td class="text"><?php echo $row['CNDNtype']." - ".$row['CNDNTypeName'] ?></td>
                          <td><?php echo $row['tanggal_cndn'] ?></td>
                          <td class="text"><?php echo $row['CNDNSuplier'] ?></td>
                          <td><?php echo $row['supname'] ?></td>
                          <td><?php echo $row['CNDNDesc'] ?></td>
                          <td><?php echo $row['GRNNmbr'] ?></td>
                          <td><?php echo $row['fgcndn'] ?></td>
                          <td><?php echo number_format($row['kredit'],2) ?></td>
                          <td><?php echo number_format($row['debit'],2) ?></td>
                          <td><?php echo $row['nomor_kontrabon'] ?></td>
                          <td><?php echo $row['tanggal_kontrabon'] ?></td>
                          <td><?php echo $row['no_retur'] ?></td>
                            <td><?php echo $row['nota_retur'] ?></td>
                          <td><?php echo $row['tanggal_retur'] ?></td>
                          <td><?php echo $row['keterangan_retur'] ?></td>
                      </tr>
                    <?php $no++; } ?>
                </tbody>
            </table>