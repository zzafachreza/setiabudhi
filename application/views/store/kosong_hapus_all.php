<?php


$host="localhost";
$db="ci";
$user="root";
$pass="";
$connMy=new PDO("mysql:host=$host;dbname=$db",$user,$pass);



$kode = $_GET['kode'];


echo $sql = "DELETE FROM data_kosong WHERE kode='$kode'";

$connMy->query($sql);

header('location:kosong');