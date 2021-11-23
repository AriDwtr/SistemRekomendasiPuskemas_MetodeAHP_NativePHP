<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="">Home</a></li>
          <li class="breadcrumb-item active">Registrasi Pasien</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
  <?php
  if (isset($_POST["submit"]))
      {
          $nik=$_POST['nik'];
          $nama=$_POST['nama'];
          $jk=$_POST['jk'];
          $tgl_lahir=$_POST['tgl'];
          $alamat=$_POST['alamat'];
          $layanan=$_POST['layanan'];
          $no_layanan=$_POST['no_layanan'];
          $tanggal_regis=date('Y-m-d');
          $data = mysqli_query($conn, "SELECT * FROM pasien WHERE nik='$nik'");
          $row = mysqli_fetch_array($data);
          if ($row > 0) {
            echo '<div class="alert alert-danger alert-dismissible" id="success-alert">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <i class="icon fas fa-check"></i>NIK TELAH TERDAFTAR !!!
            </div>';
          } else {
            $input=mysqli_query($conn,"INSERT INTO pasien VALUES('','$nik','$nama','$jk','$tgl_lahir','$alamat','$layanan','$no_layanan','$tanggal_regis')");
            echo "<script>window.location.href='index.php?page=Pasien';</script>";
            exit;
          }
        }
   ?>

  <!-- Default box -->
  <div class="card">
    <div class="card-header">
      <h3 class="card-title"><i class="far fas fa-user-plus nav-icon"></i> <b>Form Registrasi Pasien</b></h3>
    </div>
    <div class="card-body">
      <form method="post" action="" enctype="multipart/form-data" onSubmit="window.location.reload()">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>NIK</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-user"></i></span>
                </div>
                <input type="text" name="nik" class="form-control" data-inputmask="'mask': ['9999999999999999']" data-mask required>
              </div>
              <!-- /.input group -->
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="exampleInputEmail1">Nama Lengkap</label>
              <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" required>
            </div>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Jenis Kelamin :</label>
              <div class="row">
                <div class="col-sm-6">
                  <div class="custom-control custom-radio">
                    <input class="custom-control-input" name="jk" value="l" type="radio" id="customRadio1" name="customRadio">
                    <label for="customRadio1" class="custom-control-label"><i class="far fas fa-male fa-lg nav-icon"></i> Laki - Laki</label>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="custom-control custom-radio">
                    <input class="custom-control-input" name="jk" value="p" type="radio" id="customRadio2" name="customRadio" checked>
                    <label for="customRadio2" class="custom-control-label"><i class="far fas fa-female fa-lg nav-icon"></i> Perempuan</label>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label>Tanggal Lahir</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-birthday-cake"></i></span>
                </div>
                <input type="date" name="tgl" class="form-control" required>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>Alamat</label>
              <textarea class="form-control" name="alamat" rows="5" placeholder="Masukan Alamat Pasien" required></textarea>
            </div>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label>Pilih Layanan Kesehatan</label>
              <select class="form-control" id='dropdown' name="layanan">
                <option value="umum">Umum</option>
                <option value="bpjs">BPJS</option>
                <option value="sktm">SKTM</option>
                <option value="kis">KIS</option>
                <option value="dll">Dan Lain-Lain</option>
              </select>
            </div>
          </div>
          <div class="col-md-8">
            <div class="form-group" id="textInput" hidden>
              <label for="exampleInputEmail1">Nomor Peserta</label>
              <input type="number" name="no_layanan" class="form-control" placeholder="Nomor Peserta">
            </div>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-md-4">
            <button type="reset" class="btn btn-warning"style="color:white;">Batal</button>
            &nbsp&nbsp<button name="submit" type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </div>
      </form>
    </div>
    <!-- /.card-body -->
    <!-- /.card-footer-->
  </div>
  <!-- /.card -->

</section>
