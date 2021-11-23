<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" href="dist/img/puskesmas.png" type="image/icon type">
  <title>PUSKESMAS | WAIWERANG</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <style>
    body {
      background-image:url('dist/img/tampilan.jpg');
      background-repeat: no-repeat;
      background-size: auto;
    }
  </style>
</head>
<body class="hold-transition login-page" style="background-image:url('dist/img/2554554.jpg');background-size: cover">
<div class="login-box">
  <div class="login-logo">
  </div>
  <!-- /.login-logo -->
  <?php
  if (isset($_POST['submit'])) {
    include "pages/conn/koneksi.php";
    session_start();
    $usename = $_POST['user'];
    $password = $_POST['pass'];
    $query=mysqli_query($conn,"SELECT * From user WHERE username='$usename' AND password='$password'");
    $row=mysqli_num_rows($query);
    if ($row > 0) {
      $data=mysqli_fetch_assoc($query);
      $_SESSION['user']=$usename;
      $_SESSION['nama']=$data['nama'];
      $_SESSION['tipe']=$data['tipe'];
      $_SESSION['nip']=$data['nip'];
    	header("Location:pages/index.php");
    }else {
      echo "<div class='alert alert-danger alert-dismissible'  id='batal-alert'>
                      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                      <h6><i class='icon fas fa-ban'></i> Username Dan Password salah </h6>
                      Tolong cek ulang dan lapor kepada admin
                    </div>";
    }
  }

   ?>
  <div class="card">
    <div class="card-body login-card-body">
      <center><img src="dist/img/puskesmas.png" class="user-image img-circle elevation-2" height="100" width="100"  alt="User Image"></center><br>
      <form action="" method="post" enctype="multipart/form-data">
        <div class="input-group mb-3">
          <input type="text" name="user" class="form-control" placeholder="Nama Pengguna" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="pass" class="form-control" placeholder="Kata Sandi" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" name="submit" class="btn btn-primary btn-block">Masuk</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>

</body>
</html>
<script>
$("#batal-alert").fadeTo(3000, 500).slideUp(500, function(){
$("#batal-alert").slideUp(500);
});
</script>
