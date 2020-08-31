<div class="row">
  <div class="col-md-12">
    <!-- Advanced Tables -->
    <div class="box box-primary box-solid">
      <div class="box-header with-border">
        Data Jenis Bayar
      </div>
      <div class="panel-body">
        <div class="table-responsive">
          <table class="table table-striped table-bordered table-hover" id="example1">
            <div class="col-md-3">
              <button type="button" class="btn btn-info" style="margin-top: 20px;" data-toggle="modal" data-target="#modal-default">
                Tambah
              </button>

            </div>



            <div class="col-md-3">
              <div class="form-group">

                <form method="POST">

                  <label>Tahun Ajaran :</label> <br>

                  <select required="" class="form-control" name="tahun_ajaran">
                    <option value="">-Pilih Tahun Ajaran-</option>

                    <?php


                    $query = $koneksi->query("SELECT * FROM tb_tahun_ajaran ORDER by status ASC");

                    while ($tampil_t = $query->fetch_assoc()) {

                      echo "<option value='$tampil_t[id_tahun_ajaran]'> $tampil_t[tahun_ajaran]</option>";
                    }

                    ?>

                  </select>
              </div>

            </div>



            <div class="col-md-3">
              <div class="form-group">
                <button type="submit" name="filter" style="margin-top: 25px;" class="btn btn-info"><i class="fa fa-search"></i> Cari</button>
              </div>

            </div>

            </form>




            <thead>
              <tr>
                <th>No</th>
                <th>Nama Pembayaran</th>
                <th>Jenis Bayar</th>
                <th>Tahun Ajaran</th>
                <th>Setting Tarif</th>

                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>

              <?php

              if (isset($_POST['filter'])) {
                echo $tahun = $_POST['tahun_ajaran'];
              }

              if ($tahun == "") {

                $no = 1;

                $sql = $koneksi->query("select * from tb_jenis_bayar, tb_tahun_ajaran where tb_jenis_bayar.id_tahun_ajaran=tb_tahun_ajaran.id_tahun_ajaran and tb_tahun_ajaran.status='aktif'");
              } else {
                $no = 1;

                $sql = $koneksi->query("select * from tb_jenis_bayar, tb_tahun_ajaran where tb_jenis_bayar.id_tahun_ajaran=tb_tahun_ajaran.id_tahun_ajaran and tb_jenis_bayar.id_tahun_ajaran='$tahun'");
              }

              while ($data = $sql->fetch_assoc()) {



              ?>


                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo $data['nama_bayar'] ?></td>
                  <td><?php echo $data['tipe_bayar'] ?></td>
                  <td><?php echo $data['tahun_ajaran'] ?></td>

                  <td><a href="?page=jenisbayar&aksi=seting&id=<?php echo $data['id_bayar']; ?>" class="btn btn-success" title=""><i class="fa fa-table"></i> Setting Pembayaran</a></td>


                  <td>

                    <a href="#" type="button" class="btn btn-info" data-toggle="modal" data-target="#mymodal<?php echo $data['id_bayar']; ?>"><i class="fa fa-edit"></i> Ubah</a>



                    <a onclick="return confirm('Apakah Anda Yakin Mengahpus Data Ini')" href="?page=jenisbayar&aksi=hapus&id=<?php echo $data['id_bayar']; ?>" class="btn btn-danger" title=""><i class="fa fa-trash"></i> Hapus</a>


                  </td>

                </tr>

                <div class="modal fade" id="mymodal<?php echo $data['id_bayar']; ?>">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="box box-primary box-solid">
                        <div class="box-header with-border">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                          Ubah Jenis Bayar
                        </div>
                        <div class="modal-body">

                          <form role="form" method="POST">
                            <?php

                            $id_bayar = $data['id_bayar'];

                            $sql1 = $koneksi->query("select * from tb_jenis_bayar where id_bayar='$id_bayar'");

                            while ($data1 = $sql1->fetch_assoc()) {




                            ?>

                              <input type="hidden" name="id_bayar" value="<?php echo $data1['id_bayar']; ?>">





                              <div class="form-group">
                                <label>Nama Pembayaran</label>
                                <input type="text" name="nama_bayar" class="form-control" value="<?php echo $data1['nama_bayar']; ?>" required="">
                              </div>



                              <div class="form-group">

                                <label>Jenis Bayar :</label> <br>
                                <select class="form-control" name="jenis_bayar">

                                  <option value="Bulanan" <?php if ($data1['tipe_bayar'] == 'Bulanan') {
                                                            echo "selected";
                                                          } ?>>Bulanan</option>
                                  <option value="Bebas" <?php if ($data1['tipe_bayar'] == 'Bebas') {
                                                          echo "selected";
                                                        } ?>>Bebas</option>

                                </select>
                              </div>





                              <div class="form-group">

                                <label>Tahun Ajaran :</label> <br>
                                <select class="form-control" name="tahun_ajaran">


                                  <?php


                                  $query = $koneksi->query("SELECT * FROM tb_tahun_ajaran ORDER by status ASC");

                                  while ($tampil_t = $query->fetch_assoc()) {
                                    $pilih_t = ($tampil_t['id_tahun_ajaran'] == $data1['id_tahun_ajaran'] ? "selected" : "");
                                    echo "<option value='$tampil_t[id_tahun_ajaran]' $pilih_t> $tampil_t[tahun_ajaran]</option>";
                                  }

                                  ?>

                                </select>
                              </div>






                        </div>
                        <div class="modal-footer">


                          <button type="submit" name="simpan" class="btn btn-block btn-primary btn-lg"><i class="fa fa-save"></i> Simpan</button>

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
                  $id_bayar_ubah = $_POST['id_bayar'];
                  $nama_bayar = $_POST['nama_bayar'];
                  $jenis_bayar = $_POST['jenis_bayar'];
                  $tahun_ajaran = $_POST['tahun_ajaran'];




                  $sql = $koneksi->query("update  tb_jenis_bayar set 
                                         nama_bayar='$nama_bayar',
                                         tipe_bayar='$jenis_bayar', 
                                         id_tahun_ajaran='$tahun_ajaran'
                                           
                                         where id_bayar='$id_bayar_ubah'");



                  if ($sql) {
                    echo "

                        <script>
                            setTimeout(function() {
                                swal({
                                    title: 'Data Jenis Bayar',
                                    text: 'Berhasil Diubah!',
                                    type: 'success'
                                }, function() {
                                    window.location = '?page=jenisbayar';
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


    <!-- AWAL TAMBAH DATA SISWA -->

    <div class="modal fade" id="modal-default">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="box box-primary box-solid">
            <div class="box-header with-border">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              Tambah Jenis Bayar
            </div>



            <div class="modal-body">
              <form role="form" method="POST">
                <div class="form-group">
                  <label>Nama Pembayaran</label>
                  <input type="text" name="nama_bayar" class="form-control" required="">
                </div>



                <div class="form-group">

                  <label>Jenis Bayar :</label> <br>
                  <select required="" class="form-control" name="jenis_bayar">
                    <option value="">-Pilih Jenis Bayar-</option>

                    <option value="Bulanan">Bulanan</option>
                    <option value="Bebas">Bebas</option>

                  </select>
                </div>



                <div class="form-group">

                  <label>Tahun Ajaran :</label> <br>
                  <select required="" class="form-control" name="tahun_ajaran">


                    <?php


                    $query = $koneksi->query("SELECT * FROM tb_tahun_ajaran ORDER by status ASC");

                    while ($tampil_t = $query->fetch_assoc()) {

                      echo "<option value='$tampil_t[id_tahun_ajaran]'> $tampil_t[tahun_ajaran]</option>";
                    }

                    ?>

                  </select>
                </div>


            </div>
            <div class="modal-footer">

              <button type="submit" name="tambah" class="btn btn-block btn-primary btn-lg"><i class="fa fa-save"></i> Simpan</button>

            </div>



            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>



      <?php

      if (isset($_POST['tambah'])) {

        $nama_bayar = $_POST['nama_bayar'];
        $jenis_bayar = $_POST['jenis_bayar'];
        $tahun_ajaran = $_POST['tahun_ajaran'];



        $sql = $koneksi->query("insert into tb_jenis_bayar (id_tahun_ajaran, nama_bayar, tipe_bayar)values('$tahun_ajaran', '$nama_bayar', '$jenis_bayar') ");



        if ($sql) {
          echo "

                <script>
                    setTimeout(function() {
                        swal({
                            title: 'Data Jenis Bayar',
                            text: 'Berhasil Disimpan!',
                            type: 'success'
                        }, function() {
                            window.location = '?page=jenisbayar';
                        });
                    }, 300);
                </script>

            ";
        }
      }

      ?>


      <!-- AKHIR TAMBAH DATA SISWA -->