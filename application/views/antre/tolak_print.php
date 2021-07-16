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

$arr = $_POST['PONmbr'];

$po="";

for ($i=0; $i < count($arr) ; $i++) { 
	# code...
	

	if ($i<count($arr)-1) {
		$po.="'".$arr[$i]."',";
		}else{
			$po.="'".$arr[$i]."'";
		}
}

// echo $po;
	



// die();	

 $key = trim($_POST['PONmbr']);





 $sqlHD="SELECT  PRGRNdt.GRNNmbr, convert(varchar,GRNDate,23) GRNDate,GRNSupplier,supname from PRGRNHd INNER JOIN SMSupplierMs ON SMSupplierMs.supid = PRGRNHd.GRNSupplier INNER JOIN PRGRNdt ON PRGRNdt.GRNNmbr = PRGRNHd.GRNNmbr WHERE PONmbr in ($po)";


$dataHD = $conn->query($sqlHD)->fetch();


$NO_PO = $key;
$NO_GRN = $dataHD['GRNNmbr'];
$TGL_GRN = $dataHD['GRNDate'];
$SUPPLIER_ID = $dataHD['GRNSupplier'];
$SUPPLIER_NAME = $dataHD['supname'];


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



 		$img  = code128BarCode(str_replace(".", "", $NO_GRN), 1);
        ob_start();
        imagepng($img);
		$output_img   = ob_get_clean();
       $barcode128 ='<img class="barcode" height="50"  src="data:image/png;base64,'.base64_encode($output_img).'" />'; 

        $isi_teks = $NO_GRN;
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

@media print{
	.hilang{
		display: none;
	}
	.barang{
		font-size: small;
	}
}

.barang{
		font-size: small;
	}
</style>

<center>
	<button onclick="dataPrint()"  class="btn btn-danger hilang col col-sm-6 btn-lg" style="margin-top: 2%">print</button>
</center>
<div style="border:1px solid gray;margin: 1%;padding:1%;font-size: 18pt">
	<table class="table table-bordered">
		<tr>
	
			<td>
				<p style="font-weight: bolder;font-size: 30pt;text-align: center;">BARANG TOLAKAN</p>
				<!-- <strong><?php echo $NO_GRN ?></strong>
				/
				<strong><?php echo $NO_PO ?></strong>
 -->
			</td>
		
			<!-- <td> -->
	
				<?php //echo $barcode128 ?>
			<!-- 	<div style="float: left;">
					
			<?php   echo '<img width="50" height="50" src="'.$base64.'" />';?>
				</div> -->
			<!-- </td> -->
		</tr>
		<tr>
		<tr>
	
	
			<td>
				<p style="font-weight: bolder;font-size: 20pt;text-align: center;"><?php echo $SUPPLIER_ID; ?> - <?php echo $SUPPLIER_NAME; ?></p>
			</td>
		
		
		</tr>

	</table>
	<table class="table barang table-bordered">
		<tr style="font-weight: bold">
			<td width="220"><center>GRN - TANGGAL</center></td>
			<td width="100"><center>SKU</center></td>
			<td><center>NAMA</center></td>
			<td width="10"><center>QTY</center></td>
			<td width=""><center>Keterangan</center></td>
		</tr>

		

			<?php
			$sql="SELECT PRPODt.PONmbr, POProduct,ProdName,POUOM,convert(float,POQty) POQty FROM PRPODt INNER JOIN SMProductMs ON SMProductMs.prodcode = PRPODt.POProduct WHERE PONmbr in ($po)";

			$data = $conn->query($sql);
			$no=1;
			while ($r =  $data->fetch()) {
				# code...

				$sku = $r['POProduct'];
				$nama = $r['ProdName'];
				$uom= $r['POUOM'];
				$qty = $r['POQty'];
				$poDetail = $r['PONmbr'];

				$sqlGRN = "SELECT top 1 convert(float,RecvReturQty) RecvReturQty,PRGRNdt.GRNNmbr,convert(varchar,GRNDate,103) GRNDate,RecvReturDesc FROM PRGRNdt INNER JOIN PRGRNhd ON PRGRNhd.GRNNmbr = PRGRNdt.GRNNmbr  WHERE PONmbr='$poDetail' AND GRNProduct='$sku'";
				$dataGRN = $conn->query($sqlGRN)->fetch();

				// print_r($dataGRN);
				$tolak=$dataGRN['RecvReturQty'];
				$keterangan = $dataGRN['RecvReturDesc'];
				$tgl = $dataGRN['GRNDate'];
				$listGRN = $dataGRN['GRNNmbr'];

				if ($tolak > 0) {
					# code...
					$qtyTolak=$tolak;
				}else{
					$qtyTolak=0;
				}
			
			?>

			<tr>

				<td><?php echo $listGRN ?> - <?php echo $tgl ?> </td>
				<td><?php echo $sku ?></td>
				<td><?php echo $nama ?></td>
		
				<td>
					<input class="qty" type="" name="" value="<?php echo number_format($qtyTolak) ?>" style="border: 0px;width: 40px">
				</td>
				<td><textarea cols="1" style="border: 0px;width: 200px;height: 20px"><?php echo $keterangan ?></textarea></td>
			</tr>


			<?php $no++; } ?>


	</table>


</div>



	

	
<script type="text/javascript">
	// window.print();

	function dataPrint() {
	
	
	    $('.qty').each(function(){
		    //if statement here 
		    // use $(this) to reference the current div in the loop
		    //you can try something like...


		  if ($(this).val()==0) {

			$(this).parent().parent().hide()


		  }


		 });

		 window.print();


	}


</script>
