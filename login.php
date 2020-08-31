<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

include "include/koneksi.php";
session_start();
if ($_SESSION['level'] == 'admin') { header('location:index.php'); } 

else if ($_SESSION['level'] == "user") { header("location:indexuser.php");} 
else if ($_SESSION['level'] == "tatausaha") { header("location:indextatausaha.php");} 
else if ($_SESSION['level'] == "kepalasekolah") { header("location:indexkepsek.php");}
else if ($_SESSION['level'] == "siswa") { header("location:indexuser.php");}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Selamat Datang - Menu Login</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
  <link rel='stylesheet' href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="dist/css//style.css">
  <link rel="stylesheet" type="text/css" href="sw/dist/sweetalert.css">

</head>

<body>
  <!-- partial:index.partial.html -->

  <!-- Main Content -->
  <div class="container-fluid">
    <div class="row main-content bg-success text-center">
      <div class="col-md-4 text-center company__info">
        <span class="company__logo">
          <h2><span class="fa fa-mortar-board" style="font-size:80px"></span></h2>
        </span>
        <h4 class="company_title">SDIT ALAM PERMATA LECES</h4>
      </div>
      <div class="col-md-8 col-xs-12 col-sm-12 login_form ">
        <div class="container-fluid">
          <div class="row">
            <h2>Halaman Login</h2>
            <span class="akses">Silahkan Pilih Menu Login dibawah ini :</span>
          </div>
          <div class="row">
            <a class="btn btn-primary" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Login untuk Pihak Sekolah</a>
            <button class="btn btn-danger" type="button" data-toggle="collapse" data-target="#multiCollapseExample2" aria-expanded="false" aria-controls="multiCollapseExample2">Login untuk Siswa</button>

            <div class="col">
              <div class="collapse multi-collapse" id="multiCollapseExample1">
                <form method="post" class="form-group">
                  <div class="row">
                    <input type="text" name="username" id="username" class="form__input" placeholder="Username">
                  </div>
                  <div class="row">
                    <!-- <span class="fa fa-lock"></span> -->
                    <input type="password" name="pass" id="pass" class="form__input" placeholder="Password">
                  </div>
                  <div class="row">
                    <input type="submit" name="loginadmin" id="loginadmin" value="Submit" class="btn">
                  </div>
                </form>
              </div>
              <?php

              if (isset($_POST['loginadmin'])) {

                $username = addslashes(trim($_POST['username']));

                $pass = addslashes(trim(md5($_POST['pass'])));

                $sql = $koneksi->query("select * from tb_user where username='$username' and password='$pass'");

                $data = $sql->fetch_assoc();

                $ketemu = $sql->num_rows;

                if ($ketemu >= 1) {

                  session_start();
                  $_SESSION['level'] = $data['level'];

                  if ($data['level'] == "admin") {
                    $_SESSION['admin'] = $data['id'];

                    header("location:index.php");
                  } else if ($data['level'] == "user") {
                    $_SESSION['user'] = $data['id'];

                    header("location:indexuser.php");
                  } else if ($data['level'] == "tatausaha") {
                    $_SESSION['tatausaha'] = $data['id'];

                    header("location:indextatausaha.php");
                  } else if ($data['level'] == "kepalasekolah") {
                    $_SESSION['kepalasekolah'] = $data['id'];

                    header("location:indexkepsek.php");
                  }
                } else {

              ?>

                  <script>
                    setTimeout(function() {
                      sweetAlert({
                        title: 'Username dan Password Salah!',
                        text: 'Silahkan Masukan Username dan Password Yang Benar!',
                        type: 'error'
                      }, function() {
                        window.location = 'login.php';
                      });
                    }, 300);
                  </script>

              <?php
                }
              }



              ?>
              <div class="collapse multi-collapse" id="multiCollapseExample2">
                <form method="post" class="form-group">
                  <div class="row">
                    <input type="text" name="username" id="username" class="form__input" placeholder="Username">
                  </div>
                  <div class="row">
                    <!-- <span class="fa fa-lock"></span> -->
                    <input type="password" name="pass" id="pass" class="form__input" placeholder="Password">
                  </div>
                  <div class="row">
                    <input type="submit" value="Submit" name="loginsiswa" class="btn">
                  </div>
                </form>
              </div>
              <?php

              if (isset($_POST['loginsiswa'])) {

                $username = addslashes(trim($_POST['username']));
                $pass = addslashes(trim(md5($_POST['pass'])));
                $sql = $koneksi->query("SELECT * from tb_siswa where username='$username' and password='$pass'");
                $data = $sql->fetch_assoc();
                $ketemu = $sql->num_rows;

                if ($ketemu >= 1) {

                  session_start();
                  $_SESSION['level'] = 'siswa';
                  $_SESSION['user'] = $data['id_siswa'];

                  // header("location:indexuser.php");
                  echo "<script> window.location = 'indexuser.php'</script>";
                } else {

              ?>

                  <script>
                    setTimeout(function() {
                      sweetAlert({
                        title: 'Username dan Password Salah!',
                        text: 'Silahkan Masukan Username dan Password Yang Benar!',
                        type: 'error'
                      }, function() {
                        window.location = 'login.php';
                      });
                    }, 300);
                  </script>

              <?php
                }
              }

              ?>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Footer -->
  <div class="container-fluid text-center footer">

  </div>
  <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
  <!-- Bootstrap 3.3.6 -->
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="sw/dist/sweetalert.min.js"></script>
  <script>
    $(function() {
      $('#multiCollapseExample1').on('show.bs.collapse', function() {
        $('#multiCollapseExample2').collapse('hide')
        $('.akses').text('Login sebagai Pihak Sekolah')
      });
      $('#multiCollapseExample2').on('show.bs.collapse', function() {
        $('#multiCollapseExample1').collapse('hide')
        $('.akses').text('Login sebagai Siswa')

      });
    })
  </script>
</body>
<!-- partial -->

</html>