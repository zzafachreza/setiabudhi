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


function tglSql($tgl){
	$tgl = explode("/", $tgl);
	return $tgl[2]."-".$tgl[1]."-".$tgl[0];
}

if(!empty($_POST)){

	   $TANGGAL_PAYMNET = tglSql($_POST['awal']);
	   $DUE_DATE = tglSql($_POST['akhir']);

	   $sql="select CMTTTdt.TTTNmbr NO_KONTRABON, convert(varchar,TTTDate,103) TANGGAL_KONTRA,convert(varchar,TTTDueDate,103) JATUH_TEMPO ,convert(float,SUM(TTTAmountPmt)) AMOUNT ,CMTTTHd.TTTSupid SUPPLIER_ID,SupName SUPPLIER_NAME, SMSupplierMs.APSubLedg APL, 
AccNmbr SUPPLIER_ACC,AccName SUPPLIER_ACCNAME,CMTTTHd.ApprTemp
from (dbo.CMTTTHd inner join SMSupplierMs ON SMSupplierMs.supid = CMTTTHd.TTTSupid )
inner join CMTTTdt on CMTTTdt.TTTNmbr = CMTTTHd.TTTNmbr
 WHERE  TTTDueDate <='$DUE_DATE' AND CMTTTHd.FgStatus='A' AND TTTSupid like '0%'  GROUP BY CMTTTdt.TTTNmbr,TTTDate,TTTDueDate,CMTTTHd.TTTSupid,SupName,AccNmbr,AccName,APSubLedg,ApprTemp";


	   $hasil = $conn->query($sql);
	}



?>

<form id="frm-example" method="POST">
	<center>
		<input type="hidden" id="awalA" name="awal">
		<input type="hidden" id="akhirA" name="akhir">
		<button class="btn btn-success btn-lg"> <i class="flaticon-file"></i> Ceate Payment</button>
	</center>
<table class="table" id="tableKontra">
	<thead>
		<tr>

			<th>NO</th>
			<th>NO_KONTRABON</th>
			<th>NO_TMP</th>
			<th>TANGGAL_KONTRA</th>
			<th>JATUH_TEMPO</th>
			<th>AMOUNT</th>
			<th>SUPPLIER_ID</th>
			<th>SUPPLIER_NAME</th>
			<th>SUPPLIER_ACC</th>
			<th>SUPPLIER_ACCNAME</th>
			<th>APL</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$no=1;
		while ( $r = $hasil->fetch()) {
			# code...
	
		?>
			<tr>
				
				<td><?php echo $no ?></td>
				<td>
					<input type="hidden" name="KONTRA<?php echo $no ?>" value="<?php echo $r['NO_KONTRABON']?>">
					<?php echo $r['NO_KONTRABON']?></td>
					<td><?php echo $r['ApprTemp']?></td>
				<td><?php echo $r['TANGGAL_KONTRA']?></td>
				<td><?php echo $r['JATUH_TEMPO']?></td>
				<td><?php echo number_format($r['AMOUNT'],2)?></td>
				<td><?php echo $r['SUPPLIER_ID']?></td>
				<td><?php echo $r['SUPPLIER_NAME']?></td>
				<td><?php echo $r['SUPPLIER_ACC']?></td>
				<td><?php echo $r['SUPPLIER_ACCNAME']?></td>
				<td><?php echo $r['APL']?></td>
			</tr>


		<?php $no++; } ?>
	</tbody>
</table>



<script type="text/javascript">

	$("#awalA").val($("#awal").val());
	$("#akhirA").val($("#akhir").val());


	var table = $('#tableKontra').DataTable({
		'paging':false,
   'columnDefs': [
      {
         'targets':0,
         'checkboxes': {
            'selectRow': true
         }
      }
   ],
   'select': {
      'style': 'multi'
   }
});


	 // Handle form submission event
   $('#frm-example').on('submit', function(e){

   	 $("#loader").show();
   	e.preventDefault();
      var form = this;

      var rows_selected = table.column(0).checkboxes.selected();

      // Iterate over all selected checkboxes
      $.each(rows_selected, function(index, rowId){
         // Create a hidden element
         $(form).append(
             $('<input>')
                .attr('type', 'hidden')
                .attr('name', 'id[]')
                .val(rowId-1)
         );
      });



      var data = $('#frm-example').serialize();

      	$.ajax({
      		url:'payment/save',
      		data:data,
      		type:'POST',
      		success:function(html){
      			

      			setTimeout(function(){
      			 	$("#loader").fadeOut('fast',function(){
      			 		alert(html);
      			 		console.log(html);
      			 		location.href='payment';

      			 });
      			 },1500)
      		}
      	})
   });
</script>