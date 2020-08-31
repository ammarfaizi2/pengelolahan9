
<div class="row">
    <div class="col-md-12">
        <!-- Advanced Tables -->
        <div class="box box-primary box-solid">
            <div class="box-header with-border">
                 Laporan Data Siswa
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
                  <th>Jenis Kelamin</th>
                  <th>Kelas</th>
                  <th>Nama Ortu</th>
                  <th>Alamat</th>
                  <th>Telp</th>
                 
        
                </tr>
                </thead>
                <tbody>

                  <?php 

                  	if (isset($_POST['filter'])) {
                     		 $kelas = $_POST['kelas'];
                     		  
                     		 
                     	}

                     if ($kelas !="") {

                      $no = 1;

                      $sql = $koneksi->query("select * from tb_siswa, tb_kelas where tb_siswa.kelas=tb_kelas.id_kelas and tb_siswa.kelas='$kelas' ");


                     
                      while ($data = $sql->fetch_assoc()) {

                      	$jml_data = $sql->num_rows;	

                     
                        
                      
                   ?>


             
                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo $data['nis'] ?></td>
                  <td><?php echo $data['nama_siswa'] ?></td>
                  <td><?php echo $data['jk'] ?></td>
                  <td><?php echo $data['nama_kelas'] ?></td>
                   <td><?php echo $data['nama_ortu'] ?></td>
                  <td><?php echo $data['alamat'] ?></td>
                  <td><?php echo $data['no_hp_ortu'] ?></td>  
 
                 


                  
                </tr>

                <?php }  }
?>



            </tbody>

           

        </table>

                      
			               
               <?php if ($jml_data !=0) {
               
                ?> 	
            <div class="col-md-3" style="margin-bottom: 20px;">	
               
		                <a target="blank" href="page/laporan/cetak_laporan_siswa.php?kelas=<?php echo $kelas ?>" class="btn btn-default" title=""><i class="fa fa-print"></i>  Cetak </a>
		           
                <a target="blank" href="page/laporan/cetak_laporan_siswa_excel.php?kelas=<?php echo $kelas ?>" class="btn btn-success" title="" style="margin-left: 5px;"><i class="fa fa-file-excel-o"></i>  Cetak </a>
                
		        </div> 

		       <?php } ?>     
		           
        </form> 
       

      


