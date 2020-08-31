<?php 


      $id_kelas = $_GET['id'];

      $sql=$koneksi->query("delete from tb_kelas where id_kelas='$id_kelas'");

      if ($sql) {
         ?>

            <script>
                setTimeout(function() {
                    sweetAlert({
                        title: 'OKE!',
                        text: 'Data Berhasil Dihapus!',
                        type: 'error'
                    }, function() {
                        window.location = '?page=kelas';
                    });
                }, 300);
            </script>

         <?php
      }

 ?>


