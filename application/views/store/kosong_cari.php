
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



 $key = $_GET['key'];


?>
<div class="container">


<center><h2>KATA KUNCI : <?php echo $key ?></h2></center>


</center>

	<table class="table tabza2">
		<thead>
			<tr>
			<th>NO</th>
			<th>KODE</th>
			<th>TANGGAL</th>
			<th>DIVISI</th>
			<th>SKU</th>
			<th>NAMA</th>
			<th>PO</th>
			<th>Keterangan</th>
			<th></th>
		</tr>
		</thead>
		<tbody>
			<?php

			$no=1;
				$sql="SELECT * FROM data_kosong WHERE sku like '%$key%' OR nama like '%$key%'";

				// die();
				$hasil = $connMy->query($sql);

				// print_r($hasil->fetch());

				while ($r = $hasil->fetch()) {

				
			?>

			<tr>
				<td><?php echo $no; ?></td>
				 <td><?php echo $r['kode']; ?></td>
					<td><?php echo tglIndonesia($r['tgl']); ?></td>
					<td><?php echo $r['member']; ?></td>
					<td><?php echo $r['sku']; ?></td>
					<td><?php echo $r['nama']; ?></td>
							<td><?php echo $r['po']; ?></td>
							<td><?php echo $r['keterangan']; ?></td>
					<td>
						<a href="kosong_detail?id=<?php echo $r['kode']; ?>&member=<?php echo $r['member']; ?>&sku=<?php echo $r['sku']; ?>" class="btn btn-success">LIHAT</a>




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
		// searching:false,
		// paging:false
	});
</script>