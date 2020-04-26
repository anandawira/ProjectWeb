<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
      integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
      crossorigin="anonymous"
    />
    <script
      src="https://kit.fontawesome.com/5fd5318cab.js"
      crossorigin="anonymous"
    ></script>

  </head>
  <body>
    <header>
      <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand d-flex" href="#">
          <i
            class="fas fa-fingerprint align-self-center"
            style="font-size: 70px;"
          ></i>
          <h1 class="align-self-center mx-3">Absensi Karyawan</h1>
        </a>
        <ul class="nav collapse-nav mr-auto">
          <li class="nav-item dropdown">
            <a
              class="nav-link dropdown-toggle"
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
              <a class="dropdown-item" href="#">Master Data Karyawan</a>
              <a class="dropdown-item" href="#">Master Data Shift Karyawan</a>
              <a class="dropdown-item" href="#">Master Data Lokasi Absensi</a>
              <a class="dropdown-item" href="#"
                >Master Data Departemen Karyawan</a
              >
            </div>
          </li>
          <li class="nav-item dropdown">
            <a
              class="nav-link dropdown-toggle"
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
              <a class="dropdown-item" href="#">Laporan Karyawan Harian</a>
              <a class="dropdown-item" href="#">Laporan Karyawan Mingguan</a>
              <a class="dropdown-item" href="#">Laporan Karyawan Bulanan</a>
              <a class="dropdown-item" href="#">Laporan Karyawan Terlambat</a>
              <a class="dropdown-item" href="#">Laporan Karyawan Bermasalah</a>
            </div>
          </li>
        </ul>
      </nav>
    </header>
    <main>
      <?php
        include 'pages/master_data/department.php';
      ?>
    </main>
    <div class="spacer" style="padding: 28px">
    </div>
    <footer class="fixed-bottom py-3 bg-dark text-white-50">
      <div class="container text-center">
          <small>Copyright &copy; Ananda Wiradharma</small>
      </div>
    </footer>
  </body>
</html>
