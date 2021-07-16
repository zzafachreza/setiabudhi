<?php


$host="localhost";
$db="ci";
$user="root";
$pass="";
$connMy=new PDO("mysql:host=$host;dbname=$db",$user,$pass);



$id = $_POST['id'];


echo $sql = "DELETE FROM data_kosong WHERE id='$id'";

$connMy->query($sql);