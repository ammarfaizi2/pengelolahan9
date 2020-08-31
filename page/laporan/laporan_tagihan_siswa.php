
<div class="row">
    <div class="col-md-12">
        <!-- Advanced Tables -->
        <div class="box box-primary box-solid">
            <div class="box-header with-border">
                 Laporan Tagihan Siswa
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="example1">
            
            	  <div class="col-md-12" >
				<form  method="POST" >
                    <div class="col-md-3">    
		                <div class="form-group">

                    <label style="color: black; font-weight: bold;">Pilih Kelas</label> <br>
                   <select required=""   class="form-control" name="kelas">

                               <option value="">-Pilih Kelas-</option>
                                  <?php


                                      $query = $koneksi->query("SELECT * FROM tb_kelas ORDER by id_kelas");
                                       
                                      while ($tampil_t=$query->fetch_assoc()) {
                                         
                                        echo "<option value='$tampil_t[id_kelas]'> $tampil_t[nama_kelas]</option>";
                                      }

                                  ?>

                            </select>
              </div> 

              

       </div>

       <div class="col-md-3">    
		                <div class="form-group">

                    <label>Tahun Ajaran :</label> <br>
                            
                            <select required=""  class="form-control" name="tahun_ajaran">
                            	<option value="">-Pilih Tahun Ajaran-</option>
                               
                                        <?php


                                            $query = $koneksi->query("SELECT * FROM tb_tahun_ajaran ORDER by status ASC");
                                             
                                            while ($tampil_t=$query->fetch_assoc()) {
                                               
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

   </div>      	
            
             
                <thead>



                <tr>
                  <th>No</th>
                  <th>NIS</th>
                  <th>Nama</th>
                 
                  <th>Kelas</th>
                 
               

                
                  
                
                
                </tr>
                </thead>
                <tbody>

                  <?php 

                  	if (isset($_POST['filter'])) {
                     		 $kelas = $_POST['kelas'];
                     		  $tahun_ajaran = $_POST['tahun_ajaran'];
                     		 
                     	}

                     if ($kelas !="") {

                      $no = 1;

                      $sql = $koneksi->query("select * from tb_siswa, tb_kelas where tb_siswa.kelas=tb_kelas.id_kelas and tb_siswa.kelas='$kelas' and status='aktif' ");


                     
                      while ($data = $sql->fetch_assoc()) {

                      	$jml_data = $sql->num_rows;	

                     
                        
                      
                   ?>


             
                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo $data['nis'] ?></td>
                  <td><?php echo $data['nama_siswa'] ?></td>
                
                  <td><?php echo $data['nama_kelas'] ?></td>  

                  <td><a target="blank" href="page/laporan/cetak_laporan_tagihan_per_siswa.php?id_siswa=<?php echo $data['id_siswa'] ?>&tahun_ajaran=<?php echo $tahun_ajaran ?>" class="btn btn-default" title=""><i class="fa fa-print"></i>  Cetak Per Siswa</a></td>  
                 


                  
                </tr>

                <?php }  }
?>



            </tbody>

           

        </table>

                      
			               
               <?php if ($jml_data !=0) {
               
                ?> 	
              <div class="col-md-3">
                	
                		<div class="form-group">
		                <a target="blank" href="page/laporan/cetak_laporan_tagihan_siswa.php?kelas=<?php echo $kelas ?>&tahun_ajaran=<?php echo $tahun_ajaran ?>" class="btn btn-default" title=""><i class="fa fa-print"></i>  Cetak Semua Siswa</a>
		             </div>

		        </div> 

		       <?php } ?>     
		           
                 </form> 
       

      


