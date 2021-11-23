<?php
error_reporting(0);
include "conn/koneksi.php";
$ID = $_GET['IdRek'];
$query = mysqli_query($conn, "SELECT * FROM spk WHERE no_rekmed = $ID");
$tampil = mysqli_fetch_array($query);
?>
<section class="content">
  <div class="container-fluid">
    <h3><b>PROSES PENENTUAN</b></h3>
    <br>
      <div class="row">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Table Kriteria Anamnesa</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th style="width: 100px">EVN Sub</th>
                    <th>Anamnesa</th>
                    <th>Bobot</th>
                    <th style="width: 40px">EVN</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>0,13</td>
                    <td>Panas</td>
                    <td>2</td>
                    <td rowspan="7">0,09</td>
                  </tr>
                  <tr>
                    <td>0,13</td>
                    <td>Pusing</td>
                    <td>2</td>
                  </tr>
                  <tr>
                    <td>0,17</td>
                    <td>Mual Muntah</td>
                    <td>4</td>
                  </tr>
                  <tr>
                    <td>0,19</td>
                    <td>Keringat Dingi</td>
                    <td>5</td>
                  </tr>
                  <tr>
                    <td>0,17</td>
                    <td>Kejang</td>
                    <td>4</td>
                  </tr>
                  <tr>
                    <td>0,14</td>
                    <td>Sesak</td>
                    <td>3</td>
                  </tr>
                  <tr>
                    <td>0,09</td>
                    <td>Pucat</td>
                    <td>1</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <!-- /.card -->
          <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-6">
          <div class="card">
          <div class="card-header">
            <h3 class="card-title"><b>Anamnesa</b></h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th style="width: 10px">No</th>
                  <th style="width: 100px"><center>Anamnesa Kriteria (0,09)</center></th>
                  <th style="width: 50px;">Bobot</th>
                  <th style="width: 80px">EVN Sub Kriteria x EVN</th>
                  <th style="width: 40px">Nilai</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $n=1;
                $sql=mysqli_query($conn,"SELECT * FROM spk WHERE no_rekmed = $ID");
                while ($data=mysqli_fetch_array($sql)) {
                  $kata = $data['a_text'];
                  $angka = $data['a_number'];
                  $arr_kalimat = explode (",",$kata);
                  $arr_angka = explode (",",$angka);
                  $totalArray = count($arr_kalimat);
                  for($i=0; $i < $totalArray; $i++) {
                    $skor = $arr_angka[$i] * 0.09;
                    ?>
                    <tr>
                      <td><?php echo $n++;?></td>
                      <td><?php echo $arr_kalimat[$i]; ?></td>
                      <td><?php
                      if($arr_kalimat[$i] == "panas" OR $arr_kalimat[$i] == "pusing" ){
                        echo "2";
                      } elseif ($arr_kalimat[$i] == "mual muntah" OR $arr_kalimat[$i] == "kejang") {
                        echo "4";
                      } elseif ($arr_kalimat[$i] == "keringat dingin") {
                        echo "5";
                      } elseif ($arr_kalimat[$i] == "sesak") {
                        echo "3";
                      } elseif ($arr_kalimat[$i] == "pucat") {
                        echo "1";
                      }
                      ?>
                    </td>
                    <td><?php echo $arr_angka[$i].' x 0,09'; ?></td>
                    <td><?php echo $skor; ?></td>
                    <tr>

                      <?php
                    }
                  }
                  ?>
                </tbody>
              </table>
              <p align="right"><b>Total = <?php echo $tampil['a_total'];?></b></p>
            </div>
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <div class="row">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Table Kriteria Tekanan Darah (TD)</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th style="width: 100px">EVN Sub</th>
                    <th>Tekanan Darah (TD)</th>
                    <th>Bobot</th>
                    <th style="width: 40px">EVN</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>0,09</td>
                    <td>90/60 mmhg - 120/80 mmhg</td>
                    <td>1</td>
                    <td rowspan="7">0,06</td>
                  </tr>
                  <tr>
                    <td>0,45</td>
                    <td>< 90/60 mmhg</td>
                    <td>2</td>
                  </tr>
                  <tr>
                    <td>0,45</td>
                    <td>> 120/80 mmhg</td>
                    <td>2</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <!-- /.card -->
          <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"><b>Tekanan Darah (TD)</b></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th style="width: 10px">No</th>
                    <th style="width: 100px"><center>TD (0,06)</center></th>
                    <th style="width: 50px;">Bobot</th>
                    <th style="width: 80px">EVN Sub Kriteria x EVN</th>
                    <th style="width: 40px">Nilai</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td><?php echo $tampil['td'].' mmhg';?></td>
                    <td>
                      <?php
                      $ints = array_map('intval', explode('/', $tampil['td'] ));
                      $awal = $ints[0];
                      $akhir = $ints[1];
                      $total = $awal + $akhir;
                      switch ($total){

                        case ($total >= 150 && $total<= 200):
                        $t_td =  0.09 * 0.06;
                        $bobot = "1";
                        $evn = "0.09 x 0.06";
                        break;
                        default: //default
                        $t_td = 0.45  * 0.06;
                        $bobot = "2";
                        $evn = "0.45 x 0.06";
                        break;
                      }
                      echo $bobot;
                      ?>
                    </td>
                    <td><?php echo $evn; ?></td>
                    <td><?php echo $t_td;?></td>
                  </tr>
                </tbody>
              </table>
              <p align="right"><b>Total = <?php echo $t_td;?></b></p>
            </div>
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <div class="row">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Table Kriteria Heart Rate (HR)</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th style="width: 100px">EVN Sub</th>
                    <th>Heart Rate(HR)</th>
                    <th>Bobot</th>
                    <th style="width: 40px">EVN</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>0,09</td>
                    <td>50x/menit - 80x/menit</td>
                    <td>1</td>
                    <td rowspan="7">0,11</td>
                  </tr>
                  <tr>
                    <td>0,45</td>
                    <td>< 50x/menit</td>
                    <td>2</td>
                  </tr>
                  <tr>
                    <td>0,45</td>
                    <td>> 80x/menit</td>
                    <td>2</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <!-- /.card -->
          <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"><b>Heart Rate (HR)</b></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th style="width: 10px">No</th>
                    <th style="width: 100px"><center>HR (0,11)</center></th>
                    <th style="width: 50px;">Bobot</th>
                    <th style="width: 80px">EVN Sub Kriteria x EVN</th>
                    <th style="width: 40px">Nilai</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td><?php echo $tampil['hr'].'x/menit';?></td>
                    <td>
                      <?php
                      switch ($tampil['hr']){

                        case ($tampil['hr'] >= 50 && $tampil['hr'] <= 80):
                        $t_hr =  0.09 * 0.11;
                        $bobot_hr = "1";
                        $evn_hr = "0.09 x 0.11";
                        break;
                        default: //default
                        $t_hr = 0.45  * 0.11;
                        $bobot_hr = "2";
                        $evn_hr = "0.45 x 0.11";
                        break;
                      }
                      echo $bobot_hr;
                      ?>
                    </td>
                    <td><?php echo $evn_hr;?></td>
                    <td><?php echo $t_hr;?></td>
                  </tr>
                </tbody>
              </table>
              <p align="right"><b>Total = <?php echo $t_hr;?></b></p>
            </div>
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <div class="row">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Table Kriteria Respiration Rate (RR) baba</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th style="width: 100px">EVN Sub</th>
                    <th>Respiration Rate (RR)</th>
                    <th>Bobot</th>
                    <th style="width: 40px">EVN</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>0,09</td>
                    <td>40 - 60x/menit < 1 tahun</td>
                    <td>1</td>
                    <td rowspan="9">0,07</td>
                  </tr>
                  <tr>
                    <td>0,12</td>
                    <td>< 40x/menit < 1 tahun </td>
                    <td>2</td>
                  </tr>
                  <tr>
                    <td>0,12</td>
                    <td>> 60x/menit < 1 tahun</td>
                    <td>2</td>
                  </tr>
                  <tr>
                    <td>0,09</td>
                    <td>20 - 30x/menit > 1 tahun</td>
                    <td>1</td>
                  </tr>
                  <tr>
                    <td>0,12</td>
                    <td>< 20x/menit > 1 tahun </td>
                    <td>2</td>
                  </tr>
                  <tr>
                    <td>0,12</td>
                    <td>> 30x/menit > 1 tahun</td>
                    <td>2</td>
                  </tr>
                  <tr>
                    <td>0,09</td>
                    <td>12 - 20x/menit > 6 tahun</td>
                    <td>1</td>
                  </tr>
                  <tr>
                    <td>0,12</td>
                    <td>< 12x/menit > 6 tahun </td>
                    <td>2</td>
                  </tr>
                  <tr>
                    <td>0,12</td>
                    <td>> 20x/menit > 6 tahun</td>
                    <td>2</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <!-- /.card -->
          <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"><b>Respiration Rate (RR)</b></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th style="width: 10px">No</th>
                    <th style="width: 100px"><center>RR (0,07)</center></th>
                    <th style="width: 50px;">Bobot</th>
                    <th style="width: 80px">EVN Sub Kriteria x EVN</th>
                    <th style="width: 40px">Nilai</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td><?php echo $tampil['rr'].'x/menit';?></td>
                    <td>
                      <?php
                      $rr=$tampil['rr'];
                      $tanggal = new DateTime($tampil['tanggal_rr']);
                      $today = new DateTime('today');
                      $y = $today->diff($tanggal)->y;
                      $m = $today->diff($tanggal)->m;
                      $d = $today->diff($tanggal)->d;
                      if($y > "6")
                      {
                        switch ($rr){

                          case ($rr >= 12 && $rr<= 20):
                          $t_rr =  0.09 * 0.07;
                          $evn_rr = "0,09 x 0,07";
                          $bobot_rr = "1";
                          break;
                          default: //default
                          $t_rr = 0.12  * 0.07;
                          $evn_rr = "0,12 x 0,07";
                          $bobot_rr = "2";
                          break;
                        }
                      }elseif ($y == "0") {
                        switch ($rr){

                          case ($rr >= 40 && $rr<= 60):
                          $t_rr =  0.09 * 0.07;
                          $evn_rr = "0,09 x 0,07";
                          $bobot_rr = "1";
                          break;
                          default: //default
                          $t_rr = 0.12  * 0.07;
                          $evn_rr = "0,12 x 0,07";
                          $bobot_rr = "2";
                          break;
                        }
                      }elseif ($y > "0") {
                        switch ($rr){

                          case ($rr >= 20 && $rr<= 30):
                          $t_rr = 0.09 * 0.07;
                          $evn_rr = "0,09 x 0,07";
                          $bobot_rr = "1";
                          break;
                          default: //default
                          $t_rr = 0.12  * 0.07;
                          $evn_rr = "0,12 x 0,07";
                          $bobot_rr = "2";
                          break;
                        }
                      };
                      echo $bobot_rr.'<br>';
                      ?>
                    </td>
                    <td><?php echo $evn_rr;?></td>
                    <td><?php echo $t_rr;?></td>
                  </tr>
                </tbody>
              </table>
              <p align="right"><b>Total = <?php echo $t_rr;?></b></p>
            </div>
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <div class="row">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Table Kriteria Suhu</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th style="width: 100px">EVN Sub</th>
                    <th>Suhu</th>
                    <th>Bobot</th>
                    <th style="width: 40px">EVN</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>0,14</td>
                    <td>36.5 *C - 37.5 *C</td>
                    <td>1</td>
                    <td rowspan="7">0,04</td>
                  </tr>
                  <tr>
                    <td>0,45</td>
                    <td>< 36.5 *C</td>
                    <td>2</td>
                  </tr>
                  <tr>
                    <td>0,45</td>
                    <td>> 37.5 *C</td>
                    <td>2</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <!-- /.card -->
          <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"><b>Suhu</b></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th style="width: 10px">No</th>
                    <th style="width: 100px"><center>Suhu (0,04)</center></th>
                    <th style="width: 50px;">Bobot</th>
                    <th style="width: 80px">EVN Sub Kriteria x EVN</th>
                    <th style="width: 40px">Nilai</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td><?php echo $tampil['suhu'].' *C';?></td>
                    <td>
                      <?php
                      $suhu=$tampil['suhu'];
                      switch ($suhu){

                        case ($suhu >= 36.5 && $suhu<= 37.5):
                        $t_suhu =  0.14 * 0.04;
                        $bobot_suhu = "1";
                        $evn_suhu = " 0.14 x 0.04";
                        break;
                        default: //default
                        $t_suhu = 0.43  * 0.04;
                        $bobot_suhu = "2";
                        $evn_suhu = " 0.43 x 0.04";
                        break;
                      }
                      echo $bobot_suhu;
                      ?>
                    </td>
                    <td><?php echo $evn_suhu;?></td>
                    <td><?php echo $t_suhu;?></td>
                  </tr>
                </tbody>
              </table>
              <p align="right"><b>Total = <?php echo $t_suhu;?></b></p>
            </div>
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <div class="row">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Table Kriteria Komplikasi</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th style="width: 100px">EVN Sub</th>
                    <th>Komplikasi</th>
                    <th>Bobot</th>
                    <th style="width: 40px">EVN</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>0</td>
                    <td>Tidak Ada</td>
                    <td>-</td>
                    <td rowspan="7">0,18</td>
                  </tr>
                  <tr>
                    <td>0,11</td>
                    <td>Anemia Parah</td>
                    <td>1</td>
                  </tr>
                  <tr>
                    <td>0,6</td>
                    <td>Malaria Otak</td>
                    <td>5</td>
                  </tr>
                  <tr>
                    <td>0,28</td>
                    <td>Gagal Fungsi Organ Tubuh</td>
                    <td>2</td>
                  </tr>
                  <tr>
                    <td>0,33</td>
                    <td>Gangguan Pernafasan</td>
                    <td>3</td>
                  </tr>
                  <tr>
                    <td>0,34</td>
                    <td>Hipoglikemia</td>
                    <td>4</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <!-- /.card -->
          <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"><b>Komplikasi</b></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th style="width: 10px">No</th>
                    <th style="width: 100px"><center>Komplikasi (0,18)</center></th>
                    <th style="width: 50px;">Bobot</th>
                    <th style="width: 80px">EVN Sub Kriteria x EVN</th>
                    <th style="width: 40px">Nilai</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td><?php echo $tampil['kom'];?></td>
                    <td>
                      <?php
                      $kom=$tampil['kom'];
                      switch ($kom) {
                        case ($kom == "Tidak Ada"):
                        $bobot_kom = "-";
                        $evn_kom = "0 x 0";
                        $t_kom = 0 * 0.18;
                        break;
                        case ($kom == "Anemia Parah"):
                        $bobot_kom = "1";
                        $evn_kom = "0,11 x 0,18";
                        $t_kom = 0.11 * 0.18;
                        break;
                        case ($kom == "Malaria Otak"):
                        $bobot_kom = "5";
                        $evn_kom = "0,6 x 0,18";
                        $t_kom = 0.6 * 0.18;
                        break;
                        case ($kom == "Gagal Fungsi Organ Tubuh"):
                        $bobot_kom = "2";
                        $evn_kom = "0,28 x 0,18";
                        $t_kom = 0.28 * 0.18;
                        break;
                        case ($kom == "Gangguan Pernafasan"):
                        $bobot_kom = "3";
                        $evn_kom = "0,33 x 0,18";
                        $t_kom = 0.33 * 0.18;
                        break;
                        case ($kom == "Hipoglikemia"):
                        $bobot_kom = "4";
                        $evn_kom = "0,34 x 0,18";
                        $t_kom = 0.34 * 0.18;
                        break;
                      }
                      echo $bobot_kom;
                      ?>
                    </td>
                    <td><?php echo $evn_kom;?></td>
                    <td><?php echo $t_kom;?></td>
                  </tr>
                </tbody>
              </table>
              <p align="right"><b>Total = <?php echo $t_kom;?></b></p>
            </div>
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <div class="row">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Table Kriteria Homoglobin (HB)</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th style="width: 100px">EVN Sub</th>
                    <th>Homoglobin (HB)</th>
                    <th>Bobot</th>
                    <th style="width: 40px">EVN</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>0,12</td>
                    <td>12-15 gr/dl (Wanita)</td>
                    <td>1</td>
                    <td rowspan="7">0,19</td>
                  </tr>
                  <tr>
                    <td>0,19</td>
                    <td>< 12 gr/dl (Wanita)</td>
                    <td>2</td>
                  </tr>
                  <tr>
                    <td>0,19</td>
                    <td>> 15 gr/dl (Wanita)</td>
                    <td>2</td>
                  </tr>
                  <tr>
                    <td>0,12</td>
                    <td>13-17 gr/dl (Pria)</td>
                    <td>1</td>
                  </tr>
                  <tr>
                    <td>0,19</td>
                    <td>< 13 gr/dl (Pria)</td>
                    <td>2</td>
                  </tr>
                  <tr>
                    <td>0,19</td>
                    <td>< 13 gr/dl (Pria)</td>
                    <td>2</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <!-- /.card -->
          <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"><b>Homoglobin</b></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th style="width: 10px">No</th>
                    <th style="width: 100px"><center>Homoglobin (0,19)</center></th>
                    <th style="width: 50px;">Bobot</th>
                    <th style="width: 80px">EVN Sub Kriteria x EVN</th>
                    <th style="width: 40px">Nilai</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td><?php echo $tampil['hb'].' gr/dl';?></td>
                    <td><?php echo $tampil['bobot_hb']?></td>
                    <td><?php echo $tampil['evn_hb'];?></td>
                    <td><?php echo $tampil['t_hb'];?></td>
                  </tr>
                </tbody>
              </table>
              <p align="right"><b>Total = <?php echo $tampil['t_hb'];?></b></p>
            </div>
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <div class="row">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Table Kriteria Malaria</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th style="width: 100px">EVN Sub</th>
                    <th>Malaria</th>
                    <th>Bobot</th>
                    <th style="width: 40px">EVN</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>0,40</td>
                    <td>Plasmodium falciparum (Pf)</td>
                    <td>5</td>
                    <td rowspan="7">0,27</td>
                  </tr>
                  <tr>
                    <td>0,12</td>
                    <td>Plasmodium vivax (Pv)</td>
                    <td>2</td>
                  </tr>
                  <tr>
                    <td>0,5</td>
                    <td>Plasmodium ovale (Po)</td>
                    <td>1</td>
                  </tr>
                  <tr>
                    <td>0,26</td>
                    <td>Plasmodium malariae (Pm)</td>
                    <td>4</td>
                  </tr>
                  <tr>
                    <td>0,18</td>
                    <td>Plasmodium knowlesi (Pk)</td>
                    <td>3</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <!-- /.card -->
          <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"><b>Malaria</b></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th style="width: 10px">No</th>
                    <th style="width: 100px"><center>Malaria (0,27)</center></th>
                    <th style="width: 50px;">Bobot</th>
                    <th style="width: 80px">EVN Sub Kriteria x EVN</th>
                    <th style="width: 40px">Nilai</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td><?php echo $tampil['malaria'];?></td>
                    <td>
                      <?php
                      $mala=$tampil['malaria'];
                      switch ($mala) {
                        case ($mala == "Pf"):
                        $bobot_mala = "5";
                        $evn_mala = "0,40 x 0,27";
                        $t_mala = 0.40 * 0.27;
                        break;
                        case ($mala == "Pv"):
                        $bobot_mala = "2";
                        $evn_mala = "0,12 x 0,27";
                        $t_mala = 0.12 * 0.27;
                        break;
                        case ($mala == "Po"):
                        $bobot_mala = "1";
                        $evn_mala = "0,05 x 0,27";
                        $t_kom = 0.5 * 0.27;
                        break;
                        case ($mala == "Pm"):
                        $bobot_mala = "4";
                        $evn_mala = "0,26 x 0,27";
                        $t_mala = 0.26 * 0.27;
                        break;
                        case ($mala == "Pk"):
                        $bobot_mala = "3";
                        $evn_mala = "0,18 x 0,27";
                        $t_kom = 0.18 * 0.27;
                        break;
                      }
                      echo $bobot_mala;
                      ?>
                    </td>
                    <td><?php echo $evn_mala;?></td>
                    <td><?php echo $t_mala;?></td>
                  </tr>
                </tbody>
              </table>
              <p align="right"><b>Total = <?php echo $t_mala;?></b></p>
            </div>
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <div class="row">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Table Kriteria Alternatif</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th style="width: 200px">Alternatif</th>
                    <th>Persentase Alternatif</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Rawat jalan</td>
                    <td>< 25 %</td>
                  </tr>
                  <tr>
                    <td>Rawat Inap</td>
                    <td> 25 % - 35 %</td>
                  </tr>
                  <tr>
                    <td>Rujuk</td>
                    <td>> 35 %</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <!-- /.card -->
          <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"><b>Total Nilai</b></h3>
            </div>
            <!-- /.card-header -->
            <?php
            $cov = round($tampil['total'], 2);
            $pen = $cov * 100;
            switch ($pen) {
              case ($pen >= 25 && $pen<= 35):
              $hs='<span class="badge badge-warning">Rawat Inap</span>';
              break;
              case ($pen < 25):
             $hs='<span class="badge badge-info">Rawat Jalan</span>';
                break;
              default: //default
              $hs='<span class="badge badge-danger">Rujuk</span>';
              break;
            };
             ?>
            <div class="card-body">
              <p><b>Rumus: </b> (EVN Kriteria1 x EVN Sub kriteria1) + ( EVNKriteria n x EVN sub kriteria n )= Hasil Nilai Alternatif</p>
              <b>Total : </b><p><?php echo $tampil['a_total'].' + '.$t_td.' + '.$t_hr. ' + '.$t_rr.' + '.$t_suhu.' + '.$t_kom.' + '.$tampil['t_hb'].' + '.$t_mala; ?></p>
              <p><b> = <?php echo round($tampil['total'], 2).' -> '.$hs;?></b></p>
            </div>
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
