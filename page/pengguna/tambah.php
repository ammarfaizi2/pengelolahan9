


 <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Tambah Data Pengguna</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method="POST" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Username</label>
                  <input type="text" class="form-control"   name="username">
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">Nama</label>
                  <input type="text" class="form-control" name="nama">
                </div>

                 <div class="form-group">
                  <label for="exampleInputPassword1">Password</label>
                  <input type="password" class="form-control" name="password">
                </div>


                <div class="form-group">
                  <label for="exampleInputPassword1">Foto</label>
                  <input type="file"  name="foto">
                </div>

                 
                
             

              <div class="box-footer">
                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
              </div>
            </form>
          </div>



          <?php 



          		if (isset($_POST['simpan'])) {
          			

          			$username = $_POST['username'];
          			$nama = $_POST['nama'];
          			$password = $_POST['password'];


          			$foto = $_FILES['foto']['name'];
          		    $lokasi = $_FILES['foto']['tmp_name'];

          		    $upload = move_uploaded_file($lokasi, "images/".$foto);
          			
                  if ($upload) {
	

          			$sql = $koneksi->query("insert into tb_user (username, nama_user, password, level, foto)values('$username', '$nama', '$password', 'user', '$foto') ");

          			if ($sql) {
          				?>

          					<script>
                            setTimeout(function() {
                                swal({
                                    title: 'Data Pengguna',
                                    text: 'Berhasil Disimpan!',
                                    type: 'success'
                                }, function() {
                                    window.location = '?page=pengguna';
                                });
                            }, 300);
                        </script>


          				<?php
          			}


          		}
}


           ?>