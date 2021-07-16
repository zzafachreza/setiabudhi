<?php 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=SALES FROM ".$_POST['awal']." - ".$_POST['akhir'].".xls");//ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");
error_reporting(0);

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
// print_r($hasil);

function tglSql($tgl){
	$tgl = explode("/", $tgl);
	return $tgl[2]."-".$tgl[1]."-".$tgl[0];
}

if(!empty($_POST)){

	   $awal = tglSql($_POST['awal']);
	   $akhir = tglSql($_POST['akhir']);

	   $jamAwal = $_POST['jamAwal'];
	   $jamAkhir = $_POST['jamAkhir'];
	   


      //transaksi belum posting
$sqlBelumPosting="select InvoiceNumber,convert(varchar, Tanggal, 103) Tanggal,Jam,sum(Total) Total
from dbo.V_sales_asli WHERE Tanggal Between '$awal' and '$akhir' and Jam Between '$jamAwal' and '$jamAkhir' GROUP BY InvoiceNumber,Tanggal,Jam";


//transaksi sudah posting
$sqlSudahPosting = "select InvoiceNumber,convert(varchar, Tanggal, 103) Tanggal,Jam,sum(Total) Total
from dbo.V_sales_tmp WHERE Tanggal Between '$awal' and '$akhir' and Jam Between '$jamAwal' and '$jamAkhir' GROUP BY InvoiceNumber,Tanggal,Jam";



	 //    $sql="select invcNmbr,convert(varchar, InvcDate, 103) tanggal,InvcGroupDesc bisnis_unit,InvcCusIdDesc customer,V_SLSBInvcProduct.prodcode sku,V_SLSBInvcProduct.Prodname nama,
		// InvcUOM UOM,convert(float,PercKonsinyasi) komisi,supid,supname,convert(float,InvcQty) qty,convert(float,InvcPrice) Harga,
		// convert(float,InvcQtyPrice) QtyKaliHarga,convert(float,Discount) Discount,
		// convert(float,InvcNetto) Total,convert(float,InvcNet) NettoAtauDpp,convert(float,InvcPPN) PPN
		// from V_SLSBInvcProduct inner join  V_SMProductMsSuper on V_SMProductMsSuper.prodcode = V_SLSBInvcProduct.prodcode
		// where InvcDate Between '$awal' and '$akhir' AND PercKonsinyasi > 0 and supid='$supid'";

		$data1 = $conn->query($sqlBelumPosting);
    $data2 = $conn->query($sqlSudahPosting);

		// $hasil = $data->fetch();
	}


?>

<style type="text/css">
  
.num {
  mso-number-format:General;
}
.text{
  mso-number-format:"\@";/*force text*/
}
</style>
  <table style="border-collapse: collapse;" cellspacing="0" width="100%" border="1">
                <thead>
                    <tr>
                    
                        <th>No</th>
                        <th>Nomor Struk</th>
                         <th>Tanggal</th>
                         <th>Jam</th>
                         <th>Total</th>
                   
                         
                       </tr>
                </thead>
                <tbody>
                    
                      <?php 

                           $no=1;
									$Total1=0;

                          while ($row = $data2->fetch()) {
                          		$Total1 +=$row['Total'];
                      ?>
                      <tr>
                      <td><?php echo $no;?></td>
                       <td><?php echo $inv=$row['InvoiceNumber'];?></td>
                       <td><?php echo $row['Tanggal'];?></td>
                        <td><?php echo $row['Jam'];?></td>
         
                            <td><?php echo number_format($row['Total']);?></td>
     


                        
                        
                        </tr>
                    <?php $no++; } ?>

                    <?php 

                           $no2=$no;

                           	$Total2=0;


                          while ($row = $data1->fetch()) {
                          		$Total2 +=$row['Total'];
                      ?>
                      <tr>
                      <td><?php echo $no2;?></td>
                       <td><?php echo $inv2 = $row['InvoiceNumber'];?></td>
                       <td><?php echo $row['Tanggal'];?></td>
                        <td><?php echo $row['Jam'];?></td>
          
                            <td><?php echo number_format($row['Total']);?></td>
                         

                             
                           
                        
                        
                        </tr>
                    <?php $no2++; } ?>

                    <tr>
                    	<th colspan="4">Total</th>
                    	<th colspan="1"><?php echo number_format($Total1 + $Total2)  ?></th>
                    </tr>


               
                    
                </tbody>
            </table>