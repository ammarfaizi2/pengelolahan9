<div class="row">
  <div class="col-md-12">
    <!-- Advanced Tables -->
    <div class="box box-primary box-solid">
      <div class="box-header with-border">
        Data Kelas
      </div>
      <div class="panel-body">
        <div class="table-responsive">
          <table class="table table-striped table-bordered table-hover" id="example1">

            <button type="button" class="btn btn-info" style="margin-bottom: 10px;" data-toggle="modal" data-target="#modal-default">
              Tambah
            </button>

            <thead>
              <tr>
                <th>No</th>
                <th>Nama Kelas</th>

                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>

              <?php

              $no = 1;

              $sql = $koneksi->query("select * from tb_kelas order by id_kelas desc");

              while ($data = $sql->fetch_assoc()) {




              ?>


                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo $data['nama_kelas'] . ' ' . $data['sub_kelas'] ?></td>


                  <td>

                    <a href="#" type="button" class="btn btn-info" data-toggle="modal" data-target="#mymodal<?php echo $data['id_kelas']; ?>"><i class="fa fa-edit"></i> Ubah</a>



                    <a onclick="return confirm('Apakah Anda Yakin Mengahpus Data Ini')" href="?page=kelas&aksi=hapus&id=<?php echo $data['id_kelas']; ?>" class="btn btn-danger" title=""><i class="fa fa-trash"></i> Hapus</a>


                  </td>

                </tr>

                <div class="modal fade" id="mymodal<?php echo $data['id_kelas']; ?>">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="box box-primary box-solid">
                        <div class="box-header with-border">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                          Ubah Kelas
                        </div>
                        <div class="modal-body">

                          <form role="form" method="POST">
                            <?php

                            $id_kelas = $data['id_kelas'];

                            $sql1 = $koneksi->query("select * from tb_kelas where id_kelas='$id_kelas'");

                            while ($data1 = $sql1->fetch_assoc()) {




                            ?>

                              <input type="hidden" name="id_kelas" value="<?php echo $data1['id_kelas']; ?>">
                              <div class="form-group">
                                <label>Nama Kelas</label>
                                <input type="text" name="nama_kelas" class="form-control" value="<?php echo $data1['nama_kelas']; ?>" required="">
                              </div>
                              <div class="form-group">
                                <label>Sub Kelas</label>
                                <input type="text" name="sub_kelas" class="form-control" value="<?php echo $data1['sub_kelas']; ?>">
                              </div>




                        </div>
                        <div class="modal-footer">
                          <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>

                        </div>

                      <?php } ?>

                      </form>

                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>


                <?php } ?>

                <?php



                if (isset($_POST['simpan'])) {
                  $id_kelas_ubah = $_POST['id_kelas'];
                  $nama_kelas = $_POST['nama_kelas'];
                  $sub_kelas = $_POST['sub_kelas'];


                  $sql = $koneksi->query("update  tb_kelas set nama_kelas='$nama_kelas', sub_kelas = '$sub_kelas' where id_kelas='$id_kelas_ubah'");



                  if ($sql) {
                    echo "

                        <script>
                            setTimeout(function() {
                                swal({
                                    title: 'Data kelas',
                                    text: 'Berhasil Diubah!',
                                    type: 'success'
                                }, function() {
                                    window.location = '?page=kelas';
                                });
                            }, 300);
                        </script>

                    ";
                  }
                }


                ?>

            </tbody>

          </table>

        </div>
      </div>
    </div>


    <!-- AWAL TAMBAH DATA TAHUN AJARAN -->

    <div class="modal fade" id="modal-default">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="box box-primary box-solid">
            <div class="box-header with-border">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              Tambah Kelas
            </div>



            <div class="modal-body">
              <form role="form" method="POST">
                <div class="form-group">
                  <label>Nama Kelas</label>
                  <input type="text" name="nama_kelas" placeholder="Nama Kelas" class="form-control" required="">
                </div>
                <div class="form-group">
                  <label>Sub Kelas</label>
                  <input type="text" name="sub_kelas" placeholder="Sub Kelas" class="form-control">
                  <i>*boleh dikosongi</i>
                </div>

                <div class="modal-footer">
                  <button type="submit" name="tambah" class="btn btn-primary">Simpan</button>

                </div>



              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>



        <?php

        if (isset($_POST['tambah'])) {

          $nama_kelas = $_POST['nama_kelas'];
          $sub_kelas = $_POST['sub_kelas'];

          $sql = $koneksi->query("insert into tb_kelas (nama_kelas, sub_kelas)values('$nama_kelas', '$sub_kelas') ");



          if ($sql) {
            echo "

                <script>
                    setTimeout(function() {
                        swal({
                            title: 'Data Kelas',
                            text: 'Berhasil Disimpan!',
                            type: 'success'
                        }, function() {
                            window.location = '?page=kelas';
                        });
                    }, 300);
                </script>

            ";
          }
        }

        ?>


        <!-- AKHIR TAMBAH DATA TAHUN AJARAN -->