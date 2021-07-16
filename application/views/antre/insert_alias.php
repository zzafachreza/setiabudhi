<?php


$host="localhost";
$db="ci";
$user="root";
$pass="";
$conn=new PDO("mysql:host=$host;dbname=$db",$user,$pass);


$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$SUPPLIER_ID = $_POST['SUPPLIER_ID'];
$SUPPLIER_ALIAS = $_POST['SUPPLIER_ALIAS'];


$sql = "INSERT INTO data_alias(SUPPLIER_ID,SUPPLIER_ALIAS) VALUES('$SUPPLIER_ID','$SUPPLIER_ALIAS')";


if ($conn->query($sql)) {
	# code...
	header('location:alias');
}
