<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
      <a href="index.php?page=Regist" class="btn btn-success" style="color:white" data-toggle="tooltip">Tambah Pasien <i class="fas fa-plus"></i></a>
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
            <th></th>
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
                <a class="btn btn-primary" data-toggle="modal" data-target="#modal-xl<?php echo $data['no_pasien'];?>" style="color:white" title="Detail"><i class="fas fa-eye"></i></a>
                <a class="btn btn-secondary" href="index.php?page=Edit_Pasien&id=<?php echo $data['no_pasien'];?>" style="color:white" data-toggle="tooltip" title="Edit Pasien"><i class="fas fa-edit"></i></a>
                <a class="btn btn-danger" href="index.php?page=Delete_Pasien&id=<?php echo $data['no_pasien'];?>" style="color:white" data-toggle="tooltip" onClick="return confirm('Hapus Inputan?')" title="Hapus Pasien"><i class="fas fa-trash"></i></a>
              </td>
            </tr>
            <!-- modal -->
            <div class="modal fade" id="modal-xl<?php echo $data['no_pasien'];?>">
              <div class="modal-dialog modal-md">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title"></i>Detail Pasien</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="clearfix">
                      <img src="../dist/img/user.png" width="150" height="150" class="float-left mr-2">
                      <div class="row">
                        <div class="col-md-12" align="Left">
                          <b>NIK :</b> <?php echo $data['nik'];?>
                        </div>
                        <div class="col-md-12" align="left">
                          <b>Nama :</b> <?php echo strtoupper($data['nama']);?></td>
                        </div>
                        <div class="col-md-12" align="left">
                          <b>Tanggal Lahir :</b> <?php echo date("d/m/Y",strtotime($data['tgl_lahir']));?>
                        </div>
                        <div class="col-md-12" align="left">
                          <b>Layanan :</b> <?php echo strtoupper($data['jenis_layanan']);?> <?php if($data['jenis_layanan']=="umum"){}else{echo " - ". $data['no_layanan'];}?>
                        </div>
                        <div class="col-md-12" align="left">
                          <b>Alamat :</b>
                        </div>
                        <div class="col-md-12" align="left">
                          <?php echo substr($data['alamat'], 0, 50) . '...'; ?>
                        </div>
                      </div>
                    </div>
                </div>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
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
          <th></th>
        </tr>
      </tfoot>
    </table>
  </div>
  <!-- /.card-body -->
</div>
<!-- /.card -->

</section>
