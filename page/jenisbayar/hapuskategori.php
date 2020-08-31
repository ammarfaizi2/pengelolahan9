<?php
$id_bayar = $_GET['id_bayar'];
$id_kategori = $_GET['id_kategori'];


$sql = $koneksi->query("delete from tb_kategori where id_kategori = '$id_kategori'");
if ($sql) {
    $sql2 = $koneksi->query("delete from tb_tagihan_bulanan where id_kategori = '$id_kategori'");
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