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


$NOW = date('Y-m-d');




?>

<div class="container-fluid">
	<center>

		<h3>PRINT POP</h3><p>Silhakan Pilih Kode Promo Nya ya..</p>
			<table class="table table-bordered text-center">
				<tr>
					<th>DISCOUNT %</th>
					<th>DISC AMOUNT	</th>
					<th>NAME TAG FLOOR	</th>
				</tr>
				<tr>
					<td>
						<a href="?tipe=DISC" class="btn btn-success btn-lg col-sm-12">PERCENTED % ( REG )</a>
						<hr/>
						<a href="?tipe=DISC_A5_POT" class="btn btn-info btn-sm col-sm-5">PERCENTED % ( A5 - POTRAIT )</a>
						<a href="?tipe=DISC_A5_LAND" class="btn btn-info btn-sm col-sm-5">PERCENTED % ( A5 - LANDS )</a>
						<hr/>
						<a href="?tipe=DISC_A4_POT" class="btn btn-danger btn-sm col-sm-5">PERCENTED % ( A4 - POTRAIT )</a>
						<a href="?tipe=DISC_A4_LAN" class="btn btn-danger btn-sm col-sm-5">PERCENTED % ( A4 - LANDS)</a>
						<hr/>
						<a href="?tipe=DISC" class="btn btn-success btn-lg col-sm-12">HL PERCENTED % ( REG )</a>
					</td>
					<td>
						<a href="?tipe=AMT" class="btn btn-success btn-lg col-sm-12">AMOUNT Rp ( REG )</a>
						<hr/>
						<a href="?tipe=AMT_A5_POT" class="btn btn-info btn-sm col-sm-6">AMOUNT Rp ( A5 - POTRAIT )</a>
						<a href="?tipe=AMT_A5_LAND" class="btn btn-info btn-sm col-sm-5">AMOUNT Rp ( A5 - LANDS )</a>
						<hr/>
						<a href="?tipe=AMT_A4_POT" class="btn btn-danger btn-sm col-sm-5">AMOUNT Rp ( A4 - POTRAIT )</a>
						<a href="?tipe=AMT_A4_LAN" class="btn btn-danger btn-sm col-sm-5">AMOUNT Rp ( A4 - LANDS)</a>
					</td>
						<td>
						<a href="?tipe=TAG" class="btn btn-success btn-lg col-sm-12">NANE TAG ( REG )</a>
						<hr/>
						<a href="?tipe=TAG_A5_POT" class="btn btn-info btn-sm col-sm-6">NANE TAG ( A5 - POTRAIT )</a>
						<a href="?tipe=TAG_A5_LAND" class="btn btn-info btn-sm col-sm-5">NANE TAG ( A5 - LANDS )</a>
						<hr/>
						<a href="?tipe=TAG_A4_POT" class="btn btn-danger btn-sm col-sm-5">NANE TAG ( A4 - POTRAIT )</a>
						<a href="?tipe=TAG_A4_LAN" class="btn btn-danger btn-sm col-sm-5">NANE TAG ( A4 - LANDS)</a>
					</td>
				</tr>
			</table>

	</center>



	<?php if (!empty($_GET['tipe'])): ?>

		<center>
			<h1><?php

				$tipe = $_GET['tipe'];

				if ($tipe==="DISC") {
					# code...

					echo "PROMO DISCOUNT %";

					$action ="store/print_pop";
					 $t="01";
				}else if($tipe==="DISC_A5_POT") {
					# code...

					echo "DISCOUNT % UKURAN A5 UKURAN POTRAIT";
					$action ="store/disc_print_a5_pot";
					 $t="01";
				}
				else if($tipe==="DISC_A5_LAND") {
					# code...

					echo "DISCOUNT % UKURAN A5 UKURAN LANDSCAPE";
					$action ="store/disc_print_a5_lan";
					 $t="01";
				}

				else if($tipe==="DISC_A4_POT") {
					# code...

					echo "DISCOUNT % UKURAN A4 POTRAIT";
					$action ="store/disc_print_a4_pot";
					 $t="01";
				}else if($tipe==="DISC_A4_LAN") {
					# code...

					echo "DISCOUNT % UKURAN A4 LANDSCAPE";
					$action ="store/disc_print_a4_lan";
					 $t="01";
				}


				else if($tipe==="AMT") {
					# code...

					echo "PROMO AMOUNT Rp";
					$action ="store/disc_print_pop2";
					 $t="04";
				}else if($tipe==="AMT_A5_POT") {
					# code...

					echo "PROMO AMOUNT Rp UKURAN A5 UKURAN POTRAIT";
					$action ="store/disc_print_a5_pot2";
					 $t="04";
				}
				else if($tipe==="AMT_A5_LAND") {
					# code...

					echo "PROMO AMOUNT Rp UKURAN A5 UKURAN LANDSCAPE";
					$action ="store/disc_print_a5_lan2";
					 $t="04";
				}

				else if($tipe==="AMT_A4_POT") {
					# code...

					echo "PROMO AMOUNT Rp UKURAN A4 POTRAIT";
					$action ="store/disc_print_a4_pot2";
					 $t="04";
				}else if($tipe==="AMT_A4_LAN") {
					# code...

					echo "PROMO AMOUNT Rp UKURAN A4 LANDSCAPE";
					$action ="store/disc_print_a4_lan2";
					 $t="04";
				}

				else if($tipe==="TAG") {
					# code...

					echo "NAME TAG";
					$action ="store/print_pop3";
					 $t="77";
				}else if($tipe==="TAG_A5_POT") {
					# code...

					echo "NAME TAG UKURAN A5 UKURAN POTRAIT";
					$action ="store/disc_print_a5_pot3";
					 $t="77";
				}
				else if($tipe==="TAG_A5_LAND") {
					# code...

					echo "NAME TAG UKURAN A5 UKURAN LANDSCAPE";
					$action ="store/disc_print_a5_lan3";
					 $t="77";
				}

				else if($tipe==="TAG_A4_POT") {
					# code...

					echo "NAME TAG UKURAN A4 POTRAIT";
					$action ="store/disc_print_a4_pot3";
					 $t="77";
				}else if($tipe==="TAG_A4_LAN") {
					# code...

					echo "NAME TAG UKURAN A4 LANDSCAPE";
					$action ="store/disc_print_a4_lan3";
					 $t="77";
				}


				else{
					die();
				}

			?></h1>
		</center>

	


		<?php

			if ($t=="77") {
				# code...
			

		?>



			
		
				<form action="<?php echo $action ?>" method="POST">
					<div class="form-group">
							<input type="text" id="sku" placeholder="serach sku or name" class="form-control" autofocus="autofocus">
						<div class="form-group">
							<div class="form-group" id="dataSKU" style="height: 200px;overflow: auto;">
							</div>
						<div class="form-group">
						<input type="text" name="sku" id="skulist" class="form-control">
						<div class="form-group">
						<button class="btn btn-warning col col-sm-12 btn-lg">Generate POP</button>
					</div>
				</form>

					




		<?php

			}else{



		?>



				<form action="<?php echo $action ?>" method="POST">
					<div class="form-group">
							<select class="form-control selectza" name="PromoCode">
			<option></option>
			<?php  

			$sql ="SELECT PromoCode,PromoName,PromoType,convert(varchar, StartDate, 103) StartDate,StartTime,convert(varchar, Enddate, 103) Enddate,EndTime 
				FROM SLPromoHd WHERE Enddate >= '$NOW' AND PromoType='$t' AND fgCriteria='01'";
				$hasil = $conn->query($sql);


					while ($data = $hasil->fetch()) {
						# code...
					
			?>
				<option value="<?php echo $data['PromoCode'] ?>" ><?php echo $data['PromoCode'] ?> - <?php echo $data['PromoName'] ?></option>

			<?php } ?>
		</select>
						</div>
						<div class="form-group">
						<button class="btn btn-warning col col-sm-12 btn-lg">Generate POP</button>
					</div>
				</form>

	



		<?php } ?>






	</div>


	<?php endif ?>
</div>


<script type="text/javascript">
	$("#sku").keyup(function(e){
		e.preventDefault();

		var id = $(this).val();

		$.ajax({
			url:"store/getSKU",
			type:'GET',
			data:{
				id:id
			},
			success:function(data){
				$("#dataSKU").html(data);

				$(".ambil").click(function(e){
					e.preventDefault();
					var sku = $(this).attr('data-sku');
					var skue = $("#skulist").val();

					$("#skulist").val(skue + sku);
				})
			}
		});
	})
</script>