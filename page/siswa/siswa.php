<div class="row">
  <div class="col-md-12">
    <!-- Advanced Tables -->
    <div class="box box-primary box-solid">
      <div class="box-header with-border">
        Data Siswa
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
                <th>NIS</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Penghasilan Ortu</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>

              <?php

              $no = 1;

              $sqlx = $koneksi->query("select * from tb_siswa, tb_kelas where tb_siswa.kelas=tb_kelas.id_kelas order by tb_siswa.id_siswa desc");

              if (!$sqlx) { var_dump(mysqli_error($koneksi));die;}

              while ($data = $sqlx->fetch_assoc()) {




              ?>


                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo $data['nis'] ?></td>
                  <td><?php echo $data['nama_siswa'] ?></td>
                  <td><?php echo $data['nama_kelas'] . ' ' . $data['sub_kelas'] ?></td>
                  <td><?php echo number_format($data['gaji_ortu']) ?></td>
                  <td>
                    <a href="#" type="button" class="btn btn-info" data-toggle="modal" data-target="#mymodal2<?php echo $data['id_siswa']; ?>"><i class="fa fa-edit"></i> Detail</a>
                    <a href="#" type="button" class="btn btn-info" data-toggle="modal" data-target="#mymodal<?php echo $data['id_siswa']; ?>"><i class="fa fa-edit"></i> Ubah</a>
                    <a onclick="return confirm('Apakah Anda Yakin Mengahpus Data Ini')" href="?page=siswa&aksi=hapus&id=<?php echo $data['id_siswa']; ?>" class="btn btn-danger" title=""><i class="fa fa-trash"></i> Hapus</a>
                  </td>

                </tr>

                <div class="modal fade" id="mymodal<?php echo $data['id_siswa']; ?>">
                  <div class="modal-dialog" style=" width: 1000px;">
                    <div class="modal-content" style=" width: 1000px;">
                      <div class="box box-primary box-solid">
                        <div class="box-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                          Ubah Data Siswa
                        </div>
                        <div class="modal-body">

                          <form role="form" method="POST" enctype="multipart/form-data">
                            <?php

                            $id_siswa = $data['id_siswa'];

                            $sql1 = $koneksi->query("select * from tb_siswa where id_siswa='$id_siswa'");

                            while ($data1 = $sql1->fetch_assoc()) {




                            ?>

                              <input type="hidden" name="id_siswa" value="<?php echo $data1['id_siswa']; ?>">

                              <div class="col-md-6">



                                <div class="form-group">
                                  <label>No. Induk Siswa</label>
                                  <input type="text" name="nis" class="form-control" value="<?php echo $data1['nis']; ?>" required="">
                                </div>

                                <div class="form-group">
                                  <label>Nama Siswa</label>
                                  <input type="text" name="nama" class="form-control" value="<?php echo $data1['nama_siswa']; ?>" required="">
                                </div>

                                <div class="form-group">

                                  <label>Jenis Kelamin :</label> <br>
                                  <select class="form-control" name="jk">

                                    <option value="Laki-laki" <?php if ($data1['jk'] == 'Laki-laki') {
                                                                echo "selected";
                                                              } ?>>Laki-laki</option>
                                    <option value="Perempuan" <?php if ($data1['jk'] == 'Perempuan') {
                                                                echo "selected";
                                                              } ?>>Perempuan</option>

                                  </select>
                                </div>


                                <div class="form-group">

                                  <label>Agama :</label> <br>
                                  <select class="form-control" name="agama">

                                    <option value="Islam" <?php if ($data1['agama'] == 'Islam') {
                                                            echo "selected";
                                                          } ?>>Islam</option>
                                    <option value="Kristen" <?php if ($data1['agama'] == 'Kristen') {
                                                              echo "selected";
                                                            } ?>>Kristen</option>
                                    <option value="Katolik" <?php if ($data1['agama'] == 'Katolik') {
                                                              echo "selected";
                                                            } ?>>Katolik</option>
                                    <option value="Hindu" <?php if ($data1['agama'] == 'Hindu') {
                                                            echo "selected";
                                                          } ?>>Hindu</option>
                                    <option value="Budha" <?php if ($data1['agama'] == 'Budha') {
                                                            echo "selected";
                                                          } ?>>Budha</option>

                                  </select>
                                </div>


                                <div class="form-group">

                                  <label>Kelas :</label> <br>
                                  <select class="form-control" name="kelas">


                                    <?php


                                    $query = $koneksi->query("SELECT * FROM tb_kelas ORDER by id_kelas");

                                    while ($tampil_t = $query->fetch_assoc()) {
                                      $pilih_t = ($tampil_t['id_kelas'] == $data1['kelas'] ? "selected" : "");
                                      echo "<option value='$tampil_t[id_kelas]' $pilih_t> $tampil_t[nama_kelas]</option>";
                                    }

                                    ?>

                                  </select>
                                </div>
                                <div class="form-group">
                                  <label>Foto</label>

                                  <?php
                                  echo "<p><img style='width:70px;' src='images/" . $data1['foto'] . "' alt=''></p>";
                                  ?>
                                  <input type="hidden" name="gambar_lama" value="<?php echo $data1['foto'] ?>">
                                  <input type="file" name="berkas" class="form-control">
                                </div>

                              </div>

                              <div class="col-md-6">

                                <div class="form-group">
                                  <label>Nama Ortu</label>
                                  <input type="text" name="nama_ortu" class="form-control" value="<?php echo $data1['nama_ortu']; ?>" required="">
                                </div>

                                <div class="form-group">
                                  <label>Alamat Ortu </label>
                                  <textarea class="form-control" rows="3" name="alamat"><?php echo $data['alamat']; ?></textarea>
                                </div>



                                <div class="form-group">
                                  <label>No HP ortu</label>
                                  <input type="text" name="no_hp_ortu" class="form-control" value="<?php echo $data1['no_hp_ortu']; ?>" required="">
                                </div>
                                <div class="form-group">
                                  <label>Penghasilan Ortu</label>
                                  <input type="text" name="gaji_ortu" class="form-control uang" value="<?php echo $data1['gaji_ortu']; ?>" required="">
                                </div>


                                <div class="form-group">

                                  <label>Status :</label> <br>
                                  <select class="form-control" name="status">

                                    <option value="Aktif" <?php if ($data1['status'] == 'Aktif') {
                                                            echo "selected";
                                                          } ?>>Aktif</option>
                                    <option value="Tidak Aktif" <?php if ($data1['status'] == 'Tidak Aktif') {
                                                                  echo "selected";
                                                                } ?>>Tidak Aktif</option>
                                    <option value="Lulus" <?php if ($data1['status'] == 'Lulus') {
                                                            echo "selected";
                                                          } ?>>Lulus</option>
                                    <option value="Pindah" <?php if ($data1['status'] == 'Pindah') {
                                                              echo "selected";
                                                            } ?>>Pindah</option>
                                    <option value="Keluar" <?php if ($data1['status'] == 'Keluar') {
                                                              echo "selected";
                                                            } ?>>Keluar</option>

                                  </select>
                                </div>

                              </div>
                        </div>
                        <div class="modal-footer">


                          <button type="submit" name="simpan" class="btn btn-block btn-primary btn-lg">Simpan</button>

                        </div>

                      <?php } ?>

                      </form>

                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                </div>


                <?php



                if (isset($_POST['simpan'])) {
                  $id_siswa_ubah = $_POST['id_siswa'];
                  $nis = $_POST['nis'];
                  $nama = $_POST['nama'];
                  $jk = $_POST['jk'];
                  $agama = $_POST['agama'];
                  $kelas = $_POST['kelas'];
                  $nama_ortu = $_POST['nama_ortu'];
                  $alamat = $_POST['alamat'];
                  $no_hp_ortu = $_POST['no_hp_ortu'];
                  $gaji_ortu = $_POST['gaji_ortu'];
                  $status = $_POST['status'];
                  $gambar = $_FILES['berkas']['name'];
                  $lokasi = $_FILES['berkas']['tmp_name'];
                  $gambar_lama = $_POST['gambar_lama'];
                  $gaji_ortu_oke = str_replace(".", "", $gaji_ortu);

                  $sql = $koneksi->query("update  tb_siswa set 
                                         nis='$nis',
                                         nama_siswa='$nama', 
                                         jk='$jk',
                                         agama='$agama',
                                         kelas='$kelas',
                                         status='$status',
                                         nama_ortu='$nama_ortu',  
                                         foto = '$gambar',
                                         alamat='$alamat',  
                                         no_hp_ortu='$no_hp_ortu',
                                         gaji_ortu ='$gaji_ortu_oke'   
                                         where id_siswa='$id_siswa_ubah'");


                  require __DIR__."/../jenisbayar/fungsi_bulanan.php";

                  $sql = ($sql && reconstruct_tagihan_bulanan($koneksi, $id_siswa_ubah, $kelas, $gaji_ortu_oke));

                  if ($sql) {
                    $hapus_gambar = unlink("images/" . $gambar_lama);
                    $upload = move_uploaded_file($lokasi, "images/" . $gambar);
                    echo "

                        <script>
                            setTimeout(function() {
                                swal({
                                    title: 'Data Siswa',
                                    text: 'Berhasil Diubah!',
                                    type: 'success'
                                }, function() {
                                    window.location = '?page=siswa';
                                });
                            }, 300);
                        </script>

                    ";
                  }
                }


                ?>
                <div class="modal fade" id="mymodal2<?php echo $data['id_siswa']; ?>">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="box box-primary box-solid">
                        <div class="box-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                          Data Siswa
                        </div>
                        <div class="modal-body">
                          <div class="container">
                            <?php

                            $id_siswa2 = $data['id_siswa'];

                            $sql2 = $koneksi->query("select * from tb_siswa, tb_kelas where tb_siswa.kelas=tb_kelas.id_kelas and id_siswa='$id_siswa2'");

                            while ($data2 = $sql2->fetch_assoc()) {
                            ?>
                              <div class="row">
                                <div class="col-sm-8">
                                  <div class="row">
                                    <div class="col-xs-3 col-md-3">
                                      <div class="row">
                                        <div class="col-sm-12">
                                          <div class="row">
                                            <img src="images/<?php echo $data2['foto'] ?>" widht="100px" height="100px" alt="">
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-xs-8 col-md-8">
                                      <div class="row">
                                        <div class="col-sm-12">
                                          <div class="row">
                                            <div class="col-xs-4 col-md-4">Nama</div>
                                            <div class="col-xs-8 col-md-8">: <?php echo $data2['nama_siswa'] ?></div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-sm-12">
                                          <div class="row">
                                            <div class="col-xs-4 col-md-4">NIS</div>
                                            <div class="col-xs-8 col-md-8">: <?php echo $data2['nis'] ?></div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-sm-12">
                                          <div class="row">
                                            <div class="col-xs-4 col-md-4">Jenis Kelamin</div>
                                            <div class="col-xs-8 col-md-8">: <?php echo $data2['jk'] ?></div>
                                          </div>
                                        </div>

                                      </div>
                                      <div class="row">
                                        <div class="col-sm-12">
                                          <div class="row">
                                            <div class="col-xs-4 col-md-4">Agama</div>
                                            <div class="col-xs-8 col-md-8">: <?php echo $data2['agama'] ?></div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-sm-12">
                                          <div class="row">
                                            <div class="col-xs-4 col-md-4">Kelas</div>
                                            <div class="col-xs-8 col-md-8">: <?php echo $data2['nama_kelas'] ?></div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-sm-12">
                                          <div class="row">
                                            <div class="col-xs-4 col-md-4">Nama Orang Tua</div>
                                            <div class="col-xs-8 col-md-8">: <?php echo $data2['nama_ortu'] ?></div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-sm-12">
                                          <div class="row">
                                            <div class="col-xs-4 col-md-4">Alamat Ortu</div>
                                            <div class="col-xs-8 col-md-8">: <?php echo $data2['alamat'] ?></div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-sm-12">
                                          <div class="row">
                                            <div class="col-xs-4 col-md-4">No. HP Ortu</div>
                                            <div class="col-xs-8 col-md-8">: <?php echo $data2['no_hp_ortu'] ?></div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-sm-12">
                                          <div class="row">
                                            <div class="col-xs-4 col-md-4">Penghasilan Ortu</div>
                                            <div class="col-xs-8 col-md-8">: Rp. <?php echo number_format($data2['gaji_ortu']) ?></div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                          </div>
                        </div>
                      <?php } ?>


                      <div class="modal-footer">
                        <button class="btn btn-primary" data-dismiss="modal"><span class="fa fa-close"></span>Tutup</button>
                      </div>



                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                </div>
              <?php } ?>
            </tbody>

          </table>

        </div>

        <!-- AWAL TAMBAH DATA SISWA -->

        <div class="modal fade" id="modal-default">
          <div class="modal-dialog" style=" width: 1000px;">
            <div class="modal-content" style="width: 1000px;">
              <div class="box box-primary box-solid">
                <div class="box-header with-border">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                  Tambah Siswa
                </div>



                <div class="modal-body">
                  <form role="form" method="POST" enctype="multipart/form-data">
                    <div class="col-md-6">



                      <div class="form-group">
                        <label>No. Induk Siswa</label>
                        <input type="text" name="nis" class="form-control" required="">
                      </div>

                      <div class="form-group">
                        <label>Nama Siswa</label>
                        <input type="text" name="nama" class="form-control" required="">
                      </div>

                      <div class="form-group">

                        <label>Jenis Kelamin :</label> <br>
                        <select class="form-control" name="jk">

                          <option value="">-Pilih Jenis Kelamin-</option>

                          <option value="Laki-laki">Laki-laki</option>
                          <option value="Perempuan">Perempuan</option>

                        </select>
                      </div>


                      <div class="form-group">

                        <label>Agama :</label> <br>
                        <select class="form-control" name="agama">

                          <option value="">-Pilih Agama-</option>

                          <option value="Islam">Islam</option>
                          <option value="Kristen">Kristen</option>
                          <option value="Katolik">Katolik</option>
                          <option value="Hindu">Hindu</option>
                          <option value="Budha">Budha</option>

                        </select>
                      </div>
                      <div class="form-group">

                        <label>Kelas :</label> <br>
                        <select class="form-control" name="kelas">

                          <option value="">--Pilih Kelas--</option>
                          <?php


                          $query = $koneksi->query("SELECT * FROM tb_kelas ORDER by id_kelas");

                          while ($tampil_t = $query->fetch_assoc()) {

                            echo "<option value='$tampil_t[id_kelas]'> $tampil_t[nama_kelas]</option>";
                          }

                          ?>

                        </select>
                      </div>
                      <div class="form-group">
                        <label for="berkas">Foto</label>
                        <input type="file" name="berkas" class="form-control">
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Nama Ortu</label>
                        <input type="text" name="nama_ortu" class="form-control" required="">
                      </div>
                      <div class="form-group">
                        <label>Alamat Ortu </label>
                        <textarea class="form-control" rows="3" name="alamat"></textarea>
                      </div>
                      <div class="form-group">
                        <label>No HP ortu</label>
                        <input type="text" name="no_hp_ortu" class="form-control" required="">
                      </div>
                      <div class="form-group">
                        <label>Penghasilan Ortu</label>
                        <input type="text" name="gaji_ortu" class="form-control uang" required="">
                      </div>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" name="tambah" class="btn btn-block btn-primary btn-lg">Simpan</button>
                </div>
                </form>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>



          <?php

          if (isset($_POST['tambah'])) {

            $nis = $_POST['nis'];
            $nama = $_POST['nama'];
            $jk = $_POST['jk'];
            $agama = $_POST['agama'];
            $kelas = $_POST['kelas'];
            $nama_ortu = $_POST['nama_ortu'];
            $alamat = $_POST['alamat'];
            $no_hp_ortu = $_POST['no_hp_ortu'];
            $gaji_ortu = $_POST['gaji_ortu'];
            $gaji_ortu_oke = str_replace(".", "", $gaji_ortu);
            $gambar = $_FILES['berkas']['name'];
            $lokasi = $_FILES['berkas']['tmp_name'];

            $query = $koneksi->query("select * from tb_siswa where nis='$nis'");
            $data = $query->fetch_assoc();
            if (count($data['nis']) == 0) {
              $sql = $koneksi->query("insert into tb_siswa (nis, nama_siswa, jk, agama, kelas, foto, status, nama_ortu, alamat, no_hp_ortu, gaji_ortu, username, password, level)values('$nis', '$nama', '$jk', '$agama', '$kelas', '$gambar', 'Aktif', '$nama_ortu', '$alamat', '$no_hp_ortu', '$gaji_ortu_oke', '$nis', md5(123456), 'siswa') ");
              if ($sql) {
                $upload = move_uploaded_file($lokasi, "images/" . $gambar);
                echo "

                <script>
                    setTimeout(function() {
                        swal({
                            title: 'Data Siswa',
                            text: 'Berhasil Disimpan!',
                            type: 'success'
                        }, function() {
                            window.location = '?page=siswa';
                        });
                    }, 300);
                </script>

            ";
              }
            } else {
              echo "

                <script>
                    setTimeout(function() {
                        swal({
                            title: 'Data Siswa',
                            text: 'NIS Sudah Tersedia!',
                            type: 'error'
                        }, function() {
                            window.location = '?page=siswa';
                        });
                    }, 300);
                </script>

            ";
            }
          }

          ?>


          <!-- AKHIR TAMBAH DATA SISWA -->
        </div>
      </div>
    </div>
  </div>