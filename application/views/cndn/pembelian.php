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
	     $CNDNtype = $_POST['CNDNtype'];

	   echo $sql="select APCNDNhd.CNDNNmbr,CNDNtype,convert(varchar, CNDNDate, 103) as tanggal_cndn ,CNDNSuplier,supname,CNDNDesc,APCNDNdt.GRNNmbr,PRReturHd.fgcndn,
convert(float,cnhcamount) kredit, convert(float,dnhcamount) debit,CMTTTDt.TTTNmbr nomor_kontrabon,convert(varchar,TTTDate,103) tanggal_kontrabon,PRReturHd.AppNumber no_retur,convert(varchar,AppDate,103)  tanggal_retur,AppDesc keterangan_retur
from (((
(APCNDNdt inner join APCNDNhd  on APCNDNhd.CNDNNmbr = APCNDNdt.CNDNNmbr) 
inner join SmSupplierMS on APCNDNhd.CNDNSuplier = SmSupplierMS.supid) inner join CMTTTDt on CMTTTDt.GRNNmbr = APCNDNdt.GRNNmbr)
inner join CMTTTHd on CMTTTDt.TTTNmbr = CMTTTHd.TTTNmbr) inner join PRReturHd on PRReturHd.CNDNNmbr = APCNDNhd.CNDNNmbr
where APCNDNhd.CNDNDate between '$awal' and '$akhir' AND CNDNtype='$CNDNtype' order by APCNDNhd.CNDNNmbr ASC";

		// $data = $conn->query($sql);

		// $hasil = $data->fetch();
	}

?>
<div class="container">
	<hr/>
	<form method="POST" action="downloadpembelian">

		<center><h2>Analisa Pembelian</h2></center>
		<div class="row">

			
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
				<button class="btn btn-info">Download Excel Pembelian</button>
			</center>
		</div>
	</div>
	</form>
</div>