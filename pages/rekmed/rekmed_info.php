<?php
include "conn/koneksi.php";
$ID = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM pasien WHERE no_pasien= $ID");
$data = mysqli_fetch_array($query);
if($data['jk']=="l"){ $jk="LAKI-LAKI";}else{ $jk="PEREMPUAN";}
?>
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Rekam Medis Info</li>
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
    $anem=$_POST['anamnesa'];
    $t_anem = $anem * 0.09;
    $list = implode(",", $_POST['list_a']);
    $list_anem = preg_replace('/[0-9.]+/', '', $list);
    $list_a_number = preg_replace('/[a-z]+/', '', $list);

    $td=$_POST['td'];
    $td_data = $td.'mmhg';
    $ints = array_map('intval', explode('/', $td ));
    $awal = $ints[0];
    $akhir = $ints[1];
    $total = $awal + $akhir;
    switch ($total){

      case ($total >= 150 && $total<= 200):
      $t_td =  0.09 * 0.06;
      break;
      default: //default
      $t_td = 0.45  * 0.06;
      break;
    }

    $hr=$_POST['hr'];
    $hr_data = $hr.'x/Menit';
    switch ($hr){

      case ($hr >= 50 && $hr<= 80):
      $t_hr =  0.09 * 0.11;
      break;
      default: //default
      $t_hr = 0.45  * 0.11;
      break;
    }

    $rr=$_POST['rr'];
    $tgl_lahir=$data['tgl_lahir'];
    $rr_list = $rr.' x/Menit';
    $tanggal = new DateTime($data['tgl_lahir']);
    $today = new DateTime('today');
    $y = $today->diff($tanggal)->y;
    $m = $today->diff($tanggal)->m;
    $d = $today->diff($tanggal)->d;
    if($y > "6")
    {
      switch ($rr){

        case ($rr >= 12 && $rr<= 20):
        $t_rr =  0.09 * 0.07;
        break;
        default: //default
        $t_rr = 0.12  * 0.07;
        break;
      }
    }elseif ($y == "0") {
      switch ($rr){

        case ($rr >= 40 && $rr<= 60):
        $t_rr =  0.09 * 0.07;
        break;
        default: //default
        $t_rr = 0.12  * 0.07;
        break;
      }
    }elseif ($y > "0") {
      switch ($rr){

        case ($rr >= 20 && $rr<= 30):
        $t_rr = 0.09 * 0.07;
        break;
        default: //default
        $t_rr = 0.12  * 0.07;
        break;
      }
    };

    $suhu=$_POST['suhu'];
    $suhu_data = $suhu.' *C';
    switch ($suhu){

      case ($suhu >= 36.5 && $suhu<= 37.5):
      $t_suhu =  0.14 * 0.04;
      break;
      default: //default
      $t_suhu = 0.43  * 0.04;
      break;
    }

    $kom=$_POST['kom'];
    $data_kom = preg_split('#(?<=\d)(?=[a-z])#i', $kom);
    $t_kom = $data_kom[0] * 0.18;
    $list_kom = $data_kom[1];


    $hb=$_POST['hb'];
    if($data['jk']=="l"){
      switch ($hb){

        case ($hb >= 13 && $hb <= 17):
        $t_hb =  0.12 * 0.19;
        $evn_hb = "0,12 x 0,19";
        $bobot_hb = "1";
        $data_hb = $hb.' gr/dl';
        break;
        default: //default
        $t_hb = 0.19 * 0.19;
        $evn_hb = "0,19 x 0,19";
        $bobot_hb = "2";
        $data_hb = $hb.' gr/dl';
        break;
      }
    }else{
      switch ($hb){

        case ($hb >= 12 && $hb <= 15):
        $t_hb =  0.12 * 0.19;
        $evn_hb = "0,12 x 0,19";
        $bobot_hb = "1";
        $data_hb = $hb.' gr/dl';
        break;
        default: //default
        $t_hb = 0.19 * 0.19;
        $evn_hb = "0,19 x 0,19";
        $bobot_hb = "2";
        $data_hb = $hb.' gr/dl';
        break;
      }
    }

    $mala=$_POST['malaria'];
    $data_mala = preg_split('#(?<=\d)(?=[a-z])#i', $mala);
    $t_mala = $data_mala[0] *  0.27;
    $list_mala = $data_mala[1];
    $total_rekam = $t_anem + $t_td + $t_hr + $t_rr + $t_suhu + $t_kom + $t_hb + $t_mala;
    $skor = round($total_rekam, 2);
    $nilai = $skor * 100 ;
    switch ($nilai) {
      case ($nilai >= 25 && $nilai<= 35):
      $id_grafik = "1";
      break;
      case ($nilai < 25):
      $id_grafik = "2";
        break;
      default: //default
      $id_grafik = "3";
      break;
    }
    $tanggal_rek=date('Y-m-d');
    $input=mysqli_query($conn,"INSERT INTO rekmed VALUES('','$ID','$list_anem','$td_data','$hr_data','$rr_list','$suhu_data','$list_kom','$data_hb','$list_mala','$total_rekam','$tanggal_rek')");
    if ($input)
    {
      $input=mysqli_query($conn,"INSERT INTO spk VALUES('','$list_anem','$list_a_number','$t_anem','$td','$hr','$rr','$tgl_lahir','$suhu','$list_kom','$hb','$bobot_hb','$evn_hb','$t_hb','$list_mala','$total_rekam')");
      $grafik=mysqli_query($conn,"UPDATE grafik SET jumlah=jumlah + 1 WHERE no='$id_grafik'");
      ?>

      <div class="alert alert-success alert-dismissible" id="success-alert">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <i class="icon fas fa-check"></i>Berhasil Memperbarui Rekam Medis
      </div>
    <?php }
    else
    { ?>
      <div class="alert alert-danger alert-dismissible" id="success-alert">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <i class="icon fas fa-ban"></i>Gagal .. Pastikan Tidak ada Yang salah
      </div>
    <?php }
  }
  ?>

  <div class="container-fluid">
    <div class="row">
      <div class="col-md-3">

        <!-- Profile Image -->
        <div class="card card-primary card-outline">
          <div class="card-body box-profile">
            <div class="text-center">
              <img class="profile-user-img img-fluid img-circle"
              src="../dist/img/user.png"
              alt="User profile picture">
            </div>

            <h3 class="profile-username text-center"><?php echo strtoupper($data['nama']);?></h3>

            <p class="text-muted text-center"><b><?php echo $data['nik'];?></b></p>

            <ul class="list-group list-group-unbordered mb-3">
              <li class="list-group-item">
                <b>No Registrasi</b> <a class="float-right">K - <?php echo $data['no_pasien'];?></a>
              </li>
              <li class="list-group-item">
                <b>Umur</b><a class="float-right">
                  <?php
                  $tanggal = new DateTime($data['tgl_lahir']);
                  $today = new DateTime('today');
                  $y = $today->diff($tanggal)->y;
                  $m = $today->diff($tanggal)->m;
                  $d = $today->diff($tanggal)->d;
                  if($y > "6")
                  {
                    echo $y.' Tahun';
                  }elseif ($y == "0") {
                    echo $m.' Bulan';
                  }elseif ($y > "0") {
                    echo $y.' tahun';
                  };
                  ?>
                </a>
              </li>
            </ul>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <!-- About Me Box -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Info Pasien</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <strong><i class="fas fa-venus-mars mr-1"></i>Jenis Kelamin</strong>

            <p class="text-muted">
              <?php if($data['jk']=="l"){ echo "LAKI-LAKI";}else{ echo "PEREMPUAN";}?>
            </p>

            <hr>

            <strong><i class="fas fa-calendar-alt mr-1"></i> Tanggal Lahir</strong>

            <p class="text-muted"><?php echo date("d/m/Y",strtotime($data['tgl_lahir'])); ?></p>

            <hr>

            <strong><i class="fas fa-user-nurse mr-1"></i> Jenis Layanan</strong>

            <p class="text-muted">
              <?php echo strtoupper($data['jenis_layanan']); ?>
            </p>

            <hr>

            <strong><i class="fas fa-map-marker-alt mr-1"></i>Alamat</strong>

            <p class="text-muted"><?php echo $data['alamat']; ?></p>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
      <div class="col-md-9">
        <div class="card">
          <div class="card-header p-2">
            <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active" href="#timeline" data-toggle="tab">Rekam Medis</a></li>
              <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">History Rekam Medis</a></li>
            </ul>
          </div><!-- /.card-header -->
          <div class="card-body">
            <div class="tab-content">
              <div class="tab-pane" id="activity">
                <!-- Post -->
                <div class="post">
                  <div class="user-block">
                    <img class="img-circle img-bordered-sm" src="../dist/img/user.png" alt="user image">
                    <span class="username">
                      <a href="#"><?php echo strtoupper($data['nama']);?></a>
                    </span>
                    <span class="description"><?php echo $data['nik'];?></span>
                  </div>
                  <!-- /.user-block -->
                  <div class="card-body table-responsive p-0" style="height: 400px;">
                    <table class="table table-head-fixed text-nowrap">
                      <thead>
                        <tr>
                          <th></th>
                          <th>No Rekam Medis</th>
                          <th>Nama</th>
                          <th>Tanggal Rekam</th>
                          <th>Status</th>
                          <th>Hasil Anamnesa</th>
                          <th>TD</th>
                          <th>HR</th>
                          <th>RR</th>
                          <th>Suhu</th>
                          <th>Komplikasi</th>
                          <th>HB</th>
                          <th>Malaria</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $sql2="SELECT * FROM rekmed WHERE no_pasien= $ID ORDER BY no_rekmed DESC";
                        $table=mysqli_query($conn,$sql2);
                        while ($tampil=mysqli_fetch_array($table)) {
                          ?>
                        <tr>
                          <td>
                            <center>
                              <a href="rekmed/cetak_rekmed.php?id=<?php echo $tampil['no_rekmed'];?>" target="_blank" style="color:blue" data-toggle="tooltip" title="Cetak Rekam Medis"><i class="fas fa-print"></i></a> ||
                              <a href="index.php?page=Delete_Rek&id=<?php echo $tampil['no_rekmed'];?>" style="color:red" data-toggle="tooltip" onClick="return confirm('Apakah Anda Yakin Menghapus Rekam Medis?')" title="Hapus Rekam Medis"><i class="fas fa-trash"></i></a>
                            </center>
                          </td>
                          <td><a href="index.php?page=Form_Detail&IdRek=<?php echo $tampil['no_rekmed'];?>">RM - <?php echo $tampil['no_rekmed'];?></a></td>
                          <td><?php echo $data['nama'];?></td>
                          <td><?php echo date("d/M/Y",strtotime($tampil['tgl_rekam'])); ?></td>
                          <td><?php
                           $skor = round($tampil['total_rekam'], 2);
                           $pen = $skor * 100 ;
                           switch ($pen) {
                             case ($pen >= 25 && $pen<= 35):
                             echo '<span class="badge badge-warning">Rawat Inap</span>';
                             break;
                             case ($pen < 25):
                            echo '<span class="badge badge-info">Rawat Jalan</span>';
                               break;
                             default: //default
                             echo '<span class="badge badge-danger">Rujuk</span>';
                             break;
                           }
                           ?>
                          </td>
                          <td><?php echo $tampil['anamnesa'];?></td>
                          <td><?php echo $tampil['td'];?></td>
                          <td><?php echo $tampil['hr'];?></td>
                          <td><?php echo $tampil['rr'];?></td>
                          <td><?php echo $tampil['suhu'];?></td>
                          <td><?php echo $tampil['komplikasi'];?></td>
                          <td><?php echo $tampil['hb'];?></td>
                          <td><?php echo $tampil['malaria'];?></td>
                        </tr>
                        <?php }; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
                <!-- /.post -->
              </div>
              <!-- /.tab-pane -->
              <div class="active tab-pane" id="timeline">
                <!-- The timeline -->
                <form action="" method="post">
                  <div class="timeline timeline-inverse">
                    <!-- timeline time label -->
                    <div>
                      <i class="fas fa-comment-medical bg-primary"></i>

                      <div class="timeline-item">
                        <h3 class="timeline-header"><a href="#">Anamnesa</a></h3>

                        <div class="timeline-body">
                          <div class="row">
                            <div class="col-md-2">
                              <div class="form-group ml-2">
                                <div class="custom-control custom-checkbox mb-2">
                                  <input class="custom-control-input" name="list_a[]" type="checkbox" id="customCheckbox1" value="0.13panas">
                                  <label for="customCheckbox1" class="custom-control-label">Panas</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                  <input class="custom-control-input" name="list_a[]" type="checkbox" id="customCheckbox2" value="0.13pusing">
                                  <label for="customCheckbox2" class="custom-control-label">Pusing</label>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group ml-2">
                                <div class="custom-control custom-checkbox mb-2">
                                  <input class="custom-control-input" name="list_a[]" type="checkbox" id="customCheckbox3" value="0.17mual muntah">
                                  <label for="customCheckbox3" class="custom-control-label">Mual Muntah</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                  <input class="custom-control-input" name="list_a[]" type="checkbox" id="customCheckbox4" value="0.19keringat dingin">
                                  <label for="customCheckbox4" class="custom-control-label">Keringat Dingin</label>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-2">
                              <div class="form-group ml-2">
                                <div class="custom-control custom-checkbox mb-2">
                                  <input class="custom-control-input" name="list_a[]" type="checkbox" id="customCheckbox5" value="0.17kejang">
                                  <label for="customCheckbox5" class="custom-control-label">Kejang</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                  <input class="custom-control-input" name="list_a[]" type="checkbox" id="customCheckbox6" value="0.14sesak">
                                  <label for="customCheckbox6" class="custom-control-label">Sesak</label>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-2">
                              <div class="form-group ml-2">
                                <div class="custom-control custom-checkbox mb-2">
                                  <input class="custom-control-input" name="list_a[]" type="checkbox" id="customCheckbox7" value="0.09pucat">
                                  <label for="customCheckbox7" class="custom-control-label">Pucat</label>
                                </div>
                              </div>
                            </div>
                            <input name="anamnesa" hidden/>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- END timeline item -->
                    <div>
                      <i class="fas fa-comment-medical bg-warning"></i>

                      <div class="timeline-item">
                        <h3 class="timeline-header"><a href="#">Tekanan Darah (TD)</a></h3>

                        <div class="timeline-body">
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">mmhg</span>
                            </div>
                            <input type="text" class="form-control" name="td"
                            data-inputmask="'mask': ['99/99', '999/99']" data-mask required>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- END timeline item -->
                    <div>
                      <i class="fas fa-comment-medical bg-purple"></i>

                      <div class="timeline-item">
                        <h3 class="timeline-header"><a href="#">Heart Rate (HR)</a></h3>

                        <div class="timeline-body">
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"> x/ Menit </span>
                            </div>
                            <input type="number" class="form-control" name="hr" required>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- END timeline item -->
                    <div>
                      <i class="fas fa-comment-medical bg-secondary"></i>

                      <div class="timeline-item">
                        <h3 class="timeline-header"><a href="#">Respiration Rate (RR)</a></h3>

                        <div class="timeline-body">
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"> x/ Menit </span>
                            </div>
                            <input type="number" class="form-control" name="rr" required>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- END timeline item -->
                    <div>
                      <i class="fas fa-comment-medical bg-danger"></i>

                      <div class="timeline-item">
                        <h3 class="timeline-header"><a href="#">Suhu</a></h3>

                        <div class="timeline-body">
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">*C</span>
                            </div>
                            <input type="text" class="form-control" name="suhu"
                            data-inputmask="'mask': ['99.9']" data-mask required>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- END timeline item -->
                    <div>
                      <i class="fas fa-comment-medical bg-green"></i>

                      <div class="timeline-item">
                        <h3 class="timeline-header"><a href="#">Komplikasi</a></h3>

                        <div class="timeline-body">
                          <div class="form-group">
                            <select class="form-control select2" name="kom" style="width: 100%;">
                              <option selected="selected" value="0Tidak Ada">- Tidak Ada -</option>
                              <option value="0.11Anemia Parah">Anemia Parah</option>
                              <option value="0.6Malaria Otak">Malaria Otak</option>
                              <option value="0.28Gagal Fungsi Organ Tubuh">Gagal Fungsi Organ Tubuh</option>
                              <option value="0.33Gangguan Pernafasan">Gangguan Pernafasan</option>
                              <option value="0.34Hipoglikemia">Hipoglikemia</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- END timeline item -->
                    <div>
                      <i class="fas fa-comment-medical bg-maroon"></i>

                      <div class="timeline-item">
                        <h3 class="timeline-header"><a href="#">Hasil Lab Hemoglobin (HB)</a></h3>

                        <div class="timeline-body">
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">gr/dl</span>
                            </div>
                            <input type="text" class="form-control" name="hb"
                            data-inputmask="'mask': ['9.9', '99.9']" data-mask required>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- END timeline item -->
                    <div>
                      <i class="fas fa-comment-medical bg-info"></i>

                      <div class="timeline-item">
                        <h3 class="timeline-header"><a href="#">Hasil Lab Malaria (Malaria)</a></h3>

                        <div class="timeline-body">
                          <div class="form-group">
                            <select class="form-control select2" name="malaria" style="width: 100%;">
                              <option selected="selected">- Pilih Hasil -</option>
                              <option value="0.40Pf">Plasmodium Falciparum (Pf)</option>
                              <option value="0.12Pv">Plasmodium vivax (Pv)</option>
                              <option value="0.05Po">Plasmodium ovale (Po)</option>
                              <option value="0.26Pm">Plasmodium malariae (Pm)</option>
                              <option value="0.18Pk">Plasmodium knowlesi (Pk)</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- END timeline item -->

                    <div>
                      <i class="far fa-clock bg-gray"></i>
                      <div class="timeline-item" style="background:white;border:0px">
                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                      </div>
                    </div>

                  </div>
                </form>

              </div>
              <!-- /.tab-pane -->

            </div>
            <!-- /.tab-content -->
          </div><!-- /.card-body -->
        </div>
        <!-- /.nav-tabs-custom -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
