<div class="container mt-2">
          <!-- Content Row -->
          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row align-items-center no-gutters">
                        <div class="col justify-content-center d-flex">
                        <i class="fas fa-user-friends fa-5x text-primary"></i>
                        </div>
                    </div>
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                        <div class="h4 font-weight-bold text-primary text-uppercase text-center mt-2">Employee</div>
                        <div class="my-2 font-weight-bold text-primary text-center display-4">
                        <?php
                            $root =  $_SERVER['DOCUMENT_ROOT'];
                            include $root.'/koneksi.php';   
                            $data = mysqli_query($koneksi,"SELECT * FROM employee_count");
                            $result= $data->fetch_row();
                            echo $result[0];
                        ?>
                        </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row align-items-center no-gutters">
                        <div class="col justify-content-center d-flex">
                        <i class="fas fa-building fa-5x text-success"></i>
                        </div>
                    </div>
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="h4 font-weight-bold text-success text-uppercase text-center mt-2">Department</div>
                      <div class="h5 my-2 font-weight-bold text-success text-center display-4">
                        <?php
                        $data = mysqli_query($koneksi,"SELECT * FROM department_count");
                        $result= $data->fetch_row();
                        echo $result[0];
                        ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row align-items-center no-gutters">
                        <div class="col justify-content-center d-flex">
                        <i class="fas fa-clock fa-5x text-info"></i>
                        </div>
                    </div>
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="h4 font-weight-bold text-info text-uppercase text-center mt-2">Shift</div>
                      <div class="my-2 font-weight-bold text-info text-center display-4">
                        <?php
                        $data = mysqli_query($koneksi,"SELECT * FROM shift_count");
                        $result= $data->fetch_row();
                        echo $result[0];
                        ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          

          <!-- Content Row -->

          <div class="row">

        </div>