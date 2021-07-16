<?php


$host="localhost";
$db="ci";
$user="root";
$pass="";
$connMy=new PDO("mysql:host=$host;dbname=$db",$user,$pass);

$id = $_POST['id'];
$keterangan = $_POST['keterangan'];

$sql = "UPDATE data_kosong SET keterangan='$keterangan' WHERE id='$id'";

$connMy->query($sql);