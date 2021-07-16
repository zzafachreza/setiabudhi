<?php

$serverName = "server";  
/* Connect using Windows Authentication. */  
try  
{  
$conn = new PDO( "sqlsrv:server=$serverName ; Database=DEMOHRMS", "sa", "stb@12345");  
$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );  
}  
catch(Exception $e)  
{   
die( print_r( $e->getMessage() ) );   
}


$host="localhost";
$db="ci";
$user="root";
$pass="";
$conn2=new PDO("mysql:host=$host;dbname=$db",$user,$pass);
$conn2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql="SELECT * FROm data_alarm";
$hasil = $conn2->query($sql);

// print_r($hasil->fetch());
?>


<div class="container-fluid">



		<?php
		date_default_timezone_set("Asia/Jakarta");
		$tgl  = date('Y-m-d 23:15:00');
		$waktu_awal        =strtotime(date('Y-m-d H:i:s'));
        $waktu_akhir    =strtotime($tgl); // bisa juga waktu sekarang now()
        
        //menghitung selisih dengan hasil detik
         $diff    =$waktu_akhir - $waktu_awal;


         ?>

		<div id="clockdiv">
            <div>
                <span id="hours"></span>
              
            </div>
            <div>
                <div style="width:10px;height:10px;background-color:white;border-radius:5px;margin-bottom:5px"></div>
                 <div style="width:10px;height:10px;background-color:white;border-radius:5px;margin-top:5px"></div>
            </div>
            <div>
                <span id="minutes"></span>
               
            </div>
            <div>
                <div style="width:10px;height:10px;background-color:white;border-radius:5px;margin-bottom:5px"></div>
                 <div style="width:10px;height:10px;background-color:white;border-radius:5px;margin-top:5px"></div>
            </div>
            <div>
                <span id="seconds"></span>
            </div>
        </div>

</div>

<script type="text/javascript">
	initializeClock(<?php echo $diff ?>);

    function getTimeRemaining(endtime) {
            var t = endtime;
            var seconds = parseInt(t % 60);
            var minutes = parseInt(t / 60, 10) % 60;
            var hours =  parseInt(t / (60 * 60), 10) % 24 + parseInt(t / (60 * 60 * 24), 10) * 24;
            return {
                'total': t,
                'hours': hours,
                'minutes': minutes,
                'seconds': seconds
            };
        }


        function initializeClock(endtime) {

     
            var hoursSpan = document.getElementById('hours');
            var minutesSpan = document.getElementById('minutes');
            var secondsSpan = document.getElementById('seconds');

            function updateClock() {
                endtime = endtime - 1;
                var t = getTimeRemaining(endtime);

       
                hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
                minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
                secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);

                if (t.total < 1) {
                    clearInterval(timeinterval);
                     hoursSpan.innerHTML = "00";
                    minutesSpan.innerHTML = "00";
                    secondsSpan.innerHTML = "00";
                       
                       $.ajax({
                       	url:'email',
                       	type:'GET',
                       	success:(function(data){
                       		console.log(data);
                       		initializeClock(86400);
                       	})
                       })

                }
            }

            updateClock();
            var timeinterval = setInterval(updateClock, 1000);
        }
        
  
</script>
<style>
  #clockdiv{
	font-family: sans-serif;
	color: #fff;
	margin-left: 30%;
	margin-top: 10%;
	display: inline-block;
	font-weight: 100;
	background-color:#1A3A59;
	text-align: center;
	font-size: 50px;
/*margin-top:10%;*/
/*	position:absolute;*/
/*	z-index:999;*/
}
#clockdiv > div{
	padding: 2px;
	border-radius: 10px;
	/*background-image:linear-gradient(to right, #f06826 0%, #ee1f3b 51%, #ee1f3b 100%);*/
	display: inline-block;
}
#clockdiv div > span{
	padding: 50px;
	font-size: 50pt;
	font-family: Bebas Neue;
	border-radius: 3px;
	background-image:linear-gradient(to right, #f06826 0%, #ee1f3b 51%, #ee1f3b 100%);
	display: inline-block;
}

</style>


</script>