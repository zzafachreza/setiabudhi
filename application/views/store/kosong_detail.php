<?php
error_reporting(0);

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



$kode = $_GET['id'];



$sqlhd="SELECT * FROM data_kosong WHERE kode='$kode' GROUP BY kode";

				// die();
				$hasilhd = $connMy->query($sqlhd);

				$hd = $hasilhd->fetch();

				// print_r($hd);


?><div class="container">

<center>

</center>
<a href="kosong" class="btn btn-secondary col-sm-3">Kembali</a>
	<a href="kosong_print?id=<?php echo $kode ?>" class="btn btn-danger" style="margin:10px;width: 200px;">PRINT</a>
	
	<table class="table table-bordered">
		<thead>
			<tr>
			<th>KODE</th>
			<td><?php echo $hd['kode']; ?></td>
			</tr>
			<tr>
			
			<th>TANGGAL</th>
			<td><?php echo tglIndonesia($hd['tgl']); ?></td>
				
			</tr>
			<tr>
			<th>MEMBER</th>
			<td><?php echo $hd['member']; ?></td>
		</tr>
	</table> 

		<fieldset>
			<label>Detail</label>
			<hr/>
		<table class="table table-hover table-bordered" >
		<thead>
			<tr>
			<th>NO</th>
			<th>SKU</th>
			<th>PRODUCT</th>
			<th>STOK TOKO</th>
			<th>STOK GUDANG</th>
			<th>LAST PO</th>
<!-- 			<th>Keterangan</th>
			<th>Paraf</th> -->

		</tr>
		</thead>
		<tbody>
			<?php

			$no=1;
				$sql="SELECT * FROM data_kosong WHERE kode='$kode'";

				// die();
				$hasil = $connMy->query($sql);

				while ($r = $hasil->fetch()) {

					if($_GET['sku']===$r['sku']){

						$style = 'style="background-color:orange"';
					}else{
						$style='';
					}

				
			?>

			<tr <?php echo $style ?>>
				<td><?php echo $no; ?></td>
					<td><?php echo $r['sku']; ?></td>
					<td><?php echo $r['nama']; ?></td>
					<td><?php echo $r['qty_toko']; ?></td>
					<td><?php echo $r['qty_gudang']; ?></td>
					<td><?php echo $r['po']; ?></td>
					<!-- <td><?php echo $r['keterangan']; ?></td>
					<td></td> -->
	

			</tr>



			<?php

			$no++;		
					}

			?>
		</tbody>
	</table>
		</fieldset>
</div>