<?php
$host="localhost";
$db="ci";
$user="root";
$pass="";
$conn=new PDO("mysql:host=$host;dbname=$db",$user,$pass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$GROUP_PO = $_POST['GROUP_PO'];
$NO_PO = $_POST['NO_PO'];
$SUPPLIER_ID = $_POST['SUPPLIER_ID'];
$SUPPLIER_NAME = str_replace("'", "\'", $_POST['SUPPLIER_NAME']);
$SALES_ID = $_POST['SALES_ID'];
$STATUS_ANTRIAN = 'OPEN';

// cek antrain
$NOW = date('Y-m-d');
$cekAntrian = "SELECT NO_ANTRIAN FROM data_antrian WHERE GROUP_PO='$GROUP_PO' AND TANGGAL_ANTRIAN='$NOW' ORDER BY NO_ANTRIAN DESC LIMIT 1";
$NO_AKHIR = $conn->query($cekAntrian)->fetch();

$NO_ANTRIAN = $NO_AKHIR['NO_ANTRIAN'] + 1;


try{

 	$SQL = "INSERT INTO `data_antrian`
            (
             `TANGGAL_ANTRIAN`,
             `JAM_ANTRI`,
             `GROUP_PO`,
             `NO_PO`,
             `SUPPLIER_ID`,
             `SUPPLIER_NAME`,
             `SALES_ID`,
             `STATUS_ANTRIAN`,`NO_ANTRIAN`)
VALUES (
        NOW(),
        NOW(),
        '$GROUP_PO',
        '$NO_PO',
        '$SUPPLIER_ID',
        '$SUPPLIER_NAME',
        '$SALES_ID',
        '$STATUS_ANTRIAN','$NO_ANTRIAN');";

        $conn->query($SQL);

        echo $GROUP_PO." ANTRIAN KE - ".$NO_ANTRIAN;

        }catch(PDOException $e){
    echo $e->getMessage();
 }






