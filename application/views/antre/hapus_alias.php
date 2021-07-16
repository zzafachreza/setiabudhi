<?php

$host="localhost";
$db="ci";
$user="root";
$pass="";
$conn=new PDO("mysql:host=$host;dbname=$db",$user,$pass);


echo $sql ="DELETE FROM data_alias WHERE SUPPLIER_ID='$ID'";
if ($conn->query($sql)) {
	# code...
	header('location:alias');
}
