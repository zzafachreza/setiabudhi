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

$connMy=new PDO("mysql:host=$host;dbname=$db",$user,$pass);

function tglIndonesia($tanggal){
  $namaBln = array("01" => "Januari", "02" => "Februari", "03" => "Maret", "04" => "April", "05" => "Mei", "06" => "Juni", 
           "07" => "Juli", "08" => "Agustus", "09" => "September", "10" => "Oktober", "11" => "November", "12" => "Desesmber");
           
  $tgl=substr($tanggal,8,2);
  $bln=substr($tanggal,5,2);
  $thn=substr($tanggal,0,4);
  $tanggal ="$tgl ".$namaBln[$bln]." $thn";
  return $tanggal;
}


$kode = $_GET['kode'];

?>

<table class="table table-bordered">
    <thead>
      <tr>
      <th>NO</th>
      <th>SKU</th>
      <th>PRODUCT</th>
      <th>STOK TOKO</th>
      <th>STOK GUDANG</th>
      <th>LAST PO</th>
      <th></th>
    </tr>
    </thead>
    <tbody>
      <?php

      $no=1;
        $sql="SELECT * FROM data_kosong WHERE kode='$kode'";

        // die();
        $hasil = $connMy->query($sql);

        while ($r = $hasil->fetch()) {

        
      ?>

      <tr>
        <td><?php echo $no; ?></td>
          <td><?php echo $r['sku']; ?></td>
          <td><?php echo $r['nama']; ?></td>
          <td><?php echo $r['qty_toko']; ?></td>
          <td><?php echo $r['qty_gudang']; ?></td>
          <td><?php echo $r['po']; ?></td>
   
          <td>
            <button class="hapus btn btn-danger" data-kode="<?php echo $r['kode']; ?>" data-id="<?php echo $r['id']; ?>" data-member="<?php echo $r['member']; ?>" data-tgl="<?php echo $r['tgl']; ?>">Hapus</button>
          </td>
  

      </tr>



      <?php

      $no++;    
          }

      ?>
    </tbody>
  </table>

  <script type="text/javascript">
    $(".hapus").click(function(e){
      e.preventDefault();
      var id = $(this).attr('data-id');
      var member = $(this).attr('data-member');
         var kode = $(this).attr('data-kode');
                var tgl = $(this).attr('data-tgl');
      // alert(id);

      $.ajax({
        url:'kosong_hapus',
        type:'POST',
        data:{
          id:id
        },
        success:function(data){
          console.log(data);

          location.href='kosong_add?kode='+kode+'&member='+member+'&tgl='+tgl;;

        }
      })

    })
  </script>