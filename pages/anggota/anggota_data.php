<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <a data-toggle="modal" data-target="#modal-add" class="btn btn-success" style="color:white" data-toggle="tooltip">Anggota <i class="fas fa-plus"></i></a>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Data Anggota</li>
        </ol>
      </div>
      <!-- modal -->
      <div class="modal fade" id="modal-add">
        <div class="modal-dialog modal-md">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"></i>Tambah User</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form class="" action="" method="post">
              <div class="clearfix">
                <div class="row">
                    <div class="col-md-6" align="Left">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" required>
                      </div>
                    </div>
                    <div class="col-md-6" align="Left">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Nomor Induk Pegawai (NIP)</label>
                        <input type="number" name="nip" class="form-control" placeholder="Nomor induk Pegawai" required>
                      </div>
                    </div>
                    <div class="col-md-6" align="Left">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Tanggal Lahir</label>
                        <input type="date" name="tl" class="form-control" placeholder="Tanggal / Bulan / Tahun" required>
                      </div>
                    </div>
                    <div class="col-md-6" align="Left">
                      <div class="form-group">
                        <label>Jabatan</label>
                        <select class="form-control" name="jabatan">
                          <option value="dokter">Dokter</option>
                          <option value="pegawai">Pegawai</option>
                          <option value="suster">Suster</option>
                          <option value="admin">Administrator</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6" align="left">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Username</label>
                        <input type="text" name="username" class="form-control" placeholder="UserName" required>
                      </div>
                    </div>
                    <div class="col-md-6" align="left">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Password</label>
                        <input type="password" name="pass" class="form-control" placeholder="Password" required>
                      </div>
                    </div>
                    <div class="col-md-12" align="left">
                      <button class="btn btn-danger" type="reset">Batal</button>&nbsp<button class="btn btn-success" type="submit" name="add">Tambahkan</button>
                    </div>
                </div>
              </div>
            </form>
          </div>
          <?php
          include 'conn/koneksi.php';
          if (isset($_POST['add'])) {
            $nama=$_POST['nama'];
            $user=$_POST['username'];
            $pass=$_POST['pass'];
            $tipe=$_POST['jabatan'];
            $nip=$_POST['nip'];
            $lahir=$_POST['tl'];
            mysqli_query($conn,"INSERT INTO user VALUES ('','$nama','$user','$pass','$tipe','$nip','$lahir')");
            echo "<script>window.location.href='index.php?page=Anggota';</script>";
            exit;
          }
            ?>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

  <!-- Default box -->

  <div class="card">
    <div class="card-header">
      <h3 class="card-title"><i class="far fas fa-address-book nav-icon"></i> <b>DATA ANGGOTA</b></h3>
    </div>
    <div class="card-body">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th style="width: 10px">No</th>
            <th>NIP</th>
            <th>Nama</th>
            <th>Username</th>
            <th style="width: 40px">Jabatan</th>
            <th style="width:200px"></th>
          </tr>
        </thead>
        <tbody>
          <?php
          include 'conn/koneksi.php';
          $query=mysqli_query($conn,"SELECT * FROM user");
          while ($data=mysqli_fetch_array($query)) {
            echo "<tr>";
            echo "<td>".$data['id']."</td>";
            echo "<td>".$data['nip']."</td>";
            echo "<td>".$data['nama']."</td>";
            echo "<td>".$data['username']."</td>";
            echo "<td>".$data['tipe']."</td>";
            echo "<td>";?>
            <a class="btn btn-primary" data-toggle="modal" data-target="#modal-detail<?php echo $data['id'];?>" style="color:white" title="Detail"><i class="fas fa-eye"></i></a>
            <a class="btn btn-danger" href="index.php?page=Delete_User&id=<?php echo $data['id'];?>" style="color:white" data-toggle="tooltip" onClick="return confirm('Apakah Anda Yakin Menghapus User?')" title="Hapus Pasien"><i class="fas fa-trash"></i></a>
          <?php
            echo "</td>";
            echo "</tr>";
          ?>
          <!-- modal -->
          <div class="modal fade" id="modal-detail<?php echo $data['id'];?>">
            <div class="modal-dialog modal-md">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title"></i>Detail User</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="clearfix">
                    <div class="row">
                        <div class="col-md-6" align="Left">
                          <div class="form-group">
                            <label for="exampleInputEmail1">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" value="<?php echo $data['nama'] ?>" readonly>
                          </div>
                        </div>
                        <div class="col-md-6" align="Left">
                          <div class="form-group">
                            <label for="exampleInputEmail1">Nomor Induk Pegawai</label>
                            <input type="text" name="nama" class="form-control" value="<?php echo $data['nip'] ?>" readonly>
                          </div>
                        </div>
                        <div class="col-md-6" align="left">
                          <div class="form-group">
                            <label for="exampleInputEmail1">Username</label>
                            <input type="text" name="username" class="form-control" value="<?php echo $data['username'] ?>" readonly>
                          </div>
                        </div>
                        <div class="col-md-6" align="left">
                          <div class="form-group">
                            <label for="exampleInputEmail1">Password</label>
                            <input type="text" name="pass" class="form-control" value="<?php echo $data['password'] ?>" readonly>
                          </div>
                        </div>
                    </div>
                  </div>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->

          <?php };
           ?>
        </tbody>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->

</section>
