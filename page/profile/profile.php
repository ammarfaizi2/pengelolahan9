
 <?php 

 		

 		$sql = $koneksi->query("select * from tb_profile ");

 		$data = $sql->fetch_assoc();

 		
 		

  ?>

 <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Setting  Profile Sekolah</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method="POST" enctype="multipart/form-data">
              <div class="box-body">

                <div class="form-group">
                  <label for="exampleInputEmail1">Nama Sekolah</label>
                  <input type="text" class="form-control"   name="nama_sekolah" value="<?php echo $data['nama_sekolah'] ?>">
                </div>

             <div class="form-group">
                    <label>Alamat Sekolah </label>
                    <textarea class="form-control" rows="3" name="alamat"> <?php echo $data['alamat']; ?></textarea>
              </div> 

               <div class="form-group">
                  <label for="exampleInputEmail1">Telpon</label>
                  <input type="text" class="form-control"   name="telpon" value="<?php echo $data['telpon'] ?>">
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">Kota</label>
                  <input type="text" class="form-control"   name="kota" value="<?php echo $data['kota'] ?>">
                </div>

                 <div class="form-group">
                  <label for="exampleInputEmail1">Nama Bendahara</label>
                  <input type="text" class="form-control"   name="bendahara" value="<?php echo $data['bendahara'] ?>">
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">NIP Bendahara</label>
                  <input type="text" class="form-control"   name="nip" value="<?php echo $data['nip'] ?>">
                </div>

                 <div class="form-group">
                  <label for="exampleInputEmail1">Kepala Tata Usaha </label>
                  <input type="text" class="form-control"   name="ktu" value="<?php echo $data['ktu'] ?>">
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">NIP Kepala Tata Usaha</label>
                  <input type="text" class="form-control"   name="nip_ktu" value="<?php echo $data['nip_ktu'] ?>">
                </div>

                

                 <div class="form-group">
                  <label for="exampleInputPassword1">Logo</label>
                    <label><img src="images/<?php echo $data['foto'] ?>" widht="100" height="100" alt=""></label>
                </div>


                <div class="form-group">
                  <label for="exampleInputPassword1">Ganti Logo</label>
                  <input type="file"  name="foto">
                </div>

                 
                
             

              <div class="box-footer">
                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
              </div>
            </form>
          </div>



          <?php 



          		if (isset($_POST['simpan'])) {
          			

          			$nama_sekolah = $_POST['nama_sekolah'];
          			$alamat = $_POST['alamat'];
          			$telpon = $_POST['telpon'];
          			$website = $_POST['website'];
          			$kota = $_POST['kota'];
          			$bendahara = $_POST['bendahara'];
          			$nip = $_POST['nip'];
                $ktu = $_POST['ktu'];
                $nip_ktu = $_POST['nip_ktu'];
          			$foto = $_FILES['foto']['name'];
          		  $lokasi = $_FILES['foto']['tmp_name'];

          		   
          			
                  if (!empty($lokasi)) {
	
                    move_uploaded_file($lokasi, "images/".$foto);
          			$sql = $koneksi->query("update  tb_profile set nama_sekolah='$nama_sekolah', alamat='$alamat', telpon='$telpon', website='$website', kota='$kota', bendahara='$bendahara', nip='$nip',  ktu='$ktu', nip_ktu='$nip_ktu',  foto='$foto' ");

          			if ($sql) {
          				?>

          					<script>
                            setTimeout(function() {
                                swal({
                                    title: 'Data Profile Sekolah',
                                    text: 'Berhasil Diubah!',
                                    type: 'success'
                                }, function() {
                                    window.location = '?page=profile';
                                });
                            }, 300);
                        </script>


          				<?php
          			}




          		}else{
          			$sql = $koneksi->query("update  tb_profile set nama_sekolah='$nama_sekolah', alamat='$alamat', telpon='$telpon', website='$website', kota='$kota', bendahara='$bendahara', nip='$nip', ktu='$ktu', nip_ktu='$nip_ktu' ");

          			if ($sql) {
          				?>

          					<script>
                            setTimeout(function() {
                                swal({
                                    title: 'Data Profile Sekolah',
                                    text: 'Berhasil Diubah!',
                                    type: 'success'
                                }, function() {
                                    window.location = '?page=profile';
                                });
                            }, 300);
                        </script>


          				<?php
          			}
          		}
				
				}


           ?>