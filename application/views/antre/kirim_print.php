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


$key = trim($_POST['supid']);
$sql="SELECT SupName,SupAliasName,SupAddr1,SupPhone1,SupZipCode,CityName,CityState,CityCountry FROM SMSUpplierMs INNER JOIN
SMCityMs ON SMSupplierMs.SupCity = SMCityMs.CityCode WHERE SupId='$key'";


$sku = $key;
$data = $conn->query($sql)->fetch();


// print_r($data);

$nama = $data['SupName'];
$alamat = $data['SupAddr1'];
$kota = $data['CityName'];
$provinsi = $data['CityState'];
$kode_pos = $data['SupZipCode'];
$telepon = $data['SupPhone1'];



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
	


<div style="border:1px solid gray;margin: 1%;padding:1%;font-size: 18pt">
	<table class="table">
		<tr>
	
			<td><h3>DARI</h3></td>
			<td><?php echo $barcode128 ?>
				<div style="float: right;">
			<?php   echo '<img width="50" height="50" src="'.$base64.'" />';?>
				</div>
			</td>
		</tr>
		<tr>
		<tr>
	
			<td>NAMA</td>
			<td>SETIABUDHI SUPERMARKET</td>
		</tr>
		<tr>
			<td>ALAMAT</td>
			<td>JL. SETIABUDHI NO. 46 HEGARMANAH - CIDADAP</td>
		</tr>
		<tr>
			<td>KOTA</td>
			<td>BANDUNG</td>
		</tr>
		<tr>
			<td>TELEPON</td>
			<td>022-203 5000</td>
		</tr>
	</table>


	<table class="table">
		<tr>
	
			<td><h3>KEPADA</h3></td>
			<td>
				</div>
			</td>
		</tr>
		<tr>
			<td >NAMA</td>
			<td ><?php echo $nama ?></td>
		</tr>
		<tr>
			<td >ALAMAT</td>
			<td ><?php echo $alamat ?></td>
		</tr>
		<tr>
			<td >KOTA</td>
			<td ><?php echo $kota ?>, <?php echo $provinsi ?></td>
		</tr>
		<tr>
			<td >KODE POS</td>
			<td ><?php echo $kode_pos ?></td>
		</tr>
		<tr>
			<td>TELEPON</td>
			<td ><?php echo $telepon ?></td>
		</tr>
	</table>
</div>

<hr/>

<div style="border:1px solid gray;margin: 1%;padding:1%;font-size: 18pt">
	<table class="table">
		<tr>
	
			<td><h3>DARI</h3></td>
			<td><?php echo $barcode128 ?>
				<div style="float: right;">
			<?php   echo '<img width="50" height="50" src="'.$base64.'" />';?>
				</div>
			</td>
		</tr>
		<tr>
		<tr>
	
			<td>NAMA</td>
			<td>SETIABUDHI SUPERMARKET</td>
		</tr>
		<tr>
			<td>ALAMAT</td>
			<td>JL. SETIABUDHI NO. 46 HEGARMANAH - CIDADAP</td>
		</tr>
		<tr>
			<td>KOTA</td>
			<td>BANDUNG</td>
		</tr>
		<tr>
			<td>TELEPON</td>
			<td>022-203 5000</td>
		</tr>
	</table>


	<table class="table">
		<tr>
	
			<td><h3>KEPADA</h3></td>
			<td>
				</div>
			</td>
		</tr>
		<tr>
			<td >NAMA</td>
			<td ><?php echo $nama ?></td>
		</tr>
		<tr>
			<td >ALAMAT</td>
			<td ><?php echo $alamat ?></td>
		</tr>
		<tr>
			<td >KOTA</td>
			<td ><?php echo $kota ?>, <?php echo $provinsi ?></td>
		</tr>
		<tr>
			<td >KODE POS</td>
			<td ><?php echo $kode_pos ?></td>
		</tr>
		<tr>
			<td>TELEPON</td>
			<td ><?php echo $telepon ?></td>
		</tr>
	</table>
</div>


	

	
<script type="text/javascript">
	window.print();


</script>
