<style type="text/css">
  body {
  /*background: rgb(204,204,204); */
}
page {
  background: white;
  display: block;
  margin: 0 auto;
  margin-bottom: 0.5cm;
  box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
}

page[size="A4"][layout="landscape"] {
  width: 50.7cm;
  height: 100%;
}



@media print {
  body, page {
    margin: 0;
    box-shadow: 0;
  }



  

}

 table {
      font-family: arial, sans-serif;
      border-collapse: collapse;
      width: 100%;
      font-size: small;
    }

    td, th {
      border: 1px solid #dddddd;
      text-align: left;
      padding: 8px;
    }
.judul{
  background-color: #dddddd;
}
.POP{
  border:4px solid #EE3036;
  width: 30cm;
  height: 21.2cm;
  float: left;
  margin-left: 7px;
  margin-top: 10px;
}


.POP:hover {
  cursor: pointer;
}

.top{


  background-image: url('<?php echo site_url() ?>assets/images/promo/gelombang.png');
  position: relative;
  background-size: 100% 100%;
  width: 100%;
  height: 20%;
    -webkit-print-color-adjust: exact; 
  /*border:1px solid black;*/
}

.center{
  position: relative;
  /*border:1px solid black;*/
  width: 100%;
  height: 70%;
  text-align: center;

}
.center2{
  position: relative;
  /*border:1px solid black;*/
  width: 100%;
  /*text-align: center;*/

}


.bottom{

  height: 10%;
  padding-left: 1%;
  font-size: xx-small;
  position: relative;
/*background-color: red;*/
}
.periode{
  position: absolute;
  top: 2;
  left: 420px;
  font-size: 20pt;
/*  font-weight: bold;*/
  font-family: Impact;
}


.down{

  top: 0;
  width: 450px;
  margin-left: 5px;
}
.stb{
	margin-top: 10px;
  margin-left: 65px;
  width: 230px;
}

.brand{
  /*background-color: blue;*/
  margin-top:0;
    font-family: Impact;
  color:  #EE3036;
  /*font-weight: bolder;*/
  font-size: 80pt;
   transform: scale(1.2, 1.3);
}


.brand2{
  /*background-color: blue;*/
  margin-top:0;
    font-family: Impact;
  color:  #EE3036;
  /*font-weight: bolder;*/
  font-size: 29.434pt;
   transform: scale(1.2, 1);
}

.product{

  /*background-color: blue;*/
    font-family: Impact;
  margin-top:10px;
  color:  #000;

  /*font-weight: bolder;*/
  font-size: 25pt;
}


.product2{

  /*background-color: blue;*/
    font-family: Impact;
  color:  #000;
  /*font-weight: bolder;*/
  font-size: 10pt;
}

.disc{

  /*background-color: blue;*/
  margin-top:-40px;
  color:  #000;
  /*font-weight: bolder;*/
  font-size: 70pt;
  font-family: Impact;
  letter-spacing: 0px;
  transform: scale(1, 1.3);
}

.disc2{

  /*background-color: blue;*/
  position: absolute;
  top: 75;
  left: 15;
  color:  #000A11;
  /*font-weight: bolder;*/
  font-size: 10pt;
  font-family: Impact;
 
}

.harga1{
  margin-top: -30px;
  font-size: 50pt;
  width:100%;
  font-family: Impact;
  transform: scale(1, 1.3);
    -webkit-print-color-adjust: exact; 
}


.harga2{
  /*float:left;*/
  font-size: 100pt;
  font-family: Impact;
  transform: scale(1, 1.3);
  color: #EE3036;
}



.harga11{
  float:left;
  padding-left:2%;
  width:100%;
  background-image: url('<?php echo site_url() ?>assets/images/promo/coret.png');
  background-size: 100% 100%;
  background-repeat: no-repeat;
  font-family: Impact;
  transform: scale(1, 1.3);
    -webkit-print-color-adjust: exact; 
}


.harga21{
  /*float:left;*/
  font-size: 15pt;
  font-family: Impact;
  transform: scale(1, 1.3);
  color: #EE3036;
}



.panah{
  margin: 5%;
  width:12%;
  transform: rotate(90deg);

}

.panah2{
  width:12%;
  top: 20%;
  position: absolute;
  left: 38%;
}

.barcode{
  margin-top: -50px;
  margin-right: 2%;
  width:350px;
  height: 120px;
}

.coret{
  width: 40%;
  position: absolute;
  opacity: 0.8;
}
</style>


<?php

