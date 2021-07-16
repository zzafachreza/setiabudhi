<?php

die();
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

	<form id="dataForm">
		<table class="table col-sm-12">
		<tr>
			<td>
				<div class="form-group">
					<label>Payment Date From</label>
					<input type="text" name="awal" id="awal" class="tgl form-control" value="<?php echo date('d/m/Y') ?>">
				</div>
			</td>
			<td>
				<div class="form-group">
					<label>to</label>
					<input type="text" name="akhir" id="akhir" class="tgl form-control" value="<?php echo date('d/m/Y') ?>">
				</div>
			</td>
			<td>
				<div class="form-group">
					<label>&nbsp;</label><br/>
					<button type="SUBMIT" class="btn btn-primary"><i class="flaticon-search"></i> SEARACH</button>
				</div>
			</td>
		</tr>
	</table>
	</form>

	<?php if (!empty($_GET['awal']) && !empty($_GET['akhir'])): ?>
			<form method="POST" action="./csv">
		<div class="row">
			<div class="col col-sm-12" style="margin-bottom: 10%">

				<div class="from-group">
					<label>Please Select Type Payment</label>
					<select class="form-control selectza" name="pay">
						<option></option>
						<?php

						$awal = tglSql($_GET['awal']);

						$akhir = tglSql($_GET['akhir']);
							$sqlData ="SELECT PmtNmbr,PmtDate,convert(varchar,PmtDueDate,103) PmtDueDate,NotePad,NotePadType FROM CMTTTPmt WHERE PmtDate BETWEEN '$awal' AND '$akhir' AND NotePad is not null ";
							$dataR = $conn->query($sqlData);

							while ($r = $dataR->fetch()) {
								# code...
							
						?>


							<option value="<?php echo $r['PmtNmbr'] ?>ABUHANIF<?php echo $r['NotePad'] ?>ABUHANIF<?php echo $r['NotePadType'] ?>ABUHANIF<?php echo $r['PmtDueDate'] ?>"><?php echo $r['PmtNmbr'] ?> - <?php echo $r['NotePad'] ?></option>
						<?php
							}
						?>
					</select>
				</div>
			</div>
			<div class="col col-sm-12" style="margin-top: 0%">
			<center>
				<button class="btn btn-success btn-lg col-sm-12">CEK CSV</button>
			</center>
		</div>
	</div>

		
	</div>
	</form>
	<?php endif ?>
</div>