<?php

$id_bayar = $_GET['id'];

$sql = $koneksi->query("select * from tb_jenis_bayar, tb_tahun_ajaran where tb_jenis_bayar.id_tahun_ajaran=tb_tahun_ajaran.id_tahun_ajaran and tb_jenis_bayar.id_bayar='$id_bayar'");
$data = $sql->fetch_assoc();

$tipe_bayar = $data['tipe_bayar'];


if ($tipe_bayar == "Bulanan") {




?>


  <div class="row">
    <div class="col-md-12">
    <div>
      <div>
        <a style="margin-bottom: 10px;" href="?page=jenisbayar" class=" btn btn-info"><i class=" fa fa-arrow-circle-left"></i> Kembali</a>
      </div>
    </div>
      <!-- Advanced Tables -->
      <div class="box box-primary box-solid">
        <div class="box-header with-border">
          Pilih Kelas dan Input Tarif
        </div>
        <div class="panel-body">

          <form role="form" method="POST">

            <div class="col-md-4">
              <div class="form-group">
                <label>Jenis Bayar</label>
                <input type="text" name="jenis_bayar" value="<?php echo $data['nama_bayar'] ?>" readonly="" class="form-control">
              </div>
            </div>


            <div class="col-md-2">
              <div class="form-group">
                <label>Tahun Ajaran</label>
                <input type="hidden" name="id_tahun" value="<?php echo $data['id_tahun_ajaran'] ?>">
                <input type="text" name="tahun_ajaran" value="<?php echo $data['tahun_ajaran'] ?>" readonly="" class="form-control">
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <label>Tipe Bayar</label>
                <input type="text" name="tipe_bayar" value="<?php echo $data['tipe_bayar'] ?>" readonly="" class="form-control">
              </div>
            </div>


            <div class="col-md-2">
              <div class="form-group">

                <label>Kelas :</label> <br>
                <select required="" class="form-control" name="kelas">

                  <option value="">-Pilih Kelas-</option>
                  <?php


                  $query = $koneksi->query("SELECT * FROM tb_kelas ORDER by id_kelas");

                  while ($tampil_t = $query->fetch_assoc()) {

                    echo "<option value='$tampil_t[id_kelas]'> $tampil_t[nama_kelas]</option>";
                  }

                  ?>

                </select>
              </div>
            </div>


            <div class="col-md-3">
              <div class="form-group">
                <label>Batas Bawah </label>
                <input type="text" name="batas_bawah" required="" autocomplete="off" class="form-control uang">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Batas Atas </label>
                <input type="text" name="batas_atas" required="" autocomplete="off" class="form-control uang">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Jumlah Biaya</label>
                <input type="text" name="jml_biaya" required="" autocomplete="off" class="form-control uang">
              </div>
            </div>

            <button type="submit" name="tambah" class="btn btn-block btn-primary btn-lg">Simpan</button>

          </form>

        </div>
      </div>

      <?php
      if (isset($_POST['tambah'])) {
        $id_bayar_oke = $id_bayar;
        $id_kelas = $_POST['kelas'];
        $batas_bawah = $_POST['batas_bawah'];
        $tahun_ajaran = $_POST['id_tahun'];
        $batas_atas = $_POST['batas_atas'];
        $jml_biaya = $_POST['jml_biaya'];
        $bawah_oke = str_replace(".", "", $batas_bawah);
        $atas_oke = str_replace(".", "", $batas_atas);
        $biaya_oke = str_replace(".", "", $jml_biaya);
        //$sqlSiswa=mysql_query("SELECT * FROM siswa WHERE idKelas='$_POST[idKelas]'");
        $sqlSiswa = $koneksi->query("SELECT count(*) as total FROM tb_kategori WHERE id_kelas='$id_kelas' and id_bayar = '$id_bayar' and id_tahun_ajaran = '$tahun_ajaran' and batas_bawah = '$bawah_oke' and batas_atas ='$atas_oke'");
        $dataSiswa = $sqlSiswa->fetch_assoc();
        $jmlSiswa = $dataSiswa['total'];
        //nilai tarif
        if ($jmlSiswa > 0) { ?>
          <script>
            setTimeout(function() {
              sweetAlert({
                title: 'Maaf!',
                text: 'Data Tagihan Sudah Dibuat Silahkan Cari di Data Tagihan!',
                type: 'error'
              }, function() {
                window.location = '?page=jenisbayar&aksi=seting&id=<?php echo $id_bayar ?>';
              });
            }, 300);
          </script>
      <?php

        } else {

          $simpan_kategori = $koneksi->query("INSERT INTO tb_kategori (id_kelas, id_tahun_ajaran, id_bayar, batas_bawah, batas_atas, jml_bayar) values
                  ('$id_kelas','$tahun_ajaran','$id_bayar_oke', '$bawah_oke','$atas_oke' , '$biaya_oke')");
          $kategori = $koneksi->query("select id_kategori from tb_kategori order by id_kategori desc limit 1");
          $data_kategori = $kategori->fetch_assoc();
          $id_kategori = $data_kategori['id_kategori'];

          require __DIR__."/fungsi_bulanan.php";

          $query = tagihan_bulanan(compact("koneksi", "id_kelas", "bawah_oke", "atas_oke", "id_bayar", "id_kategori", "biaya_oke"));

          /*$sqlSiswa2 = $koneksi->query("SELECT * FROM tb_siswa where kelas = '$id_kelas' and gaji_ortu between '$bawah_oke' and '$atas_oke'");
          while ($ds = $sqlSiswa2->fetch_assoc()) {
            $idSiswa = $ds['id_siswa'];
            $jmlbulan = 12;
            for ($j = 1; $j <= $jmlbulan; $j++) {
              switch ($j) {
                case ($j <= $jmlbulan):
                  $dt = $biaya_oke;
                  break;
                default:
                  $dt = "";
              }
              $query = $koneksi->query("INSERT INTO tb_tagihan_bulanan(id_bayar, id_siswa, id_kelas, id_kategori, id_bulan, jml_bayar)
									VALUES('$id_bayar',
										'$idSiswa',
										'$id_kelas',
                    '$id_kategori',
										'$j',
										'$dt')");
            }
          }*/

          if ($query) {

            echo "

		                <script>
		                    setTimeout(function() {
		                        swal({
		                            title: 'Data Tagihan',
		                            text: 'Berhasil Disimpan!',
		                            type: 'success'
		                        }, function() {
		                            window.location = '?page=jenisbayar&aksi=seting&id=$id_bayar';
		                        });
		                    }, 300);
		                </script>

		            ";
          }
        }
      }


      ?>

      <div class="row">
        <div class="col-md-12">
          <!-- Advanced Tables -->
          <div class="box box-warning box-solid">
            <div class="box-header with-border">
              Data Aturan
            </div>
            <div class="panel-body">
              <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="example1">

                  <div class="col-md-12">
                    <form method="POST">
                      <div class="col-md-3">
                        <div class="form-group">

                          <label style="color: black; font-weight: bold;">Pilih Kelas</label> <br>
                          <select required="" class="form-control" name="kelas2">

                            <option value="">-Pilih Kelas-</option>
                            <?php


                            $query = $koneksi->query("SELECT * FROM tb_kelas ORDER by id_kelas");

                            while ($tampil_t = $query->fetch_assoc()) {

                              echo "<option value='$tampil_t[id_kelas]'> $tampil_t[nama_kelas] $tampil_t[sub_kelas]</option>";
                            }

                            ?>

                          </select>
                        </div>

                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                          <button type="submit" name="filter2" style="margin-top: 25px;" class="btn btn-info"><i class="fa fa-search"></i> Cari</button>
                        </div>

                      </div>

                    </form>

                  </div>
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Kelas</th>
                      <th>Tahun Ajaran</th>
                      <th>Batas Bawah</th>
                      <th>Batas Atas</th>
                      <th>Jumlah Biaya</th>
                      <th>Aksi</th>

                    </tr>
                  </thead>
                  <tbody>

                    <?php

                    if (isset($_POST['filter2'])) {
                      $kelas2 = $_POST['kelas2'];
                    }

                    if ($kelas2 != "") {
                      $no = 1;
                      $sql_aturan = $koneksi->query("SELECT s.nama_kelas, k.id_kategori, k.id_kelas, t.tahun_ajaran, k.batas_atas, k.batas_bawah, k.jml_bayar
                              from tb_kategori k 
                              join tb_kelas s on k.id_kelas = s.id_kelas 
                              join tb_tahun_ajaran t on t.id_tahun_ajaran = k.id_tahun_ajaran where k.id_kelas ='$kelas2' and id_bayar='$id_bayar' order by k.jml_bayar asc");
                      while ($data_aturan = $sql_aturan->fetch_assoc()) {
                    ?>


                        <tr>
                          <td><?php echo $no++; ?></td>
                          <td><?php echo $data_aturan['nama_kelas'] ?></td>
                          <td><?php echo $data_aturan['tahun_ajaran'] ?></td>
                          <td><?php echo number_format($data_aturan['batas_bawah'], 0, ",", ".") ?></td>
                          <td><?php echo number_format($data_aturan['batas_atas'], 0, ",", ".") ?></td>
                          <td><?php echo number_format($data_aturan['jml_bayar'], 0, ",", ".") ?></td>
                          <td>
                            <a onclick="return confirm('Apakah Anda Yakin Menghapus Data Ini')" href="?page=jenisbayar&aksi=hapuskategori&id_kategori=<?php echo $data_aturan['id_kategori']; ?>&id_bayar=<?php echo $id_bayar ?>" class="btn btn-danger" title=""><i class="fa fa-trash"></i> Hapus</a>
                          </td>



                        </tr>


                    <?php }
                    } ?>

                  </tbody>




                </table>



              </div>


            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <!-- Advanced Tables -->
              <div class="box box-warning box-solid">
                <div class="box-header with-border">
                  Data Tagihan
                </div>
                <div class="panel-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="example2">

                      <div class="col-md-12">
                        <form method="POST">
                          <div class="col-md-3">
                            <div class="form-group">

                              <label style="color: black; font-weight: bold;">Pilih Kelas</label> <br>
                              <select required="" class="form-control" name="kelas">

                                <option value="">-Pilih Kelas-</option>
                                <?php


                                $query = $koneksi->query("SELECT * FROM tb_kelas ORDER by id_kelas");

                                while ($tampil_t = $query->fetch_assoc()) {

                                  echo "<option value='$tampil_t[id_kelas]'> $tampil_t[nama_kelas]</option>";
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

                      </div>



                      <thead>
                        <tr>
                          <th>No.</th>
                          <th>NIS</th>
                          <th>Nama</th>
                          <th>Kelas</th>
                          <th>Total Tagihan</th>
                          <th>Aksi</th>

                        </tr>
                      </thead>
                      <tbody>

                        <?php

                        if (isset($_POST['filter'])) {
                          $kelas = $_POST['kelas'];
                        }

                        if ($kelas != "") {

                          $no = 1;

                          $sql = $koneksi->query("SELECT tb_siswa.nis, tb_siswa.id_siswa, tb_siswa.nama_siswa, tb_kelas.nama_kelas, sum(tb_tagihan_bulanan.jml_bayar) as jml_bayar_oke from tb_tagihan_bulanan
													
											INNER JOIN tb_siswa ON tb_tagihan_bulanan.id_siswa = tb_siswa.id_siswa
											INNER JOIN tb_kelas ON tb_tagihan_bulanan.id_kelas = tb_kelas.id_kelas
											WHERE tb_tagihan_bulanan.id_bayar='$id_bayar'
											AND tb_tagihan_bulanan.id_kelas='$kelas' GROUP BY tb_siswa.id_siswa	
                      	");


                          while ($data = $sql->fetch_assoc()) {


                        ?>


                            <tr>
                              <td><?php echo $no++; ?></td>
                              <td><?php echo $data['nis'] ?></td>
                              <td><?php echo $data['nama_siswa'] ?></td>
                              <td><?php echo $data['nama_kelas'] ?></td>
                              <td><?php echo number_format($data['jml_bayar_oke'], 0, ",", ".") ?></td>

                              <td>

                                <a href="#" type="button" class="btn btn-info" data-toggle="modal" data-target="#mymodal<?php echo $data['id_siswa']; ?>"><i class="fa fa-eye"></i> Lihat Detail Tagihan</a>

                                <a href="?page=jenisbayar&aksi=ubahbulanan&id=<?php echo $data['id_siswa']; ?>" class="btn btn-success" title=""><i class="fa fa-edit"></i> Ubah</a>

                                <a onclick="return confirm('Apakah Anda Yakin Mengahpus Data Ini')" href="?page=jenisbayar&aksi=hapusbulanan&id_siswa=<?php echo $data['id_siswa']; ?>&id_bayar=<?php echo $id_bayar ?>" class="btn btn-danger" title=""><i class="fa fa-trash"></i> Hapus</a>
                              </td>



                            </tr>


                            <div class="modal fade" id="mymodal<?php echo $data['id_siswa']; ?>">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="box box-primary box-solid">
                                    <div class="box-header with-border">
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                      Detail Tagihan
                                    </div>
                                    <div class="modal-body">

                                      <?php

                                      $id_siswa = $data['id_siswa'];

                                      $nama_siswa = $data['nama_siswa'];
                                      $nis = $data['nis'];

                                      ?>


                                      <div class="col-md-12">

                                        <div class="col-md-6">

                                          <div class="form-group">
                                            <label>Nis</label>
                                            <input type="text" name="nis" class="form-control" value="<?php echo  $nis; ?>" required="">
                                          </div>
                                        </div>

                                        <div class="col-md-6">

                                          <div class="form-group">
                                            <label>Nama Siswa</label>
                                            <input type="text" name="nis" class="form-control" value="<?php echo  $nama_siswa; ?>" required="">
                                          </div>

                                        </div>

                                      </div>


                                      <?php

                                      $sql2 = $koneksi->query("select * from tb_tagihan_bulanan, tb_bulan, tb_jenis_bayar, tb_tahun_ajaran, tb_kelas, tb_siswa where tb_tagihan_bulanan.id_bayar=tb_jenis_bayar.id_bayar and tb_tahun_ajaran.id_tahun_ajaran=tb_jenis_bayar.id_tahun_ajaran and
                            tb_tagihan_bulanan.id_kelas=tb_kelas.id_kelas and
                            tb_tagihan_bulanan.id_siswa=tb_siswa.id_siswa and
                            tb_tagihan_bulanan.id_bulan = tb_bulan.id_bulan and
                            tb_tagihan_bulanan.id_siswa='$id_siswa' ORDER BY tb_bulan.urutan ASC");

                                      while ($data2 = $sql2->fetch_assoc()) {


                                        $status = $data2['status_bayar'];

                                        if ($status == 0) {
                                          $status_t = "Belum Lunas";
                                          $color = "red";
                                        } else {
                                          $status_t = "Lunas";
                                          $color = "green";
                                        }

                                      ?>



                                        <div class="col-md-12">

                                          <div class="col-md-4">

                                            <div class="form-group" style="color: <?php echo $color ?>">
                                              <label>Bulan</label>
                                              <input style="color: <?php echo $color ?>" type="text" name="nis" class="form-control" value="<?php echo $data2['nama_bulan']; ?>" required="">
                                            </div>



                                          </div>

                                          <div class="col-md-4">

                                            <div class="form-group" style="color: <?php echo $color ?>">
                                              <label>Jumlah Tagihan</label>
                                              <input style="color: <?php echo $color ?>" type="text" name="nis" class="form-control" value="<?php echo number_format($data2['jml_bayar'], 0, ",", ".") ?>" required="">
                                            </div>



                                          </div>

                                          <div class="col-md-4">

                                            <div class="form-group" style="color: <?php echo $color ?>">
                                              <label>Status</label>
                                              <input style="color: <?php echo $color ?>" type="text" name="nis" class="form-control" value="<?php echo $status_t ?>" required="">
                                            </div>



                                          </div>

                                        </div>



                                      <?php
                                      }
                                      ?>


                                    </div>
                                    <div class="modal-footer">

                                      <button type="button" class="btn btn-block btn-danger btn-lg" data-dismiss="modal">Close</button>




                                    </div>



                                <?php }
                            } ?>

                      </tbody>




                    </table>



                  </div>


                </div>
              </div>


            <?php } else { ?>

              <div class="row">
                <div class="col-md-12">
                  <!-- Advanced Tables -->
                  <div class="box box-primary box-solid">
                    <div class="box-header with-border">
                      Pilih Kelas dan Input Tarif Data Bebas
                    </div>
                    <div class="panel-body">

                      <form role="form" method="POST">

                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Jenis Bayar</label>

                            <input type="text" name="jenis_bayar" value="<?php echo $data['nama_bayar'] ?>" readonly="" class="form-control">
                          </div>
                        </div>


                        <div class="col-md-3">
                          <div class="form-group">
                            <label>Tahun Ajaran</label>
                            <input type="hidden" name="id_tahun" value="<?php echo $data['id_tahun_ajaran'] ?>">
                            <input type="text" name="tahun_ajaran" value="<?php echo $data['tahun_ajaran'] ?>" readonly="" class="form-control">
                          </div>
                        </div>

                        <div class="col-md-2">
                          <div class="form-group">
                            <label>Tipe Bayar</label>
                            <input type="text" name="tipe_bayar" value="<?php echo $data['tipe_bayar'] ?>" readonly="" class="form-control">
                          </div>
                        </div>





                        <div class="col-md-2">
                          <div class="form-group">

                            <label>Kelas :</label> <br>
                            <select required="" class="form-control" name="kelas">

                              <option value="">-Pilih Kelas-</option>
                              <?php


                              $query = $koneksi->query("SELECT * FROM tb_kelas ORDER by id_kelas");

                              while ($tampil_t = $query->fetch_assoc()) {

                                echo "<option value='$tampil_t[id_kelas]'> $tampil_t[nama_kelas]</option>";
                              }

                              ?>

                            </select>
                          </div>
                        </div>


                        <div class="col-md-3">
                          <div class="form-group">
                            <label>Batas Bawah </label>
                            <input type="text" name="batas_bawah" required="" autocomplete="off" class="form-control uang">
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label>Batas Atas </label>
                            <input type="text" name="batas_atas" required="" autocomplete="off" class="form-control uang">
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label>Jumlah Biaya</label>
                            <input type="text" name="total_tagihan" required="" autocomplete="off" class="form-control uang">
                          </div>
                        </div>


                        <button type="submit" name="tambah" class="btn btn-block btn-primary btn-lg">Simpan</button>

                      </form>



                    </div>
                  </div>
                  <?php
                  if (isset($_POST['tambah'])) {
                    $id_bayar_oke = $id_bayar;
                    $id_kelas = $_POST['kelas'];
                    $batas_bawah = $_POST['batas_bawah'];
                    $tahun_ajaran = $_POST['id_tahun'];
                    $batas_atas = $_POST['batas_atas'];
                    $jml_biaya = $_POST['total_tagihan'];
                    $bawah_oke = str_replace(".", "", $batas_bawah);
                    $atas_oke = str_replace(".", "", $batas_atas);
                    $biaya_oke = str_replace(".", "", $jml_biaya);

                    $sqlSiswa = $koneksi->query("SELECT count(*) as total FROM tb_kategori WHERE id_kelas='$id_kelas' and id_bayar = '$id_bayar' and id_tahun_ajaran = '$tahun_ajaran' and batas_bawah = '$bawah_oke' and batas_atas ='$atas_oke'");
                    $dataSiswa = $sqlSiswa->fetch_assoc();
                    $jmlSiswa = $dataSiswa['total'];
                    if ($jmlSiswa > 0) {
                  ?> <script>
                        setTimeout(function() {
                          sweetAlert({
                            title: 'Maaf!',
                            text: 'Data Tagihan Sudah Dibuat Silahkan Cari di Data Tagihan!',
                            type: 'error'
                          }, function() {
                            window.location = '?page=jenisbayar&aksi=seting&id=<?php echo $id_bayar ?>';
                          });
                        }, 300);
                      </script>

                  <?php

                    } else {
                      // looping
                      $simpan_kategori = $koneksi->query("INSERT INTO tb_kategori (id_kelas, id_tahun_ajaran, id_bayar, batas_bawah, batas_atas, jml_bayar) values
                  ('$id_kelas','$tahun_ajaran','$id_bayar_oke', '$bawah_oke','$atas_oke' , '$biaya_oke')");
                      $kategori = $koneksi->query("select id_kategori from tb_kategori order by id_kategori desc limit 1");
                      $data_kategori = $kategori->fetch_assoc();
                      $id_kategori = $data_kategori['id_kategori'];

          require __DIR__."/fungsi_bebas.php";

           $query_simpan = tagihan_bebas(compact("koneksi", "id_kelas", "bawah_oke", "atas_oke", "id_bayar", "id_kategori", "biaya_oke"));
          


                  //     $sqlSiswa2 = $koneksi->query("SELECT * FROM tb_siswa where kelas = '$id_kelas' and gaji_ortu between '$bawah_oke' and '$atas_oke'");
                  //     while ($ds = $sqlSiswa2->fetch_assoc()) {
                  //       $idSiswa = $ds['id_siswa'];
                  //       $query_simpan = $koneksi->query("INSERT INTO tb_tagihan_bebas(id_bayar, id_siswa, id_kelas, id_kategori, total_tagihan)
									// VALUES('$id_bayar_oke',
									// 		'$idSiswa',
									// 		'$id_kelas',
                  //     '$id_kategori',
									// 		'$biaya_oke')");
                  //     }




                      if ($query_simpan) {

                        echo "
		                <script>
		                    setTimeout(function() {
		                        swal({
		                            title: 'Data Tagihan Bebas',
		                            text: 'Berhasil Disimpan!',
		                            type: 'success'
		                        }, function() {
		                            window.location = '?page=jenisbayar&aksi=seting&id=$id_bayar';
		                        });
		                    }, 300);
		                </script>

		            ";
                //       } else {
                //         echo "
		            //     <script>
		            //         setTimeout(function() {
		            //             swal({
		            //                 title: 'Data Tagihan Bebas',
		            //                 text: 'Gagal Simpan!',
		            //                 type: 'error'
		            //             }, function() {
		            //                 window.location = '?page=jenisbayar&aksi=seting&id=$id_bayar';
		            //             });
		            //         }, 300);
		            //     </script>

		            // ";
                      }
                    }
                  }


                  ?>

                  <div class="row">
                    <div class="col-md-12">
                      <!-- Advanced Tables -->
                      <div class="box box-warning box-solid">
                        <div class="box-header with-border">
                          Data Aturan
                        </div>
                        <div class="panel-body">
                          <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="example1">

                              <div class="col-md-12">
                                <form method="POST">
                                  <div class="col-md-3">
                                    <div class="form-group">

                                      <label style="color: black; font-weight: bold;">Pilih Kelas</label> <br>
                                      <select required="" class="form-control" name="kelas2">

                                        <option value="">-Pilih Kelas-</option>
                                        <?php


                                        $query = $koneksi->query("SELECT * FROM tb_kelas ORDER by id_kelas");

                                        while ($tampil_t = $query->fetch_assoc()) {

                                          echo "<option value='$tampil_t[id_kelas]'> $tampil_t[nama_kelas] $tampil_t[sub_kelas]</option>";
                                        }

                                        ?>

                                      </select>
                                    </div>

                                  </div>



                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <button type="submit" name="filter2" style="margin-top: 25px;" class="btn btn-info"><i class="fa fa-search"></i> Cari</button>
                                    </div>

                                  </div>

                                </form>

                              </div>
                              <thead>
                                <tr>
                                  <th>No.</th>
                                  <th>Kelas</th>
                                  <th>Tahun Ajaran</th>
                                  <th>Batas Bawah</th>
                                  <th>Batas Atas</th>
                                  <th>Jumlah Biaya</th>
                                  <th>Aksi</th>

                                </tr>
                              </thead>
                              <tbody>

                                <?php

                                if (isset($_POST['filter2'])) {
                                  $kelas2 = $_POST['kelas2'];
                                }

                                if ($kelas2 != "") {
                                  $no = 1;
                                  $sql_aturan = $koneksi->query("SELECT s.nama_kelas, k.id_kategori, k.id_kelas, t.tahun_ajaran, k.batas_atas, k.batas_bawah, k.jml_bayar
                              from tb_kategori k 
                              join tb_kelas s on k.id_kelas = s.id_kelas 
                              join tb_tahun_ajaran t on t.id_tahun_ajaran = k.id_tahun_ajaran where k.id_kelas ='$kelas2' and id_bayar='$id_bayar' order by k.jml_bayar asc");
                                  while ($data_aturan = $sql_aturan->fetch_assoc()) {

                                ?>


                                    <tr>
                                      <td><?php echo $no++; ?></td>
                                      <td><?php echo $data_aturan['nama_kelas'] ?></td>
                                      <td><?php echo $data_aturan['tahun_ajaran'] ?></td>
                                      <td><?php echo number_format($data_aturan['batas_bawah'], 0, ",", ".") ?></td>
                                      <td><?php echo number_format($data_aturan['batas_atas'], 0, ",", ".") ?></td>
                                      <td><?php echo number_format($data_aturan['jml_bayar'], 0, ",", ".") ?></td>
                                      <td>
                                        <a onclick="return confirm('Apakah Anda Yakin Mengahpus Data Ini')" href="?page=jenisbayar&aksi=hapuskategori&id_kategori=<?php echo $data_aturan['id_kategori']; ?>&id_bayar=<?php echo $id_bayar ?>" class="btn btn-danger" title=""><i class="fa fa-trash"></i> Hapus</a>
                                      </td>



                                    </tr>


                                <?php }
                                } ?>

                              </tbody>




                            </table>



                          </div>


                        </div>
                      </div>



                      <div class="row">
                        <div class="col-md-12">
                          <!-- Advanced Tables -->
                          <div class="box box-warning box-solid">
                            <div class="box-header with-border">
                              Data Tagihan
                            </div>
                            <div class="panel-body">
                              <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="example2">

                                  <div class="col-md-12">
                                    <form method="POST">
                                      <div class="col-md-3">
                                        <div class="form-group">

                                          <label style="color: black; font-weight: bold;">Pilih Kelas</label> <br>
                                          <select required="" class="form-control" name="kelas">

                                            <option value="">-Pilih Kelas-</option>
                                            <?php


                                            $query = $koneksi->query("SELECT * FROM tb_kelas ORDER by id_kelas");

                                            while ($tampil_t = $query->fetch_assoc()) {

                                              echo "<option value='$tampil_t[id_kelas]'> $tampil_t[nama_kelas]</option>";
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

                                  </div>



                                  <thead>
                                    <tr>
                                      <th>No.</th>
                                      <th>NIS</th>
                                      <th>Nama</th>
                                      <th>Kelas</th>
                                      <th>Total Tagihan</th>
                                      <th>Aksi</th>

                                    </tr>
                                  </thead>
                                  <tbody>

                                    <?php

                                    if (isset($_POST['filter'])) {
                                      $kelas = $_POST['kelas'];
                                    }

                                    if ($kelas != "") {

                                      $no = 1;

                                      $sql = $koneksi->query("SELECT * from tb_tagihan_bebas
													
											INNER JOIN tb_siswa ON tb_tagihan_bebas.id_siswa = tb_siswa.id_siswa
											INNER JOIN tb_kelas ON tb_tagihan_bebas.id_kelas = tb_kelas.id_kelas
											WHERE tb_tagihan_bebas.id_bayar='$id_bayar'
											AND tb_tagihan_bebas.id_kelas='$kelas' GROUP BY tb_siswa.id_siswa	
                      	");


                                      while ($data = $sql->fetch_assoc()) {


                                    ?>


                                        <tr>
                                          <td><?php echo $no++; ?></td>
                                          <td><?php echo $data['nis'] ?></td>
                                          <td><?php echo $data['nama_siswa'] ?></td>
                                          <td><?php echo $data['nama_kelas'] ?></td>
                                          <td><?php echo number_format($data['total_tagihan'], 0, ",", ".") ?></td>

                                          <td>



                                            <a href="?page=jenisbayar&aksi=ubahbebas&id=<?php echo $data['id_tagihan_bebas']; ?>" class="btn btn-success" title=""><i class="fa fa-edit"></i> Ubah</a>

                                            <a onclick="return confirm('Apakah Anda Yakin Mengahpus Data Ini')" href="?page=jenisbayar&aksi=hapusbebas&id_tagihan=<?php echo $data['id_tagihan_bebas']; ?>&id_bayar=<?php echo $id_bayar ?>" class="btn btn-danger" title=""><i class="fa fa-trash"></i> Hapus</a>
                                          </td>



                                        </tr>


                                    <?php }
                                    } ?>

                                  </tbody>




                                </table>



                              </div>


                            </div>
                          </div>



                        <?php } ?>