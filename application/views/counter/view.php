<?php

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

	   echo $sql="select invcNmbr,convert(varchar, InvcDate, 103) tanggal,InvcGroupDesc bisnis_unit,InvcCusIdDesc customer,V_SLSBInvcProduct.prodcode sku,V_SLSBInvcProduct.Prodname nama,
		InvcUOM UOM,convert(float,PercKonsinyasi) komisi,supid,supname,convert(float,InvcQty) qty,convert(float,InvcPrice) Harga,
		convert(float,InvcQtyPrice) QtyKaliHarga,convert(float,Discount) Discount,
		convert(float,InvcNetto) Total,convert(float,InvcNet) NettoAtauDpp,convert(float,InvcPPN) PPN
		from V_SLSBInvcProduct inner join  V_SMProductMsSuper on V_SMProductMsSuper.prodcode = V_SLSBInvcProduct.prodcode
		where InvcDate Between '$awal' and '$akhir' AND PercKonsinyasi > 0 and supid='$supid'";

		// $data = $conn->query($sql);

		// $hasil = $data->fetch();
	}

?>
<div class="container">
	<hr/>
	<form method="POST" action="./home/download">
		<div class="row">
			<div class="col col-sm-6">
				<h2>Tarik Penjualan Counter</h2>
				<img src="./assets/images/counter.svg" width="250">
			</div>
			<div class="col col-sm-6" style="margin-bottom: 10%">

				<div class="from-group">
					<label>Please Select Supplier</label>
					<select class="form-control selectza" name="supid">
						<option></option>
						<?php
							$sqlSupplier ="SELECT supid,supname FROM SMSupplierMs";
							$dataSupplier = $conn->query($sqlSupplier);

							while ($rSupplier = $dataSupplier->fetch()) {
								# code...
							
						?>


							<option value="<?php echo $rSupplier['supid'] ?>"><?php echo $rSupplier['supid'] ?> - <?php echo $rSupplier['supname'] ?></option>
						<?php
							}
						?>
					</select>
				</div>
			</div>

		<div class="col col-sm-6">
			<div class="from-group">
				<label>From</label>
				<input type="text" name="awal" class="AppInput tgl" autocomplete="off">
			</div>
		</div>
		<div class="col col-sm-6">
			<div class="from-group">
				<label>to</label>
				<input type="text" name="akhir" class="AppInput tgl" autocomplete="off">
			</div>
		</div>
		<div class="col col-sm-12" style="margin-top: 10%">
			<center>
				<button class="btn btn-warning">Download Excel</button>
			</center>
		</div>
	</div>
	</form>
</div>