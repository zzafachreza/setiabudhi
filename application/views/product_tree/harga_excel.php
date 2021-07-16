<?php


header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=SKU_HARGA_".date('Ymdhis').".xls");//ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");
error_reporting(0);

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
    	<th>No</th>
    	<th>SKU</th>
        <th>UOM</th>
    	<th>NAME</th>
        <th>SUPPLIER ID</th>
    	<th>SUPPLIER NAME</th>
        <th>SALESMAN</th>
        <th>PURCHASE PRICE</th>
        <th>PPN</th>
        <th>TOTAL PURCHASE</th>
        <th>HARGA JUAL</th>
        <th>% MU Act</th>
        <th>% MU Std </th>
        <th>% GP Act</th>
        <th>% GP Std</th>                
        <th>NO_GRN</th>
        <th>TGL_GRN</th>
    </tr>

    <?php

    // $sql ="SELECT top 1 PriceProduct,convert(float,IDRPRICE) harga,ProdName FROM SMCusPriceListDt
    // INNER JOIN SMProductMs ON SMProductMs.prodcode = SMCusPriceListDt.PriceProduct
    //  WHERE PriceSeq='6' AND InActDate IS NULL";

    $sql="SELECT SMSUpSalesProd.prodcode,convert(float,MUperc) MUperc,convert(float,GPPerc) GPPerc,ProdName,ProdUom,SMSUpSalesProd.supid,supname,SalesID,convert(float,IDRPRICE) harga from SMSUpSalesProd INNER JOIN SMProductMs ON SMProductMs.prodcode
    = SMSUpSalesProd.prodcode INNER JOIN SMSUpplierMS ON SMSUpplierMS.supid = SMSUpSalesProd.supid INNER JOIN SMCusPriceListDt ON SMSUpSalesProd.prodcode = SMCusPriceListDt.PriceProduct INNER JOIN SMProdField ON SMProdField.prodcode = SMSUpSalesProd.prodcode WHERE SMProductMs.fgStatus='A' AND PriceSeq='6' GROUP BY SMSUpSalesProd.prodcode, SMSUpSalesProd.supid,SalesID,MUperc,GPPerc,ProdName,ProdUom,supname,IDRPrice";



    	$no=1;

       




    $hasil= $conn->query($sql);

    // print_r($hasil->fetch());

    while ($r = $hasil->fetch()) {
    	# code...
 // $harga = $r['harga'];
  $sku = $r['prodcode'];


  $sqlGRN = "select top 1 PRGrnDt.GRNNmbr,convert(varchar,GRNDate,103) TGL_GRN,GRNProduct,convert(float,GRNQty) GRNQty,convert(float,GRNStdQty) GRNStdQty,GRNUOM,convert(float,GRNPrice) GRNPrice,convert(float,GRNPercPPN) GRNPercPPN from PRGrnDt INNER JOIN PRGrnHd ON PRGrnHd.GRNNmbr = PRGrnDt.GRNNmbr  WHERE GRNProduct='$sku' ORDER BY GRNDate DESC";

  $dataGRN = $conn->query($sqlGRN)->fetch();



  if ($dataGRN['GRNUOM']=='PCS') {
      # code...
        $harga_beli = $dataGRN['GRNPrice'];
  }else{
    $harga_beli = $dataGRN['GRNPrice'] / ($dataGRN['GRNStdQty']/$dataGRN['GRNQty']);
  }

  $NO_GRN = $dataGRN['GRNNmbr'];
  $TGL_GRN = $dataGRN['TGL_GRN'];

$harga = $r['harga'];
$PPN =  $harga_beli*($dataGRN['GRNPercPPN']/100);

$total_harga_beli =  $harga_beli+$PPN;

$MUact = number_format(( $harga -$total_harga_beli ) /$total_harga_beli *100,4);
$GPact = number_format(( $harga -$total_harga_beli ) /$harga *100,4);

$MUStd = $r['MUperc'];
$GPStd = $r['GPPerc'];










    ?>

    <tr>
    	<td><?php echo $no ?></td>
    	<td class="text"><?php echo $sku; ?></td>
    	<td><?php echo $r['ProdName'] ?></td>
        <td><?php echo $r['ProdUom'] ?></td>
         <td><?php echo $r['supid'] ?></td>
        <td><?php echo $r['supname'] ?></td>
        <td><?php echo $r['SalesID'] ?></td>
        <td><?php echo number_format($harga_beli) ?></td>
        <td><?php echo number_format($PPN) ?></td>
        <td><?php echo number_format($total_harga_beli)?></td>
          <td><?php echo number_format($harga) ?></td>
          <td><?php echo $MUact?></td>
          <td><?php echo number_format($MUStd) ?></td>
          <td><?php echo $GPact?></td>
          <td><?php echo number_format($GPStd ) ?></td>
          <td><?php echo $NO_GRN?></td>
          <td><?php echo $TGL_GRN ?></td>
          

    </tr>



    <?php $no++; } 	die(); ?>

</table>