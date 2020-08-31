<?php 	
		error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
		include "../../include/koneksi.php";
		 $id_tagihan_bulanan = $_GET['id_tagihan_bulanan'];

    $sql2 = $koneksi->query("SELECT tb_tahun_ajaran.tahun_ajaran, tb_tahun_ajaran.id_tahun_ajaran, tb_jenis_bayar.nama_bayar, tb_jenis_bayar.id_bayar, tb_jenis_bayar.id_tahun_ajaran, tb_siswa.nis, tb_siswa.nama_siswa, tb_kelas.nama_kelas, tb_tagihan_bulanan.id_bayar, tb_bulan.nama_bulan, tb_bulan.urutan, tb_tagihan_bulanan.jml_bayar, tb_tagihan_bulanan.id_tagihan_bulanan, tb_tagihan_bulanan.status_bayar from tb_jenis_bayar
        
      INNER JOIN tb_tagihan_bulanan ON tb_tagihan_bulanan.id_bayar = tb_jenis_bayar.id_bayar
      INNER JOIN tb_tahun_ajaran ON tb_jenis_bayar.id_tahun_ajaran = tb_tahun_ajaran.id_tahun_ajaran
      INNER JOIN tb_bulan ON tb_tagihan_bulanan.id_bulan = tb_bulan.id_bulan

      INNER JOIN tb_siswa ON tb_tagihan_bulanan.id_siswa = tb_siswa.id_siswa
      INNER JOIN tb_kelas ON tb_tagihan_bulanan.id_kelas = tb_kelas.id_kelas
      WHERE tb_tagihan_bulanan.id_tagihan_bulanan='$id_tagihan_bulanan'
        ");

      $data = $sql2->fetch_assoc();


      $satu_hari        = mktime(0,0,0,date("n"),date("j"),date("Y"));
       
          function tglIndonesia($str){
             $tr   = trim($str);
             $str    = str_replace(array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'), array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at', 'Sabtu', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'), $tr);
             return $str;
         }

        

 ?>
<style type="text/css">

	.tabel{border-collapse: collapse;}
	.tabel th{padding: 8px 5px;  background-color:  #cccccc;  }
	.tabel td{padding: 8px 5px;     }
</style>
<script>
	

			window.print();
			window.onfocus=function() {window.close();}
				
	

</script>
</head>

<body onload="window.print()">

<?php 

    $sql = $koneksi->query("select * from tb_profile ");

    $data1 = $sql->fetch_assoc();

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



</body>



<table width="100%" >
  <tr>
    <td width="0">&nbsp;</td>
    <td colspan="6"><div align="center"><strong>BUKTI PEMBAYARAN <br> <?php echo $data['nama_bayar'] ?></strong></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
     <td width="700">&nbsp;</td>
    <td width="16">&nbsp;</td>
    <td width="2050">&nbsp;</td>
    <td width="200">&nbsp;</td>
    <td width="15">&nbsp;</td>
    <td width="375">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td width="80px">Nama Siswa</td>
    <td>:</td>
    <td><?php echo $data['nama_siswa'] ?></td>
    <td>Kelas</td>
    <td>:</td>
    <td><?php echo $data['nama_kelas'] ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Nis</td>
    <td>:</td>
    <td><?php echo $data['nis'] ?></td>
     <td>Tahun Ajaran</td>
    <td>:</td>
    <td><?php echo $data['tahun_ajaran'] ?></td>
  </tr>
</table><br>


<table class="tabel" border="1" width="100%">

  <thead>
    <tr>
      
                  <th>No</th>
                  <th>Bulan</th>
                  <th>Tangal Bayar</th>
                  <th>Cara Bayar</th>
                  <th>Jumlah Byar</th>
                  <th>Status</th>
                  
                  
    </tr>
  </thead>
    <tbody>
  
                     <?php 

                      $no = 1;

                      $sql = $koneksi->query("select * from tb_tagihan_bulanan, tb_bulan where tb_tagihan_bulanan.id_bulan=tb_bulan.id_bulan and tb_tagihan_bulanan.id_tagihan_bulanan='$id_tagihan_bulanan' ");

                      while ($data = $sql->fetch_assoc()) {

                        $status=  $data['status_bayar'];

                        if ($status==1) {
                          $status_oke = "Lunas";
                        }else{
                           $status_oke = "Belum Lunas";
                        }
                        
                      
                   ?>


                <tr>
                  <td align="center"><?php echo $no++; ?></td>
                  <td><?php echo $data['nama_bulan'] ?></td>
                  <td><?php echo tglIndonesia(date('d F Y', strtotime($data['tgl_bayar']))) ?></td>
                  <td><?php echo $data['cara_bayar'] ?></td>
                  <td><?php echo number_format($data['jml_bayar'],0,",",".") ?></td>
                  <td><?php echo $status_oke ?></td>
                 

                 </tr> 

                 <?php


                  } 

                  ?>

               

  </tbody>
</table><br><br><br>

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


