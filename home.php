 <?php


  $tgl = date("Y-m-d");
  $sql = $koneksi->query("select * from tb_kas where tgl_kas = '$tgl'");

  while ($tampil = $sql->fetch_assoc()) {

    $kas_hari_ini = $kas_hari_ini + $tampil['penerimaan'];
  }

  $sql2 = $koneksi->query("select * from tb_kas");

  while ($tampil2 = $sql2->fetch_assoc()) {

    $penerimaan = $penerimaan + $tampil2['penerimaan'];
    $pengeluaran = $pengeluaran + $tampil2['pengeluaran'];
    $saldo = $penerimaan - $pengeluaran;
  }
  $user = $_SESSION['user'];
  $sql_bebas = $koneksi->query("select sum(total_tagihan) as tot_tagihan, sum(terbayar) as tot_terbayar, id_siswa from tb_tagihan_bebas where id_siswa = '$user'");
  while ($tampil_bebas = $sql_bebas->fetch_assoc()) {
    $tagihan_bebas = $tampil_bebas['tot_tagihan'] - $tampil_bebas['tot_terbayar'];
  }
  $sql_bulanan = $koneksi->query("select sum(jml_bayar) as tot_tagihan, sum(terbayar) as tot_terbayar, id_siswa from tb_tagihan_bulanan where id_siswa = '$user'");
  while ($tampil_bulanan = $sql_bulanan->fetch_assoc()) {
    $tagihan_bulanan = $tampil_bulanan['tot_tagihan'] - $tampil_bulanan['tot_terbayar'];
  }



  ?>


 <section class="content-header">
   <h1>
     Dashboard
     <small>Control panel</small>
   </h1>
   <ol class="breadcrumb">
     <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
     <li class="active">Dashboard</li>
   </ol>
 </section>

 <!-- Main content -->
 <section class="content">
   <!-- Small boxes (Stat box) -->
   <div class="row">

     <?php if ($level == "admin") { ?>
       <div class="col-lg-3 col-xs-6">
         <!-- small box -->
         <div class="small-box bg-aqua">
           <div class="inner">
             <h3><?php echo number_format($kas_hari_ini, 0, ",", "."); ?></h3>

             <p>Pamasukan Hari Ini</p>
           </div>
           <div class="icon">
             <i class="ion ion-stats-bars"></i>
           </div>
           <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
         </div>
       </div>
       <!-- ./col -->
       <div class="col-lg-3 col-xs-6">
         <!-- small box -->
         <div class="small-box bg-aqua">
           <div class="inner">
             <h3><?php echo number_format($penerimaan, 0, ",", ".") ?><sup style="font-size: 20px"></sup></h3>

             <p>Total Pemasukan</p>
           </div>
           <div class="icon">
             <i class="ion ion-stats-bars"></i>
           </div>
           <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
         </div>
       </div>
       <!-- ./col -->
       <div class="col-lg-3 col-xs-6">
         <!-- small box -->
         <div class="small-box bg-aqua">
           <div class="inner">
             <h3><?php echo number_format($pengeluaran, 0, ",", ".") ?></h3>

             <p>Total Pengeluaran</p>
           </div>
           <div class="icon">
             <i class="ion ion-stats-bars"></i>
           </div>
           <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
         </div>
       </div>
       <!-- ./col -->
       <div class="col-lg-3 col-xs-6">
         <!-- small box -->
         <div class="small-box bg-yellow">
           <div class="inner">
             <h3><?php echo number_format($saldo, 0, ",", ".") ?></h3>

             <p>SALDO</p>
           </div>
           <div class="icon">
             <i class="ion ion-stats-bars"></i>
           </div>
           <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
         </div>
       </div>

     <?php } else { ?>
       <div class="col-lg-3 col-xs-6">
         <!-- small box -->
         <div class="small-box bg-aqua">
           <div class="inner">
             <h3><?php echo number_format($tagihan_bulanan, 0, ",", "."); ?></h3>

             <p>Total Tagihan Bulanan</p>
           </div>
           <div class="icon">
             <i class="ion ion-stats-bars"></i>
           </div>
           <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
         </div>
       </div>
       <!-- ./col -->
       <div class="col-lg-3 col-xs-6">
         <!-- small box -->
         <div class="small-box bg-aqua">
           <div class="inner">
             <h3><?php echo number_format($tagihan_bebas, 0, ",", ".") ?><sup style="font-size: 20px"></sup></h3>

             <p>Total Tagihan Bebas</p>
           </div>
           <div class="icon">
             <i class="ion ion-stats-bars"></i>
           </div>
           <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
         </div>
       </div>
       <!-- ./col -->

     <?php } ?>