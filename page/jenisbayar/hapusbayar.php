<?php 


    $id_bayar = $_GET['id_bayar'];
    $id_siswa = $_GET['id_siswa'];

    $sql=$koneksi->query("delete from tb_tagihan_bulanan where id_bayar='$id_bayar' and id_siswa='$id_siswa'");

    if ($sql) {
      ?>

        <script>
            setTimeout(function() {
                sweetAlert({
                    title: 'OKE!',
                    text: 'Data Berhasil Dihapus!',
                    type: 'error'
                }, function() {
                    window.location = '?page=jenisbayar&aksi=seting&id=<?php echo $id_bayar ?>';
                });
            }, 300);
        </script>

      <?php
    }

 ?>


