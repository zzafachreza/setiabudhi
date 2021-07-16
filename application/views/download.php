<?php 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=COUNTER ".$_POST['supid']." FROM ".$_POST['awal']." - ".$_POST['akhir'].".xls");//ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");
error_reporting(0);

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
	     $supid = $_POST['supid'];


      //transaksi belum posting
$sqlBelumPosting="select InvoiceNumber,CustomerId,CustomerName,convert(varchar, Tanggal, 103) Tanggal,Jam,SKUMaster,SKUName,Harga,
Kuantitas,Satuan,Bruto,Discount,V_sales_asli.PPNPerc,NilaiPPN,Total, supid,supname,convert(float,PercKonsinyasi) komisi
from dbo.V_sales_asli inner join  V_SMProductMsSuper on V_SMProductMsSuper.prodcode = V_sales_asli.SKUMaster 
WHERE supid='$supid' AND Tanggal Between '$awal' and '$akhir' AND PercKonsinyasi > 0";


//transaksi sudah posting
$sqlSudahPosting = "select InvoiceNumber,CustomerId,CustomerName,convert(varchar, Tanggal, 103) Tanggal,Jam,SKUMaster,SKUName,Harga,
Kuantitas,Satuan,Bruto,Discount,V_sales_tmp.PPNPerc,NilaiPPN,Total, supid,supname,convert(float,PercKonsinyasi) komisi
from dbo.V_sales_tmp inner join  V_SMProductMsSuper on V_SMProductMsSuper.prodcode = V_sales_tmp.SKUMaster 
WHERE supid='$supid' AND Tanggal Between '$awal' and '$akhir' AND PercKonsinyasi > 0";


  $sqlSalesOrder = "select InvcNmbr,convert(varchar, InvcDate,103) Tanggal,InvcNmbr,InvcCusIdDesc CustomerId,V_SLSBInvcProduct.ProdCode,V_SLSBInvcProduct.ProdName,InvcUOM UOM,convert(float,InvcQty) qty,convert(float,InvcPrice) Harga,
  convert(float,InvcQtyPrice) QtyKaliHarga,convert(float,Discount) Discount,
  convert(float,InvcNetto) Total,convert(float,InvcNet) NettoAtauDpp,convert(float,InvcPPN) PPN,
  supid,supname,
  convert(float,PercKonsinyasi) komisi
  from V_SLSBInvcProduct inner join V_SMProductMsSuper on V_SMProductMsSuper.prodcode = V_SLSBInvcProduct.ProdCode 
  where 
  InvcCusIdDesc not in('0000000001 - GENERAL CUSTOMER') AND supid='$supid'
  AND InvcDate Between '$awal' and '$akhir' AND PercKonsinyasi > 0";



	 //    $sql="select invcNmbr,convert(varchar, InvcDate, 103) tanggal,InvcGroupDesc bisnis_unit,InvcCusIdDesc customer,V_SLSBInvcProduct.prodcode sku,V_SLSBInvcProduct.Prodname nama,
		// InvcUOM UOM,convert(float,PercKonsinyasi) komisi,supid,supname,convert(float,InvcQty) qty,convert(float,InvcPrice) Harga,
		// convert(float,InvcQtyPrice) QtyKaliHarga,convert(float,Discount) Discount,
		// convert(float,InvcNetto) Total,convert(float,InvcNet) NettoAtauDpp,convert(float,InvcPPN) PPN
		// from V_SLSBInvcProduct inner join  V_SMProductMsSuper on V_SMProductMsSuper.prodcode = V_SLSBInvcProduct.prodcode
		// where InvcDate Between '$awal' and '$akhir' AND PercKonsinyasi > 0 and supid='$supid'";

		$data1 = $conn->query($sqlBelumPosting);
    $data2 = $conn->query($sqlSudahPosting);
    $data3 = $conn->query($sqlSalesOrder);

		// $hasil = $data->fetch();
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
                <thead>
                    <tr>
                      <th colspan="17">Penjualan</th>
                      <th colspan="8">Retur</th>
                    <tr>
                        <th>No</th>
                        <th>Nomor Struk</th>
                         <th>Tanggal</th>
                         <th>Jam</th>
                         <th>Customer</th>
                         <th>SKU</th>
                         <th>Nama</th>
                         <th>UOM</th>
                         <th>Komisi</th>
                         <th>Sup ID</th>
                         <th>Suppllier</th>
                         <th>Qty</th>
                         <th>Harga</th>
                         <th>Bruto</th>
                         <th>Discount</th>
                         <th>Total</th>
                         <th>PPN</th>
                         <th>No Retur</th>
                         <th>Tgl Retur</th>
                         <th>Ketrangan</th>
                         <th>Qty Retur</th>
                         <th>Harga Barang Retur</th>
                         <th>Total Harga Retur</th>
                         <th>Diskon Retur</th>
                         <th>Netto Retur</th>
                       </tr>
                </thead>
                <tbody>
                    
                      <?php 

                           $no=1;


                          while ($row = $data2->fetch()) {

                      ?>
                      <tr>
                      <td><?php echo $no;?></td>
                       <td><?php echo $inv=$row['InvoiceNumber'];?></td>
                       <td><?php echo $row['Tanggal'];?></td>
                        <td><?php echo $row['Jam'];?></td>
                        <td><?php echo $row['CustomerId'];?></td>
                        <td class="text"><?php echo $sku = $row['SKUMaster'];?></td>
                         <td><?php echo $row['SKUName'];?></td>
                          <td><?php echo $row['Satuan'];?></td>
                          <td><?php echo number_format($row['komisi'])."%";?></td>
                          <td><?php echo $row['supid'];?></td>
                          <td><?php echo $row['supname'];?></td>

                            <td><?php echo number_format($row['Kuantitas']);?></td>
                            <td><?php echo number_format($hrg = $row['Harga']);?></td>
                            <td><?php echo number_format($row['Bruto']);?></td>
                            <td><?php echo number_format($row['Discount']);?></td>
                            <td><?php echo number_format($row['Total']);?></td>
                            <td><?php echo number_format($row['NilaiPPN']);?></td>

                            <?php

                                      $sqlRetur = "select top 1  INReturHd.AppNumber no_retur,appinvoice,ReturnType,convert(varchar, AppDate, 103) tgl_retur,
                  AppDesc Keterangan,convert(float,InvcQtyRetur) InvcQtyRetur,convert(float,ProdPrice) harga_retur_barang,ProdCode, convert(float,ProdQtyPrice) Total,convert(float,Discount1) disc,convert(float,ProdNetto) Netto from INReturHd
                  inner join V_INReturDt on V_INReturDt.AppNumber = INReturHd.AppNumber WHERE appinvoice='$inv' AND prodcode='$sku' AND ProdPrice='$hrg'";

                        $dataRetur = $conn->query($sqlRetur)->fetch();

                        // print_r($dataRetur);


                            ?>
                            <td><?php echo $dataRetur['no_retur'] ?></td>
                              <td><?php echo $dataRetur['tgl_retur'] ?></td>
                              <td><?php echo $dataRetur['Keterangan'] ?></td>
                                <td><?php echo number_format($dataRetur['InvcQtyRetur']) ?></td>
                                  <td><?php echo number_format($dataRetur['harga_retur_barang'])  ?></td>
                                    <td><?php echo number_format($dataRetur['Total'])  ?></td>
                                      <td><?php echo  number_format($dataRetur['disc'])  ?></td>
                                        <td><?php echo  number_format($dataRetur['Netto'])  ?></td>



                        
                        
                        </tr>
                    <?php $no++; } ?>

                    <?php 

                           $no2=$no;


                          while ($row = $data1->fetch()) {

                      ?>
                      <tr>
                      <td><?php echo $no2;?></td>
                       <td><?php echo $inv2 = $row['InvoiceNumber'];?></td>
                       <td><?php echo $row['Tanggal'];?></td>
                        <td><?php echo $row['Jam'];?></td>
                        <td><?php echo $row['CustomerId'];?></td>
                        <td class="text"><?php echo $sku2 =  $row['SKUMaster'];?></td>
                         <td><?php echo $row['SKUName'];?></td>
                          <td><?php echo $row['Satuan'];?></td>
                          <td><?php echo number_format($row['komisi'])."%";?></td>
                          <td><?php echo $row['supid'];?></td>
                          <td><?php echo $row['supname'];?></td>

                            <td><?php echo number_format($row['Kuantitas']);?></td>
                            <td><?php echo number_format($hrg2 = $row['Harga']);?></td>
                            <td><?php echo number_format($row['Bruto']);?></td>
                            <td><?php echo number_format($row['Discount']);?></td>
                            <td><?php echo number_format($row['Total']);?></td>
                            <td><?php echo number_format($row['NilaiPPN']);?></td>

                              <?php

                                       $sqlRetur2 = "select top 1  INReturHd.AppNumber no_retur,appinvoice,ReturnType,convert(varchar, AppDate, 103) tgl_retur,
                  AppDesc Keterangan,convert(float,InvcQtyRetur) InvcQtyRetur,convert(float,ProdPrice) harga_retur_barang,ProdCode, convert(float,ProdQtyPrice) Total,convert(float,Discount1) disc,convert(float,ProdNetto) Netto from INReturHd
                  inner join V_INReturDt on V_INReturDt.AppNumber = INReturHd.AppNumber WHERE appinvoice='$inv2' AND prodcode='$sku2' AND ProdPrice='$hrg2'";

                        $dataRetur2 = $conn->query($sqlRetur2)->fetch();

                        // print_r($dataRetur);


                            ?>
                            <td><?php echo $dataRetur2['no_retur'] ?></td>
                              <td><?php echo $dataRetur2['tgl_retur'] ?></td>
                              <td><?php echo $dataRetur2['Keterangan'] ?></td>
                                <td><?php echo number_format($dataRetur2['InvcQtyRetur']) ?></td>
                                  <td><?php echo number_format($dataRetu2r['harga_retur_barang'])  ?></td>
                                    <td><?php echo number_format($dataRetur2['Total'])  ?></td>
                                      <td><?php echo  number_format($dataRetur2['disc'])  ?></td>
                                        <td><?php echo  number_format($dataRetur2['Netto'])  ?></td>

                        
                        
                        </tr>
                    <?php $no2++; } ?>


                    <!-- cek penjualan sales ORDER -->

                           <?php 

                           $no3=$no2;


                          while ($row = $data3->fetch()) {

                      ?>
                      <tr>
                      <td><?php echo $no3;?></td>
                       <td><?php echo $inv3 = $row['InvcNmbr'];?></td>
                       <td><?php echo $row['Tanggal'];?></td>
                        <td><?php echo $row['Tanggal'];?></td>
                        <td><?php echo $row['CustomerId'];?></td>
                        <td class="text"><?php echo $sku3 =  $row['ProdCode'];?></td>
                         <td><?php echo $row['ProdName'];?></td>
                          <td><?php echo $row['UOM'];?></td>
                          <td><?php echo number_format($row['komisi'])."%";?></td>
                          <td><?php echo $row['supid'];?></td>
                          <td><?php echo $row['supname'];?></td>

                            <td><?php echo number_format($row['qty']);?></td>
                            <td><?php echo number_format($hrg3 = $row['Harga']);?></td>
                            <td><?php echo number_format($row['QtyKaliHarga']);?></td>
                            <td><?php echo number_format($row['Discount']);?></td>
                            <td><?php echo number_format($row['Total']);?></td>
                            <td><?php echo number_format($row['PPN']);?></td>

                              <?php

                                       $sqlRetur3 = "select top 1  INReturHd.AppNumber no_retur,appinvoice,ReturnType,convert(varchar, AppDate, 103) tgl_retur,
                  AppDesc Keterangan,convert(float,InvcQtyRetur) InvcQtyRetur,convert(float,ProdPrice) harga_retur_barang,ProdCode, convert(float,ProdQtyPrice) Total,convert(float,Discount1) disc,convert(float,ProdNetto) Netto from INReturHd
                  inner join V_INReturDt on V_INReturDt.AppNumber = INReturHd.AppNumber WHERE appinvoice='$inv3' AND prodcode='$sku3' AND ProdPrice='$hrg3'";

                        $dataRetur3 = $conn->query($sqlRetur3)->fetch();

                        // print_r($dataRetur);


                            ?>
                            <td><?php echo $dataRetur3['no_retur'] ?></td>
                              <td><?php echo $dataRetur3['tgl_retur'] ?></td>
                              <td><?php echo $dataRetur3['Keterangan'] ?></td>
                                <td><?php echo number_format($dataRetur3['InvcQtyRetur']) ?></td>
                                  <td><?php echo number_format($dataRetur3['harga_retur_barang'])  ?></td>
                                    <td><?php echo number_format($dataRetur3['Total'])  ?></td>
                                      <td><?php echo  number_format($dataRetur3['disc'])  ?></td>
                                        <td><?php echo  number_format($dataRetur3['Netto'])  ?></td>

                        
                        
                        </tr>
                    <?php $no2++; } ?>
                    
                </tbody>
            </table>