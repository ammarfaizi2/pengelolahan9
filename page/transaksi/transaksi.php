

 <section class="content">
      <div class="row">
<div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Pembayaran</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>NIS</th>
                  <th>Nama</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>

                  <?php 

                      $no = 1;

                       $sql = $koneksi->query("select * from tb_siswa, tb_kelas where tb_siswa.kelas=tb_kelas.id_kelas order by tb_siswa.id_siswa desc");

                      while ($data = $sql->fetch_assoc()) {
                        
                      
                   ?>


                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo $data['nis'] ?></td>
                  <td><?php echo $data['nama_siswa'] ?></td>

                  <td>
                    
                    <a href="?page=transaksi&aksi=lihat&id=<?php echo $data['id_siswa'] ;?>" class="btn btn-success" title=""><i class="fa fa-eye"></i> Lihat Pembayaran</a>

                    


                  </td>
                  
                </tr>
                

                <?php } ?>

            </tbody>

        </table>

    </div>
</div>
</div>
</section>