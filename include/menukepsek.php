 <?php 

    $sql2 = $koneksi->query("select * from tb_profile ");

    $data1 = $sql2->fetch_assoc();

 ?>

 <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
<div class="user-panel">
  <div>
  <img style="margin-left:30px" src="images/<?php echo $data1['foto'] ?>" width="140" height="120" >
      
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
            
            <li class="<?php echo $aktifHome; ?>"><a href="indexkepsek.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>


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
 
