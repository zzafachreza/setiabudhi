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


$host="localhost";
$db="ci";
$user="root";
$pass="";
$MyConn=new PDO("mysql:host=$host;dbname=$db",$user,$pass);



?>
<style type="text/css">
	.autocomplete-items {
  position: absolute;
  border: 1px solid #d4d4d4;
  border-bottom: none;
  border-top: none;
  z-index: 99;
  /*position the autocomplete items to be the same width as the container:*/
  top: 100%;
  left: 0;
  right: 0;
}
.autocomplete-items div {
  padding: 10px;
  cursor: pointer;

  background-color: #fff;
  border-bottom: 1px solid #d4d4d4;
}
.autocomplete-items div:hover {
  /*when hovering an item:*/
  background-color: #0d6efd;
  color: #FFF;
}
.autocomplete-active {
  /*when navigating through the items using the arrow keys:*/
  background-color: DodgerBlue !important;
  color: #ffffff;
}
</style>
<div class="container">
	<center>
		<h3>TAMBAH SERAH TERIMA</h3>
	</center>

	<form  method="POST" id="myForm">
		<div class="row">
	
		<div class="col col-sm-12">
			<div class="from-group">
				
				<label>Select Retur + Supplier</label>
				<select class="form-control" required="required" id="select_retur">
					<option></option>
					<?php
							$sql="select AppNumber as no_retur,AppDesc as Keterangan, AppSuplier,supname,convert(float,dnAmount) as harga 
								from dbo.PRReturHd inner join SMSupplierMs
								on PRReturHd.AppSuplier = SMSupplierMs.supid
								 WHERE AppDate >= '2021-01-01'";



							$hasil = $conn->query($sql);
							while ($a = $hasil->fetch()) {
								# code...
							
					?>

					<option value="<?php echo $a['no_retur'] ?>|<?php echo $a['supname'] ?>"><strong><?php echo $a['no_retur'] ?></strong><?php echo " (".$a['AppSuplier']." - ".$a['supname'].")" ?></option>
		
					<?php
						}

					?>
				</select>
				
			</div>
		</div>

		<div class="col col-sm-6">
			<div class="from-group">
				<br/>	
				<label>Tanggal</label>
				<input type="date" name="tgl" class="form-control" id="tgl" autocomplete="off" required="required" placeholder="masukan Tanggal">
			</div>
		</div>
		<div class="col col-sm-6">
			<div class="from-group">
				<br/>
				<label>Pengambil</label>
				<input type="text" id="myInput" name="keterangan" placeholder="masukan Pengambil" class="form-control" autocomplete="off" required="required">
			</div>
		</div>
		<input type="hidden" id="no_retur" name="no_retur" class="form-control" autocomplete="off" required="required">
		<input type="hidden" id="nama_supplier"name="nama_supplier"  class="form-control" autocomplete="off" required="required">

		<div class="col col-sm-12" style="margin-top: 5%">
			<center>
				<button class="btn btn-success col-sm-5">SMPAN TRANSAKSI</button>	
			</center>
		</div>
	</div>
	</form>
</div>



<?php

function tglSql($tgl){
	$tgl = explode("/", $tgl);
	return $tgl[2]."-".$tgl[1]."-".$tgl[0];
}

if (!empty($_POST)) {
	# code...
	$no_retur = $_POST['no_retur'];
	$tgl = $_POST['tgl'];
	$nama_supplier = str_replace("'", "\'", $_POST['nama_supplier']);
	$keterangan = $_POST['keterangan'];

	echo $sql = "INSERT INTO serah(no_retur,tgl,nama_supplier,keterangan) VALUES('$no_retur','$tgl','$nama_supplier','$keterangan')";
	
	$MyConn->query($sql);
	redirect('antre/serah');

	}





?>

<script type="text/javascript">


	$(window).keydown(function(event) {
		  if(event.keyCode == 16) { 
		    $("#myForm").submit();
		    event.preventDefault(); 
		  }
		});



	$('#select_retur').selectize();

	$('#select_retur')[0].selectize.focus();



	


	$("#select_retur").change(function(e){
										e.preventDefault()

										var sup = $(this).val().split("|");
										var no_retur = sup[0];
										var nama_supplier = sup[1];

										$("#no_retur").val(no_retur);
										$("#nama_supplier").val(nama_supplier);

										$("#tgl").focus();

								});

var countries = [
	
<?php
							$sqlb="SELECT DISTINCT keterangan FROM serah";



							$hasilb = $MyConn->query($sqlb);
							while ($b = $hasilb->fetch()) {
								# code...
							
					 echo '"'.$b['keterangan'].'",';
		
					
						}

					?>


];

function autocomplete(inp, arr) {
  /*the autocomplete function takes two arguments,
  the text field element and an array of possible autocompleted values:*/
  var currentFocus;
  /*execute a function when someone writes in the text field:*/
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      /*close any already open lists of autocompleted values*/
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/
      for (i = 0; i < arr.length; i++) {
        /*check if the item starts with the same letters as the text field value:*/
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          /*create a DIV element for each matching element:*/
          b = document.createElement("DIV");
          /*make the matching letters bold:*/
          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].substr(val.length);
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
              b.addEventListener("click", function(e) {
              /*insert the value for the autocomplete text field:*/
              inp.value = this.getElementsByTagName("input")[0].value;
              /*close the list of autocompleted values,
              (or any other open lists of autocompleted values:*/
              closeAllLists();
          });
          a.appendChild(b);
        }
      }
  });
  /*execute a function presses a key on the keyboard:*/
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        e.preventDefault();
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomplete-active":*/
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
      x[i].parentNode.removeChild(x[i]);
    }
  }
}
/*execute a function when someone clicks in the document:*/
document.addEventListener("click", function (e) {
    closeAllLists(e.target);
});
}
autocomplete(document.getElementById("myInput"), countries);
</script>