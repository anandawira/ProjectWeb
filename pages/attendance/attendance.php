<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Department</title>
    <script src="https://code.jquery.com/jquery-3.5.0.js" integrity="sha256-r/AaFHrszJtwpe+tHyNi/XCfMxYpbsRg2Uqn0x3s2zc=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script
      src="https://kit.fontawesome.com/5fd5318cab.js"
      crossorigin="anonymous"
    ></script>
</head>
<body>
    <h2 class="mt-4 text-center">ATTENDANCE</h2>
    <div class="container-lg">
        <div class="row">
            <div class="col-md-6 pr-2 p-3">
                <div class="table-responsive border rounded p-2">
                <table class="table table-borderless h5 font-weight-normal m-0">
                    <?php
                        $root =  $_SERVER['DOCUMENT_ROOT'];
                        include $root.'/koneksi.php';    
                        $data = mysqli_query($koneksi,"CALL get_employee('100010')");
                        $d = mysqli_fetch_assoc($data)
                    ?>
                    <tbody>
                        <tr>
                            <td>Name</td>
                            <td>:</td>
                            <td><?php echo $d['full_name']; ?></td>
                        </tr>
                        <tr>
                            <td>Employee Number</td>
                            <td>:</td>
                            <td><?php echo $d['no']; ?></td>
                        </tr>
                        <tr>
                            <td>Department</td>
                            <td>:</td>
                            <td><?php echo $d['department']; ?></td>
                        </tr>
                        <tr>
                            <td>Position</td>
                            <td>:</td>
                            <td><?php echo $d['position']; ?></td>
                        </tr>
                        <tr>
                            <td>Shift</td>
                            <td>:</td>
                            <td><?php echo $d['in_time']; ?> WIB - <?php echo $d['out_time']; ?> WIB</td>
                        </tr>
                    </tbody>
                </table>
                </div>
            </div>
            <div class="col-md-6 p-3">
                <form action="">
                    <div class="form-group">
                        <label for="uploadPhoto">Upload photo</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="uploadPhoto">
                            <label class="custom-file-label" for="uploadPhoto">Choose file</label>
                        </div>
                    </div>  
                    <div class="form-group">
                        <label for="notes">Notes</label>
                        <textarea class="form-control" id="notes"></textarea>
                    </div>
                    <div class="d-sm-flex flex-row justify-content-around">
                        <button type="button" class="btn btn-primary btn-lg p-3"><i class="fas fa-sign-in-alt"></i>   Check In </button>
                        <button type="button" class="btn btn-danger btn-lg p-3"><i class="fas fa-sign-out-alt"></i>   Check Out</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>