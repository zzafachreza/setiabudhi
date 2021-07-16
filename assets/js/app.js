$(function(){
	// init service worker

	 // $("#loader").fadeIn('slow',function(){
	 // 	 setTimeout(function(){
	 // 	 	$("#loader").fadeOut('slow');
	 // 	 },100)
	 // });
		
		$('.tgl').datepicker({
			'todayHighlight':true,
			'todayBtn':true,
			'autoclose':true,
			'format':'dd/mm/yyyy'
		});


		$('.tgl2').datepicker({
			'todayHighlight':true,
			'todayBtn':true,
			'autoclose':true,
			'format':'yyyy-mm-dd'
		});
	

	$(".tabza").DataTable();
	// load menu header
	$(".selectza").selectize();




	$(".AppInput").click(function(e){
		e.preventDefault();


		$(this).siblings(".AppLabel").css({
			
			'color':'#F47721'
		})
		$(this).siblings(".iconInput").css({
			
			'color':'#1B2755'
		})

	});
	$(".AppInput").blur(function(e){
		e.preventDefault();
		$(this).siblings(".AppLabel").css({
			
			'color':'#1B2755'
		})
		$(this).siblings(".iconInput").css({
			
			'color':'#1B2755'
		})
	});


	// handleLogin

	$("#dataFormLogin").submit(function(e){
		e.preventDefault();
		var data = $(this).serialize();
		$.ajax({
			url:'./login/validasi',
			type:'POST',
			data:data,
			beforeSend:function(){
 				$("#loader").fadeIn('slow');
			},
			success:function(data){

				setTimeout(function(){
				  $("#loader").fadeOut('fast');
				   if (data==200) {
					location.href = './';
					}else{

						 notify("Maaf username atau password Anda salah !","error");
						
					}
				},1500)
			}
		})
	})

	// handleRegister

	$("#dataFormRegister").submit(function(e){
		e.preventDefault();
		var data = $(this).serialize();
		$.ajax({
			url:'./register/add',
			type:'POST',
			data:data,
			beforeSend:function(){
 				$("#loader").fadeIn('slow');
			},
			success:function(data){
				console.log(data);
				 $("#loader").fadeOut('fast');
				 notify("Selamat Anda berhasil Daftar, Silahkan Login","success");
				setTimeout(function(){
				 
				  	// notify("Selamat Anda berhasil Daftar, Silahkan Login","success");
				   if (data==200) {
				 		location.href = './login';
					}else{

						 notify("Maaf username atau password Anda salah !","error");
						
					}
				},2500)
			}
		})
	})




});

// area fungsi


function notify(text,type){


				if (type=='error') {
					$("#flash-message-error").html(text);
					$("#flash-message-error").slideDown();
					setTimeout(function(){
						$("#flash-message-error").slideUp();
					},1500)

				}else if (type=='success') {
					$("#flash-message-success").html(text);
					$("#flash-message-success").slideDown();
					setTimeout(function(){
						$("#flash-message-success").slideUp();
					},1500)

				}

	
}



