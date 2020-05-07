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
<body onload="viewData()">
    <?php
        $root =  $_SERVER['DOCUMENT_ROOT'];
        include $root.'/koneksi.php';
    ?>
    <h2 class="text-center mt-5 mb-0">EMPLOYEE MASTER DATA</h2>
    <div class="container-sm p-0 mb-5">
    <button type="button" data-toggle="modal" data-target="#addModal" class="btn btn-primary btn-sm mb-2 float-right"><i class="fas fa-plus"></i>  Add</button>
        <div class="table-responsive">
            <table class="table table-hover mx-auto m-0  text-center">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col" class="align-middle">No</th>
                    <th scope="col" class="align-middle">Employee No</th>
                    <th scope="col" class="align-middle">Full Name</th>
                    <th scope="col" class="align-middle">Department</th>
                    <th scope="col" class="align-middle">Position</th>
                    <th scope="col" class="align-middle">Shift</th>
                    <th scope="col" class="align-middle">Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    <!-- modal -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Add Employee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="name">Employee Name</label>
                        <input type="text" class="form-control" id="name" required>
                    </div>
                    <div class="form-group">
                        <label for="department">Department</label>
                        <select class="form-control" id="department">
                        <?php
                            $data1 = mysqli_query($koneksi,"CALL get_departments");
                            while($departments = mysqli_fetch_assoc($data1)){
                        ?>
                            <option value="<?php echo $departments['id']; ?>"><?php echo $departments['name']; ?></option>
                        <?php
                            }
                            $koneksi->next_result();
                        ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="position">Position</label>
                        <select class="form-control" id="position">
                        <option>Operator</option>
                        <option>Engineer</option>
                        <option>Staff</option>
                        <option>Supervisor</option>
                        <option>Manager</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="shift">Shift</label>
                        <select class="form-control" id="shift">
                        <?php
                            $data2 = $koneksi->query("CALL get_shifts");
                            echo "SQLSTATE error: " . mysqli_sqlstate($koneksi);
                            echo "<br>";
                            echo "SQLSTATE error: " . mysqli_error($koneksi);
                            while($shifts = $data2->fetch_assoc()){
                        ?>
                            <option value="<?php echo $shifts['id']; ?>"><?php echo $shifts['in_time']; ?> WIB - <?php echo $shifts['in_time']; ?> WIB</option>
                        <?php
                            }
                        ?>
                        </select>
                    </div>
                    <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-success btn-sm" onClick="insertData()" data-dismiss="modal">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>
    <!-- modal -->
    <script>
    function insertData() {
        let name = $('#name').val();
        let department = $('#department').val();
        let position = $('#position').val();
        let shift = $('#shift').val();
        console.log(name+department+position+shift);
        if (name!="") {
            $.ajax({
                type: "POST",
                url: '/pages/master_data/crud/employee_script.php?p=add',
                data: "name="+name+"&dept="+department+"&pos="+position+"&shift="+shift,
                success: function(msg) {
                    viewData();
                    alert("hahaha");
                }
            })
        }
    }
    function viewData() {
        // $.ajax({
        //     type: "GET",
        //     url: '/pages/master_data/crud/employee_script.php?p=view',
        //     success: function(data) {
        //         $('tbody').html(data);
        //     }
        // });
    }
    function deleteData(str) {
        // let id=str;
        // $.ajax({
        //     type: "POST",
        //     url: '/pages/master_data/crud/employee_script.php?p=delete',
        //     data: "id="+id,
        //     success: function () {
        //         viewData();
        //     }
        // })
    }
    function updateData(str) {
        // $('.modal-backdrop').remove();
        // let id = str;
        // let name = $('#name-'+id).val();
        // console.log(name);
        // $.ajax({
        //     type: "POST",
        //     url: "/pages/master_data/crud/employee_script.php?p=edit",
        //     data: "name="+name+"&id="+id,
        //     success: function() {
        //         viewData();
        //     }
        // })
    }
    </script>
</body>
</html>