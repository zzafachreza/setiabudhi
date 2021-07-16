<?php 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=PROMO_TEMPLATE ".date('ymd').".xls");//ganti nama sesuai keperluan
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




$sql = "SELECT PromoCode,PromoName,convert(varchar, StartDate, 103) StartDate,StartTime,convert(varchar, Enddate, 103) Enddate,EndTime FROM SLPromoHd WHERE fgStatus='O'";
$hasil = $conn->query($sql);

function tglIndonesia($tanggal){
  $namaBln = array("01" => "JAN", "02" => "FEB", "03" => "MAR", "04" => "APR", "05" => "MEI", "06" => "JUN", 
           "07" => "JUL", "08" => "AUG", "09" => "SEP", "10" => "OKT", "11" => "NOV", "12" => "DES");
           
  $tgl=substr($tanggal,8,2);
  $bln=substr($tanggal,5,2);
  $thn=substr($tanggal,0,4);
  $tanggal ="$tgl ".$namaBln[$bln]." $thn";
  return $tanggal;
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

<table border="1" style=" border-collapse: collapse;">

	<tr>
		<th></th>
		<th>SKU</th>
		<th>Product Name</th>
		<th>H. JUAL</th>
		<th>Discount %</th>
		<th>Discount Amount</th>
		<th>Special Price</th>
		<th>H. JUAL STLH DISC</th>
		<th class="text">Start Date</th>
		<th class="text">End Date</th>
	</tr>

	

	<?php



while ($r = $hasil->fetch()) {
	# code...


?>
	<tr>
		<th colspan="10" style="background-color: yellow">&nbsp;</th>
	</tr>
		<tr>
			<td colspan="10" style="font-size: large;">Promo Code : <?php echo $r['PromoCode']  ?> - <?php echo $r['PromoName']  ?></td>
	
		</tr>
		
			<?php

			$CODE = $r['PromoCode'] ;

			 $sql2 = "select SLPromoDt.PromoCode,PromoName,convert(float,IDRPRICE) harga,
convert(char(10), SLPromoHd.StartDate, 126) StartDate,StartTime,convert(char(10), SLPromoHd.Enddate, 126) Enddate,EndTime,
SLPromoDt.ProdCode,ProdName,ProdUOM,convert(float,ProdQty1) ProdQty1,convert(float,ProdQty2) ProdQty2,
convert(float,ProdAmount1) ProdAmount1,convert(float,ProdAmount2) ProdAmount2,
convert(float,PromoPerc) PromoPerc,convert(float,PromoDisc) PromoDisc,convert(float,PromoPrice) PromoPrice
from ((SLPromoDt inner join SLPromoHd ON SLPromoDt.promoCode = SLPromoHd.promoCode )
inner join SMProductMs on SLPromoDt.ProdCode = SMProductMs.ProdCode) INNER JOIN SMCusPriceListDt ON SMProductMs.prodcode = SMCusPriceListDt.PriceProduct
where SLPromodt.promoCode='$CODE' AND PriceSeq='6'";



				$hasil2 = $conn->query($sql2);

				while ($r2 = $hasil2->fetch()) {

					$harga = $r2['harga'];



					# code...

					if ($r2['PromoPerc'] > 0) {
						# code...
						

						$total= ( $harga - ($harga*($r2['PromoPerc']/100)));

						$r2['PromoDisc'] = $harga*($r2['PromoPerc']/100);

					}elseif($r2['PromoDisc'] > 0){

						$total=  $harga - $r2['PromoDisc'];
					}elseif($r2['PromoPrice'] > 0){
						
						$total=  $harga - $r2['PromoPrice'];
					}
				
			 ?>
			 <tr>
			 	<td width="50">&nbsp;</td>
				<td class="text"><?php echo $r2['ProdCode'] ?></td>
				<td style="width:400px;"><?php echo $r2['ProdName'] ?></td>
				<td><?php echo number_format($harga) ?></td>
				<td><?php echo number_format($r2['PromoPerc']) ?></td>
				<td><?php echo number_format($r2['PromoDisc'])?></td>
				<td><?php echo number_format($r2['PromoPrice']) ?></td>
				<td><?php echo number_format($total) ?></td>
				<td class="text" colspan="1"><?php echo tglIndonesia($r2['StartDate'])  ?></td>
				<td class="text" colspan="1"><?php echo tglIndonesia($r2['Enddate']);  ?></td>


			</tr>
			<?php } ?>
	<?php } ?>
	
</table>