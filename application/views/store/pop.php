<style type="text/css">
  body {
  /*background: rgb(204,204,204); */
}
page {
  background: white;
  display: block;
  margin: 0 auto;
  margin-bottom: 0.5cm;
  /*box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);*/
}

page[size="A4"][layout="landscape"] {
  width: 32.7cm;
  height: 100%;
}


@media print {
  body, page {
    margin: 0;
    box-shadow: 0;
  }



  

}

.box{
  /*padding: 1%;*/


}
.judul{
  background-color: #dddddd;
}
.POP{
 border:4px solid #EE3036;
  width: 7.8cm;
  height: 9cm;
  float: left;
  margin-left: 2px;
  margin-top: 40px;
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
  height: 60%;
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
  top: 1;
  left: 160px;
/*  font-weight: bold;*/
  font-family: Impact;
}

.down{

  top: 0;
  width: 135px;
  margin-left: 5px;
}
.stb{
  margin-bottom: 15px;
  margin-left: 65px;
  width: 70px;
}

.brand{
  /*background-color: blue;*/
  margin-top:0;
    font-family: Impact;
  color:  #EE3036;
  /*font-weight: bolder;*/
  font-size: 33.434pt;
   transform: scale(1.2, 1);
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
  font-size: 12.767pt;
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
  font-size: 80pt;
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
  float:left;
  padding-left:2%;
  width:45%;
  background-image: url('<?php echo site_url() ?>assets/images/promo/coret.png');
  background-size: 80% 100%;
  background-repeat: no-repeat;
  font-family: Impact;
  transform: scale(1, 1.3);
    -webkit-print-color-adjust: exact; 
}


.harga2{
  /*float:left;*/
  font-size: 23pt;
  font-family: Impact;
  transform: scale(1, 1.3);
  color: #EE3036;
}



.harga11{
  float:left;
  padding-left:2%;
  width:50%;
  background-image: url('<?php echo site_url() ?>assets/images/promo/coret.png');
  background-size: 100% 100%;
  background-repeat: no-repeat;
  font-family: Impact;
  transform: scale(1, 1.3);
    -webkit-print-color-adjust: exact; 
}


.harga21{
  /*float:left;*/
  font-size: 19pt;
  font-family: Impact;
  margin-bottom: 6.5px;
  transform: scale(1, 1.3);
  color: #EE3036;
}



.panah{
  width:12%;
  top: 20%;
  position: absolute;
  left: 34%;
}

.panah2{
  width:12%;
  top: 20%;
  position: absolute;
  left: 38%;
}

.barcode{
  margin-top: -10px;
  margin-right: 2%;
  width:130px;
  height: 40px;
}


@media print {
  #fontSize {
    display: none !important;
  }
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


$PromoCode = $_POST['PromoCode'];

 $sqlDt="select  PromoCOde,ProdSeq,ProdCode,convert(float,PromoPerc) PromoPerc,convert(float,PromoDisc) PromoDisc,convert(float,PromoPrice) PromoPrice from SLPromoDt WHERE PromoCode='$PromoCode'";
$hasilDt= $conn->query($sqlDt);

$sqlPeriode = "SELECT PromoCode,convert(char(10), StartDate, 126) StartDate,StartTime,convert(char(10), Enddate, 126) Enddate,EndTime FROM SLPromoHd WHERE PromoCode='$PromoCode'";

$hasilPeriode = $conn->query($sqlPeriode)->fetch();

 $hasilPeriode['StartDate'];

$start = explode(" ", tglIndonesia($hasilPeriode['StartDate']));
$start = $start[0]." ".$start[1];
$end = tglIndonesia($hasilPeriode['Enddate']);





?>
<center>
<input style="padding:10px;border-bottom:1px solid #EEEEEE;border-top:0px;border-left:0px;border-right:0px" placeholder="masukan ukuran huruf" id="fontSize" type="" name="fontSize" width="20%" onchange="ubahFont(this.value)"></center>
<page size="A4" layout="landscape">

  <div class="box">

    <?php 
    $no=1;
    while ($r = $hasilDt->fetch()) {
      # code...
      $sku = $r['ProdCode'];
      
$sqlBarang = "select top 1 PriceProduct,ProdName nama,convert(float,IDRPrice) harga,prodname,prodUom from dbo.SMCusPriceListDt inner join SMProductms ON SMCusPriceListDt.PriceProduct = SMProductms.prodcode  where priceProduct='$sku' order by PriceSeq DESC";
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


      $disc = $r['PromoPerc'];

      $hargaAwal = $barang['harga'];

      $hargaAfter = $hargaAwal - ($hargaAwal*($disc/100));

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



       if ($hargaAwal > 1000000) {
         # code...
        $stl3 = 'class="harga11"';
         $stl5 = 'class="panah2"';
       }else{
        $stl3 = 'class="harga1"';
        $stl5 = 'class="panah"';
       }

         if ($hargaAfter > 1000000) {
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
                <img src="<?php echo site_url() ?>assets/images/promo/down.png"  class="down">
                 <img src="<?php echo site_url() ?>assets/images/promo/stb.png"  class="stb">
        </div>
        <div class="center">
            <p <?php echo $stl ?>>

             <input class="brand" style="width:65%;padding:0px;border:0;text-align:center" <?php echo $stl ?> value="<?php echo $brand ?>"/>


                <input style="width:75%;margin-top:0px;border:0;text-align:center" <?php echo $stl2 ?> value="<?php echo  $product  ?>"/>
                  

                

            </p>
            <span class="disc2">Disc</span>
            <p class="disc"> <?php echo number_format($disc) - $disc==0?number_format($disc)."%":$disc."%" ?></p>
        </div> 

         <div class="center2">
            <div <?php echo $stl3 ?>>
              Rp. <?php echo number_format($hargaAwal) ?>
            </div>
            <img src="<?php echo site_url() ?>assets/images/promo/arah.png" <?php echo $stl5 ?>>
             <div <?php echo $stl4 ?>>
              Rp. <?php echo number_format($hargaAfter) ?>
            </div>
        </div>  
 

      <div class="bottom">
       <?php echo $barcode128 ?>
            <img src="<?php echo site_url() ?>assets/images/promo/promo.png" width="140" style="margin-top: 7px;position:absolute">
            <p class="periode">Promo <?php echo $start ?> - <?php echo $end ?></p>
           
        </div>
        
      </div>
 <?php $no++; } ?>


       
  </div>
</page>


<script type="text/javascript">
  function del(x){
      
      document.getElementById(x).style.display = "none";
  }




  function ubahFont(z){
    
    // document.getElementsByClassName('brand').style.display = 'none';

    var x = document.getElementsByClassName("brand");
    var i;
    for (i = 0; i < x.length; i++) {
        x[i].style.fontSize = z ;
    }
  }
</script>

