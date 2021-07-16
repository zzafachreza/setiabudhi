<?php

$serverName = "server";  
/* Connect using Windows Authentication. */  
try  
{  
$conn = new PDO( "sqlsrv:server=$serverName ; Database=DEMOHRMS", "sa", "stb@12345");  
$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );  
}  
catch(Exception $e)  
{   
die( print_r( $e->getMessage() ) );   
}

$sql="SELECT * FROM dbo.vEmployee_data WHERE IDPegawai='$IDPegawai'";
$hasil = $conn->query($sql);

$sql2="SELECT FirstName,CONVERT(char(10), BirthDate,103) BirthDate,Gender,BirthPlace FROM dbo.Person WHERE OID='$IDPegawai'";
$hasil2 = $conn->query($sql2);


$r= $hasil->fetch();
$r2= $hasil2->fetch();



?>

<?php
//barcode QR
 
$isi_teks = $r['EmployeeNumber'];
$namafile = "coba.png";
$quality = 'H'; //ada 4 pilihan, L (Low), M(Medium), Q(Good), H(High)
$ukuran = 5; //batasan 1 paling kecil, 10 paling besar
$padding = 0;
$tempdir =''; 
$qr = QRCode::png($isi_teks,$tempdir.$namafile,$quality,$ukuran,$padding);
 
$path = $tempdir.$namafile;
$type = pathinfo($path, PATHINFO_EXTENSION);
$data = file_get_contents($path);
$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
   $qrcode = '<img id="QR" src="'.$base64.'" />';

//barcode Batang 128

               $img      = code128BarCode($isi_teks, 1);
              ob_start();
              imagepng($img);
           
              $output_img   = ob_get_clean();
              echo "";

 $barcode128 ='<img id="QR" src="data:image/png;base64,'.base64_encode($output_img).'" />'; 

                            

// untuk experiment php
   
  
?>

<!-- 	<body>
		<center>
		<div id="card">
			<div id="box1" style="background-color: red">


			</div>
			<div id="box2">
				<center>
					<img src="https://setiabudhi-supermarket.co.id/images/brand.png" width="300" style="margin:5%">
				</center>
			</div>
			<center>
				
				<img src="https://setiabudhi-supermarket.co.id/images/brand.png" width="300" style="margin:5%">
				<hr style="border:0.5px solid black" />
				<img src="<?php echo site_url() ?>assets/images/ava.jpg" width="180" height="230">

				
				<h3><?php echo $r['FirstName']." ".$r['MiddleName']." ".$r['LastName'] ?></h3>

				<?php echo $qrcode ?>
				<h5 style="margin-top: 3%"><?php echo $r['EmployeeNumber'] ?></h5>
				<hr style="border:0.5px solid black" />
				<h5><strong>PT. SETIABUDHI JAYA ABADI</strong></h5>
			</center>
		</div>
	</center>
	</body> -->


