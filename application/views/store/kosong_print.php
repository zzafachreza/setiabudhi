<?php
# Pengaturan tanggal komputer
date_default_timezone_set("Asia/Jakarta");

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

$host="localhost";
$db="ci";
$user="root";
$pass="";

$connMy=new PDO("mysql:host=$host;dbname=$db",$user,$pass);

function tglIndonesia($tanggal){
  $namaBln = array("01" => "Januari", "02" => "Februari", "03" => "Maret", "04" => "April", "05" => "Mei", "06" => "Juni", 
           "07" => "Juli", "08" => "Agustus", "09" => "September", "10" => "Oktober", "11" => "November", "12" => "Desesmber");
           
  $tgl=substr($tanggal,8,2);
  $bln=substr($tanggal,5,2);
  $thn=substr($tanggal,0,4);
  $tanggal ="$tgl ".$namaBln[$bln]." $thn";
  return $tanggal;
}



$kode = $_GET['id'];



$sqlhd="SELECT * FROM data_kosong WHERE kode='$kode' GROUP BY kode";

				// die();
				$hasilhd = $connMy->query($sqlhd);

				$hd = $hasilhd->fetch();

				// print_r($hd);

		  $img      = code128BarCode(str_replace(".", "", $hd['kode']), 1);
              ob_start();
              imagepng($img);
           
              $output_img   = ob_get_clean();
              echo "";

       $barcode128 ='<img width="180px"  src="data:image/png;base64,'.base64_encode($output_img).'" />'; 


       //barcode QR
 
$isi_teks = $hd['kode'];
$namafile = "coba.png";
$quality = 'H'; //ada 4 pilihan, L (Low), M(Medium), Q(Good), H(High)
$ukuran = 3; //batasan 1 paling kecil, 10 paling besar
$padding = 0;
$tempdir =''; 
$qr = QRCode::png($isi_teks,$tempdir.$namafile,$quality,$ukuran,$padding);
 
$path = $tempdir.$namafile;
$type = pathinfo($path, PATHINFO_EXTENSION);
$data = file_get_contents($path);
$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
   $qrcode = '<img id="QR" src="'.$base64.'" />';


?>



