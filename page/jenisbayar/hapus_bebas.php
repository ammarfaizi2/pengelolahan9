<?php 


    $id_tagihan = $_GET['id_tagihan'];
     $id_bayar = $_GET['id_bayar'];

    $sql=$koneksi->query("delete from tb_tagihan_bebas where id_tagihan_bebas='$id_tagihan'");

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


