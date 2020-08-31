
<div class="row">
    <div class="col-md-12">
        <!-- Advanced Tables -->
        <div class="box box-primary box-solid">
            <div class="box-header with-border">
                 Kelulusan Siswa
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
                 
                  <th>Kelas</th>
                  <th>Status</th>
                <th colspan="2" style="text-align: center; margin-left: 100px;"><input type="checkbox" id="parent"> Pilih Semua</th>

                
                  
                
                
                </tr>
                </thead>
                <tbody>

                  <?php 

                  	if (isset($_POST['filter'])) {
                     		 $kelas = $_POST['kelas'];
                     		 
                     	}

                     if ($kelas !="") {

                      $no = 1;

                      $sql = $koneksi->query("select * from tb_siswa, tb_kelas where tb_siswa.kelas=tb_kelas.id_kelas and tb_siswa.kelas='$kelas' and status='aktif' ");
                      }else{
                      	 $no = 1;
                      	 $sql = $koneksi->query("select * from tb_siswa, tb_kelas where tb_siswa.kelas=tb_kelas.id_kelas and status='aktif'");
                      }

                      while ($data = $sql->fetch_assoc()) {

                     
                        
                      
                   ?>


             
                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo $data['nis'] ?></td>
                  <td><?php echo $data['nama_siswa'] ?></td>
                
                  <td><?php echo $data['nama_kelas'] ?></td>  
                  <td><?php echo $data['status'] ?></td>
                  <td><input type="hidden" name=""></td>

                <form  method="POST">

                  <td><input type="checkbox" name="pilih[]" value="<?php echo $data['id_siswa']; ?>" class="child"></td>


                  
                </tr>

                <?php } ?>



            </tbody>

           

        </table>

                      
			               
                	
              <div class="col-md-3">
                	
                		<div class="form-group">
		                <button type="submit" name="simpan" style="margin-left: 850px;" class="btn btn-info"><i class="fa fa-save"></i> Luluskan</button>
		             </div>

		        </div>     
		           
                 </form> 
       

      


<?php 

	if (isset($_POST['simpan'])) {
		$siswa = $_POST['pilih'];
		
		$jumlah_dipilih = count($siswa);
	 
		for($x=0;$x<$jumlah_dipilih;$x++){
			
			$query=$koneksi->query("UPDATE tb_siswa SET status='Lulus' WHERE id_siswa='$siswa[$x]'");

			 if ($query) {
	            echo "

	                <script>
	                    setTimeout(function() {
	                        swal({
	                            title: 'Siswa',
	                            text: 'Berhasil Diluluskan!',
	                            type: 'success'
	                        }, function() {
	                            window.location = '?page=kelulusan';
	                        });
	                    }, 300);
	                </script>

	            ";
	          }

	      }
	}

 ?>

