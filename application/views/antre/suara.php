
<?php
$host="localhost";
$db="ci";
$user="root";
$pass="";
$conn=new PDO("mysql:host=$host;dbname=$db",$user,$pass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$ID = $_POST['ID'];
$STATUS_ANTRIAN = $_POST['STATUS_ANTRIAN'];

$sql="SELECT * FROM data_antrian WHERE ID='$ID'";

$data = $conn->query($sql)->fetch();

if ($data['STATUS_ANTRIAN']==='FINISH') {
	# code...
	$SUPPLIER_ID  = $data['SUPPLIER_ID'];

	$sql1="SELECT * FROM data_alias WHERE SUPPLIER_ID='$SUPPLIER_ID'";
	$jml = $conn->query($sql1)->rowCount();
	$alias = $conn->query($sql1)->fetch();

	if ($jml > 0 ) {
		# code...
		$text = $alias['SUPPLIER_ALIAS']." ( SILAHKAN AMBIL FAKTUR ) (JANGAN LUPA PAKAI MASKER)";
	}else{

 		 $text = strtolower(str_replace(" CV", "", str_replace(" PT", "", $data['SUPPLIER_NAME'])))." ( SILAHKAN AMBIL FAKTUR ) (JANGAN LUPA PAKAI MASKER )";
	}


 	
}else{

	$SUPPLIER_ID  = $data['SUPPLIER_ID'];

	$sql1="SELECT * FROM data_alias WHERE SUPPLIER_ID='$SUPPLIER_ID'";
	$jml = $conn->query($sql1)->rowCount();
	$alias = $conn->query($sql1)->fetch();

	if ($jml > 0 ) {
		# code...
		$GRP = explode(" - ", $data['GROUP_PO']);
		$text = $alias['SUPPLIER_ALIAS']." ( SILAHKAN MASUK KE AREA ) ". $GRP[0]." (JANGAN LUPA PAKAI MASKER)";
	}else{

 		 $GRP = explode(" - ", $data['GROUP_PO']);
 		 $text = strtolower(str_replace(" CV", "", str_replace(" PT", "", $data['SUPPLIER_NAME']))) ." ( SILAHKAN MASUK KE AREA ) ". $GRP[0]." (JANGAN LUPA PAKAI MASKER)";

	}



		
}



	// $txt=htmlspecialchars($text);
	// $txt=rawurlencode($txt);
	// $html=file_get_contents('https://translate.google.com/translate_tts?ie=UTF-8&client=gtx&q='.$txt.'&tl=ID');
	
	// $player="<audio controls='controls' autoplay><source src='data:audio/mpeg;base64,".base64_encode($html)."'></audio>";
	
	// echo $player;



?>

<script type="text/javascript">
	responsiveVoice.speak("<?php echo $text  ?>","Indonesian Female",{rate: 0.8,volume:3});
</script>



