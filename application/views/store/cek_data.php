<?php
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


$key = trim($_POST['key']);
$sql="SELECT top 1 SmProdBarcode.prodcode,SmProdBarcode.prodbarcode  FROM SmProdBarcode inner join SMProductms ON SmProdBarcode.prodcode = SMProductms.prodcode  WHERE SmProdBarcode.prodcode like '%$key%' or SmProdBarcode.prodbarcode like '%$key%' or prodname like '%$key%'";



$data = $conn->query($sql)->fetch();

$sku = $data['prodcode'];


$sql2="select top 1 PriceProduct,convert(float,IDRPrice) harga,prodname,prodUom from dbo.SMCusPriceListDt inner join SMProductms ON SMCusPriceListDt.PriceProduct = SMProductms.prodcode  where priceProduct='$sku' order by PriceSeq DESC";
$data2 = $conn->query($sql2)->fetch();


// print_r($data2);

$now = date('Y-m-d');
$day = date('D', strtotime($now));
$dayList = array(
	'Sun' => 'minggu',
	'Mon' => 'senin',
	'Tue' => 'selasa',
	'Wed' => 'rabu',
	'Thu' => 'kamis',
	'Fri' => 'jumat',
	'Sat' => 'sabtu'
);

  $sqlPromo = "select top 1 SLPromoDt.promocode, PromoName,PromoDesc, convert(varchar,StartDate,103)  StartDate, convert(varchar,EndDate,103) EndDate,PromoType,fgCriteria 
,convert(float,PromoPerc) persen,convert(float,PromoDisc) amount,convert(float,PromoPrice) spesial,prodQty1,ProdQty2 from SLPromoDt inner join SLPromoHd on  SLPromoDt.promocode = SLPromoHd.promocode where SLPromoDt.PromoCode not like 'AR%' AND StartDate <='$now' 
and EndDate >='$now' and prodcode='$sku' Order By SLPromoDt.UpdDate DESC";

 $promo = $conn->query($sqlPromo)->fetch();

 // echo $day;

 // print_r($promo);


  $ada_promo = $conn->query($sqlPromo)->rowCount();

  	# code...
  		if ($promo['PromoType']=="01" AND $promo['fgCriteria']=="01") {
  			# code...
  			if ($promo['promocode']!='SM-HDS-0120-034') {
  				# code...
  					$desc="PROMO DISKON ".number_format($promo['persen'])."%";
		  			$harga = $data2['harga'] - ($promo['persen']/100*$data2['harga']);
		  			$ada =1;
  			}
  			elseif ($promo['promocode']=='SM-HDS-0120-034' && $day=="Mon") {
  				# code...
  					$desc="PROMO DISKON ".number_format($promo['persen'])."%";
		  			$harga = $data2['harga'] - ($promo['persen']/100*$data2['harga']);
		  			$ada =1;
  			}
  			elseif ($promo['promocode']=='SM-HDS-0120-034' && $day=="Thu") {
  				# code...
  					$desc="PROMO DISKON ".number_format($promo['persen'])."%";
		  			$harga = $data2['harga'] - ($promo['persen']/100*$data2['harga']);
		  			$ada =1;
  			}


  		}elseif ($promo['PromoType']=="04" AND $promo['fgCriteria']=="01") {
  			# code...
  			$desc="PROMO POTONGAN SEBESAR ".number_format($promo['amount']);
  			$harga = $data2['harga'] - $promo['amount'];
  			$ada =1;

  		}elseif ($promo['PromoType']=="04" AND $promo['fgCriteria']=="04") {
  			# code...
  			$desc="PROMO POTONGAN SEBESAR Rp. ".number_format($promo['amount'])." SETIAP PEMBELIAN MINIMAL ".number_format($promo['prodQty1']);
  			$harga = $data2['harga'];
  			$ada =1;

  		}elseif ($promo['PromoType']=="06" AND $promo['fgCriteria']=="01") {
  			# code...
  			$desc="PROMO SPECIAL PIRCE";
  			$harga = $promo['spesial'];
  			$ada =1;

  		}elseif ($promo['PromoType']=="09" AND $promo['fgCriteria']=="04") {
  			# code...
  			$desc="PROMO BUY ".number_format($promo['prodQty1'])." GET ".number_format($promo['ProdQty2'])." FREE ( PRODUK YANG SAMA)";
  			$harga = $promo['spesial'];
  			$ada =1;

  		}elseif ($promo['PromoType']=="07" AND $promo['fgCriteria']=="04") {
  			# code...

  			 $sqlOther="select SLPromoDt2.ProdCode,ProdName,ProdUOM,ProdQty1,ProdQty2 
				from dbo.SLPromoDt2 inner join SMProductMs 
				ON SLPromoDt2.prodcode = SMProductMs.prodcode 
				where PromoCode='$promo[promocode]'";
				 $other = $conn->query($sqlOther)->fetch();

  			$desc="PROMO BUY ".number_format($promo['prodQty1'])." GET ".$other['ProdName']."  ".number_format($other['ProdQty1'])." FREE";
  			$harga = $promo['spesial'];
  			$ada =1;

  		}else{
		  	$desc="Tidak Ada Promo";
		  	$harga = $data2['harga'];
		  	$ada=0;
		 }


