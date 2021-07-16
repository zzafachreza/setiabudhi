<?php

$host="localhost";
$db="ci";
$user="root";
$pass="";
$MyConn=new PDO("mysql:host=$host;dbname=$db",$user,$pass);



function IndonesiTGL($TGL){
	$TGL = explode("-", $TGL);
	return $TGL[2]."/".$TGL[1]."/".$TGL[0];
}


?>

<div class="container-fluid">
	<center>
		<h3>Serah Terima Retur</h3>
		<a href="serah_add" class="btn btn-primary col-sm-5"><i class="flaticon flaticon-plus"></i> TAMBAH</a>
	</center>
	<hr/>


	<form>
		<input style="margin-bottom: 1%;border:1px solid #0d6efd;" type="text" name="cari" class="form-control col-sm-6" placeholder="Pencarian nomor Retur dan Supplier" autocomplete="off">
	</form>
	<table class="table table-bordered table-hovertable-striped" >
		<thead>
			<tr>
			<th>NO</th>
			<th>NO_RETUR</th>
			<th>TANGAL</th>
			<th>SUPPLIER</th>
			<th>PENGAMBIL</th>
			<th></th>
		</tr>
		</thead>
		<tbody>
			<?php
			$no=1;
			
			if (!empty($_GET['cari'])) {
				# code...
				$cari = $_GET['cari'];
				$sql="SELECT * FROM serah WHERE no_retur like '%$cari$%' OR nama_supplier like '%$cari%' ORDER BY tgl DESC LIMIT 100";
			}else{
				$sql="SELECT * FROM serah ORDER BY tgl DESC LIMIT 10";
			}

			$hasil= $MyConn->query($sql);

			// print_r($hasil->fetch());

			// die();
				while ($r = $hasil->fetch()) {
					# code...
				
			?>

					<tr>
						<td><?php echo $no ?></td>
						<td><?php echo $r['no_retur'] ?></td>
						<td><?php echo IndonesiTGL($r['tgl'] )?></td>
						<td><?php echo $r['nama_supplier'] ?></td>
						<td><?php echo $r['keterangan'] ?></td>
						<td>

						<a class="btn btn-primary" href="serah_view?id=<?php echo $r['id'] ?>">

							<i class="flaticon flaticon-search"></i> Lihat

						</a>

						<a class="btn btn-danger" href="?action=delete&id=<?php echo $r['id'] ?>">

							<i class="flaticon flaticon-delete"></i> Hapus

						</a>


						</td>
			
					</tr>


			<?php $no++;} ?>

		</tbody>
	</table>
</div>

<?php

if (!empty($_GET['action']) && $_GET['action']=='delete') {
	# code...

	echo $id=$_GET['id'];
	$sql="DELETE FROM serah WHERE id='$id'";
	if ($MyConn->query($sql)) {
		# code...
		redirect('antre/serah');
	}

}

?>

<script type="text/javascript">

	$(window).keydown(function(event) {
		
		  if(event.keyCode == 67) { 
		    window.location.href='serah_add'
		    event.preventDefault(); 
		  }
		});

		function hapus(x){
			$("#"+x).fadeToggle();
		}
	
</script>