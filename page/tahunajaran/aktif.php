<?php 

 		$id_tahun_ajaran = $_GET['id'];

 		$sql = $koneksi->query("update  tb_tahun_ajaran set status='aktif' where id_tahun_ajaran='$id_tahun_ajaran'");

 		$sql = $koneksi->query("update  tb_tahun_ajaran set status='tidak' where id_tahun_ajaran!='$id_tahun_ajaran'");

 		if ($sql) {
                    echo "

                        <script>
                            setTimeout(function() {
                                swal({
                                    title: 'Tahun Ajaran',
                                    text: 'Berhasil Diaktifkan!',
                                    type: 'success'
                                }, function() {
                                    window.location = '?page=tahunajaran';
                                });
                            }, 300);
                        </script>

                    ";
                  }

 		
 		

  ?>
