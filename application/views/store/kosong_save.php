<?php


$host="localhost";
$db="ci";
$user="root";
$pass="";
$connMy=new PDO("mysql:host=$host;dbname=$db",$user,$pass);



$kode = $_POST['kode'];
$tgl = $_POST['tgl'];
$member = $_POST['member'];
$sku = $_POST['sku'];
$nama = str_replace("'", "\'", $_POST['nama']);
$qty_toko = $_POST['qty_toko'];
$qty_gudang = $_POST['qty_gudang'];
$po = $_POST['po'];


echo $sql = "INSERT INTO data_kosong(kode,tgl,member,sku,nama,qty_toko,qty_gudang,po,st) VALUES('$kode','$tgl','$member','$sku','$nama','$qty_toko','$qty_gudang','$po','OPEN')";

$connMy->query($sql);