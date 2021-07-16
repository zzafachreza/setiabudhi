<?php

$host="localhost";
$db="ci";
$user="root";
$pass="";
$conn=new PDO("mysql:host=$host;dbname=$db",$user,$pass);

function IndonesiTGL($TGL){
	$TGL = explode("-", $TGL);
	return $TGL[2]."/".$TGL[1]."/".$TGL[0];
}


?>

<div class="container-fluid">
	<center>
		<h3>Product Expired</h3>
		<a href="exp_add" class="btn btn-warning">TAMBAH</a>
	</center>
	<hr/>


	<table class="table table-bordered table-hovertable-striped tabza" >
		<thead>
			<tr>
			<th>NO</th>
			<th>TANGGAL_DATANG</th>
			<th>SUPPLIER</th>
			<th>SKU</th>
			<th>JUMLAH</th>
			<th>CHECKER</th>
			<th>PURCHASING</th>
			<th>TANGGAL_EXPIRED</th>
		</tr>
		</thead>
		<tbody>
			<?php
			$no=1;
			$sql="SELECT * FROM data_exp";
			$hasil= $conn->query($sql);
				while ($r = $hasil->fetch()) {
					# code...
				
			?>

					<tr onClick="hapus('HAPUS<?php echo $r['ID'] ?>')">
						<td><?php echo $no ?></td>
						<td><?php echo IndonesiTGL($r['TANGGAL_DATANG'] )?></td>
						<td><?php echo $r['SUPPLIER'] ?></td>
						<td><?php echo $r['PRODUCT'] ?></td>
						<td><?php echo $r['JUMLAH'] ?></td>
						<td><?php echo $r['CHECKER'] ?></td>
						<td><?php echo $r['PURCHASING'] ?></td>
						<td><?php echo IndonesiTGL($r['TANGGAL_EXPIRED']) ?> 
						<a onClick="retrun confirm('Apakah Anda yakin akan hapus ini ?')" href="hapus_exp/<?php echo $r['ID'] ?>" class="btn btn-danger btn-sm" id="HAPUS<?php echo $r['ID'] ?>" style="display:none">HAPUS</a></td>
					</tr>


			<?php $no++;} ?>

		</tbody>
	</table>
</div>

<script type="text/javascript">

		function hapus(x){
			$("#"+x).fadeToggle();
		}
	
</script>