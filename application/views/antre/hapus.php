<?php
$host="localhost";
$db="ci";
$user="root";
$pass="";
$conn=new PDO("mysql:host=$host;dbname=$db",$user,$pass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$SQL = "DELETE FROM data_antrian WHERE ID='$ID'";
$conn->query($SQL);




