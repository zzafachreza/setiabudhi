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



?>

<style type="text/css">
	.card-1 {

	  box-shadow:2px 1px 3px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
	  width: 300px;
	  height: 300px;
	   transition: box-shadow 1s;
	   margin:1%;
	   overflow: hidden;
	   /*padding-top: 1%;*/

	

	}



	.card-1:hover {

	  box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
	  cursor: pointer;

	  

	}

	.imgService{

		align-items: center;
		border-top-right-radius: 10px;
		border-top-left-radius: 10px;
/*		max-width: 200px;
		max-height: 200px;*/
		width: 100%;
		height: auto;

	

		transition: transform 1s;



	}

		.card-1:hover .imgService {

		 transform: scale(1.5,1.5);

	}

</style>



<div class="container-fluid">
	

	<div class="row" style="justify-content: center;margin-top: 5%">
		<div class="col-sm-3 card-1" onclick="location.href='./product_tree/tree'">
			<center><h3>SKU SUPPLIER SALES</h3></center>
			<img src="assets/images/1.jpeg" class="imgService">
		</div>
		<div class="col-sm-3 card-1" onclick="location.href='./product_tree/uom'">
			<center><h3>PRODUCT UOM</h3></center>
			<img src="assets/images/2.jpeg" class="imgService">
		</div>
		<div class="col-sm-3 card-1" onclick="location.href='./product_tree/barcode'">
			<center><h3>BARCODE</h3></center>
			<img src="assets/images/3.jpeg" class="imgService">
		</div>
	</div>
	




</div>