<!DOCTYPE html>
<html>
<head>
	<base href="">
	<meta charset="utf-8" />
	<title><?php echo $title ?></title>
	<meta name="description" content="Fachreza Maulana Framework">
	 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- area css -->
  <link type="text/css" href="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/css/dataTables.checkboxes.css" rel="stylesheet" />
    <link href="<?php echo site_url() ?>assets/css/pagePreloaders.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo site_url() ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo site_url() ?>assets/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo site_url() ?>assets/css/selectize.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo site_url() ?>assets/css/app.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo site_url() ?>assets/css/flaticon/flaticon.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo site_url() ?>assets/css/flaticon2/flaticon.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo site_url() ?>assets/css/bootstrap-datepicker.css" rel="stylesheet" type="text/css" />

      <!-- <link href="<?php echo site_url() ?>assets/css/bootstrap-datetimepicker.css" rel="stylesheet" type="text/css" /> -->
    

    <link href="<?php echo site_url() ?>assets/css/line-awesome/css/line-awesome.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo site_url() ?>assets/css/chart.css" rel="stylesheet" type="text/css" />  
    <link rel="stylesheet" type="text/css" href="<?php echo site_url() ?>assets/css/app.css">

      <script type="text/javascript" src="<?php echo site_url() ?>assets/js/jquery.min.js"></script>

  <script type="text/javascript" src="<?php echo site_url() ?>assets/js/dataTables.min.js"></script>

  <script type="text/javascript" src="<?php echo site_url() ?>assets/js/dataTables.bootstrap4.min.js"></script>

  <script type="text/javascript" src="<?php echo site_url() ?>assets/js/notify.js"></script>



  <script type="text/javascript" src="<?php echo site_url() ?>assets/js/pagePreloaders.js"></script>

  <script type="text/javascript" src="<?php echo site_url() ?>assets/js/popper.min.js"></script>

  <script type="text/javascript" src="<?php echo site_url() ?>assets/js/bootstrap.min.js"></script>

  <script type="text/javascript" src="<?php echo site_url() ?>assets/js/selectize.js"></script>

  <script type="text/javascript" src="<?php echo site_url() ?>assets/js/bootstrap-datepicker.js"></script>
  <!--  <script type="text/javascript" src="<?php echo site_url() ?>assets/js/bootstrap-datetimepicker.js"></script> -->

  <script type="text/javascript" src="<?php echo site_url() ?>assets/js/moment.js"></script>

  <script type="text/javascript" src="<?php echo site_url() ?>assets/js/chart.js"></script>

  <script type="text/javascript" src="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/js/dataTables.checkboxes.min.js"></script>
  
  <script type="text/javascript" src="<?php echo site_url() ?>assets/js/app.js"></script>
   <script src="https://code.responsivevoice.org/responsivevoice.js?key=VAaAUteA"></script>
    

    <link rel="manifest" href="<?php echo site_url() ?>manifest.json">

    <!-- area icon -->

  <link rel="shortcut icon" href="<?php echo site_url() ?>assets/images/icon.png" />
</head>

<div id="loader">
  <img src="<?php echo site_url()?>/assets/images/loader.png" width="200">
</div>
<div id="flash-message-error">
  test
</div>
<div id="flash-message-success">
  test
</div>

