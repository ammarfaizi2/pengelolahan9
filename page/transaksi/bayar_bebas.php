<?php
$nis = $_GET['nis_siswa'];
$id_bayar = $_GET['id_bayar'];
$id_tahun_ajaran = $_GET['id_tahun_ajaran'];

$sql = $koneksi->query("SELECT tb_tahun_ajaran.tahun_ajaran, tb_tahun_ajaran.id_tahun_ajaran, tb_jenis_bayar.nama_bayar, tb_jenis_bayar.id_bayar, tb_jenis_bayar.id_tahun_ajaran, tb_siswa.nis, tb_siswa.nama_siswa, tb_kelas.nama_kelas, tb_tagihan_bebas.id_tagihan_bebas, tb_tagihan_bebas.id_bayar,tb_tagihan_bebas.id_siswa, Sum(tb_tagihan_bebas.total_tagihan) AS jmlTagihanBulanan, Sum(tb_tagihan_bebas.terbayar) AS total_terbayar from tb_jenis_bayar
                          
                        INNER JOIN tb_tagihan_bebas ON tb_tagihan_bebas.id_bayar = tb_jenis_bayar.id_bayar
                        INNER JOIN tb_tahun_ajaran ON tb_jenis_bayar.id_tahun_ajaran = tb_tahun_ajaran.id_tahun_ajaran

                        INNER JOIN tb_siswa ON tb_tagihan_bebas.id_siswa = tb_siswa.id_siswa
                        INNER JOIN tb_kelas ON tb_tagihan_bebas.id_kelas = tb_kelas.id_kelas
                        WHERE tb_siswa.nis='$nis' and tb_jenis_bayar.id_tahun_ajaran='$id_tahun_ajaran' and tb_jenis_bayar.id_bayar='$id_bayar' GROUP BY tb_jenis_bayar.id_bayar 
                          ");

$data = $sql->fetch_assoc();

$nama_bayar = $data['nama_bayar'];
$Siswa = $data['nama_siswa'];
$keterangan = 'pembayaran' . '&nbsp' . $nama_bayar . '&nbsp' . 'Atas Nama' . '&nbsp' . $Siswa;
$id_siswa = $data['id_siswa'];
$sisa = $data['jmlTagihanBulanan'] - $data['total_terbayar'];
$terbayar = $data['total_terbayar'];
$id_tagihan_bebas = $data['id_tagihan_bebas'];

$tgl = date('Y-m-d');


?>


<div class="row">
  <div class="col-md-12">
    <div>
      <div>
        <a style="margin-bottom: 10px;" href="?page=transaksi&aksi=lihat&id=<?php echo $id_siswa; ?>" class=" btn btn-info"><i class=" fa fa-arrow-circle-left"></i> Kembali</a>
      </div>
    </div>
    <!-- Advanced Tables -->
    <div class="box box-primary box-solid">
      <div class="box-header with-border">
        Informasi Siswa
      </div>
      <div class="panel-body">
        <div class="col-md-4">
          <div class="form-group">
            <label>Jenis Bayar</label>
            <input type="text" readonly="" value="<?php echo $data['nama_bayar'] ?>" class="form-control">
          </div>
        </div>


        <div class="col-md-4">
          <div class="form-group">
            <label>Tahun Ajaran</label>
            <input type="text" value="<?php echo $data['tahun_ajaran'] ?>" readonly="" class="form-control">
          </div>
        </div>

        <div class="col-md-4">
          <div class="form-group">
            <label>Nis</label>
            <input type="text" name="jenis_bayar" value="<?php echo $data['nis'] ?>" readonly="" class="form-control">
          </div>
        </div>


        <div class="col-md-4">
          <div class="form-group">
            <label>Nama Siswa</label>
            <input type="text" name="tahun_ajaran" value="<?php echo $data['nama_siswa'] ?>" readonly="" class="form-control">
          </div>
        </div>

        <div class="col-md-4">
          <div class="form-group">
            <label>Kelas</label>
            <input type="text" name="tipe_bayar" value="<?php echo $data['nama_kelas'] ?>" readonly="" class="form-control">
          </div>
        </div>


        <div class="col-md-4">
          <div class="form-group">
            <label>Jumlah Tagihan</label>
            <input type="text" name="tipe_bayar" value="<?php echo number_format($data['jmlTagihanBulanan']) ?>" readonly="" class="form-control">
          </div>
        </div>




      </div>
    </div>


    <div class="row">
      <div class="col-md-12">
        <!-- Advanced Tables -->
        <div class="box box-info box-solid">
          <div class="box-header with-border">
            Pembayaran Tagihan Lain-lain
          </div>
          <div class="panel-body">
            <?php if ($sisa != 0) {
            ?>
              <form method="POST" enctype="multipart/form-data">
                <div class="col-md-2">
                  <label for="exampleInputEmail1">Tanggal Bayar</label>
                  <div class="form-group">
                    <input type="date" class="form-control" value="<?php echo $tgl ?>" name="tgl_bayar">
                  </div>
                </div>

                <div class="col-md-2">
                  <label for="exampleInputEmail1">Jumlah Bayar</label>
                  <div class="form-group">
                    <input type="text" class="form-control uang" value="<?php echo $sisa ?>" name="jml_bayar">
                  </div>
                </div>
                <div class="col-md-2">
                  <label for="exampleInputEmail1">Tipe Bayar</label>
                  <div class="form-group">

                    <?php if ($level == "admin") {
                    ?>
                      <select style=" width: 100px;" class="form-control" name="tipe">
                        <option value="Cash" selected>Cash</option>
                        <option value="Transfer">Transfer</option>
                      </select>
                    <?php } else { ?>
                      <input style=" width: 150px;" type="text" value="Transfer" class="form-control" name="tipe" readonly>
                    <?php } ?>
                  </div>
                </div>
                <div class="col-md-2 form-group">
                  <label for="berkas">Foto</label>
                  <input type="file" class="form-control" name="berkas">
                </div>

                <div class="col-md-2">
                  <label for="exampleInputEmail1">Keterangan</label>
                  <div class="form-group">

                    <select class="form-control" name="keterangan">
                      <option value="Angsuran 1">Angsuran 1</option>
                      <option value="Angsuran 2">Angsuran 2</option>
                      <option value="Angsuran 3">Angsuran 3</option>
                      <option value="Angsuran 4">Angsuran 4</option>
                      <option value="Angsuran 5">Angsuran 5</option>
                      <option value="Angsuran 6">Angsuran 6</option>

                    </select>
                  </div>
                </div>

                <div class="col-md-2">
                  <?php if ($level == 'admin') { ?>
                    <input type="submit" style="margin-top: 20px;" name="simpan_admin" value="Simpan" class="btn btn-primary">
                  <?php } else { ?>
                    <input type="submit" style="margin-top: 20px;" name="simpan" value="Simpan" class="btn btn-primary">
                  <?php } ?>
                </div>

              </form>


            <?php } ?>

            <?php
            if (isset($_POST['simpan_admin'])) {
              $tgl_bayar = $_POST['tgl_bayar'];
              $jml_bayar = $_POST['jml_bayar'];
              $tipe_bayar = $_POST['tipe'];
              $keterangan2 = $_POST['keterangan'];
              $jml_bayar_oke = str_replace(".", "", $jml_bayar);
              $keterangan_oke = $keterangan . '&nbsp' . $keterangan2;
              $lunas = $sisa - $jml_bayar_oke;
              if ($jml_bayar_oke > $sisa) {
                echo "

                          <script>
                              setTimeout(function() {
                                  sweetAlert({
                                      title: 'Maaf!',
                                      text: 'Jumlah Bayar Melebihi sisa Tagihan!',
                                      type: 'error'
                                  }, function() {
                                      window.location = '?page=transaksi&aksi=bayarbebas&nis_siswa=$nis&id_bayar=$id_bayar&id_tahun_ajaran=$id_tahun_ajaran';
                                  });
                              }, 300);
                          </script>
                        ";
              } else {
                $query = $koneksi->query("insert into tb_bayar_bebas (id_tagihan_bebas, tgl_bayar, jml_bayar, ket, foto, cara_bayar, validasi)values('$id_tagihan_bebas', '$tgl_bayar', '$jml_bayar_oke', '$keterangan2', '$gambar2', '$tipe_bayar', 'Pembayaran_Tervalidasi') ");
                if ($query == true) {
                  $query2 = $koneksi->query(" insert into tb_kas (id_transaksi, tgl_kas, keterangan, penerimaan)values('$id_tagihan_bebas', '$tgl_bayar', '$keterangan_oke', '$jml_bayar_oke') ");
                  if ($lunas == 0) {
                    $query3 = $koneksi->query("UPDATE tb_tagihan_bebas SET terbayar=($terbayar+$jml_bayar_oke), status_bayar ='1' WHERE id_tagihan_bebas='$id_tagihan_bebas' ");
                  } else {
                    $query3 = $koneksi->query("UPDATE tb_tagihan_bebas SET terbayar=($terbayar+$jml_bayar_oke) WHERE id_tagihan_bebas='$id_tagihan_bebas' ");
                  }
                  if ($query3 == true) {
                    echo "

                              <script>
                                  setTimeout(function() {
                                      swal({
                                          title: 'Pembayaran',
                                          text: 'Berhasil Disimpan !' ,
                                          type: 'success'
                                      }, function() {
                                          window.location ='?page=transaksi&aksi=bayarbebas&nis_siswa=$nis&id_bayar=$id_bayar&id_tahun_ajaran=$id_tahun_ajaran';
                                      });
                                  }, 300);
                              </script>

                          ";
                  }
                }
              }
            }

            if (isset($_POST['simpan'])) {
              $tgl_bayar = $_POST['tgl_bayar'];
              $jml_bayar = $_POST['jml_bayar'];
              $tipe_bayar = $_POST['tipe'];
              $keterangan2 = $_POST['keterangan'];
              $jml_bayar_oke = str_replace(".", "", $jml_bayar);
              $keterangan_oke = $keterangan . '&nbsp' . $keterangan2;
              $gambar2 = $_FILES['berkas']['name'];
              $lokasi = $_FILES['berkas']['tmp_name'];


              if ($jml_bayar_oke > $sisa) {
                echo "

                          <script>
                              setTimeout(function() {
                                  sweetAlert({
                                      title: 'Maaf!',
                                      text: 'Jumlah Bayar Melebihi sisa Tagihan!',
                                      type: 'error'
                                  }, function() {
                                      window.location = '?page=transaksi&aksi=bayarbebas&nis_siswa=$nis&id_bayar=$id_bayar&id_tahun_ajaran=$id_tahun_ajaran';
                                  });
                              }, 300);
                          </script>
                        ";
              } else {
                $upload = move_uploaded_file($lokasi, "images/" . $gambar2);
                if ($upload == true) {
                  $query = $koneksi->query("insert into tb_bayar_bebas (id_tagihan_bebas, tgl_bayar, jml_bayar, ket, foto, cara_bayar, validasi)values('$id_tagihan_bebas', '$tgl_bayar', '$jml_bayar_oke', '$keterangan2', '$gambar2', '$tipe_bayar', 'Menunggu_Validasi') ");
                  if ($query == true) {
                    $query2 = $koneksi->query(" insert into tb_kas (id_transaksi, tgl_kas, keterangan, penerimaan)values('$id_tagihan_bebas', '$tgl_bayar', '$keterangan_oke', '$jml_bayar_oke') ");
                    $query3 = $koneksi->query("UPDATE tb_tagihan_bebas SET terbayar=($terbayar+$jml_bayar_oke) WHERE id_tagihan_bebas='$id_tagihan_bebas' ");


                    echo "

                              <script>
                                  setTimeout(function() {
                                      swal({
                                          title: 'Pembayaran',
                                          text: 'Berhasil Disimpan !' ,
                                          type: 'success'
                                      }, function() {
                                          window.location ='?page=transaksi&aksi=bayarbebas&nis_siswa=$nis&id_bayar=$id_bayar&id_tahun_ajaran=$id_tahun_ajaran';
                                      });
                                  }, 300);
                              </script>

                          ";
                  }
                } else {
                  echo "

                          <script>
                              setTimeout(function() {
                                  sweetAlert({
                                      title: 'Maaf!',
                                      text: 'Upload Bukti Pembayaran!',
                                      type: 'error'
                                  }, function() {
                                      window.location = '?page=transaksi&aksi=bayarbebas&nis_siswa=$nis&id_bayar=$id_bayar&id_tahun_ajaran=$id_tahun_ajaran';
                                  });
                              }, 300);
                          </script>
                        ";
                }
              }
            }


            ?>

          </div>
          <div class="panel-body">
            <div class="table-responsive">
              <table class="table table-striped table-bordered table-hover" id="example1">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Tanggal</th>
                    <th>Jumlah Bayar</th>
                    <th>Tipe Bayar</th>
                    <th>Bukti Transfer</th>
                    <th>Keterangan</th>
                    <th>Status</th>
                    <th>Aksi </th>

                  </tr>
                </thead>
                <tbody>

                  <?php


                  $no = 1;

                  $sql2 = $koneksi->query("SELECT * from tb_bayar_bebas WHERE id_tagihan_bebas='$id_tagihan_bebas'");

                  while ($data = $sql2->fetch_assoc()) {

                  ?>


                    <tr>
                      <td><?php echo $no++; ?></td>
                      <td><?php echo tglIndonesia2(date('d F Y', strtotime($data['tgl_bayar']))) ?></td>
                      <td><?php echo number_format($data['jml_bayar']) ?></td>
                      <td><?php echo $data['cara_bayar'] ?></td>
                      <td><?php
                          echo "<img style='width:70px;' src='images/" . $data['foto'] . "' alt=''>";
                          ?>
                        <input type="hidden" name="gambar_lama" value="<?php echo $data['foto'] ?>">
                      </td>
                      <td><?php echo $data['ket'] ?></td>
                      <td>
                        <?php
                        if ($level == "admin") {
                          echo "<select style=' width: 100px;' class='form-control' name='vld'>";
                          if ($data['validasi'] == "Pembayaran_Tervalidasi") {
                            echo "<option value='Menunggu_Validasi' >Menunggu Validasi</option> <option value='Pembayaran_Tervalidasi' selected>Pembayaran Tervalidasi</option>";
                          } else {
                            echo "<option value='Menunggu_Validasi' selected>Menunggu Validasi</option> <option value='Pembayaran_Tervalidasi' >Pembayaran Tervalidasi</option>";
                          }
                          echo "</select>";
                        } else {
                          if ($data['validasi'] == "Pembayaran_Tervalidasi") { ?>
                            <span style="color:blue"> Pembayaran Tervalidasi</span>
                          <?php } else { ?>
                            <span style="color:red"> Menunggu Validasi</span>
                        <?php }
                        }
                        ?>

                        </select></td>
                      <td>
                        <form method="POST">
                          <input style="width: 150px;" type="hidden" name="jml_bayar" value="<?php echo $data['jml_bayar'] ?>" readonly="" class="form-control">

                          <input type="hidden" name="id_bayar_bebas" value="<?php echo $data['id_bayar_bebas'] ?>">
                          <?php if ($level == 'admin') {
                            if ($data['validasi'] <> "Pembayaran_Tervalidasi") {
                              echo "<button type='submit' dis name='simpan3' class='btn btn-primary btn-xs'><i></i> Konfirmasi </button>";
                            }
                          } ?>
                          <button type="submit" dis name="simpan2" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Hapus </button>

                          <a target="blank" href="page/transaksi/cetak_bebas.php?id_bayar_bebas=<?php echo $data['id_bayar_bebas'] ?>" class="btn btn-default btn-xs" title=""><i class="fa fa-print"></i> Cetak</a>

                      </td>
                      </form>


                      </form>

                    </tr>


                  <?php  } ?>

                </tbody>


              </table>

            </div>

          </div>
        </div>


        <?php

        if (isset($_POST['simpan2'])) {

          $id_bayar_bebas = $_POST['id_bayar_bebas'];

          $jml_bayar2 = $_POST['jml_bayar'];
          $gambar_lama = $_POST['gambar_lama'];
          $query = $koneksi->query("delete from tb_kas WHERE id_transaksi='$id_tagihan_bebas'");
          $hapus_gambar = unlink("images/" . $gambar_lama);

          if ($query) {
            $query2 = $koneksi->query("delete from tb_bayar_bebas WHERE id_bayar_bebas='$id_bayar_bebas'");
            $query3 = $koneksi->query("update tb_tagihan_bebas set terbayar=(terbayar-$jml_bayar2) WHERE id_tagihan_bebas='$id_tagihan_bebas'");


            echo "

                <script>
                    setTimeout(function() {
                        sweetAlert({
                            title: 'OKE!',
                            text: 'Berhasil Dihapus!',
                            type: 'error'
                        }, function() {
                            window.location = '?page=transaksi&aksi=bayarbebas&nis_siswa=$nis&id_bayar=$id_bayar&id_tahun_ajaran=$id_tahun_ajaran';
                        });
                    }, 300);
                </script>
              ";
          }
        }

        ?>
        <?php

        if (isset($_POST['simpan3'])) {
          $id_bayar_bebas = $_POST['id_bayar_bebas'];
          $jml_bayar2 = $_POST['jml_bayar'];
          $lunas = $sisa - $jml_bayar2;
          if ($lunas == 0) {
            $query = $koneksi->query("update tb_bayar_bebas set validasi ='Pembayaran_Tervalidasi' WHERE id_bayar_bebas='$id_bayar_bebas'");
            $query2 = $koneksi->query("update tb_tagihan_bebas set status_bayar = '1' where id_tagihan_bebas= '$id_tagihan_bebas'");
          } else {
            $query = $koneksi->query("update tb_bayar_bebas set validasi ='Pembayaran_Tervalidasi' WHERE id_bayar_bebas='$id_bayar_bebas'");
          }
          if ($query == true) {
            echo "
            <script>
            setTimeout(function() {
                sweetAlert({
                    title: 'Pembayaran',
                    text: 'Berhasil Dikonfirmasi!',
                    type: 'success'
                }, function() {
                    window.location = '?page=transaksi&aksi=bayarbebas&nis_siswa=$nis&id_bayar=$id_bayar&id_tahun_ajaran=$id_tahun_ajaran';
                });
            }, 300);
        </script>
      ";
          }
        }

        ?>