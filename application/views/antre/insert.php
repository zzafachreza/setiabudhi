<?php

function tglSql($tgl){
	$tgl = explode("/", $tgl);
	return $tgl[2]."-".$tgl[1]."-".$tgl[0];
}


$host="localhost";
$db="ci";
$user="root";
$pass="";
$conn=new PDO("mysql:host=$host;dbname=$db",$user,$pass);


$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$TANGGAL_DATANG = tglSql($_POST['TANGGAL_DATANG']);
$SUPPLIER_F =  str_replace("'","\'",$_POST['SUPPLIER']);
$SUPPLIER = str_replace("|","-",$SUPPLIER_F);

$PRODUCT_F =  str_replace("'","\'",$_POST['PRODUCT']);
$PRODUCT = str_replace("|","-",$PRODUCT_F);

$JUMLAH = $_POST['JUMLAH'];
$TANGGAL_EXPIRED = tglSql($_POST['TANGGAL_EXPIRED']);
$CHECKER = $_POST['CHECKER'];
$PURCHASING = $_POST['PURCHASING'];


$sql = "INSERT INTO data_exp(TANGGAL_DATANG,SUPPLIER,PRODUCT,JUMLAH,TANGGAL_EXPIRED,CHECKER,PURCHASING) VALUES('$TANGGAL_DATANG','$SUPPLIER','$PRODUCT','$JUMLAH','$TANGGAL_EXPIRED','$CHECKER','$PURCHASING')";


if ($conn->query($sql)) {
	# code...
	header('location:exp');
}
