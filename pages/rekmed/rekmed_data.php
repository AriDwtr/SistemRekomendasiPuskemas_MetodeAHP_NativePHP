<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Data Pasien</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="card">
    <div class="card-header">
      <h3 class="card-title"><i class="far fas fa-address-book nav-icon"></i> <b>DATA PASIEN</b></h3>
    </div>
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>No Reg</th>
            <th>NIK</th>
            <th>Nama</th>
            <th>Kelamin</th>
            <th>Tanggal Lahir</th>
            <th>Jenis Layanan</th>
            <th>Rekam Medis</th>
          </tr>
        </thead>
        <tbody>

          <?php
          include "conn/koneksi.php";
          $sql="SELECT * FROM pasien";
          $query=mysqli_query($conn,$sql);
          while ($data=mysqli_fetch_array($query)) {
            ?>

            <tr>
              <td>R-<?php echo $data['no_pasien']; ?></td>
              <td> <?php echo $data['nik']; ?></td>
              <td><?php echo strtoupper($data['nama']);?></td>
              <td><?php if($data['jk']=="l"){ echo "LAKI-LAKI";}else{ echo "PEREMPUAN";}?></td>
              <td><?php echo date("d/m/Y",strtotime($data['tgl_lahir'])); ?></td>
              <td> <?php echo strtoupper($data['jenis_layanan']); ?></td>
              <td>
                <center>
                  <a href="index.php?page=Form_Rekmde&id=<?php echo $data['no_pasien'];?>" class="btn btn-success"  style="color:white" title="Rekam Medis"><i class="fas fa-diagnoses"></i></a>
                </center>
              </td>
            </tr>
          </div>
          <!-- /.modal -->
        <?php }; ?>
      </tbody>
      <tfoot>
        <tr>
          <th>No Reg</th>
          <th>NIK</th>
          <th>Nama</th>
          <th>Kelamin</th>
          <th>Tanggal Lahir</th>
          <th>Jenis Layanan</th>
          <th>Rekam Medis</th>
        </tr>
      </tfoot>
    </table>
  </div>
  <!-- /.card-body -->
</div>
<!-- /.card -->

</section>
