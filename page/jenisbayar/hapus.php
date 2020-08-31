<?php 


    $id_bayar = $_GET['id'];

    $sql=$koneksi->query("delete from tb_jenis_bayar where id_bayar='$id_bayar'");

    if ($sql) {
      ?>

        <script>
            setTimeout(function() {
                sweetAlert({
                    title: 'OKE!',
                    text: 'Data Berhasil Dihapus!',
                    type: 'error'
                }, function() {
                    window.location = '?page=jenisbayar';
                });
            }, 300);
        </script>

      <?php
    }

 ?>


