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


?>


 <input type="hidden" id="sku" name="sku" class="AppInput" autocomplete="off" required="required">
  <div class="form-group col-sm-9 key">
        <label for="username" class="AppLabel">Search SKU / Name</label>
          <i class="flaticon2-cube iconInput"></i>
         
        <input type="text" id="key" name="key" class="AppInput" autocomplete="off" >
      </div>


<div id="dataHasilSku">
	
</div>
