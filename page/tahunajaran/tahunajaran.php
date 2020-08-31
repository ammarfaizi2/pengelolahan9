
<div class="row">
    <div class="col-md-12">
        <!-- Advanced Tables -->
        <div class="box box-primary box-solid">
            <div class="box-header with-border">
                 Data Tahun Ajaran 
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
                  <th>Tahun Ajaran</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>

                	<?php 

                			$no = 1;

                			$sql = $koneksi->query("select * from tb_tahun_ajaran order by id_tahun_ajaran desc");

                			while ($data = $sql->fetch_assoc()) {

                      $status =$data['status'];
                				
                			
                	 ?>


                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo $data['tahun_ajaran'] ?></td>
                 <td>

                 <?php if ($status=="aktif") { ?>
                   <a href="#" class="btn btn-info" title=""></i>Aktif</a>
                 <?php } else{ ?>  
                    <a href="?page=tahunajaran&aksi=aktif&id=<?php echo $data['id_tahun_ajaran'] ?>" class="btn btn-danger" title=""></i>Aktifkan</a>
                 <?php } ?>
                 </td>
                 

                  <td>

                    <a href="#" type="button" class="btn btn-info" data-toggle="modal" data-target="#mymodal<?php echo $data['id_tahun_ajaran']; ?>"><i class="fa fa-edit"></i> Ubah</a>
                    
                  

                     <a onclick="return confirm('Apakah Anda Yakin Mengahpus Data Ini')" href="?page=tahunajaran&aksi=hapus&id=<?php echo $data['id_tahun_ajaran'] ;?>" class="btn btn-danger" title=""><i class="fa fa-trash"></i>  Hapus</a>


                  </td>
                  
                </tr>

                  <div class="modal fade" id="mymodal<?php echo $data['id_tahun_ajaran']; ?>">
                  <div class="modal-dialog">
                    <div class="modal-content">
                     <div class="box box-primary box-solid">
                      <div class="box-header with-border">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                           Ubah Tahun Ajaran 
                      </div>
                      <div class="modal-body">

                        <form role="form"  method="POST"> 
                        <?php 

                          $id_tahun_ajaran = $data['id_tahun_ajaran'];

                          $sql1 = $koneksi->query("select * from tb_tahun_ajaran where id_tahun_ajaran='$id_tahun_ajaran'");

                         while ($data1 = $sql1->fetch_assoc()) {

                          


                        ?>

                        <input type="hidden" name="id_tahun_ajaran" value="<?php echo $data1['id_tahun_ajaran']; ?>">
                        <div class="form-group">
                          <label>Tahun Ajaran</label>
                          <input required="" type="text" name="tahun_ajaran" class="form-control" value="<?php echo $data1['tahun_ajaran']; ?>">      
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
                $id_tahun_ajaran_ubah = $_POST['id_tahun_ajaran'];
                $tahun_ajaran = $_POST['tahun_ajaran'];
                
                

                $sql = $koneksi->query("update  tb_tahun_ajaran set tahun_ajaran='$tahun_ajaran' where id_tahun_ajaran='$id_tahun_ajaran_ubah'");

              

                if ($sql) {
                    echo "

                        <script>
                            setTimeout(function() {
                                swal({
                                    title: 'Data Tahun Ajaran',
                                    text: 'Berhasil Diubah!',
                                    type: 'success'
                                }, function() {
                                    window.location = '?page=tahunajaran';
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
                 Tambah Tahun Ajaran 
            </div>
                
               
              
              <div class="modal-body">
                <form role="form"  method="POST"> 
                        <div class="form-group">
                          <label>Tahun Ajaran</label>
                          <input type="text" name="tahun_ajaran" required=""  maxlength="9" placeholder="0000/0000" class="form-control" >      
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
  
        $tahun_ajaran = $_POST['tahun_ajaran'];
        
        

        $sql = $koneksi->query("insert into tb_tahun_ajaran (tahun_ajaran, status)values('$tahun_ajaran', 'tidak') ");

      

        if ($sql) {
            echo "

                <script>
                    setTimeout(function() {
                        swal({
                            title: 'Data Tahun Ajaran',
                            text: 'Berhasil Disimpan!',
                            type: 'success'
                        }, function() {
                            window.location = '?page=tahunajaran';
                        });
                    }, 300);
                </script>

            ";
          }



      }

 ?>   


 <!-- AKHIR TAMBAH DATA TAHUN AJARAN -->   