<?php
    if(isset($_SESSION['username'])){


 $nav = explode("/", $_SERVER['REQUEST_URI']);

$menu = $nav[2];

?>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">
    <img src="<?php echo site_url() ?>assets/images/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
         <li class="nav-item <?php echo $menu=="" ? "active":"" ?>">
        <a class="nav-link" href="<?php echo site_url() ?>">Home <span class="sr-only">(current)</span></a>
      </li>

         <li class="nav-item <?php echo $menu=="" ? "active":"" ?>">
        <a class="nav-link" href="<?php echo site_url('store/cek') ?>">Cek Harga</a>
      </li>


         <li class="nav-item <?php echo $menu=="" ? "active":"" ?>">
        <a class="nav-link" href="<?php echo site_url('store/cek_inventory') ?>">Cek Stok</a>
      </li>
   
   
 <!--        <li class="nav-item">
        <a class="nav-link" href="<?php echo site_url('users') ?>">User</a>
      </li> -->

<?php if ($_SESSION['username']!=="hrd" AND $_SESSION['username']!=="store"): ?>
  
      <li class="nav-item dropdown">
        <a  class="nav-link dropdown-toggle <?php echo $menu=="counter" ? "active":"" ?>" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Accounting
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="<?php echo site_url('counter') ?>">Penjualan Counter</a>
            <a class="dropdown-item" href="<?php echo site_url('cndn') ?>">CNDN Account Payable</a>
              <a class="dropdown-item" href="<?php echo site_url('cndn/pa') ?>">Purchase Advance</a>
              <a class="dropdown-item" href="<?php echo site_url('cndn/sa') ?>">Sales Advance</a>
              <a class="dropdown-item" href="<?php echo site_url('cndn/va') ?>">Mutasi Voucher</a>
              <a class="dropdown-item" href="<?php echo site_url('cndn/pembelian') ?>">Analisa Pembelian</a>
               <a class="dropdown-item" href="<?php echo site_url('cndn/service') ?>">PO Biaya</a>
                <a class="dropdown-item" href="<?php echo site_url('cndn/inv') ?>">Penjualan Invoice</a>
            <a href="" class="divider" style="background-color: orange;width">&nbsp;</a>

             <a class="dropdown-item" href="<?php echo site_url('payment') ?>">Create Paymnet</a>

               <a class="dropdown-item" href="<?php echo site_url('payment/payment_download') ?>">Download Paymnet</a>
               <a class="dropdown-item" href="<?php echo site_url('product_tree/sales') ?>">Sales Analysis</a>
        </div>
      </li>



      <li class="nav-item dropdown">
        <a  class="nav-link dropdown-toggle <?php echo $menu=="product_tree" ? "active":"" ?>" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Purchasing
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="<?php echo site_url('product_tree/sla') ?>">Service Level Supplier (%)</a>
          <a class="dropdown-item" href="<?php echo site_url('product_tree') ?>">Product Tree</a>
            <a class="dropdown-item" href="<?php echo site_url('grn') ?>">Analisa GRN</a>
            <a class="dropdown-item" href="<?php echo site_url('product_tree/promo') ?>">Download Promo Template</a>
             <a class="dropdown-item" href="<?php echo site_url('product_tree/pindah') ?>">tambah/pindah sku supplier</a>
               <a href="" class="divider"></a>
             <a class="dropdown-item" href="<?php echo site_url('store/kosong_prch') ?>">Data Barang Kosong</a>
             <a href="" class="divider"></a>
             <!-- <a class="dropdown-item" href="<?php echo site_url('product_tree/po') ?>">Create PO</a> -->
             <a class="dropdown-item" href="<?php echo site_url('product_tree/harga') ?>">Tarik Harga Jual</a>

        </div>
      </li>

      <li class="nav-item dropdown">
        <a  class="nav-link dropdown-toggle <?php echo $menu=="product_tree" ? "active":"" ?>" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Receiving
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="<?php echo site_url('antre') ?>">Antrian Supplier</a>
            <a class="dropdown-item" href="<?php echo site_url('antre/detail') ?>">Antrean Detail</a>

                  <a class="dropdown-item" href="<?php echo site_url('antre/laporan') ?>">Laporan</a>
                  <a href="" class="divider"></a>
                  <a class="dropdown-item" href="<?php echo site_url('antre/analisa') ?>">Cari PO</a>

                  <a class="dropdown-item" href="<?php echo site_url('antre/exp') ?>">Product Expired</a>

                  <a class="dropdown-item" href="<?php echo site_url('antre/alias') ?>">Supplier Alias</a>
                   <a class="dropdown-item" href="<?php echo site_url('antre/serah') ?>">Serah Terima Retur</a>
                    <a class="dropdown-item" href="<?php echo site_url('antre/kirim') ?>">Print Alamat Supplier</a>
                     <a class="dropdown-item" href="<?php echo site_url('antre/tolak') ?>">Print Tolakan Barang</a>


        </div>
      </li>
<?php endif ?>

<?php if ($_SESSION['username']==="hrd"): ?>
  
      <li class="nav-item dropdown">
        <a  class="nav-link dropdown-toggle <?php echo $menu=="hrms" ? "active":"" ?>" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          HRMS
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="<?php echo site_url('hrms/data_absen') ?>">Data Absen</a>
            <a class="dropdown-item" href="<?php echo site_url('hrms/data_karyawan') ?>">Data Karyawan</a>
        </div>
      </li>
<?php endif ?>


<?php if ($_SESSION['username']==="store"): ?>
  
      <li class="nav-item dropdown">
        <a  class="nav-link dropdown-toggle <?php echo $menu=="hrms" ? "active":"" ?>" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          MENU OPRASIONAL
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="<?php echo site_url('store') ?>">Print POP</a>
           <a class="dropdown-item" href="<?php echo site_url('store/kosong') ?>">Data Barang Kosong</a>
           <a class="dropdown-item" href="<?php echo site_url('store/kupon') ?>">Print Kupon</a>
       
        </div>
      </li>
<?php endif ?>


     


      <!--  <li class="nav-item <?php echo $menu=="cndn2" ? "active":"" ?>">
        <a class="nav-link" href="<?php echo site_url('cndn2') ?>">CNDN Account Receivable </a>
      </li>

 -->
  


  
    </ul>
    <ul class="navbar-nav ml-auto">

    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Hallo Selamat datang,<strong> <?php echo $_SESSION['nama_lengkap'] ?></strong></a>
      <div class="dropdown-menu" aria-labelledby="navbarDropdown">
         <a class="dropdown-item" href="<?php echo site_url() ?>/test/ubah_password.php?username=<?php echo $_SESSION['username'] ?>">Ubah Password</a>
        <a class="dropdown-item" href="<?php echo site_url() ?>/login/logout">Logout</a>
      </div>
    </li>
  </ul>
  </div>
</nav>

<?php
  }
?>



