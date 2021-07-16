

<!DOCTYPE html>
<html>
<head>
  <base href="">
  <meta charset="utf-8" />
  <title>STB</title>
  <meta name="description" content="Reparasi Sepatu Terbaik di Indonesia. Lebih dari sekedar menyegarkan tampilannya, tapi juga memperpanjang usia kenangannya.">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- area css -->
    <link href="https://new.shoeworkshop.id/admin/assets/css/pagePreloaders.css" rel="stylesheet" type="text/css" />
    <link href="https://new.shoeworkshop.id/admin/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="https://new.shoeworkshop.id/admin/assets/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="https://new.shoeworkshop.id/admin/assets/css/selectize.css" rel="stylesheet" type="text/css" />
    <link href="https://new.shoeworkshop.id/admin/assets/css/app.css" rel="stylesheet" type="text/css" />
    <link href="https://new.shoeworkshop.id/admin/assets/css/flaticon/flaticon.css" rel="stylesheet" type="text/css" />
    <link href="https://new.shoeworkshop.id/admin/assets/css/flaticon2/flaticon.css" rel="stylesheet" type="text/css" />
    <link href="https://new.shoeworkshop.id/admin/assets/css/bootstrap-datepicker.css" rel="stylesheet" type="text/css" />
    <link href="https://new.shoeworkshop.id/admin/assets/css/line-awesome/css/line-awesome.css" rel="stylesheet" type="text/css" />
    <link href="https://new.shoeworkshop.id/admin/assets/css/chart.css" rel="stylesheet" type="text/css" />  
    <link rel="stylesheet" type="text/css" href="https://new.shoeworkshop.id/admin/assets/css/app.css">
    
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

      <script type="text/javascript" src="https://new.shoeworkshop.id/admin/assets/js/jquery.min.js"></script>

  <script type="text/javascript" src="https://new.shoeworkshop.id/admin/assets/js/dataTables.min.js"></script>

  <script type="text/javascript" src="https://new.shoeworkshop.id/admin/assets/js/dataTables.bootstrap4.min.js"></script>

  <script type="text/javascript" src="https://new.shoeworkshop.id/admin/assets/js/notify.js"></script>


 <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

  <script type="text/javascript" src="https://new.shoeworkshop.id/admin/assets/js/pagePreloaders.js"></script>

  <script type="text/javascript" src="https://new.shoeworkshop.id/admin/assets/js/popper.min.js"></script>

  <script type="text/javascript" src="https://new.shoeworkshop.id/admin/assets/js/bootstrap.min.js"></script>

  <script type="text/javascript" src="https://new.shoeworkshop.id/admin/assets/js/selectize.js"></script>

  <script type="text/javascript" src="https://new.shoeworkshop.id/admin/assets/js/bootstrap-datepicker.js"></script>

  <script type="text/javascript" src="https://new.shoeworkshop.id/admin/assets/js/moment.js"></script>

  <script type="text/javascript" src="https://new.shoeworkshop.id/admin/assets/js/chart.js"></script>

  <script type="text/javascript" src="https://new.shoeworkshop.id/admin/assets/js/app.js"></script>
    

    <link rel="manifest" href="https://new.shoeworkshop.id/admin/manifest.json">

    <!-- area icon -->

  <link rel="shortcut icon" href="https://new.shoeworkshop.id/admin/assets/images/icon.png" />
</head>

<div id="loader">
  <img src="https://new.shoeworkshop.id/admin//assets/images/loading.gif" width="200">

 
</div>

<div id="flash-message-error">
  test
</div>
<div id="flash-message-success">
  test
</div>




<div class="container" >
  
<div class="row">
  <div class="col col-sm-12" style="padding: 5%;padding-left: 15%;padding-top: 2%;">

     <blockquote class="blockquote" style="margin-top: 5%">
     
        <hr/>
        <footer class="blockquote-footer" style="color:#000">
           Ubah Password User </footer>
      </blockquote>
  </div>
    

  <div class="col col-sm-6">
    <form method="POST" action="http://1.1.26.116:88/setiabudhi/login/ubah_password">
      
      <div class="form-group">
        <label for="username">Username</label>
          <input required="required" type="text" name="username" autocomplete="off" autofocus="autofocus" class="form-control" value="<?php echo $_GET['username'] ?>" readonly="readonly">
      </div>
       <div class="form-group">
        <label for="username" class="AppLabel">Password</label>
          <input required="required" type="password" name="password" autocomplete="off" class="form-control">
      </div>
    <div class="form-group">
        <button type="SUBMIT" class="btn btn-primary  col-sm-12">Ubah Password</button>
    </div>
    </form> 

   
  </div>
  
  </div>
</div>

<?php
if(!empty($_POST)){
  $username = $_POST['username'];
  $password = sha1($_POST['password']);

  $sql= "UPDATE master_user SET password='$password' WHERE username='$username'";
  if ($conn->query($sql)) {
    # code...
    redirect('./');
  }

}

?>

