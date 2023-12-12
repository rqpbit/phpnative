<?php  
  // Connection and Helper
	require_once('config/connection.php');
  require_once('config/helper.php');
  
  // Check if the user is already logged in for button signout
  $isLoggedin = false;
  if(isset($_SESSION["loggedin"])){
    $isLoggedin = true;
  }
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" class="js-site-favicon" type="image/svg+xml" href="<?= BASE_URL.'assets/images/favicon.svg'; ?>">

    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="<?= BASE_URL.'libraries/bootstrap-4/css/bootstrap.min.css'; ?>">
		
    <!-- Font awesome 4 -->
    <link rel="stylesheet" href="<?= BASE_URL.'libraries/font-awesome-4/css/font-awesome.min.css'; ?>">

    <!-- dataTables -->
    <!-- <link rel="stylesheet" href="<?= BASE_URL.'libraries/dataTables/DataTables-1.10.20/css/dataTables.bootstrap.css'; ?>"> -->

		<!-- MyStyle CSS -->
    <link rel="stylesheet" href="<?= BASE_URL.'assets/css/mystyle.css'; ?>">

    <!-- Only this Page -->
    <link rel="stylesheet" href="<?= BASE_URL.'assets/css/welcome.css'; ?>">

    <title><?= 'phpnative. Framework - '.app('name_apps'); ?></title>
  </head>
  <body>
    
    <?php  
    if ($isLoggedin) {
    ?>
      
      <center class='mt-3'>
        <a href="<?= BASE_URL.'config/functions/signout.php'; ?>" class="btn btn-sm btn-danger">Sign Out</a>
      </center>

      <div class="row no-gutters" style="margin-top: 90px;">
        <div class="col-md-8 offset-md-2 col-lg-6 offset-lg-3 no-gutters">
          <center>
            <h3 class="text-center display-2"><kbd>dashboard</kbd></h3>
            <a href="<?= BASE_URL.'assets/files/phpnative_userguide.pdf'; ?>" class="btn btn-sm btn-light mb-4" id="userGuideFile" download>Download User Guide</a>
          </center>
          <ul class="nav nav-tabs mb-3">
            <li class="nav-item">
              <a class="nav-link" href="" page="create">Create</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="" page="read">Read</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="" page="update">Update</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="" page="delete">Delete</a>
            </li>
          </ul>
          <div id="content" class="ml-3 mr-3">
            <h1 class="text-center display-3 mb-4 mt-5">Hello, I am CRUD</h1>
            <blockquote class="blockquote text-justify mt-3">
              <p class="mb-0">Anda bisa mempelajari crud pada menu diatas semua fungsi bisa digunaan, jika sudah selesai sebaiknya hapus folder <code>crud</code>. Seluruh halaman crud ada pada folder tersebut, jika memiliki kendala silahkan unduh dokumentasi.</p>
            </blockquote>
          </div>
        </div>
      </div>

    <?php
    } else {
    ?>

    <center class='mt-3'>
      <a href="<?= BASE_URL.'signin'; ?>" class="btn btn-sm btn-light">Sign In</a>
      <div class="row no-gutters" style="margin-top: 130px;">
        <div class="col-sm-8 offset-sm-2 col-lg-6 offset-lg-3 no-gutters text-center">
          <h1 class="text-center display-2 mb-0"><kbd>phpnative.</kbd></h1>
          <hr>
          <blockquote class="blockquote text-justify mt-3">
            <p class="mb-0"><span class="font-weight-bold">PHP native</span> merupakan pemrograman web perpaduan bahasa pemrograman yang didasari dengan bahasa pemrograman PHP yang mana bisa disisipi oleh text Javascript, css, bootstrap dan lain-lain. Native sendiri artinya asli, yakni pemrograman php yang murni disusun dan di coding/dibangun oleh para programmer sendiri tanpa ada istilah tambahan buat settingan/ konfigurasi lainnya. Manfaat dari PHP Native sederhana kalau kita sudah menguasai maka akan lebih mudah menggunakan PHP Framework.</p>
          </blockquote>
        </div>
      </div>
    </center>

    <footer>
      made with <code><span style="font-size: 13px;"><i class="fa fa-heart" aria-hidden="true"></i></span></code>
    </footer>
    <?php
    }
    ?>


    <!-- Optional JavaScript -->
    <!-- jQuery first, Bootstrap then DataTables JS -->
    <script src="<?= BASE_URL.'libraries/jquery-3/jquery-3.3.1.min.js'; ?>"></script>
    <script src="<?= BASE_URL.'libraries/bootstrap-4/js/bootstrap.min.js'; ?>"></script>
    <script src="<?= BASE_URL.'libraries/dataTables/dataTables.min.js'; ?>"></script>
    <script>
    $(document).ready(function() {

        // Navbar
        $('body').on('click', '.nav-link', function(e) {
          e.preventDefault();
          $('#content').html('Memuat ...');

          $('.nav-link').removeClass('active');
          $(this).addClass('active');
          var page = $(this).attr('page');

          $.get("crud/" + page + ".php", function(html_string){
            $('#content').html(html_string);
          },'html'); 
        });

        // Download user guide for offline
        $('#userGuideFile').click(function(e){
          // alert('Coming soon!');
        });
        
    });
    </script>
  </body>
</html>
