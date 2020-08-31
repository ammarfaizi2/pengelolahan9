<?php 

		error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
		include "../../include/koneksi.php";


$sql = $koneksi->query("SELECT * FROM tb_tahun_ajaran where id_tahun_ajaran='$_GET[tahun_ajaran]'");
$ta = $sql->fetch_assoc();
$idTahun = $ta['id_tahun_ajaran'];
$tahun = $ta['tahun_ajaran'];

$satu_hari        = mktime(0,0,0,date("n"),date("j"),date("Y"));
       
          function tglIndonesia($str){
             $tr   = trim($str);
             $str    = str_replace(array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'), array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at', 'Sabtu', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'), $tr);
             return $str;
         }



?>
<!DOCTYPE html>
<html>
<head>
<title>Cetak - Laporan Tagihan Siswa</title>

<style type="text/css">
		

		.tabel{border-collapse: collapse;}
		.tabel th{padding: 8px 5px;  background-color:  #cccccc;  }
		.tabel td{padding: 8px 5px;     }
	

		

		@media print {
		    footer {page-break-after: always;}
		}

</style>

<script>
	

			window.print();
			window.onfocus=function() {window.close();}

</script>

</head>
<body>

	<?php 

    $sql = $koneksi->query("select * from tb_profile ");

    $data1 = $sql->fetch_assoc();

 ?>

	

<?php
$sqlSiswa= $koneksi->query("SELECT * FROM tb_siswa, tb_kelas
			WHERE tb_siswa.kelas=tb_kelas.id_kelas and kelas='$_GET[kelas]' AND status='Aktif' ORDER BY nama_siswa ASC");
while($dtsiswa=$sqlSiswa->fetch_assoc()){

$idsiswa = $dtsiswa['id_siswa'];
$nissiswa = $dtsiswa['nis'];
$namasiswa = $dtsiswa['nama_siswa'];
$namakelas = $dtsiswa['nama_kelas'];
?>

<table width="100%" >
  <tr>
   
    <td width="10" rowspan="3" valign="top"><img src="../../images/<?php echo $data1['foto']; ?>" width="80" height="85" /></td>
    <td width="383"><div align="center"><?php echo $data1['nama_sekolah']; ?></div></td>
  </tr>
  <tr>
    <td><div align="center"><?php echo $data1['alamat']; ?></div></td>
  </tr>
  <tr>
    <td><div align="center">TELP. <?php echo $data1['telpon']; ?> WEBSITE: <?php echo $data1['website']; ?></div></td>
  </tr>
</table>
<hr>

<br>

<table width="100%" >

	<tr>
    <td>&nbsp;</td>
    <td width="700">&nbsp;</td>
    <td width="16">&nbsp;</td>
    <td width="2000">&nbsp;</td>
    <td width="500">&nbsp;</td>
    <td width="15">&nbsp;</td>
    <td width="375">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td width="80px">Nama Siswa</td>
    <td>:</td>
    <td><?php echo $namasiswa ?></td>
    <td width="20px">Kelas</td>
    <td>:</td>
    <td><?php echo $namakelas ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Nis</td>
    <td>:</td>
    <td><?php echo $nissiswa ?></td>
     <td >Tahun Ajaran</td>
    <td>:</td>
    <td><?php echo $tahun ?></td>
  </tr>

	
</table>
<br>


<table border="1" width="100%" class="tabel">
	<caption>Tagihan Bulanan <p></caption>
	<thead>
		<tr>
			<th>No</th>
			<th>Jenis Bayar</th>
			<th>Tagihan</th>
			<th>Tagihan Terbayar</th>
			<th>Sisa Tagihan</th>
		</tr>
	</thead>
	<tbody>

			<?php 
			$no=1;
			$sqlJenisBayar =  $koneksi->query("SELECT * from tb_jenis_bayar
 				WHERE id_tahun_ajaran='$idTahun' and tipe_bayar='bulanan'");
					while($djb=$sqlJenisBayar->fetch_assoc()){


							 $sqltotal = $koneksi->query("SELECT tb_tagihan_bulanan.id_siswa, SUM(tb_tagihan_bulanan.jml_bayar) as t_bayar, SUM(tb_tagihan_bulanan.terbayar) as t_t_bayar FROM tb_tagihan_bulanan where  id_siswa='$idsiswa'  GROUP BY id_siswa");


				  $datatotal = $sqltotal->fetch_assoc();

				  $t_tagihan_total =$datatotal['t_bayar'];
				  $t_t_terbayar =$datatotal['t_t_bayar'];
				  $jml_total = $t_tagihan_total-$t_t_terbayar;
						

				
				 $sql = $koneksi->query("SELECT tb_jenis_bayar.nama_bayar, tb_siswa.nama_siswa, SUM(tb_tagihan_bulanan.jml_bayar) as totaljmlbayar2, SUM(tb_tagihan_bulanan.terbayar) as totalterbayar FROM tb_jenis_bayar 
				 	  left JOIN tb_tahun_ajaran ON tb_jenis_bayar.id_tahun_ajaran=tb_tahun_ajaran.id_tahun_ajaran 
				 	   
				 	  left JOIN tb_tagihan_bulanan on tb_tagihan_bulanan.id_bayar=tb_jenis_bayar.id_bayar
				 	   left JOIN tb_siswa ON tb_tagihan_bulanan.id_siswa=tb_siswa.id_siswa

				 	   	where 
				 	   	tb_tagihan_bulanan.id_bayar='$djb[id_bayar]' and
				 	   	tb_tagihan_bulanan.id_siswa='$idsiswa' 
				 	    GROUP BY tb_tagihan_bulanan.id_bayar");

				  $data = $sql->fetch_assoc();

				  	$t_tagihan = $data['totaljmlbayar2'];
				  	$t_terbayar = $data['totalterbayar'];


				  	$sisa = $data['totaljmlbayar2']-$data['totalterbayar'];

				  	

				
				  	

			 ?>


		<tr>
			<td><?php echo $no++ ?></td>
			<td><?php echo $djb['nama_bayar']?></td>
			<td align="right"><?php echo number_format($t_tagihan,0,",",".") ?></td>
			<td align="right"><?php echo number_format($t_terbayar,0,",",".") ?></td>
			<td align="right" style="color: red;"><?php echo number_format($sisa,0,",",".") ?></td>
		</tr>

		<?php 



	

					 } 

		?>

		<tr>
			
			<td align="center" style="font-size: 18px; font-weight: bold;" colspan="2">Total</td>
			<td align="right"><?php echo number_format($t_tagihan_total,0,",",".") ?></td>
			<td align="right"><?php echo number_format($t_t_terbayar,0,",",".") ?></td>
			<td align="right" style="color: red;"><?php echo number_format($jml_total,0,",",".") ?></td>
   </tr>
	</tbody>
	
</table><br>

<table border="1" width="100%" class="tabel">
	<caption>Tagihan Lain<p></caption>
	<thead>
		<tr>
			<th>No</th>
			<th>Jenis Bayar</th>
			<th>Tagihan</th>
			<th>Tagihan Terbayar</th>
			<th>Sisa Tagihan</th>
		</tr>
	</thead>
	<tbody>

			<?php 
			$no=1;
				
			$sqlJenisBayar =  $koneksi->query("SELECT * from tb_jenis_bayar
 				WHERE id_tahun_ajaran='$idTahun' and tipe_bayar='bebas'");
					while($djb=$sqlJenisBayar->fetch_assoc()){

						 $sqltotal_bebas = $koneksi->query("SELECT tb_tagihan_bebas.id_siswa, SUM(tb_tagihan_bebas.total_tagihan) as t_bayar, SUM(tb_tagihan_bebas.terbayar) as t_t_bayar FROM tb_tagihan_bebas where  id_siswa='$idsiswa'  GROUP BY id_siswa");


				  $datatotal_bebas = $sqltotal_bebas->fetch_assoc();

				  $t_tagihan_total_bebas =$datatotal_bebas['t_bayar'];
				  $t_t_terbayar_bebas =$datatotal_bebas['t_t_bayar'];
				  $jml_total_bebas = $t_tagihan_total_bebas-$t_t_terbayar_bebas;
						

				
				 $sql3 = $koneksi->query("SELECT tb_jenis_bayar.nama_bayar, tb_siswa.nama_siswa, SUM(tb_tagihan_bebas.total_tagihan) as totaljmlbayar, SUM(tb_tagihan_bebas.terbayar) as t_terbayar FROM tb_jenis_bayar 
				 	  left JOIN tb_tahun_ajaran ON tb_jenis_bayar.id_tahun_ajaran=tb_tahun_ajaran.id_tahun_ajaran 
				 	   
				 	  left JOIN tb_tagihan_bebas on tb_tagihan_bebas.id_bayar=tb_jenis_bayar.id_bayar
				 	   left JOIN tb_siswa ON tb_tagihan_bebas.id_siswa=tb_siswa.id_siswa
				 	    where	tb_tagihan_bebas.id_bayar='$djb[id_bayar]' and
				 	   	  tb_tagihan_bebas.id_siswa='$idsiswa'				 	   
				 	   	 GROUP BY tb_tagihan_bebas.id_bayar");

				 $data2 = $sql3->fetch_assoc();

				 	$t_tagihan2= $data2['totaljmlbayar'];
				  	$t_terbayar2 = $data2['t_terbayar'];

				  	$sisa2 = $data2['totaljmlbayar']-$data2['t_terbayar'];

					
				 
						  	

			 ?>


		<tr>
			<td><?php echo $no++ ?></td>
			<td><?php echo $djb['nama_bayar']?></td>
			<td align="right"><?php echo number_format($t_tagihan2,0,",",".") ?></td>
			<td align="right"><?php echo number_format($t_terbayar2,0,",",".") ?></td>
			<td align="right" style="color: red;"><?php echo number_format($sisa2,0,",",".") ?></td>
		</tr>

		<?php } ?>

		<tr>
			
			<td align="center" style="font-size: 18px; font-weight: bold;" colspan="2">Total</td>
			<td align="right"><?php echo number_format($t_tagihan_total_bebas,0,",",".") ?></td>
			<td align="right"><?php echo number_format($t_t_terbayar_bebas,0,",",".") ?></td>
			<td align="right" style="color: red;"><?php echo number_format($jml_total_bebas,0,",",".") ?></td>
   </tr>
	</tbody>
</table><br><br>


<?php $tgl=date('Y-m-d'); ?>
<table width="100%">
<tr>
  <td align="center"></td>
  <td align="center" width="200px">
   <?php echo $data1['kota']; ?>, <?php echo tglIndonesia(date('d F Y', strtotime($tgl))) ?>
    <br/>Bendahara,<br/><br/><br/><br/>
    <b><u><?php echo $data1['bendahara']; ?></u><br/><?php echo $data1['nip']; ?></b>
  </td>
</tr>
</table>

<footer></footer>

<?php } ?>

</body>
<script>
	window.print()
</script>
</html>