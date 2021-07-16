<?php

$host="localhost";
$db="ci";
$user="root";
$pass="";
$conn=new PDO("mysql:host=$host;dbname=$db",$user,$pass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



$NO_PO = $_POST['NO_PO'];
$sql="DELETE FROM data_antrian WHERE NO_PO='$NO_PO'";
$conn->query($sql);

echo "NOMOR PO : ".$NO_PO." BERHASIL DIHAPUS !";