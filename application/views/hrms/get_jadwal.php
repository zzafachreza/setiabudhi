<?php
date_default_timezone_set("Asia/Jakarta");
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



$host="localhost";
$db="ci";
$user="root";
$pass="";
$conn2=new PDO("mysql:host=$host;dbname=$db",$user,$pass);
$conn2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (strlen($ID) <= 0) {
	# code...
	echo 404;
	die();
}


$sql="SELECT * FROM dbo.vEmployee_data WHERE EmployeeNumber='$ID'";
$hasil = $conn->query($sql);
$r= $hasil->fetch();


$IDpegawai = $r['IDpegawai'];

$sql2="SELECT FirstName,CONVERT(char(10), BirthDate,103) BirthDate,Gender,BirthPlace FROM dbo.Person WHERE OID='$IDpegawai'";
$hasil2 = $conn->query($sql2);
$r2= $hasil2->fetch();


// get jadwal

$NOW= date('Y-m-d');
$sql3 = "SELECT  * FROm dbo.Attendance WHERE ScheduleDate='$NOW' AND Employee='$IDpegawai'";
$hasil3 = $conn->query($sql3);
$dataJadwal= $hasil3->fetch();

// print_r($dataJadwal);


$shift = $dataJadwal['Shift1'];
//get jam jadwal
$sql4 = "SELECT * FROM dbo.ScheduleCode WHERE OID='$shift'";
$hasil4 = $conn->query($sql4);
$r4= $hasil4->fetch();

$JAM_MASUK=$r4['TimeIn'];

$JAM_PULANG= $r4['TimeOut'];


if ($r['MiddleName']==null) {
	# code...
	$NAMA_KARYAWAN=$r['FirstName']." ".$r['LastName'];
}else{
	$NAMA_KARYAWAN=$r['FirstName']." ".$r['MiddleName']." ".$r['LastName'];
}


//cek double masuk

$sqlCekMasuk = "SELECT * FROM data_absen WHERE TIPE='ABSEN MASUK' AND UID='$IDpegawai'";
$jmlMasuk= $conn2->query($sqlCekMasuk)->rowCount();
if ($jmlMasuk > 0 AND $TIPE==='ABSEN MASUK') {
	# code...
	echo 100;
	die();
}


$sqlCekMasuk = "SELECT * FROM data_absen WHERE TIPE='ABSEN MASUK' AND UID='$IDpegawai'";
$jmlMasuk= $conn2->query($sqlCekMasuk)->rowCount();
if ($jmlMasuk==0 AND $TIPE==='ABSEN PULANG') {
	# code...
	echo 200;
	die();
}

$desc="";

$awal  = new DateTime(date('Y-m-d')." ".$JAM_MASUK);
$akhir = new DateTime(date('Y-m-d')." ".date('H:i:s')); // Waktu sekarang
$diff  = $awal->diff($akhir);


if ($JAM_MASUK >= date('H:i:s') AND $TIPE==='ABSEN MASUK') {
	# code...
	$desc = "MASUK LEBIH AWAL";
}else if($JAM_MASUK < date('H:i:s') AND $TIPE==='ABSEN MASUK'){
	$desc = "TERLAMBAT ".$diff->h." JAM ".$diff->i." MENIT ".$diff->s." DETIK";
}


if ($JAM_PULANG >= date('H:i:s') AND $TIPE==='ABSEN PULANG') {
	# code...
	$desc = "BELUM WAKTUNYA PULANG";
}



if ($TIPE==='SELESAI ISTIRAHAT') {

		$sqlCek = "SELECT count(*) as jmlIstirahat FROM data_absen WHERE KETERANGAN='MULAI ISTIRAHAT' AND TANGGAL=NOW() AND UID='$IDpegawai'";
		$jmlIstirahat = $conn2->query($sqlCek)->fetch();
		if ($jmlIstirahat['jmlIstirahat']==0) {
			echo 300;
			die();
		}
}elseif($TIPE==='SELESAI SHOLAT'){

	$sqlCek2 = "SELECT count(*) as jmlSolat FROM data_absen WHERE KETERANGAN='IZIN SHOLAT' AND TANGGAL=NOW() AND UID='$IDpegawai'";
	$jmlSolat = $conn2->query($sqlCek2)->fetch();
	if($jmlSolat['jmlSolat']==0) {
		# code...
		echo 400;
		die();
	}
}









$sqlinsert="INSERT INTO `data_absen`
            (
             `UID`,
             `NAMA_KARYAWAN`,
             `TIPE`,
             `TANGGAL`,
             `JAM`,
             `KETERANGAN`)
VALUES (
        '$IDpegawai',
        '$NAMA_KARYAWAN',
        '$TIPE',
        NOW(),
        NOW(),
        '$desc');";

        $conn2->query($sqlinsert);


        $sqlGet = "SELECT * FROM data_absen WHERE UID='$IDpegawai' AND TANGGAL='$NOW'";
        $hasilGet = $conn2->query($sqlGet);


?>

<table class="table table-bordered" style="text-align: center;" >
				<tr>
					<td colspan="3">
						<center>
							<h4><?php echo $NAMA_KARYAWAN ?></h4>
							<h6><?php echo $r['EmployeeNumber']; ?></h6>

						</center>
					</td>
				</tr>
				<tr style="font-weight: bold;">
					<td colspan="3">
						<div class="row">
							<div class="col col-sm-6" style="background-color: #2980b9;color: #FFF;font-family: Arial;font-size: large">
								MASUK <span><?php echo $JAM_MASUK ?></span>
							</div>
							<div class="col col-sm-6" style="background-color: #d35400;color: #FFF;">
								PULANG <span><?php echo $JAM_PULANG ?></span>
							</div>
						</div>
					</td>
				</tr>
				<tr style="background-color: #2ecc71">
					<td  style="width: 15%">JAM</td>
					<td style="width: 35%">TINDAKAN</td>
					<td style="width: 30%">KETERANGAN</td>
				</tr>

				<?php

					while ( $dataGet = $hasilGet->fetch()) {
						# code...
					
				?>
					<tr>
						<td><?php echo $dataGet['JAM']  ?></td>
							<td><?php echo $dataGet['TIPE']  ?></td>
								<td><?php echo $dataGet['KETERANGAN']  ?></td>
					</tr>

				<?php

					}
				?>
				
			</table>





</div>