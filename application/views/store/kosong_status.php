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
	
	<center><h3>Edit Status</h3></center>

	<hr/>

<form method="POST" action="kosong_update_status">
	<a href="kosong" class="btn btn-secondary col-sm-3">Kembali</a>
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
		<input readonly="readonly" autofocus="autofocus" type="text" id="member" name="member" class="form-control" value="<?php echo !empty($_GET['member'])?$_GET['member']:'' ?>">
	</div>
	<div class="form-group">
		<label>
			Tanggal
		</label>
		<input readonly="readonly" type="text" id="tgl" name="tgl" class="form-control tgl2" value="<?php echo !empty($_GET['tgl'])?$_GET['tgl']:'' ?>">
	</div>
	<div class="form-group">
		<label>
			Status
		</label>
		<select class="form-control" name="st">
			<option>OPEN</option>
			<option>DISETUJUI</option>
		</select>
	</div>
</form>
	<div class="row">
		<div class="col col-sm-4">
			
		</div>
	</div>



</div>