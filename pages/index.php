<?php
include "conn/koneksi.php";
session_start();
if (!isset($_SESSION['user'])){
	header("Location:../index.php");
}

$penjualan  = mysqli_query($conn, "SELECT jumlah FROM grafik order by no asc");
$merk       = mysqli_query($conn, "SELECT tipe FROM grafik order by no asc");
 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" href="../dist/img/puskesmas.png" type="image/icon type">
  <title>PUSKESMAS | WAIWERANG</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../plugins/jqvmap/jqvmap.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="../plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <script src="js/Chart.js"></script>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- user-->
        <li class="nav-item dropdown user-menu">
          <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
            <img src="../dist/img/user.png" class="user-image img-circle elevation-2" alt="User Image">
            <span class="d-none d-md-inline"><?php echo $_SESSION['user'];?></span>
          </a>
          <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <!-- User image -->
            <li class="user-header bg-default">
              <img src="../dist/img/user.png" class="img-circle elevation-2" alt="User Image">

              <p>
                <?php echo $_SESSION['nama'];?>
								<small><b>NIP: <?php echo $_SESSION['nip'];?></b></small>
                <small><?php echo $_SESSION['tipe'];?></small>
              </p>
            </li>
            <!-- Menu Body -->
            <li class="user-body">
              <div class="row">
                <div class="col-4 text-center">
                  <a href="#"></a>
                </div>
                <div class="col-4 text-center">
                  <a href="#"></a>
                </div>
                <div class="col-4 text-center">
                  <a href="logout.php">Logout</a>
                </div>
              </div>
              <!-- /.row -->
            </li>
          </ul>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-light-primary elevation-4">
      <!-- Brand Logo -->
      <a class="brand-link" style="color:green">
        <img src="../dist/img/puskesmas.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
        style="opacity:2.8">
        <span class="brand-text font-weight-light">PUSKESMAS</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
            with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="index.php" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Home
                  <span class="right badge badge-danger">New</span>
                </p>
              </a>
            </li>
            <li class="nav-item has-treeview menu-close">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-user"></i>
                <p>
                  Data Pasien
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="index.php?page=Pasien" class="nav-link">
                    <i class="far fas fa-address-book fa-2x nav-icon"></i>
                    <p>Data Pasien</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item has-treeview menu-close">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-book-medical"></i>
                <p>
                  Rekam Medis
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="index.php?page=Rekmed" class="nav-link">
                    <i class="far fas fa-hand-holding-medical nav-icon"></i>
                    <p>Data Rekam Medis</p>
                  </a>
                </li>
              </ul><hr>
            </li>
						<?php if ($_SESSION['tipe'] < "pegawai") {
							?>
            <li class="nav-item has-treeview menu-close">
              <a href="index.php?page=Anggota" class="nav-link">
                <i class="nav-icon fas fa-user-plus"></i>
                <p>
                  User
                </p>
              </a>
            </li>
					<?php };?>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <?php
      if(isset($_GET['page'])){
        $page = $_GET['page'];

        switch ($page) {
          case 'Regist':
          include "pasien/form_Regist.php";
          $status = "active";
          break;
          case 'Pasien':
          include "pasien/form_data.php";
          $status = "active";
          break;
          case 'Rekmed':
          include "rekmed/rekmed_data.php";
          $status = "active";
          break;
          case 'Form_Rekmde':
          include "rekmed/rekmed_info.php";
          $status = "active";
          break;
          case 'Form_Detail':
          include "rekmed/rekmed_detail.php";
          $status = "active";
          break;
					case 'Delete_Rek':
          include "rekmed/rekmed_delete.php";
          $status = "active";
          break;
          case 'Delete_Pasien':
          include "pasien/hapus_pasien.php";
          $status = "active";
          break;
          case 'Edit_Pasien':
          include "pasien/form_edit.php";
          $status = "active";
          break;
          case 'Anggota':
          include "anggota/anggota_data.php";
          $status = "active";
          break;
					case 'Delete_User':
          include "anggota/anggota_hapus.php";
          $status = "active";
          break;


        }
      }else{
        include "home.php";
      }

      ?>
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <strong>Copyright &copy; 2020 <a href="#">Puskesmas Waiwerang</a>.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 1.0
      </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="../plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="../plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- ChartJS -->
<script src="../plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="../plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="../plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- Select2 -->
<script src="../plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="../plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- InputMask -->
<script src="../plugins/moment/moment.min.js"></script>
<script src="../plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<!-- daterangepicker -->
<script src="../plugins/moment/moment.min.js"></script>
<script src="../plugins/daterangepicker/daterangepicker.js"></script>
<!-- bs-custom-file-input -->
<script src="../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Bootstrap Switch -->
<script src="../plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- Summernote -->
<script src="../plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<script>
  $(function () {

    $(document).on("click", "input[type='checkbox']", function(){
    total=0;
    value=0;
    $("input[type='checkbox']:checked").each(function(){
        total += parseFloat($(this).val())
        value = parseFloat(total).toFixed(2);
    })
    $("input[name='anamnesa']").val(value)
})
    $(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
    });

    $("#example1").DataTable({
     "responsive": true,
     "autoWidth": false,
   });

    $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
    $("#success-alert").slideUp(500);
    });

    $('#dropdown').change(function() {
    if( $(this).val() == "bpjs") {
        $('#textInput').prop( "hidden", false );
    } else if ( $(this).val() == "kis") {
      $('#textInput').prop( "hidden", false );
    } else if ( $(this).val() == "sktm") {
      $('#textInput').prop( "hidden", false );
    } else if ( $(this).val() == "dll") {
      $('#textInput').prop( "hidden", false );
    }
     else {
        $('#textInput').prop( "hidden", true );
    }
  });
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservationdate').datetimepicker({
        format: 'L'
    });

    //Timepicker
    $('#timepicker').datetimepicker({
      format: 'LT'
    })

    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()

    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });

  })

  var ctx = document.getElementById("piechart").getContext("2d");
  var data = {
            labels: [<?php while ($p = mysqli_fetch_array($merk)) { echo '"' . $p['tipe'] . '",';}?>],
            datasets: [
            {
              label: "Grafik Pasien",
              data: [<?php while ($p = mysqli_fetch_array($penjualan)) { echo '"' . $p['jumlah'] . '",';}?>],
              backgroundColor: [
                '#8ad8f2',
                '#fff829',
                '#ff0000',
              ]
            }
            ]
            };

  var myPieChart = new Chart(ctx, {
                  type: 'pie',
                  data: data,
                  options: {
                    responsive: true
                }
              });

							var ctx = document.getElementById("myChart").getContext('2d');
									var myChart = new Chart(ctx, {
										type: 'bar',
										data: {
											labels: ["Perempuan", "Laki-Laki"],
											datasets: [{
												label: '',
												data: [
												<?php
												$Dewasa = mysqli_query($conn,"SELECT * FROM pasien Where jk='p'");
												echo mysqli_num_rows($Dewasa);
												?>,
												<?php
												$Perempuan = mysqli_query($conn,"SELECT * FROM pasien Where jk='l'");
												echo mysqli_num_rows($Perempuan);
												?>
												],
												backgroundColor: [
												'rgba(255, 99, 132, 0.2)',
												'rgba(54, 162, 235, 0.2)'
												],
												borderColor: [
												'rgba(255,99,132,1)',
												'rgba(54, 162, 235, 1)'
												],
												borderWidth: 1
											}]
										},
										options: {
											scales: {
												yAxes: [{
													ticks: {
														beginAtZero:true
													}
												}]
											}
										}
									});

</script>
</body>
</html>
