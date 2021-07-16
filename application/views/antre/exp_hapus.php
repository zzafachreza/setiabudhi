<?php

$host="localhost";
$db="ci";
$user="root";
$pass="";
$conn=new PDO("mysql:host=$host;dbname=$db",$user,$pass);


echo $sql ="DELETE FROM data_exp WHERE ID='$ID'";
$conn->query($sql);
?>