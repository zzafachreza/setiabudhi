<style type="text/css">
	.loading{
		background-color: #FFF;
	}
</style>

<center>
	<div id="loading" style="display: none;z-index: 200;padding-top: 10%;background-color: #FFF">
		<img width="300" src="<?php echo base_url() ?>assets/images/oke.gif">
	</div>
</center>


<div class="container">
<div class="form-group" style="margin-top:3%">

	<?php 

	if (!empty($_POST['pass']) && $_POST['pass']=='spm4246') {
		# code...
		?>

		<input  id="key" autocomplete="off" type="text" name="key" class="form-control" autofocus="autofocus" style="border:1px solid red;border-radius: 50px;" placeholder="Masukan barcode atau sku untuk cek stok">
		<?php	 }else{

			?>

				<form method="POST">
					<input class="form-control" type="password" name="pass" placeholder="masukan kode akses"  autofocus="autofocus"/>
				</form>




			<?php

			if (!empty($_POST['pass']) && $_POST['pass'] !=="spm4246") {
				# code...
				echo "<center><h3 style='color:red'>Maaf kode akses Salah !</h3></center>";
			}
		}

		?>
</div>

<div id="data">
	
</div>

</div>



<script type="text/javascript">
	// $(".navbar").hide();
	$("#key").change(function(e){
		e.preventDefault();
		var key = $(this).val();

		$.ajax({
			url:'cek_data_inventory',
			type:'POST',
			data:{
				key:key

			},beforeSend:function(){
 					 $("#loading").show();
				     $('body').addClass('loading');
		
			},success:function(data){
				
				setTimeout(function(){

					$("#loading").hide();
				     
				     $('body').removeClass('loading');
				
					console.log(data)
				$("#data").html(data);




					},1200)

				setTimeout(function(){
				
				window.location.href='./cek_inventory'

				},7000)


							
					
				$("#key").val("");
			}
		})
	})
</script>