<?php
    session_start();
  ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>
    <?php
        $page = isset($_GET['page'])?$_GET['page']:'';
        if($page=="employee"){
          echo "Employee Master Data";
        }elseif ($page=="department") {
          echo "Department Master Data";
        }elseif ($page=="location") {
          echo "Location Master Data";
        }elseif ($page=="shift") {
          echo "Shift Master Data";
        }elseif($page=="login_data"){
          echo "Login Master Data";
        }elseif($page=="daily_report"){
          echo "Attendance Report";
        }elseif($page=="late_report"){
          echo "Late Attendance Report";
        }elseif($page=="incomplete_report"){
          echo "Incomplete Attendance Report";
        }else{
          echo "";
        }
      ?>
    </title>
    <script src="https://code.jquery.com/jquery-3.5.0.js" integrity="sha256-r/AaFHrszJtwpe+tHyNi/XCfMxYpbsRg2Uqn0x3s2zc=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script
      src="https://kit.fontawesome.com/5fd5318cab.js"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.21/b-1.6.2/b-flash-1.6.2/b-html5-1.6.2/b-print-1.6.2/datatables.min.css"/>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.21/b-1.6.2/b-flash-1.6.2/b-html5-1.6.2/b-print-1.6.2/datatables.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    
    
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.3/jspdf.plugin.autotable.js"></script>
  </head>
  
  <body>
    <header>
      <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand d-flex py-0" href="/">
          <i
            class="fas fa-fingerprint align-self-center d-none d-sm-block"
            style="font-size: 50px;"
          ></i>
          <h1 class="align-self-center mx-3 d-none d-sm-block">Absensi Karyawan</h1>
        </a>
        
        <?php
          if (isset($_SESSION['no'])) {
            ?>
            <ul class="nav collapse-nav mr-auto">
              <li class="nav-item dropdown">
                <a
                  class="nav-link dropdown-toggle my-auto"
                  href="#"
                  id="navbarDropdown1"
                  role="button"
                  data-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false"
                >
                  Master Data
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown1">
                  <a class="dropdown-item" href="/?page=employee">Master Data Karyawan</a>
                  <a class="dropdown-item" href="/?page=shift">Master Data Shift Karyawan</a>
                  <a class="dropdown-item" href="/?page=location">Master Data Lokasi Absensi</a>
                  <a class="dropdown-item" href="/?page=department">Master Data Departemen Karyawan</a>
                  <a class="dropdown-item" href="/?page=login_data">Master Data Login</a>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a
                  class="nav-link dropdown-toggle my-auto"
                  href="#"
                  id="navbarDropdown2"
                  role="button"
                  data-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false"
                >
                  Laporan
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown2">
                  <a class="dropdown-item" href="/?page=daily_report">Laporan Absensi Karyawan</a>
                  <a class="dropdown-item" href="/?page=late_report">Laporan Karyawan Terlambat</a>
                  <a class="dropdown-item" href="/?page=incomplete_report">Laporan Karyawan Bermasalah</a>
                </div>
              </li>
              <!-- Kalo gak work, hapus import bootstrap dari dynamic page nya -->
            </ul>
            <button type="button" class="btn btn-danger btn-sm my-auto" onClick="logout()">Log Out</button>
        <?php
          }
        ?>
        
      </nav>
    </header>
    <main>
      <?php
        $page = isset($_GET['page'])?$_GET['page']:'';
        if($page=="employee"){
          include 'pages/master_data/employee.php';
        }elseif ($page=="department") {
          include 'pages/master_data/department.php';
        }elseif ($page=="location") {
          include 'pages/master_data/location.php';
        }elseif ($page=="shift") {
          include 'pages/master_data/shift.php';
        }elseif($page=="login_data"){
          include 'pages/master_data/login_data.php';
        }elseif($page=="daily_report"){
          include 'pages/report/daily_report.php';
        }elseif($page=="late_report"){
          include 'pages/report/late_report.php';
        }elseif($page=="incomplete_report"){
          include 'pages/report/incomplete_report.php';
        }elseif($page=="dashboard"){
          include 'pages/dashboard.php';
        }else{
          include 'pages/attendance/attendance.php';
        }
      ?>
    </main>
    <div class="spacer" style="padding: 40px">
    </div>
    <footer class="fixed-bottom py-3 bg-dark text-white-50 d-print-none">
      <div class="container text-center">
          <small>Copyright &copy; Ananda Wiradharma</small>
      </div>
    </footer>
  </body>
  <script>
    function logout() {
      event.preventDefault();
      $.ajax({
              type: "GET",
              url: '/pages/login/logout_script.php',
              success: function(msg) {
                location.reload();
              }
      })
    }
  </script>
</html>
