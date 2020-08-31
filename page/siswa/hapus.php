<?php


$id_siswa = $_GET['id'];
$query = $koneksi->query("Select * from tb_siswa where id_siswa='$id_siswa'");
$tampil = $query->fetch_assoc();
$gambar = $tampil['foto'];
$hapus_gambar = unlink("images/" . $gambar);
$sql = $koneksi->query("delete from tb_siswa where id_siswa='$id_siswa'");
if ($sql) {
?>

	<script>
		setTimeout(function() {
			sweetAlert({
				title: 'OKE!',
				text: 'Data Berhasil Dihapus!',
				type: 'error'
			}, function() {
				window.location = '?page=siswa';
			});
		}, 300);
	</script>

<?php
}

?>