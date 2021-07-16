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

<div class="container-fluid">
	<center><h3>ANALISA PO</h3></center>
	<hr/>
	<form id="dataForm">
		<table class="table">
		<tr>
			<th>Masukan Nomor PO</th>
			<td>
				<input type="text" name="key" id="key" class="form-control" placeholder="masukan nomor po" autofocus="autofocus">
			</td>
		</tr>
	</table>
	</form>

	<div id="data">
		
	</div>
</div>

<script type="text/javascript">

get_po();

function get_po(){
 		$("#key").keyup(function(e){
		e.preventDefault();
		var key = $(this).val();
		$.ajax({
			url:'get_data_po',
			type:'POST',
			data:{
				key:key
			},
			success:function(data){
				$("#data").html(data);
				hapus_po();


			}
		})

		

	})
 }





	function hapus_po(){
		$(".hapus").click(function(e){
			$("#loader").show();
			e.preventDefault();
			var NO_PO = $(this).attr("data-id");
			$.ajax({
				url:'hapus_po',
				type:'POST',
				data:{
					NO_PO:NO_PO
				},
				success:function(data){

					setTimeout(function(){
					$("#loader").hide();
						
						alert(data);
						window.location.reload();

					},1500)
				

				}

			})

		})
	}
</script>