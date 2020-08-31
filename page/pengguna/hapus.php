<?php 


		$id = $_GET['id'];

		$sql=$koneksi->query("delete from tb_user where id='$id'");

		if ($sql) {
			?>

				<script>
				    setTimeout(function() {
				        sweetAlert({
				            title: 'OKE!',
				            text: 'Data Berhasil Dihapus!',
				            type: 'error'
				        }, function() {
				            window.location = '?page=pengguna';
				        });
				    }, 300);
				</script>


			<?php
		}

 ?>