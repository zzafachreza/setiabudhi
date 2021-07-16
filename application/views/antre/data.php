<div id="suara">
		
</div>


 
<center>
	<!-- <a href="detail" class="btn btn-success">REFRESH</a> -->
</center>
<div id="dataAntiran">
	
</div>


<script type="text/javascript">

$("#loader").fadeIn("fast");


function getAntrian() {

		
		$.ajax({
			url:'get_antrian',
			success:function(data){
				$("#dataAntiran").html(data);
				$("#loader").fadeOut("fast");
			}
		})
	// body...
}


setInterval(function(){
		getAntrian();
	},3000)



function ambil_suara(ID,STATUS_ANTRIAN){
	$("#dataAntiran").fadeOut("fast");
// 	$.ajax({
// 			url:'suara',
// 			data:{
// 				ID:ID,
// 				STATUS_ANTRIAN:STATUS_ANTRIAN
// 			},
// 			type:'POST',
// 			success:function(data){
// 				$("#suara").html(data);
// 				console.log(data);
// 			}
// 		})

$("#loader").fadeIn("fast");


	$.ajax({
					url:'suara2',
					
					success:function(data2){
						$("#suara").html(data2);
					
							$.ajax({
									url:'suara',
									data:{
										ID:ID,
										STATUS_ANTRIAN:STATUS_ANTRIAN
									},
									type:'POST',
									success:function(data){
										$("#suara").html(data);
										console.log(data);

										$("#dataAntiran").fadeIn("fast");
										$("#loader").fadeOut("fast");

									}
								})
						
					}
				})


}


</script>