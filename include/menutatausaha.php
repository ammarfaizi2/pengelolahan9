 <?php 

    $sql2 = $koneksi->query("select * from tb_profile ");

    $data1 = $sql2->fetch_assoc();

 ?>

 <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
<div class="user-panel">
  <div>
  <img style="margin-left:30px" src="images/<?php echo $data1['foto'] ?>" width="120" height="140" >
      
  </div>
  <div class="pull-left info">


  </div>
</div>
<!-- search form -->
<!-- /.search form -->
<!-- sidebar menu: : style can be found in sidebar.less -->


<?php
  switch ($_GET['page']) {
    
    case 'pengguna':
      
      $aktifAdmin='active';
      break;

      case 'profile':
      
      $aktifprofile='active';
      break;
      

    case 'tahunajaran':
      
      $aktifA='active';
      $aktifA2='active';
      break;
    case 'kelas':
     
      $aktifA='active';
      $aktifA3='active';
      break;
    case 'siswa':
     
      $aktifA='active';
      $aktifA4='active';
      break;

    case 'kenaikan':
     
      $aktifA='active';
      $aktifA5='active';
      break;

    case 'kelulusan':
     
      $aktifA='active';
      $aktifA6='active';
      break;

      case 'jenisbayar':
     
      $aktifB='active';
      $aktifB1='active';
      break;

    case 'kas':
     
      $aktifB='active';
      $aktifB2='active';
      break;

      case 'laporan_tagihan_siswa':
     
      $aktifC='active';
      $aktifC1='active';
      break;

       case 'laporan_data_siswa':
     
      $aktifC='active';
      $aktifC2='active';
      break;
   
    //menu home
    default:
      
      $aktifHome='active';
  }
  ?>



<ul class="sidebar-menu" data-widget="tree">
  <li class="header">MAIN NAVIGATION</li>
            
            <li class="<?php echo $aktifHome; ?>"><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <?php  if ($_SESSION['admin'] || $_SESSION['tatausaha'] ){ ?>

             <li class="<?php echo $aktifprofile; ?>"><a href="?page=profile"><i class="fa fa-gear"></i> Setting Profile Sekolah</a></li>
            
        

            <li class="<?php echo $aktifAdmin; ?>"><a href="?page=pengguna"><i class="fa fa-users"></i> Pengguna</a></li>

                <?php } ?>
            
           

            <li class="treeview <?php echo $aktifA; ?>">
              <a href="#">
                <i class="fa fa-list-alt"></i> <span>Data Master</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li class="<?php echo $aktifA2; ?>"><a href="?page=tahunajaran"><i class="fa fa-circle-o"></i> Data Tahun Ajaran</a></li>
                <li class="<?php echo $aktifA3; ?>"><a href="?page=kelas"><i class="fa fa-circle-o"></i> Data Kelas</a></li>
                <li class="<?php echo $aktifA4; ?>"><a href="?page=siswa"><i class="fa fa-circle-o"></i> Data Siswa</a></li>
                 <li class="<?php echo $aktifA5; ?>"><a href="?page=kenaikan"><i class="fa fa-circle-o"></i> Kenaikan Kelas</a></li>
                 <li class="<?php echo $aktifA6; ?>"><a href="?page=kelulusan"><i class="fa fa-circle-o"></i> Kelulusan Siswa</a></li>
              </ul>
            </li>

            <li class="treeview <?php echo $aktifB; ?>">
              <a href="#">
                <i class="fa fa-exchange"></i> <span>Keuangan</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li class="<?php echo $aktifB1; ?>"><a href="?page=jenisbayar"><i class="fa fa-circle-o"></i> Data Jenis Bayar</a></li>
                <li class="<?php echo $aktifB2; ?>"><a href="?page=kas"><i class="fa fa-circle-o"></i>  Kas Masuk dan Keluar</a></li>
               
              </ul>
            </li>
            
            <?php  if ($_SESSION['admin']){ ?>
           
            <li><a href="?page=transaksi"><i class="fa fa-money"></i> Transaksi Pembayaran</a></li>
             <?php } ?>



             <li class="treeview <?php echo $aktifC; ?>">
              <a href="#">
                <i class="fa fa-print"></i> <span>Laporan</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">

                <li class="<?php echo $aktifC2; ?>"><a href="?page=laporan_data_siswa"><i class="fa fa-circle-o"></i> Laporan Data Siswa</a></li>

                <li class="<?php echo $aktifC1; ?>"><a href="?page=laporan_tagihan_siswa"><i class="fa fa-circle-o"></i> Laporan Tagihan Siswa</a></li>

                 <li><a href="#" data-toggle="modal" data-target="#modal-default"><i class="fa fa-circle-o"></i> Laporan Kas Masuk dan  Keluar </a></li>

                 

                 
                
              </ul>
            </li>

 

       
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
 