<style type="text/css">
  body {
  background: rgb(204,204,204); 
}
page {
  background: white;
  display: block;
  margin: 0 auto;
  margin-bottom: 0.5cm;
  box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
}
page[size="A4"] {  
  width: 21cm;
  height: 100%; 
}
page[size="A4"][layout="landscape"] {
  width: 29.7cm;
  height: 21cm;  
}
page[size="A3"] {
  width: 29.7cm;
  height: 42cm;
}
page[size="A3"][layout="landscape"] {
  width: 42cm;
  height: 29.7cm;  
}
page[size="A5"] {
  width: 14.8cm;
  height: 21cm;
}
page[size="A5"][layout="landscape"] {
  width: 21cm;
  height: 14.8cm;  
}
@media print {
  .highlited {
    background-color: dddddd !important;
    -webkit-print-color-adjust: exact;
  }
  
  .merah {
    background-color: red !important;
    -webkit-print-color-adjust: exact;
  }
  .textMerah{
    color: red !important;
    -webkit-print-color-adjust: exact;
  }

  	#card{
			border:1px solid black;
		position: relative;
		width: 450px;
		height: 600px;
		-webkit-print-color-adjust: exact;
		
	}

	#box1{
		width: 100%;
		height: 180px;
		border-bottom-left-radius: 20%;
		border-bottom-right-radius: 20%;
		background: #e74c3c;
		-webkit-print-color-adjust: exact;
	}
	#box2{
		width: 100%;
		top: 0;
		height: 140px;
		position: absolute;
		border-bottom-left-radius: 50%;
		border-bottom-right-radius: 50%;
		background: #bdc3c7;
		-webkit-print-color-adjust: exact;
	}

	#card{
		border:1px solid black;
		position: relative;
		width: 380px;
		height: 500px;
		-webkit-print-color-adjust: exact;
		
	}


	#box1{
		width: 100%;
		height: 150px;
		border-bottom-left-radius: 0%;
		border-bottom-right-radius: 0%;
		background: #e74c3c;
	}
	#box2{
		width: 100%;
		top: 0;
		height: 120px;
		position: absolute;
		border-bottom-left-radius: 50%;
		border-bottom-right-radius: 50%;
		background: #bdc3c7;
	}
}

#card{
		border:1px solid black;
		position: relative;
		width: 204px;
		height: 323px;
		-webkit-print-color-adjust: exact;
		
	}


	#box1{
		width: 100%;
		height: 80px;
		border-bottom-left-radius: 0%;
		border-bottom-right-radius: 0%;
		background: #e74c3c;
	}
	#box2{
		width: 100%;
		top: 0;
		height: 80px;
		position: absolute;
		border-bottom-left-radius: 50%;
		border-bottom-right-radius: 50%;
		background: #bdc3c7;
	}

	#box3{
		width: 60px;
		height: 70px;
		margin-left: 35%;
		border:1px solid #000;
		position: absolute;
		overflow: hidden;
		border-radius: 10px;
		z-index: 2;
		top:40px;
		background: #bdc3c7;
	}

	#box7{
		width: 100%;
		top: 283px;
		height: 40px;
		position: absolute;

		background: #bdc3c7;
	}

	#box8{
		width: 100%;
		top: 275px;
		height: 10px;
		position: absolute;
		border-top-left-radius: 80%;
		border-top-right-radius: 80%;
		background: #e74c3c;
	}

	#box4{

		margin-top:40px;
		/*border:1px solid black;*/
	
		
	}

	#box5{

		height: 100px;
		position: absolute;
		z-index: 2;
		top:420px;
		/*border:1px solid black;*/
		/*margin-left: 35%;*/
		
	}

	#foto{
		width: 100%;
	}

	#QR{
		width: 45%;

	}

	#box6{
	margin-top:2px;
		
	}

	#pt{
		font-size: x-small;
		text-align: center;
		justify-content: center;
		align-items: center;
		font-weight: bold;
	}
</style>

<page size="A4">
  <div class="box">
  	<div id="card">
  		<div id="box1">
  			&nbsp;as
			</div>
			<div id="box2">
				<center>
					<img src="https://setiabudhi-supermarket.co.id/images/brand.png" width="100" style="margin:5%">
				</center>
			</div>

			<div id="box3">
  				<img src="<?php echo site_url() ?>assets/images/ava.jpg" id="foto">
			</div>

		
				<center>
					<h6 id="box4"><?php echo $r['FirstName']." ".$r['MiddleName']." ".$r['LastName'] ?></h6>
					<?php echo $qrcode ?>
					<h6 id="box6"><?php echo $r['EmployeeNumber'] ?></h6>
				</center>



			<div id="box7">
  				<p id="pt">PT SETIABUDHI JAYA ABADI<br/>2020</p>
			</div>
			<div id="box8">
  			
			</div>
  				
			
		
  				
			
			
  	</div>

  		
  </div>
 </page>



	

