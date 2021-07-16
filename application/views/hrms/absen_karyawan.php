
<style>
html, body {
  height: 100%;
  margin: 0;
}
.navbar{
	display: none
}


.box{
	border-radius: 10px;
}
.box:hover{
	cursor: pointer;
	background-color: #FFF;
	color: #2ecc71;
	box-shadow: 0 1px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
}

.full-height {
  height: 100%;
  background: yellow;
  overflow: hidden;
}
#kanan{
	float: left;
	width:50%; 
	height: 100%;
  background:#FFF;
  border: 1px solid #bdc3c7;

}
#kiri{
	float: left;
	width:50%; 
	height: 100%;
  background: #FFF;


}

#data{
	float: left;
	width:100%; 
	height: 70%;
  background: #FFFaaa;
  overflow-y: scroll;
  padding: 5px;
  font-size: small;


}
#jam{
	float: left;
	width:100%; 
	height: 30%;
  background: #FFF;
  border-top: 1px solid #bdc3c7;
}

#tombol{
	float: left;
	margin-top: 20%;
	width:100%; 
	height: 55%;
	padding: 1%;
  background: #FFF;

}

#masuk{
	float: left;
	width:46%;
	margin: 2%; 
	height: 30%;
  background: #2ecc71;
  color:#FFF;

   /*box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);*/
  padding: 2%;
}



#pulang{
	float: left;
	width:46%;
	margin: 2%; 
	height: 30%;
  background: #2ecc71;
    color:#FFF;
  padding: 2%;
}

#mulai_istirahat{
	float: left;
	width:21%;
	margin: 2%; 
	height: 30%;
  background: #2ecc71;
   color:#FFF;
  padding: 2%;
}

#selesai_istirahat{
	float: left;
	width:21%;
	margin: 2%; 
	height: 30%;
  background: #2ecc71;
   color:#FFF;
  padding: 2%;
}


#mulai_sholat{
	float: left;
	width:21%;
	margin: 2%; 
	height: 30%;
  background: #2ecc71;
   color:#FFF;
  padding: 2%;
}

#selesai_sholat{
	float: left;
	width:21%;
	margin: 2%; 
	height: 30%;
  background: #2ecc71;
   color:#FFF;
  padding: 2%;
}


#masuk3{
	float: left;
	width:21%;
	margin: 2%; 
	height: 30%;
  background: #FFF;
}

#keluar3{
	float: left;
	width:21%;
	margin: 2%; 
	height: 30%;
  background: #FFF;
}


#pulang_malam{
	float: left;
	width:46%;
	margin: 2%; 
	height: 30%;
  background: #2ecc71;
    color:#FFF;
  padding: 2%;
}

</style>

</head>
<body>

<div class="full-height">
	<div id="kanan">
		<div id="tombol">
			<div id="masuk" class="box">
			<h2><i class="flaticon-notes"></i> Masuk</h2>
			<h1 style="text-align:right">F1</h1>
			</div>
			<div id="pulang" class="box">
			<h2><i class="flaticon-home"></i> Pulang</h2>
			<h1 style="text-align:right">F2</h1>
			</div>
			<div id="mulai_istirahat" class="box">
			<h4>Mulai <br/>Istirahat</h4>
			<h3 style="text-align:right"> F3 <i class="flaticon-layers"></i></h3>
			</div>
			<div id="selesai_istirahat" class="box">
			<h4>Selesai <br/>Istirahat</h4>
			<h3 style="text-align:right"> F4 <i class="flaticon-multimedia-3"></i></h3>
			</div>
			<div id="mulai_sholat" class="box">
			<h4>Izin <br/>Sholat</h4>
			<h3 style="text-align:right"> F5 <i class="flaticon-users"></i></h3>
			</div>
			<div id="selesai_sholat" class="box">
			<h4>Selesai <br/>Sholat</h4>
			<h3 style="text-align:right"> F6 <i class="flaticon-interface-6"></i></h3>
			</div>
			<div id="masuk3">
			</div>
			<div id="keluar3">
			</div>
			<div id="pulang_malam" class="box">
			<h4>Pulang Shift Malam<br/><i class="flaticon-time"></i></h4>
			<h3 style="text-align:right"> F7 </h3>
			</div>
		

		</div>
	</div>
	<div id="kiri">
		<div id="data">
			
		</div>
		<div id="jam" style="padding: 1%">
			
			<h3><p><span style="color: #d35400"><i class="flaticon-event-calendar-symbol"></i></span> <span style="background-color: #FFF;font-family:Arial;font-weight: 500;" id="tgl"></span></p></h3>
				
					<center>
				<strong><p style="font-size:120px;background-color: #FFF;font-family:Arial" id="tgljam"><?php echo date('H:i:s'); ?></p></strong>
			</center>
		</div>
	</div>