function tglSql($tgl){
	$tgl = explode("/", $tgl);
	return $tgl[2]."-".$tgl[1]."-".$tgl[0];
}

function Indonesia3Tgl($tanggal){
  $namaBln = array("01" => "Januari", "02" => "Februari", "03" => "Maret", "04" => "April", "05" => "Mei", "06" => "Juni", 
           "07" => "Juli", "08" => "Agustus", "09" => "September", "10" => "Oktober", "11" => "November", "12" => "Desember");
           
  $tgl=substr($tanggal,8,2);
  $bln=substr($tanggal,5,2);
  $thn=substr($tanggal,0,4);
  $tanggal ="$tgl ".$namaBln[$bln]." $thn";
  return $tanggal;
}
function hitungHari($myDate1, $myDate2){
        $myDate1 = strtotime($myDate1);
        $myDate2 = strtotime($myDate2);
 
        return ($myDate2 - $myDate1)/ (24 *3600);
}



 		$img  = code128BarCode(str_replace(".", "", $sku), 1);
        ob_start();
        imagepng($img);
		$output_img   = ob_get_clean();
       $barcode128 ='<img class="barcode"  src="data:image/png;base64,'.base64_encode($output_img).'" />'; 

        $isi_teks = $sku;
		$namafile = "coba.png";
		$quality = 'H'; //ada 4 pilihan, L (Low), M(Medium), Q(Good), H(High)
		$ukuran = 5; //batasan 1 paling kecil, 10 paling besar
		$padding = 0;
		$qr = QRCode::png($isi_teks,$tempdir.$namafile,$quality,$ukuran,$padding);
		$path = $tempdir.$namafile;
		$type = pathinfo($path, PATHINFO_EXTENSION);
		$data = file_get_contents($path);
		$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

		


?>



<style type="text/css">
	table.table-bordered{
    border:1px solid black;
    margin-top:20px;
  }
table.table-bordered > thead > tr > th{
    border:1px solid black;
}
table.table-bordered > tbody > tr > td{
    border:1px solid black;
}
</style>
	
<!-- <div style="float: left;margin-bottom: 1%">
			<?php echo $barcode128 ?>
</div>
 -->
<table class="table table-bordered">
	<tr style="background-color: #6d77df;color:#FFF">
		<th>SKU</th>
		<th>NAME</th>
		<th>UOM</th>
	</tr>
	<tr>
		<td style="font-size:18pt;" ><?php echo $data2['PriceProduct'] ?></td>
		<td style="font-size:18pt;" ><?php echo $data2['prodname'] ?></td>
		<td style="font-size:18pt;" ><?php echo $data2['prodUom'] ?></td>
	</tr>

	<?php
	if ($ada==1) {
		# code...
	
	?>
<tr>		
	<?php if ($harga>0): ?>
		<td colspan="3" align="center">
		<span style="font-size:35pt;margin-right:5%"><strike><?php echo number_format($data2['harga']) ?></strike></span>
		<span style="font-size:50pt;color:red"><?php echo number_format($harga ) ?></span>
		<p style="font-size:15pt;color:red"><?php echo $desc ?></p>
	</tr>
	<?php endif ?>

	<?php if ($harga==0): ?>
		<td colspan="3" align="center">
		<span style="font-size:35pt;margin-right:5%"><?php echo number_format($data2['harga']) ?></span>
		<p style="font-size:15pt;color:red;font-weight: bold"><?php echo $desc ?></p>

	</tr>
	<?php endif ?>

		

	</table>

<hr/>

<table class="table table-bordered">
	<tr style="background-color: #f3548e;color:#FFF">
		<th>MULAI</th>
		<th>BERAKHIR</th>

	</tr>
	<tr>
		
		<td style="font-size:18pt;"><?php echo Indonesia3Tgl(tglSql($promo['StartDate'])) ?></td>
		<td style="font-size:18pt;"><?php echo Indonesia3Tgl(tglSql($promo['EndDate'])) ?> ( <span style="color:red"><?php echo hitungHari(date('Y-m-d'),tglSql($promo['EndDate'])) ?> Hari Lagi</span> )</td>
		
	</tr>
</table>

	<?php
		}else{

			?>
	<tr>
		<td colspan="3" align="center">
		<span style="font-size:35pt;margin-right:5%"><?php echo number_format($data2['harga']) ?></span>
	
	</tr>




<?php } ?>
	
<!-- <div style="float: right;">
			<?php   echo '<img width="100" height="100" src="'.$base64.'" />';?>
</div>
 -->