<?php

error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
include "include/koneksi.php";


session_start();


$satu_hari        = mktime(0, 0, 0, date("n"), date("j"), date("Y"));

function tglIndonesia2($str)
{
  $tr   = trim($str);
  $str    = str_replace(array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'), array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at', 'Sabtu', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'), $tr);
  return $str;
}
if ($_SESSION['level'] != 'kepalasekolah') {
  header('location:logout.php');
} else {


?>

  <!DOCTYPE html>
  <html>

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Pembayaran</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">

    <link rel="stylesheet" href="plugins/select2/select2.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">


    <link rel="stylesheet" type="text/css" href="sw/dist/sweetalert.css">
    <script type="text/javascript" src="sw/dist/sweetalert.min.js"></script>



    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  </head>

  <body class="hold-transition skin-blue sidebar-mini fixed">
    <!-- Site wrapper -->
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="../../index2.html" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>A</b>LT</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Pembayaran</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>


          <?php

          if ($_SESSION['admin']) {
            $user = $_SESSION['admin'];
          } elseif ($_SESSION['user']) {
            $user = $_SESSION['user'];
          } elseif ($_SESSION['bendahara']) {
            $user = $_SESSION['bendahara'];
          } elseif ($_SESSION['kepalasekolah']) {
            $user = $_SESSION['kepalasekolah'];
          }




          $sql_user = $koneksi->query("select * from tb_user where id='$user'");
          $data_user = $sql_user->fetch_assoc();

          $nama = $data_user['nama_user'];

          $level = $data_user['level'];

          $id_user = $data_user['id'];



          ?>


          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->

              <!-- Notifications: style can be found in dropdown.less -->

              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="images/<?php echo $data_user['foto'] ?>" class="user-image" alt="User Image">
                  <span class="hidden-xs">Hai, <?php echo $nama ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="images/<?php echo $data_user['foto'] ?>" class="img-circle" alt="User Image">

                    <p>
                      Anda Login Sebagai
                      <small><?php echo $level ?></small>
                    </p>
                  </li>
                  <!-- Menu Body -->

                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">Profilku</a>
                    </div>
                    <div class="pull-right">
                      <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->

          </div>
        </nav>
      </header>

      <!-- =============================================== -->

      <!-- Left side column. contains the sidebar -->


      <?php include "include/menukepsek.php"; ?>


      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <?php include "include/isi.php"; ?>

          <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="box box-primary box-solid">
                  <div class="box-header with-border">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                    Rekap Kas Masuk dan Keluar
                  </div>



                  <div class="modal-body">
                    <form role="form" method="POST" target="blank" action="page/laporan/rekap_kas.php">
                      <div class="form-group">
                        <label>Tanggal Awal</label>
                        <input type="date" name="tgl_awal" required="" class="form-control">
                      </div>

                      <div class="form-group">
                        <label>Tanggal Akhir</label>
                        <input type="date" name="tgl_akhir" required="" class="form-control">
                      </div>


                      <div class="modal-footer">
                        <button type="submit" name="tambah" class="btn btn-primary"><i class="fa fa-print"></i> Cetak</button>

                      </div>



                    </form>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>

        </section>
      </div>
      <!-- /.content-wrapper -->

      <footer class="main-footer navbar-fixed-bottom">
        <!-- <div class="pull-right hidden-xs">
      <b>Version</b> 1.0
    </div>
    <strong>Copyright &copy; 2020 <a href="http://almsaeedstudio.com">Parman</a>.</strong> All rights
    reserved. -->
      </footer>

      <!-- Control Sidebar -->

      <!-- /.control-sidebar -->
      <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div>
    <!-- ./wrapper -->

    <!-- jQuery 2.2.3 -->
    <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="plugins/select2/select2.full.min.js"></script>
    <!-- SlimScroll -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <script src="jquery.mask.min.js"></script>


    <script type="text/javascript">
      $(document).ready(function() {

        // Format mata uang.
        $('.uang').mask('000.000.000.000.000.000', {
          reverse: true
        });

      })


      $("#parent").click(function() {
        $(".child").prop("checked", this.checked);
      });


      $('.child').click(function() {
        if ($('.child:checked').length == $('.child').length) {
          $('#parent').prop('checked', true);
        } else {
          $('#parent').prop('checked', false);
        }
      });
    </script>

    <script>
      $(function() {
        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
      });
    </script>

    <script>
      $(function() {
        //Initialize Select2 Elements
        $(".select2").select2();

        //Datemask dd/mm/yyyy
        $("#datemask").inputmask("dd/mm/yyyy", {
          "placeholder": "dd/mm/yyyy"
        });
        //Datemask2 mm/dd/yyyy
        $("#datemask2").inputmask("mm/dd/yyyy", {
          "placeholder": "mm/dd/yyyy"
        });
        //Money Euro
        $("[data-mask]").inputmask();

        //Date range picker
        $('#reservation').daterangepicker();
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({
          timePicker: true,
          timePickerIncrement: 30,
          format: 'MM/DD/YYYY h:mm A'
        });
        //Date range as a button
        $('#daterange-btn').daterangepicker({
            ranges: {
              'Today': [moment(), moment()],
              'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
              'Last 7 Days': [moment().subtract(6, 'days'), moment()],
              'Last 30 Days': [moment().subtract(29, 'days'), moment()],
              'This Month': [moment().startOf('month'), moment().endOf('month')],
              'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            startDate: moment().subtract(29, 'days'),
            endDate: moment()
          },
          function(start, end) {
            $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
          }
        );

        //Date picker
        $('#datepicker').datepicker({
          autoclose: true
        });

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass: 'iradio_minimal-blue'
        });
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
          checkboxClass: 'icheckbox_minimal-red',
          radioClass: 'iradio_minimal-red'
        });
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
          checkboxClass: 'icheckbox_flat-green',
          radioClass: 'iradio_flat-green'
        });

        //Colorpicker
        $(".my-colorpicker1").colorpicker();
        //color picker with addon
        $(".my-colorpicker2").colorpicker();

        //Timepicker
        $(".timepicker").timepicker({
          showInputs: false
        });
      });
    </script>
  </body>

  </html>



<?php

}



?>