</div>

</body>
</html>

<script type="text/javascript">

	$("body").keydown(function(e){
         //well you need keep on mind that your browser use some keys 
         //to call some function, so we'll prevent this
         e.preventDefault();

         //now we caught the key code, yabadabadoo!!
         var keyCode = e.keyCode || e.which;

         //your keyCode contains the key code, F1 to F12 
         //is among 112 and 123. Just it.
         console.log(keyCode);   


         	if(keyCode===112){
         	var ID = prompt("ABSEN MASUK");
			   get_karyawan(ID,"ABSEN MASUK")
		   }
		   else if(keyCode===113){
			var ID = prompt("ABSEN PULANG");
			  get_karyawan(ID,"ABSEN PULANG")
		   }
		     else if(keyCode===114){
		   	var ID = prompt("MULAI ISTIRAHAT");
		   	 get_karyawan(ID,"MULAI ISTIRAHAT")
		   }
		     else if(keyCode===115){
		   	var ID = prompt("SELESAI ISTIRAHAT");
		   	 get_karyawan(ID,"SELESAI ISTIRAHAT")
		   }
		     else if(keyCode===116){
		   	var ID = prompt("IZIN SHOLAT");
		   	 get_karyawan(ID,"IZIN SHOLAT")
		   }
		     else if(keyCode===117){
		   	var ID = prompt("SELESAI SHOLAT");
		   	  get_karyawan(ID,"SELESAI SHOLAT")
		   }
		     else if(keyCode===118){
		   	var ID = prompt("PULANG SHIFT MALAM");
		   	 get_karyawan(ID,"PULANG SHIFT MALAM")
		   }



          
    });


    $("#masuk").click(function(e){
    	e.preventDefault();
    	var ID = prompt("ABSEN MASUK");
		get_karyawan(ID,"ABSEN MASUK")

    })



function get_karyawan(ID,TIPE){

		$("#loader").show();

	


		$.ajax({
		url:'get_jadwal',
		type:'POST',
		data:{
			ID:ID,
			TIPE:TIPE
		},
		success:function(data2){
			$("#loader").hide();
			
			console.log(data2);

			if (data2==100) {

				alert("ANDA SUDAH ABSEN MASUK !");
				window.location.reload();
			
			}else if (data2==404) {

				window.location.reload();
			
			}
			else if (data2==200) {

				alert("ANDA BELUM ABSEN MASUK !");
				window.location.reload();
			
			}else if (data2==300) {

				alert("ANDA BELUM MULAI ISTIRAHAT !");
				window.location.reload();
			
			}else if (data2==400) {

				alert("ANDA BELUM IZIN SHOLAT !");
				window.location.reload();
			
			}else{

				$("#data").html(data2);
				$.ajax({
					url:'get_karyawan',
					type:'POST',
					data:{
						ID:ID,
						TIPE:TIPE
					},
					success:function(data){
						$("#kanan").html(data);

					}
				})

			}


			setTimeout(function(){
				window.location.reload();
			},5000)
		}
	})
}



	setInterval(function(){
$("#tgljam").load('<?php echo site_url()."hrms/jam"; ?>');
	},1000)


$("#tgl").load('<?php echo site_url()."hrms/tgl"; ?>');



$("#masuk").click(function(e){
	e.preventDefault();
	var ID = prompt("ABSEN MASUK");
	 
})

$("#pulang").click(function(e){
	e.preventDefault();
	var ID = prompt("ABSEN PULANG");
})

$("#mulai_istirahat").click(function(e){
	e.preventDefault();
	var ID = prompt("MULAI ISTIRAHAT");
})

$("#selesai_istirahat").click(function(e){
	e.preventDefault();
	var ID = prompt("SELESAI ISTIRAHAT");
})

$("#mulai_sholat").click(function(e){
	e.preventDefault();
	var ID = prompt("IZIN SHOLAT");
})
$("#selesai_sholat").click(function(e){
	e.preventDefault();
	var ID = prompt("SELESAI SHOLAT");
})


$("#pulang_malam").click(function(e){
	e.preventDefault();
	var ID = prompt("PULANG SHIFT MALAM");
})

</script>