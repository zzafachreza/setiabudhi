<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=".$_POST['table'].".php");//ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");

print_r($_POST);

echo "<?php";





echo '<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
	    <li class="breadcrumb-item"><a href="https://zavalabs.com/wandhaelektronik/">Home</a></li>
	    <li class="breadcrumb-item active" aria-current="page">barang</li>
	  </ol>
</nav>
<div class="container-fluid">
	<div class="card">
	  <div class="card-header">
	  	<a href="https://zavalabs.com/wandhaelektronik/" class="AppButton-secondary"><i class="flaticon2-left-arrow-1"></i> Kembali</a>
	    <a href="https://zavalabs.com/wandhaelektronik/barang/add" class="AppButton-primary"><i class="flaticon-add"></i> Tambah</a>
	  </div>
	  <div class="card-body">

	  	<table class="table table-bordered table-striped table-hover tabza">
	  		<thead>
	  			<tr>
	  			    
	  			<th>No</th>
	  			
	  			
	  			<th>Nama barang</th>
                <th>Uom</th>
                <th>Harga Awal</th>
                <th>Diskon</th>
                <th>Harga</th>
                <th>Keterangan</th>
                <th>Point</th>
                <th>Tipe</th>
             
                	  			
	  			<th>Foto</th>
	  			<th>Action</th>
	  		</tr>
	  		</thead>
	  		<tbody>
	  					  			<tr>
		  				<td>1</td>
		  				<td>Samsung Galaxy A12 [4GB/ 128GB]</td>
                        <td>UNIT</td>
                        <td>2,349,000</td>
                        <td>0</td>
                        <td>2,349,000</td>
                        <td>Kecepatan bagus</td>
                        <td>100</td>
                        <td>SAMSUNG</td>
		  				<td><img src="upload/210713045758samsung a12.jpeg" width="100"> </td>
	
	
		  				
		  				
		  				<td>
		  					<a href="https://zavalabs.com/wandhaelektronik/barang/detail/17" class="AppButton-primary"><i class="flaticon-eye"></i></a>

		  					<a href="https://zavalabs.com/wandhaelektronik/barang/edit/17" class="AppButton-secondary"><i class="flaticon-edit"></i></a>

		  					<a href="https://zavalabs.com/wandhaelektronik/barang/delete/17/upload/210713045758samsung a12.jpeg" class="AppButton-dark"><i class="flaticon-delete"></i></a>	


		  					<a style="color: white" data-id="https://zavalabs.com/wandhaelektronik/upload/210713045758samsung a12.jpeg" class="alink btn btn-success">
		  						Copy Link
		  					</a>	


		  				</td>
		  			</tr>

		  				  			<tr>
		  				<td>2</td>
		  				<td>Samsung Galaxy Note10+ [256GB/ 12GB]</td>
                        <td>UNIT</td>
                        <td>8,400,000</td>
                        <td>200,000</td>
                        <td>8,200,000</td>
                        <td>test</td>
                        <td>200</td>
                        <td>SAMSUNG</td>
		  				<td><img src="upload/210713045917samsung note10.jpeg" width="100"> </td>
	
	
		  				
		  				
		  				<td>
		  					<a href="https://zavalabs.com/wandhaelektronik/barang/detail/18" class="AppButton-primary"><i class="flaticon-eye"></i></a>

		  					<a href="https://zavalabs.com/wandhaelektronik/barang/edit/18" class="AppButton-secondary"><i class="flaticon-edit"></i></a>

		  					<a href="https://zavalabs.com/wandhaelektronik/barang/delete/18/upload/210713045917samsung note10.jpeg" class="AppButton-dark"><i class="flaticon-delete"></i></a>	


		  					<a style="color: white" data-id="https://zavalabs.com/wandhaelektronik/upload/210713045917samsung note10.jpeg" class="alink btn btn-success">
		  						Copy Link
		  					</a>	


		  				</td>
		  			</tr>

		  				  			<tr>
		  				<td>3</td>
		  				<td>Samsung Galaxy S21+ [128GB/ 8GB]</td>
                        <td>UNIT</td>
                        <td>10,000,000</td>
                        <td>1,000,000</td>
                        <td>9,000,000</td>
                        <td>samsung</td>
                        <td>300</td>
                        <td>SAMSUNG</td>
		  				<td><img src="upload/210713050308samsung s21.png" width="100"> </td>
	
	
		  				
		  				
		  				<td>
		  					<a href="https://zavalabs.com/wandhaelektronik/barang/detail/19" class="AppButton-primary"><i class="flaticon-eye"></i></a>

		  					<a href="https://zavalabs.com/wandhaelektronik/barang/edit/19" class="AppButton-secondary"><i class="flaticon-edit"></i></a>

		  					<a href="https://zavalabs.com/wandhaelektronik/barang/delete/19/upload/210713050308samsung s21.png" class="AppButton-dark"><i class="flaticon-delete"></i></a>	


		  					<a style="color: white" data-id="https://zavalabs.com/wandhaelektronik/upload/210713050308samsung s21.png" class="alink btn btn-success">
		  						Copy Link
		  					</a>	


		  				</td>
		  			</tr>

		  			  		</tbody>
	  	</table>

	  </div>
	</div>';





echo "?>";