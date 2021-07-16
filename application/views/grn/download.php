<?php 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=ANALISA_PEMBELIAN_".$_POST['supid']."_".$_POST['salesid']."_FROM_".$_POST['awal']."_".$_POST['akhir'].".xls");//ganti nama sesuai keperluan
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
     $supid = $_POST['supid'];
     $SalesId = $_POST['salesid'];



      $sql="select PRGRNDt.GRNNmbr NO_GRN,PONmbr NO_PO,
              convert(varchar,GRNDate,103)  TANGGAL_GRN,GRNGroup, PRGRNHd.GRNSupplier,Supname,SalesId,
              GRNProduct SKU,ProdName SKU_NAME,
              convert(float,GRNQty) QTY_BELI,GRNUOM UOM_BELI,convert(float,GRNPrice) HARGA_UOM_BELI,
              convert(float,GRNStdQty) QTY_JUAL,GRNStdUOM UOM_JUAL,convert(float,GRNQtyPrice) HARGA_UOM_JUAL,
              convert(float,GRNBruto) BRUTO,convert(float,GRNNet) NETTO,convert(float,GRNPPN) PPN,
              convert(float,RecvReturAmount) RETUR_TOTAL,convert(float,GRNNetto) TOTAL,
              convert(float,RecvReturStdQty)RETUR_QTY,RecvReturUOM RETUR_UOM,RecvReturDesc RETUR_DESC
              from ((PRGRNDt inner join SMProductMs on PRGRNDt.GRNProduct = SMProductMs.prodcode)
              inner join PRGRNHd on PRGRNDt.grnnmbr = PRGRNHd.grnnmbr)
              inner join SMSupplierMs on SMSupplierMs.supid = PRGRNHd.GRNSupplier
          where PRGRNHd.GRNSupplier='$supid' and SalesId='$SalesId' and PRGRNHd.GRNDate between '$awal' and '$akhir'
           ORDER BY PRGRNDt.GRNNmbr ASC, POSeq ASC";






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
                        <th>GRN_GROUP</th>
                        <th>SUPPLIER_ID</th>
                        <th>SUPPLIER_NAME</th>
                        <th>SALES ID</th>
                        <th>SKU</th>
                        <th>SKU_NAME</th>
                        <th>QTY_BELI</th>
                        <th>UOM_BELI</th>
                        <th>HARGA_PER_UOM_BELI</th>
                        <th>QTY_JUAL</th>
                        <th>UOM_JUAL</th>
                        <th>HARGA_KALI_QTY_UOM_BELI</th>
                        <th>BRUTO</th>
                        <th>NETTO</th>
                        <th>PPN</th>
                        <th>RETUR_TOTAL</th>
                        <th>TOTAL</th>
                        <th>RETUR_QTY</th>
                        <th>RETUR_UOM</th>
                        <th>RETUR_DESC</th>


                </thead>
                <tbody>
                      <?php 
                           $no=1;
                           $TotalBruto=0;
                           $TotalNetto=0;
                           $TotalPPN=0;
                           $TotalRetur=0;
                           $TotalALL=0;

                          while ($row = $data1->fetch()) {


                             $TotalBruto+= $row['BRUTO'];
                             $TotalNetto+= $row['NETTO'];
                             $TotalPPN+= $row['PPN'];
                             $TotalRetur+= $row['RETUR_TOTAL'];
                             $TotalALL+= $row['TOTAL'];
                      ?>
                      <tr>
                          <td><?php echo $no;?></td>
                          <td class="text"><?php echo $row['NO_GRN'] ?></td>
                          <td class="text"><?php echo $row['NO_PO'] ?></td>
                          <td><?php echo $row['TANGGAL_GRN'] ?></td>
                          <td class="text"><?php echo $row['GRNGroup'] ?></td>                 
                          <td class="text"><?php echo $row['GRNSupplier'] ?></td>
                          <td class="text"><?php echo $row['Supname'] ?></td>
                          <td class="text"><?php echo $row['SalesId'] ?></td>
                          <td class="text"><?php echo $row['SKU'] ?></td>
                          <td class="text"><?php echo $row['SKU_NAME'] ?></td>
                          <td><?php echo number_format($row['QTY_BELI'],3) ?></td>
                          <td><?php echo $row['UOM_BELI'] ?></td>
                          <td><?php echo number_format($row['HARGA_UOM_BELI'],2) ?></td>
                          <td><?php echo number_format($row['QTY_JUAL']) ?></td>
                          <td><?php echo $row['UOM_JUAL'] ?></td>
                          <td><?php echo  number_format($row['HARGA_UOM_JUAL'],2) ?></td>
                          <td><?php echo  number_format($row['BRUTO'],2) ?></td>
                          <td><?php echo  number_format($row['NETTO'],2) ?></td>
                          <td><?php echo  number_format($row['PPN'],2) ?></td>
                          <td><?php echo  number_format($row['RETUR_TOTAL'],2) ?></td>
                          <td><?php echo  number_format($row['TOTAL'],2) ?></td>
                          <td><?php echo number_format($row['RETUR_QTY']) ?></td>
                          <td><?php echo $row['RETUR_UOM'] ?></td>
                          <td><?php echo $row['RETUR_DESC'] ?></td>
                      </tr>
                    <?php $no++; } ?>

                    <tr>
                          <td colspan="16"></td>
                       
                          <td><?php echo number_format($TotalBruto,2) ?></td>
                          <td><?php echo number_format($TotalNetto,2) ?></td>
                          <td><?php echo number_format($TotalPPN,2) ?></td>
                          <td><?php echo number_format($TotalRetur,2) ?></td>
                          <td><?php echo number_format($TotalALL,2) ?></td>
                          <td colspan="3"></td>
                        
                      </tr>
                </tbody>
            </table>