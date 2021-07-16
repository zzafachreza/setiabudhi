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

$host="localhost";
$db="ci";
$user="root";
$pass="";
$connMy=new PDO("mysql:host=$host;dbname=$db",$user,$pass);



?>

<div class="container">
	
	<center><h3>Edit Data Barang Kosong</h3></center>

	<hr/>

<form method="POST" action="kosong_update">
	<a href="kosong_prch" class="btn btn-secondary col-sm-3">Kembali</a>
<button type="SUBMIT" class="btn btn-success col-sm-3">Simpan</button>
		<div class="form-group">
		<label>
			KDOE
		</label>
		<input readonly="readonly" name="kode" class="form-control" value="<?php echo $_GET['kode'] ?>">
	</div>

	<div class="form-group">
		<label>
			Member/Pembuat/divisi
		</label>
		<input autofocus="autofocus" type="text" id="member" name="member" class="form-control" value="<?php echo !empty($_GET['member'])?$_GET['member']:'' ?>">
	</div>
	<div class="form-group">
		<label>
			Tanggal
		</label>
		<input type="text" id="tgl" name="tgl" class="form-control tgl2" value="<?php echo !empty($_GET['tgl'])?$_GET['tgl']:'' ?>">
	</div>
</form>
	<div class="row">
		<div class="col col-sm-4">
			<input type="text" id="sku" class="form-control" placeholder="seacrh sku or product name" autocomplete="off">
		</div>
	</div>

	
		<div id="dataSKU" class="row" style="margin-top: 10px;">
			
		</div>


</div>


<script type="text/javascript">

	getData();


	function getData(){

		$.ajax({
			url:'kosong_list2?kode=<?php echo $_GET['kode'] ?>',
			success:function(data){
				$("#dataSKU").html(data);
			}
		})
		

	}


	var member = $("#member").val();
	var tgl = $("#tgl").val();


					$("#sku").show().focus();


					$("#sku").change(function(e){
						e.preventDefault();
						var sku = $(this).val();

						$("#loader").show();

						$.ajax({
							url:'kosong_get',
							type:'GET',
							data:{
								kode: '<?php echo $_GET['kode'] ?>',
								member:$("#member").val(),
								tgl:$("#tgl").val(),
								sku:sku
							},
							success:function(data){
								$("#dataSKU").html(data);
								$("#qty").focus();
									$("#loader").hide();

								$("#dataForm").submit(function(e){
										e.preventDefault();

										var data = $("#dataForm").serialize();

										$.ajax({
											url:'kosong_save',
											data:data,
											type:'POST',
											success:function(data2){
												console.log(data2);
													getData();
												$("#sku").val("").focus();

											}
										})
									})
							}
						})

						
					})






</script>