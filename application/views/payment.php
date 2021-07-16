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


<div class="container-fluid">
	<form id="dataForm">
		<table class="table col-sm-5">
		<tr>
			<td>
				<div class="form-group">
					<label>Payment Date</label>
					<input type="text" name="awal" id="awal" class="tgl form-control" value="<?php echo date('d/m/Y') ?>">
				</div>
			</td>
			<td>
				<div class="form-group">
					<label>Due Date</label>
					<input type="text" name="akhir" id="akhir" class="tgl form-control" value="<?php echo date('d/m/Y') ?>">
				</div>
			</td>
			<td>
				<div class="form-group">
					<label>&nbsp;</label><br/>
					<button type="SUBMIT" class="btn btn-primary"><i class="flaticon-search"></i> SEARCH</button>
				</div>
			</td>
		</tr>
	</table>
	</form>
	<hr/>
	<div id="dataKontra">
		
	</div>
</div>


<script type="text/javascript">
	$("#dataForm").submit(function(e){
		e.preventDefault();

		var data = $(this).serialize();

		// console.log(data);

		$("#loader").show();

		$.ajax({
			url:'payment/getKontra',
			data:data,
			type:'POST',
			success:function(html){
				// console.log(html)
				$("#dataKontra").html(html);
				$("#loader").fadeOut('fast');
			}
		})
	})
</script>