<body >
		<table border="1" width="100%" style=" border-collapse: collapse;font-size: x-small;">
		<thead>
		
			
			<th>TANGGAL</th>
			<td style="text-align: left;padding-left: 2%"><?php echo tglIndonesia($hd['tgl']); ?></td>
			<td rowspan="2" width="50%" style="padding-top: 1%">
			<center>
					<?php echo  $barcode128 ?><br/>
					<span style="font-size: 6px;"><?php echo $hd['kode']; ?></span>
			</center>
			</td>
				
			</tr>
			<tr>
			<th>DIVISI</th>
			<td style="text-align: left;padding-left: 2%"><?php echo $hd['member']; ?></td>
		</tr>
	</table> 


		<div style="border-top: 1px solid black"></div>
		<table border="1" width="100%" style=" border-collapse: collapse;font-size: x-small;">
		<thead>
			<tr>
				<th rowspan="2" width="25px">NO</th>
				<th rowspan="2" width="45%">PRODUCT</th>
				<th rowspan="2" width="5%">SUDAH DATANG ?</th>
				<th colspan="2" width="10%">STOK</th>
				<th rowspan="2">KET. PURCHASING</th>
				<th rowspan="2" width="10%">PARAF</th>
			</tr>
			<tr>
			
				<th>&nbsp;TK&nbsp;</th>
				<th>&nbsp;GDG&nbsp;</th>
		
				
			</tr>
		</thead>
		<tbody>
			<?php

			$no=1;
				$sql="SELECT * FROM data_kosong WHERE kode='$kode'";

				// die();
				$hasil = $connMy->query($sql);

				while ($r = $hasil->fetch()) {

					if ($r['qty_toko'] <= 0) {
						# code...
						$warna = 'style="color:red;text-align:center"';
					}else{
						$warna = 'style="color:black;text-align:center"';
					}

					if ($r['qty_gudang'] <= 0) {
						# code...
						$warna = 'style="color:red;text-align:center"';
					}else{
						$warna = 'style="color:black;text-align:center"';
					}
				


					$exp = explode("(", $r['po']);

						$skuGRN = $r['sku'];

					 $po = trim($exp[0]);

					 $sqlGRN = "SELECT PRGRNdt.GrnNmbr,convert(char(11),GrnDate,113) GrnDate,Ponmbr FROM PRGRNdt INNER JOIN PRGrnHd ON PRGRNdt.GRNNmbr = PRGrnHd.GRNNmbr  WHERE POnmbr='$po' AND GrnProduct='$skuGRN'";

					  $GRNdata = $conn->query($sqlGRN)->fetch();

					 
					  // print_r($GRNdata);


					 $GRN = $conn->query($sqlGRN)->rowCount();


					  $sqlPO = "SELECT convert(char(10),POdate,126) POdate FROM PRPohd WHERE POnmbr='$po'";
						  $POData = $conn->query($sqlPO)->fetch();

						  $tglPO =  $POData['POdate'];
						  $now= date('Y-m-d');

						  	$tgl1 = new DateTime($tglPO);
							$tgl2 = new DateTime($now);
							$d = $tgl2->diff($tgl1)->days;

							if ($d <= 60 && $d>=30) {
								# code...
								$warnaPO='yellow';
							}elseif($d >=60){
								$warnaPO='red';
							}
							elseif($d < 60){
								$warnaPO='blue';
							}





					 if ($GRN !== 0) {
					 	# code...
					 	$ket =  "<span style='color:green;font-size:8px'>SUDAH</span><br/><span style='color:brown;font-size:7px'>".$GRNdata['GrnDate']."</span>";
					 }else{
					 		$ket =  "<span style='color:red;font-size:8px'>BELUM</span>";
					 	 
							

					 }
			?>

			<tr>
				<td style="text-align: center;"><?php echo $no; ?> <span style="width: 10px;height: 30px; background-color: <?php echo $warnaPO ?>">&nbsp;&nbsp;&nbsp;</span> </td>
					<td>
						<strong><em style="color: green;"><?php echo $r['sku']; ?> - <?php echo $r['nama']; ?></em></strong>
						<br/>
						
						<span style="font-size: x-small;"><strong>PO terakhir : </strong>
						<?php echo $r['po'] ?> </span>
					</td>
					<td <?php echo $warna ?> ><?php echo $ket ?></td>
					<td <?php echo $warna ?> ><?php echo $r['qty_toko']; ?></td>
					<td <?php echo $warna ?> ><?php echo $r['qty_gudang']; ?></td>
				
					<td><?php echo $r['keterangan']; 

					// echo $d;
						

					?></td>
					<td></td>
	

			</tr>



			<?php

			$no++;		
					}

			?>
		
		</tbody>
	</table>

	<hr/>

	<table  border="1" width="100%" style=" border-collapse: collapse;font-size: x-small;">
		<tr>
			<td>
				<ul style="list-style-type: none;margin: 1%">
					<li><span style="width: 10px;height: 30px; background-color: blue">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> ( Masih Batas Aman dibawah 1 bulan ) </li>
					<li><span style="width: 10px;height: 30px; background-color: yellow">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>  ( Warning ! diatas 1 bulan ) </li>
					<li><span style="width: 10px;height: 30px; background-color: red">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>  ( Warning Banget diatas 2 bulan ) </li>
				</ul>
			</td>
			<td width="50%" align="right" style="padding: 1%;">
				<?php echo $qrcode ?>
			</td>
		</tr>
	</table>



	<table  border="1" width="100%" style=" border-collapse: collapse;font-size: x-small;">
		<tr>
			<th style="text-align:center">DIVISI <?php echo $hd['member'];?><br/><br/><br/><br/>
				( ....................)
			</th>
			<th style="text-align:center">GUDANG<br/><br/><br/><br/>
			( ....................)
			</th>
			<th style="text-align:center">STORE<br/><br/><br/><br/>
				( ....................)
			</th>
		</tr>
	</table>

</body>