$serverName = "proint";  
  
/* Connect using Windows Authentication. */  
try  
{  
$conn = new PDO( "sqlsrv:server=$serverName ; Database=PROINT_ERP", "sa", "aDmInSTB4246");  
$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );  
}  
catch(Exception $e)  
{   
die( print_r( $e->getMessage() ) );   
}

$host="localhost";
$db="ci";
$user="root";
$pass="";
$connMy=new PDO("mysql:host=$host;dbname=$db",$user,$pass);


function tglIndonesia($tanggal){
  $namaBln = array("01" => "Jan", "02" => "Feb", "03" => "Mar", "04" => "Apr", "05" => "Mei", "06" => "Jun", 
           "07" => "Jul", "08" => "Aug", "09" => "Sep", "10" => "Okt", "11" => "Nov", "12" => "Des");
           
  $tgl=substr($tanggal,8,2);
  $bln=substr($tanggal,5,2);
  $thn=substr($tanggal,0,4);
  $tanggal ="$tgl ".$namaBln[$bln]." $thn";
  return $tanggal;
}


$skulist = explode("@", $_POST['sku']);
$jml = count($skulist)-1;
$datasku="";

for ($i=1; $i <count($skulist) ; $i++) { 
  # code...
  if ($i==$jml ) {
    # code...
    $datasku .= "'".$skulist[$i]."'";
  }else{
    $datasku .= "'".$skulist[$i]."',";
  }
}


   $sql = "SELECT * FROM data_barang WHERE sku in($datasku)";
   $hasilDt = $connMy->query($sql);



?>

<page size="A4" layout="landscape">

  <div class="box">

    <?php 

    $no=1;

    while ($r = $hasilDt->fetch()) {
     # code...
        $sku = $r['sku'];
      $sqlBarang = "select PriceProduct,ProdName nama,convert(float,IDRPrice) harga,prodname,prodUom from dbo.SMCusPriceListDt inner join SMProductms ON SMCusPriceListDt.PriceProduct = SMProductms.prodcode  where priceProduct in($sku) order by PriceSeq DESC";
      $barang = $conn->query($sqlBarang)->fetch();
  

            $sqlBrand="select ProdCode,SMProdField.ProdBrand,AttrName from SMProdField inner join  SMProdAttrMs 
            on SMProdField.ProdBrand = SMProdAttrMs.AttrCode WHERE ProdCode='$sku'";
            $brand = $conn->query($sqlBrand)->fetch();
           
       $nama = $barang['nama'];
      $ex = explode(" ", $nama);

            if ($brand=="") {

               $brand = $ex[0];

            }else{
               $brand = $brand['AttrName'];
            }






       if (strlen($brand) > 8 ) {
         # code...
        $stl = 'class="brand2"';
         $brand = $ex[0];

       }else{
        $stl = 'class="brand"';
       }



   

     


      $product = str_replace($brand, "",  $nama);



              $img      = code128BarCode(str_replace(".", "", $sku), 1);
              ob_start();
              imagepng($img);
           
              $output_img   = ob_get_clean();
              echo "";

       $barcode128 ='<img class="barcode"  src="data:image/png;base64,'.base64_encode($output_img).'" />'; 

    if (strlen($product) > 27 ) {
         # code...
        $stl2 = 'class="product2"';
       }else{
        $stl2 = 'class="product"';
       }

        $harga = $barang['harga'];

        if ($harga > 1000000) {
         # code...
        $stl4 = 'class="harga21"';
        $stl5 = 'class="panah2"';
       }else{
        $stl4 = 'class="harga2"';
        $stl5 = 'class="panah"';
       }

    
    
     ?>
      
   
      <div class="POP" id="pop<?php echo $no ?>" ondblClick="del('pop<?php echo $no ?>')">
        <div class="top">
            
                 <img src="<?php echo site_url() ?>assets/images/promo/stb.png"  class="stb">
        </div>
        <div class="center">
            <p <?php echo $stl ?>><?php echo $brand ?><br/><span <?php echo $stl2 ?>><?php echo  $product  ?></span></p>


            <div <?php echo $stl4 ?>>
              Rp. <?php echo number_format($harga) ?>
            </div>


            
        </div> 

  
 

      <div class="bottom">
       <?php echo $barcode128 ?>
    
        </div>
        
      </div>
 <?php $no++; } ?>


       
  </div>
</page>


<script type="text/javascript">
  function del(x){
      
      document.getElementById(x).style.display = "none";
  }
</script>


