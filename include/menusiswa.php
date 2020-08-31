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

      case 'jenisbayar':
     
      $aktifB='active';
      $aktifB1='active';
      break;

    case 'kas':
     
      $aktifB='active';
      $aktifB2='active';
      break;

    //menu home
    default:
      
      $aktifHome='active';
  }
  ?>



<ul class="sidebar-menu" data-widget="tree">
  <li class="header">MAIN NAVIGATION</li>
            
            <li class="<?php echo $aktifHome; ?>"><a href="indexuser.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <?php  if ($_SESSION['user'] ){ ?>

           
          <!--   <li><a href="?page=transaksi"><i class="fa fa-money"></i> Transaksi Pembayaran</a></li> -->

             <li><a href="?page=transaksi_siswa"><i class="fa fa-money"></i> Transaksi Pembayaran upload</a></li>
                <?php } ?>
         
             
            
  

       
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
 
