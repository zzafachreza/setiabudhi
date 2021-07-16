<?php
$host="localhost";
$db="ci";
$user="root";
$pass="";
$conn=new PDO("mysql:host=$host;dbname=$db",$user,$pass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$ID = $_POST['ID'];
 $STATUS_ANTRIAN = $_POST['STATUS_ANTRIAN'];


 if($STATUS_ANTRIAN ==='OPEN'){
    $STATUS_ANTRIAN ='PROSES';
 }elseif ($STATUS_ANTRIAN==='PROSES') {
     # code...
    $STATUS_ANTRIAN ='FINISH';
 }

$SQL = "UPDATE data_antrian SET STATUS_ANTRIAN='$STATUS_ANTRIAN' WHERE ID='$ID'";
$conn->query($SQL);



