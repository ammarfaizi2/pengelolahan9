<?php 


		$id_tahun_ajaran = $_GET['id'];

		$sql=$koneksi->query("delete from tb_tahun_ajaran where id_tahun_ajaran='$id_tahun_ajaran'");

		if ($sql) {
			?>

				<script>
				    setTimeout(function() {
				        sweetAlert({
				            title: 'OKE!',
				            text: 'Data Berhasil Dihapus!',
				            type: 'error'
				        }, function() {
				            window.location = '?page=tahunajaran';
				        });
				    }, 300);
				</script>

			<?php
		}

 ?>


