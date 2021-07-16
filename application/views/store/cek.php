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
	<label style="font-size:15pt;color:black"><strong>Masukan barcode atau sku : </strong></label>
	<input  id="key" autocomplete="off" type="text" name="key" class="form-control" autofocus="autofocus" style="border:1px solid black">
</div>

<div id="data">
	
</div>

</div>


<script type="text/javascript">
	$(".navbar").hide();
	$("#key").change(function(e){
		e.preventDefault();
		var key = $(this).val();

		$.ajax({
			url:'cek_data',
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

				$("#key").val("");
			}
		})
	})
</script>