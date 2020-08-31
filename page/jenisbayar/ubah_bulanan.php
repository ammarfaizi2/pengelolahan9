<?php 

   $id_siswa = $_GET['id'];
  
  $sql = $koneksi->query("select * from tb_tagihan_bulanan, tb_jenis_bayar, tb_tahun_ajaran, tb_kelas, tb_siswa where tb_tagihan_bulanan.id_bayar=tb_jenis_bayar.id_bayar and tb_tahun_ajaran.id_tahun_ajaran=tb_jenis_bayar.id_tahun_ajaran and
    tb_tagihan_bulanan.id_kelas=tb_kelas.id_kelas and
    tb_tagihan_bulanan.id_siswa=tb_siswa.id_siswa and
    tb_tagihan_bulanan.id_siswa='$id_siswa'");
  $data = $sql->fetch_assoc();

 $jenis_bayar = $data['nama_bayar'];
 $tipe_bayar = $data['tipe_bayar'];
 $tahun_ajaran = $data['tahun_ajaran'];
 $kelas = $data['nama_kelas'];
 $nis = $data['nis'];
 $nama_siswa = $data['nama_siswa'];



 ?>





<div class="row">
    <div class="col-md-12">
        <!-- Advanced Tables -->
        <div class="box box-primary box-solid">
            <div class="box-header with-border">
                 Ubah Tarif
            </div>
            <div class="panel-body">

              <form role="form"  method="POST"> 

                  <div class="col-md-2">
                    <div class="form-group">
                          <label> Nis</label>
                          <input type="text" readonly="" class="form-control" value="<?php echo $nis; ?>">      
                        </div>
                     </div>

                      <div class="col-md-2">
                    <div class="form-group">
                          <label> Nama</label>
                          <input type="text" readonly="" class="form-control" value="<?php echo $nama_siswa; ?>">      
                        </div>
                     </div>


                   <div class="col-md-2">
                    <div class="form-group">
                          <label> Jenis Bayar</label>
                          <input type="text" readonly="" class="form-control" value="<?php echo $jenis_bayar; ?>">      
                        </div>
                     </div>

                     <div class="col-md-2">
                    <div class="form-group">
                          <label> Tahun Ajaran</label>
                          <input type="text" readonly="" class="form-control" value="<?php echo $tahun_ajaran; ?>">      
                        </div>
                     </div>

                     <div class="col-md-2">
                    <div class="form-group">
                          <label> Tipe Bayar</label>
                          <input type="text" readonly="" class="form-control" value="<?php echo $tipe_bayar; ?>">      
                        </div>
                     </div>

                       <div class="col-md-2">
                    <div class="form-group">
                          <label> Kelas</label>
                          <input type="text" readonly="" class="form-control" value="<?php echo $kelas; ?>">      
                        </div>
                     </div>
             
             


                      <div class="col-md-12">
                  <div class="form-group">
                          <label> <br>Tarif Setiap Bulan </label>
                           
                        </div>
                     </div>

                
                <?php
                  $sqlEdit1 = $koneksi->query("SELECT * from tb_tagihan_bulanan
                      
                      
                      INNER JOIN tb_bulan ON tb_tagihan_bulanan.id_bulan = tb_bulan.id_bulan
                      WHERE  tb_tagihan_bulanan.id_siswa='$id_siswa' ORDER BY tb_bulan.urutan ASC");
                  while($rec=$sqlEdit1->fetch_assoc()){
                  ?>
                  
                      <input type="hidden" name="idt<?php echo $rec['id_bulan']; ?>" value="<?php echo $rec['id_tagihan_bulanan']; ?>" >

                       <div class="col-md-2">
                        <div class="form-group">
                              <label> <?php echo $rec['nama_bulan']; ?></label>
                              <input type="text"  name="n<?php echo $rec['id_bulan']; ?>" class="form-control uang" value="<?php echo $rec['jml_bayar']; ?>">      
                            </div>
                         </div>

                     
                 
                  <?php
                  }
                ?>
             

                
                     <button type="submit" name="tambah" class="btn btn-block btn-primary btn-lg">Ubah Tagihan</button>

                 </form> 

         

                
               
</div>
</div>




<?php
if (isset($_POST['tambah'])){
        $nn = 12; // membaca jumlah data
    // looping
    for($i=1; $i<=$nn; $i++){
      $idts = $_POST['idt'.$i];
      $jmlBayar = $_POST['n'.$i];
      $jmlBayar_oke = str_replace(".", "", $jmlBayar);

      $query= $koneksi->query("UPDATE tb_tagihan_bulanan SET jml_bayar='$jmlBayar_oke'
                    WHERE id_tagihan_bulanan='$idts'");
    }
        
    if ($query) {
                echo "

                    <script>
                        setTimeout(function() {
                            swal({
                                title: 'Data Tagihan',
                                text: 'Berhasil Disimpan!',
                                type: 'success'
                            }, function() {
                                window.location = '?page=jenisbayar&aksi=ubahbulanan&id=$id_siswa';
                            });
                        }, 300);
                    </script>

                ";
              }
    }
  
?>










     