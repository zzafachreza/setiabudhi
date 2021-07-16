<style type="text/css">
	.navbar{

		display: none;
	}
</style>


<div class="container">
	<div class="form-group">
		<label>Masukan Nomor PO</label>
		<input id="key" type="text" class="form-control">
	</div>
	<div id="dataPO">
		
	</div>
</div>

<script type="text/javascript">
	$("#key").keyup(function(e){
		e.preventDefault();
		var key = $(this).val();

		$.ajax({
			url:'./antre/get_po',
			type:'POST',
			data:{
				key:key
			},
			success:function(data){
				// $("#key").val("");
				// 	$("#key").focus();
				$("#dataPO").html(data);
			}
		})
	})
</script>