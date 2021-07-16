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


$host="localhost";
$db="ci";
$user="root";
$pass="";
$conn2=new PDO("mysql:host=$host;dbname=$db",$user,$pass);
$conn2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql="SELECT * FROm data_alarm";
$hasil = $conn2->query($sql);


			$no=1;

			 require_once($_SERVER['DOCUMENT_ROOT'].str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']).'/email/autoload.php');


			while ($r = $data = $hasil->fetch()) {
				# code...
	
		 $IDpegawai=$r['IDpegawai'];
					$hariIni = date('Y-m-d');
					$date = new DateTime($hariIni);
					$date->modify('+1 day');
					$NOW = $date->format('Y-m-d');

				$sql3 = "SELECT  top 1 Shift1 FROm dbo.Attendance WHERE ScheduleDate='$NOW' AND Employee='$IDpegawai'";
					$hasil3 = $conn->query($sql3);
					$dataJadwal= $hasil3->fetch();
					$shift = $dataJadwal['Shift1'];
					//get jam jadwal
					$sql4 = "SELECT top 1  TimeIn,TimeOut FROM dbo.ScheduleCode WHERE OID='$shift'";
					$hasil4 = $conn->query($sql4);
					$r4= $hasil4->fetch();

					 $JAM_MASUK=$r4['TimeIn'];

					 $JAM_PULANG= $r4['TimeOut'];


					 $mail = new PHPMailer\PHPMailer\PHPMailer(true);


// mail
                			  $mail->SMTPDebug = 2;                                 // Enable verbose debug output
                              $mail->isSMTP();                                      // Set mailer to use SMTP
                              $mail->Host = 'setiabudhi-supermarket.co.id';  // Specify main and backup SMTP servers
                              $mail->SMTPAuth = true;                               // Enable SMTP authentication
                              $mail->Username = 'online@setiabudhi-supermarket.co.id';                 // SMTP username
                              $mail->Password = 'mailstbh4246';                           // SMTP password
                              $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
                              $mail->Port = 465;                                    // TCP port to connect to
                
                              //Recipients
                              $mail->setFrom('online@setiabudhi-supermarket.co.id', 'HRD - info jadwal besok');
                              $nm = $r['nama'];;
                           	  $to = $r['email'];
                           	  // $to = 'zzafachreza@gmail.com';

                           	  if($JAM_MASUK=="00:00"){
	                           	 echo	 $sub = "Hallo - ".$nm." besok libur Yaaa";
	                              $isi ="Hallo - ".$nm." besok libur Yaaa";
	                              $msg="";
                           	  }else{

                           	  	echo $sub = "Hallo - ".$nm." besok masuk jam ".$JAM_MASUK." pulang jam ".$JAM_PULANG.' Yaaa';
	                              $isi = "besok masuk jam ".$JAM_MASUK." pulanh jam ".$JAM_PULANG.' Yaaa';
	                              $msg="";
                           	  
                           	  }

                           	 

                                  
                                      $mail->addAddress($to);
                                      $mail->isHTML(true);                                  // Set email format to HTML
                                      $mail->Subject = $sub;
                                      $mail->Body    = $isi;

                                      // $mail->addAttachment('data/brand.png');

                                      	   $mail->send();
                                      	  $mail->clearAllRecipients(); 

                                      
                                    $no++; } ?>