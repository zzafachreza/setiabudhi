<?php



$dari= $_GET['dari'];
$ke = $_GET['ke'];
?>

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


</style>


<page size="A4" layout="landscape">
  <div class="box">

  <?php


  for ($i=$dari; $i <=$ke ; $i++) { 
  	# code...

  		if (strlen($i)==1) {
  			$i="0000".$i;
  		}elseif (strlen($i)==2) {
  			$i="000".$i;
  		}elseif (strlen($i)==3) {
  			$i="00".$i;
  		}elseif (strlen($i)==4) {
  			$i="0".$i;
  		}elseif (strlen($i)==5) {
  			$i=$i;
  		}
  	?>
  		<div style="border:1px solid white;width:1150px;position:relative">
  		<div style="position:absolute;top:13px;left:10;font-weight:bold;color:#990000" >
  		<?php echo $_GET['kode'] ?> <?php echo $i ?>
  		</div>
  		<div style="position:absolute;top:13px;right:450;font-weight:bold;color:#990000" >
  		<?php echo $_GET['kode'] ?> <?php echo $i ?>
  		</div>
  			<img width="100%" src="http://1.1.26.116:88/setiabudhi/assets/images/kupon.png">
  			
  		</div>

  	<?php 
  }

?>

  
  </div>
</page>