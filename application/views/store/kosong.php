
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


?>
<div class="container-fluid">


<center>
	<a href="kosong_add?kode=<?php echo date('ymdHis') ?>" class="btn btn-primary">TAMBAH BARANG KOSONG</a>
	<hr/>


<form action="kosong_cari">
	<div class="input-group mb-3">
  <input type="text" class="form-control" name="key" placeholder="masukan sku atau nama barang" aria-label="Recipient's username" aria-describedby="basic-addon2">
  <div class="input-group-append">
    <button class="btn btn-danger" type="submit">Search</button>
  </div>
</div>
</form>


</center>

	<table class="table tabza2">
		<thead>
			<tr>
			<th>NO</th>
			<th>KODE</th>
			<th>TANGGAL</th>
			<th>DIVISI</th>
			<th>STATUS</th>
			<th></th>
		</tr>
		</thead>
		<tbody>
			<?php

			$no=1;
				$sql="SELECT * FROM data_kosong GROUP BY kode ORDER BY kode DESC";

				// die();
				$hasil = $connMy->query($sql);

				while ($r = $hasil->fetch()) {

				
			?>

			<tr>
				<td><?php echo $no; ?></td>
				 <td><?php echo $r['kode']; ?></td>
					<td><?php echo tglIndonesia($r['tgl']); ?></td>
					<td><?php echo $r['member']; ?></td>
					<td><?php echo $r['st']; ?></td>
					<td>
						<a href="kosong_detail?id=<?php echo $r['kode']; ?>&member=<?php echo $r['member']; ?>" class="btn btn-success">LIHAT</a>
						<a href="kosong_edit?kode=<?php echo $r['kode']; ?>&member=<?php echo $r['member']; ?>&tgl=<?php echo $r['tgl']; ?>" class="btn btn-primary">EDIT</a>

						<a href="kosong_hapus_all?kode=<?php echo $r['kode']; ?>&member=<?php echo $r['member']; ?>" class="btn btn-danger">HAPUS</a>


							<a href="kosong_status?kode=<?php echo $r['kode']; ?>&member=<?php echo $r['member']; ?>&tgl=<?php echo $r['tgl']; ?>" class="btn btn-warning">EDIT STATUS</a>


					</td>

			</tr>



			<?php

			$no++;		
					}

			?>
		</tbody>
	</table>
</div>

<script type="text/javascript">
	$(".tabza2").dataTable({
		searching:false,
		// paging:false
	});
</script>