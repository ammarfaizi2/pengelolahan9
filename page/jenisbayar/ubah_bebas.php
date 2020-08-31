<?php 

   $id_tagihan = $_GET['id'];
  
  
  $sql = $koneksi->query("select * from tb_tagihan_bebas, tb_jenis_bayar, tb_tahun_ajaran, tb_kelas, tb_siswa where tb_tagihan_bebas.id_bayar=tb_jenis_bayar.id_bayar and tb_tahun_ajaran.id_tahun_ajaran=tb_jenis_bayar.id_tahun_ajaran and
    tb_tagihan_bebas.id_kelas=tb_kelas.id_kelas and
    tb_tagihan_bebas.id_siswa=tb_siswa.id_siswa and
    tb_tagihan_bebas.id_tagihan_bebas='$id_tagihan'");
  $data = $sql->fetch_assoc();

 $jenis_bayar = $data['nama_bayar'];
 $tipe_bayar = $data['tipe_bayar'];
 $tahun_ajaran = $data['tahun_ajaran'];
 $kelas = $data['nama_kelas'];
 $nis = $data['nis'];
 $nama_siswa = $data['nama_siswa'];


  $total_tagihan = $data['total_tagihan'];



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

               <div class="col-md-6">	

                  <div class="col-md-6">
                    <div class="form-group">
                          <label> Nis</label>
                          <input type="text" readonly="" class="form-control" value="<?php echo $nis; ?>">      
                        </div>
                     </div>

                      <div class="col-md-6">
                    <div class="form-group">
                          <label> Nama</label>
                          <input type="text" readonly="" class="form-control" value="<?php echo $nama_siswa; ?>">      
                        </div>
                     </div>


                   <div class="col-md-6">
                    <div class="form-group">
                          <label> Jenis Bayar</label>
                          <input type="text" readonly="" class="form-control" value="<?php echo $jenis_bayar; ?>">      
                        </div>
                     </div>

                     <div class="col-md-6">
                    <div class="form-group">
                          <label> Tahun Ajaran</label>
                          <input type="text" readonly="" class="form-control" value="<?php echo $tahun_ajaran; ?>">      
                        </div>
                     </div>

                  </div> 

                  <div class="col-md-6">  

                     <div class="col-md-6">
                    <div class="form-group">
                          <label> Tipe Bayar</label>
                          <input type="text" readonly="" class="form-control" value="<?php echo $tipe_bayar; ?>">      
                        </div>
                     </div>

                       <div class="col-md-6">
                    <div class="form-group">
                          <label> Kelas</label>
                          <input type="text" readonly="" class="form-control" value="<?php echo $kelas; ?>">      
                        </div>
                     </div>

                    <div class="col-md-6">
                    <div class="form-group">
                          <label> Tarif </label>
                          <input type="text" name="tarif"  class="form-control uang" value="<?php echo $total_tagihan; ?>">      
                        </div>
                     </div>

                 </div>
             
         
                
                     <button type="submit" name="tambah" class="btn btn-block btn-primary btn-lg">Ubah Tagihan</button>

                 </form> 

         

                
               
</div>
</div>




<?php
if (isset($_POST['tambah'])){
   
      $jmlBayar = $_POST['tarif'];
     
      $jmlBayar_oke = str_replace(".", "", $jmlBayar);

      $query= $koneksi->query("UPDATE tb_tagihan_bebas SET total_tagihan='$jmlBayar_oke'
                    WHERE id_tagihan_bebas='$id_tagihan'");
   
        
    if ($query) {
                echo "

                    <script>
                        setTimeout(function() {
                            swal({
                                title: 'Data Tagihan',
                                text: 'Berhasil Diubah!',
                                type: 'success'
                            }, function() {
                                window.location = '?page=jenisbayar&aksi=ubahbebas&id=$id_tagihan';
                            });
                        }, 300);
                    </script>

                ";
              }
    }
  
?>










     