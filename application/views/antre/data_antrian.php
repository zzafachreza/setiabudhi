<?php

$host="localhost";
$db="ci";
$user="root";
$pass="";
$conn=new PDO("mysql:host=$host;dbname=$db",$user,$pass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



$serverName = "proint";  
  
/* Connect using Windows Authentication. */  
try  
{  
$conn2 = new PDO( "sqlsrv:server=$serverName ; Database=PROINT_ERP", "sa", "aDmInSTB4246");  
$conn2->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );  
}  
catch(Exception $e)  
{   
die( print_r( $e->getMessage() ) );   
}


function IndonesiTGL($TGL){
	$TGL = explode("-", $TGL);
	return $TGL[2]."/".$TGL[1]."/".$TGL[0];
}

date_default_timezone_set("Asia/Jakarta");

$NOW= date('Y-m-d');
?>


<div class="container-fluid">
	
		<div style="position:sticky;top:0;background:white;z-index:2">
			<center>
		<h3>ANTRIAN SUPPLIER</h3>
		<h4><?php echo date('d/m/Y')." ".date("h:i:s") ?></h4>
		<hr>
	</center>
	<table class="table table-hover table-bordered" style="font-size: small;">

			
			<tr style="text-align: center;">
				<th colspan="3" width="25%" style="background-color: #2980b9;">FRESH-01

					<a href="download?br=FRESH - 01" class="btn btn-success">DOWNLOAD EXCEL</a>

				</th>
				<th colspan="3" width="28%" style="background-color: #1abc9c;">FRESH-02
					<a href="download?br=FRESH - 02" class="btn btn-success">DOWNLOAD EXCEL</a>

				</th>
				<th colspan="3" width="25%" style="background-color: #f1c40f;">DRY-01
				<a href="download?br=DRY - 01" class="btn btn-success">DOWNLOAD EXCEL</a>
			</th>
				<th colspan="3" width="25%" style="background-color: #e74c3c;">DRY-02
				<a href="download?br=DRY - 02" class="btn btn-success">DOWNLOAD EXCEL</a>
			</th>
			</tr>
			</table>
		</div>
	



	<table class="table table-hover table-bordered" style="font-size: small;">

			
			<!-- <tr style="text-align: center;">
				<th colspan="3" style="background-color: #2980b9;">FRESH-01

					<a href="download?br=FRESH - 01" class="btn btn-success">DOWNLOAD EXCEL</a>

				</th>
				<th colspan="3" style="background-color: #1abc9c;">FRESH-02
					<a href="download?br=FRESH - 02" class="btn btn-success">DOWNLOAD EXCEL</a>

				</th>
				<th colspan="3" style="background-color: #f1c40f;">DRY-01
				<a href="download?br=DRY - 01" class="btn btn-success">DOWNLOAD EXCEL</a>
			</th>
				<th colspan="3" style="background-color: #e74c3c;">DRY-02
				<a href="download?br=DRY - 02" class="btn btn-success">DOWNLOAD EXCEL</a>
			</th>
			</tr> -->



			<tr>
				<td colspan="3" style="background-color: #2980b9">
					
					<table class="table" style="width: 100%">
						<tr>
							<th width="1%">No</th>
							<th>Supplier</th>
						</tr>
							<?php
								$no=1;
								$sql="SELECT * FROM data_antrian WHERE GROUP_PO='FRESH - 01' AND OKE=0";
								$hasil = $conn->query($sql);
								while ($r = $hasil->fetch()) {

									$NO_PO =$r['NO_PO'];
									$sqlPO="SELECT top 1 * FROM PRGrnDt WHERE PONmbr='$NO_PO'";
									 $jml = $conn2->query($sqlPO)->fetch();
									 $SUPPLIER_ID = $r['SUPPLIER_ID'];
									 $sqlRetur="SELECT top 1 * FROM PRReturHd WHERE AppSuplier='$SUPPLIER_ID' AND AppDate > '2020-07-01'";
									 $jmlRetur = $conn2->query($sqlRetur)->fetch();
									 if (isset($jmlRetur['AppNumber'])) {
									 	# code...
									 	 $retur = '<center><span style="font-size:x-small;background-color:white;padding:2px"><a href="retur/'.$SUPPLIER_ID.'">ADA RETUR</a></span></center>';
									 }else{	

									 	$retur="";
									 }	

									 if (isset($jml['PONmbr'])) {
										# code...
										$warna = 'btn btn-success';
										
										if ($r['STATUS_ANTRIAN']==='PROSES' OR $r['STATUS_ANTRIAN']==='OPEN') {
											# code...
											$conn->query("UPDATE data_antrian SET STATUS_ANTRIAN='FINISH',TANGGAL_SELESAI=NOW() WHERE NO_PO='$NO_PO'");
											$r['STATUS_ANTRIAN']='FINISH';
										}else{
											$r['STATUS_ANTRIAN']='FINISH';
										}

									}elseif ($r['STATUS_ANTRIAN']==='PROSES') {
										# code...
										$warna = 'btn btn-secondary';
									}
									elseif ($r['STATUS_ANTRIAN']==='OPEN') {
										# code...
										$warna = 'btn btn-danger';
									}

							?>
							<tr>
								<th width="1%"><?php echo $r['NO_ANTRIAN'] ?></th>
								<th>
								<?php echo $retur ?>
								<?php echo $r['NO_PO'] ?> <span style="color:yellow">(<?php echo IndonesiTGL($r['TANGGAL_ANTRIAN'])?> : <?php echo $r['JAM_ANTRI'] ?>)</span> <br/>
								(
								<?php echo $r['SUPPLIER_ID'] ?> - <?php echo $r['SUPPLIER_NAME'] ?> - <?php echo $r['SALES_ID'] ?> )<br/>

								
							
								<button data-id="<?php echo $r['ID'] ?>" data-tipe="<?php echo $r['STATUS_ANTRIAN'] ?>" class="call btn <?php echo $warna ?> btn-sm col-sm-16">( <?php echo $r['STATUS_ANTRIAN'] ?> )</button>

								<a style="float:right" onclick="return confirm('Apakah Andayakin Cancel PO ini ?')" href="hapus/<?php echo $r['ID'] ?>" class="btn btn-light btn-sm">CANCEL</a>

								</th>
							</tr>
							<?php $no++; } ?>
					</table>

				</td>
				<td colspan="3" style="background-color: #1abc9c">
					<table class="table" style="width: 100%">
						<tr>
							<th width="1%">No</th>
							<th>Supplier</th>
						</tr>
							<?php
								$no=1;
								$sql="SELECT * FROM data_antrian WHERE GROUP_PO='FRESH - 02' AND OKE=0";
								$hasil = $conn->query($sql);
								while ($r = $hasil->fetch()) {

									$NO_PO =$r['NO_PO'];
									$sqlPO="SELECT top 1 * FROM PRGrnDt WHERE PONmbr='$NO_PO'";
									 $jml = $conn2->query($sqlPO)->fetch();
									 $SUPPLIER_ID = $r['SUPPLIER_ID'];
									 $sqlRetur="SELECT top 1 * FROM PRReturHd WHERE AppSuplier='$SUPPLIER_ID' AND AppDate > '2020-07-01'";
									 $jmlRetur = $conn2->query($sqlRetur)->fetch();
									 if (isset($jmlRetur['AppNumber'])) {
									 	# code...
									 	 $retur = '<center><span style="font-size:x-small;background-color:white;padding:2px"><a href="retur/'.$SUPPLIER_ID.'">ADA RETUR</a></span></center>';
									 }else{	

									 	$retur="";
									 }	

									 if (isset($jml['PONmbr'])) {
										# code...
										$warna = 'btn btn-success';
										
										if ($r['STATUS_ANTRIAN']==='PROSES' OR $r['STATUS_ANTRIAN']==='OPEN') {
											# code...
											$conn->query("UPDATE data_antrian SET STATUS_ANTRIAN='FINISH' ,TANGGAL_SELESAI=NOW() WHERE NO_PO='$NO_PO'");
											$r['STATUS_ANTRIAN']='FINISH';
										}else{
											$r['STATUS_ANTRIAN']='FINISH';
										}

									}elseif ($r['STATUS_ANTRIAN']==='PROSES') {
										# code...
										$warna = 'btn btn-secondary';
									}
									elseif ($r['STATUS_ANTRIAN']==='OPEN') {
										# code...
										$warna = 'btn btn-danger';
									}


							

									
							?>
							<tr>
								<th width="1%"><?php echo $r['NO_ANTRIAN'] ?></th>
								<th>
								<?php echo $retur ?>
								<?php echo $r['NO_PO'] ?> <span style="color:yellow">(<?php echo IndonesiTGL($r['TANGGAL_ANTRIAN'])?> : <?php echo $r['JAM_ANTRI'] ?>)</span><br/>
								(
								<?php echo $r['SUPPLIER_ID'] ?> - <?php echo $r['SUPPLIER_NAME'] ?> - <?php echo $r['SALES_ID'] ?> )<br/>
								
								<button data-id="<?php echo $r['ID'] ?>" data-tipe="<?php echo $r['STATUS_ANTRIAN'] ?>" class="call btn <?php echo $warna ?> btn-sm col-sm-6">( <?php echo $r['STATUS_ANTRIAN'] ?> )</button>

								<a style="float:right" onclick="return confirm('Apakah Andayakin Cancel PO ini ?')" href="hapus/<?php echo $r['ID'] ?>" class="btn btn-light btn-sm">CANCEL</a>

								</th>
							</tr>
							<?php $no++; } ?>
					</table>

				</td>
				<td colspan="3" style="background-color: orange">
					<table class="table" style="width: 100%">
						<tr>
							<th width="1%">No</th>
							<th>Supplier</th>
						</tr>
							<?php
								$no=1;
								$sql="SELECT * FROM data_antrian WHERE GROUP_PO='DRY - 01' AND OKE=0";
								$hasil = $conn->query($sql);
								while ($r = $hasil->fetch()) {

									$NO_PO =$r['NO_PO'];
									

									$sqlPO="SELECT top 1 * FROM PRGrnDt WHERE PONmbr='$NO_PO'";
									 $jml = $conn2->query($sqlPO)->fetch();

									 $SUPPLIER_ID = $r['SUPPLIER_ID'];

									 $sqlRetur="SELECT top 1 AppNumber FROM PRReturHd WHERE AppSuplier='$SUPPLIER_ID' AND AppDate > '2020-07-01'";
									 $jmlRetur = $conn2->query($sqlRetur)->fetch();

									 if (isset($jmlRetur['AppNumber'])) {
									 	# code...
									 $retur = '<center><span style="font-size:x-small;background-color:white;padding:2px"><a href="retur/'.$SUPPLIER_ID.'">ADA RETUR</a></span></center>';
									 }else{	

									 	$retur="";
									 }	

									 if (isset($jml['PONmbr'])) {
										# code...
										$warna = 'btn btn-success';
										
										if ($r['STATUS_ANTRIAN']==='PROSES' OR $r['STATUS_ANTRIAN']==='OPEN' ) {
											# code...
											$conn->query("UPDATE data_antrian SET STATUS_ANTRIAN='FINISH',TANGGAL_SELESAI=NOW() WHERE NO_PO='$NO_PO'");
											$r['STATUS_ANTRIAN']='FINISH';
										}else{
											$r['STATUS_ANTRIAN']='FINISH';
										}

									}elseif ($r['STATUS_ANTRIAN']==='PROSES') {
										# code...
										$warna = 'btn btn-secondary';
									}
									elseif ($r['STATUS_ANTRIAN']==='OPEN') {
										# code...
										$warna = 'btn btn-danger';
									}


									
									

							?>
							<tr>
								<th width="1%"><?php echo $r['NO_ANTRIAN'] ?></th>
								<th>
								<?php echo $retur ?>
								<?php echo $r['NO_PO'] ?> <span style="color:yellow">(<?php echo IndonesiTGL($r['TANGGAL_ANTRIAN'])?> : <?php echo $r['JAM_ANTRI'] ?>)</span><br/>
								(
								<?php echo $r['SUPPLIER_ID'] ?> - <?php echo $r['SUPPLIER_NAME'] ?> - <?php echo $r['SALES_ID'] ?> )<br/>
								
								<button data-id="<?php echo $r['ID'] ?>" data-tipe="<?php echo $r['STATUS_ANTRIAN'] ?>" class="call btn <?php echo $warna ?> btn-sm col-sm-16">( <?php echo $r['STATUS_ANTRIAN'] ?> )</button>

								<a style="float:right" onclick="return confirm('Apakah Andayakin Cancel PO ini ?')" href="hapus/<?php echo $r['ID'] ?>" class="btn btn-light btn-sm">CANCEL</a>
								</th>
							</tr>
							<?php $no++; } ?>
					</table>

				</td>
				<td colspan="3" style="background-color: #e74c3c">
					<table class="table" style="width: 100%">
						<tr>
							<th width="1%">No</th>
							<th>Supplier</th>
						</tr>
							<?php
								$no=1;
								$sql="SELECT * FROM data_antrian WHERE GROUP_PO='DRY - 02' AND OKE=0";
								$hasil = $conn->query($sql);
								while ($r = $hasil->fetch()) {

									$NO_PO =$r['NO_PO'];
									$sqlPO="SELECT top 1 * FROM PRGrnDt WHERE PONmbr='$NO_PO'";
									 $jml = $conn2->query($sqlPO)->fetch();
									 $SUPPLIER_ID = $r['SUPPLIER_ID'];
									 $sqlRetur="SELECT top 1 * FROM PRReturHd WHERE AppSuplier='$SUPPLIER_ID' AND AppDate > '2020-07-01'";
									 $jmlRetur = $conn2->query($sqlRetur)->fetch();
									 if (isset($jmlRetur['AppNumber'])) {
									 	# code...
									 $retur = '<center><span style="font-size:x-small;background-color:white;padding:2px"><a href="retur/'.$SUPPLIER_ID.'">ADA RETUR</a></span></center>';
									 }else{	

									 	$retur="";
									 }	

									 if (isset($jml['PONmbr'])) {
										# code...
										$warna = 'btn btn-success';

										

										if ($r['STATUS_ANTRIAN']==='PROSES' OR $r['STATUS_ANTRIAN']==='OPEN') {
											# code...
											$conn->query("UPDATE data_antrian SET STATUS_ANTRIAN='FINISH',TANGGAL_SELESAI=NOW() WHERE NO_PO='$NO_PO'");
											$r['STATUS_ANTRIAN']='FINISH';
										}else{
											$r['STATUS_ANTRIAN']='FINISH';
										}

									}elseif ($r['STATUS_ANTRIAN']==='PROSES') {
										# code...
										$warna = 'btn btn-secondary';
									}
									elseif ($r['STATUS_ANTRIAN']==='OPEN') {
										# code...
										$warna = 'btn btn-danger';
									}


							?>
							<tr>
								<th width="1%"><?php echo $r['NO_ANTRIAN'] ?></th>
								<th>
								<?php echo $retur ?>
								<?php echo $r['NO_PO'] ?> <span style="color:yellow">(<?php echo IndonesiTGL($r['TANGGAL_ANTRIAN'])?> : <?php echo $r['JAM_ANTRI'] ?>)</span><br/>
								(
								<?php echo $r['SUPPLIER_ID'] ?> - <?php echo $r['SUPPLIER_NAME'] ?> - <?php echo $r['SALES_ID'] ?> )<br/>
								
								<button data-id="<?php echo $r['ID'] ?>" data-tipe="<?php echo $r['STATUS_ANTRIAN'] ?>" class="call btn <?php echo $warna ?> btn-sm col-sm-6">( <?php echo $r['STATUS_ANTRIAN'] ?> ) </button>

								<a style="float:right" onclick="return confirm('Apakah Andayakin Cancel PO ini ?')" href="hapus/<?php echo $r['ID'] ?>" class="btn btn-light btn-sm">CANCEL</a>

								</th>
							</tr>
							<?php $no++; } ?>
					</table>

				</td>
			</tr>


	</table>
</div>

<script type="text/javascript">
	$(".call").click(function(e){
		e.preventDefault();



		var ID  = $(this).attr("data-id");

		var STATUS_ANTRIAN  = $(this).attr("data-tipe");

		if (STATUS_ANTRIAN==='OPEN') {
			// alert('open YA')

				ambil_suara(ID,STATUS_ANTRIAN);
		
			
					$.ajax({
						url:'update_status',
						data:{
							ID:ID,
							STATUS_ANTRIAN:STATUS_ANTRIAN
						},
						type:'POST',
						success:function(data){
							getAntrian();
						}
					})
			
		}else{
			ambil_suara(ID,STATUS_ANTRIAN);
		}





		
	})
</script>