<?php
    $root =  $_SERVER['DOCUMENT_ROOT'];
    if (isset($_SESSION['no'])) {
        $userNo = $_SESSION['no'];
        $type = $_SESSION['type'];
    }else{
        include $root.'/pages/login/login.php';
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<body onload="viewData()">
    <h2 class="text-center mt-4 mb-0">LOGIN MASTER DATA</h2>
    <div class="container-sm mb-5">
    <button type="button" data-toggle="modal" data-target="#addModal" class="btn btn-primary btn-sm mb-2 float-right"><i class="fas fa-plus"></i>  Add</button>
        <div class="table-responsive">
            <table class="table table-hover mx-auto m-0  text-center">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col" class="align-middle">No</th>
                    <th scope="col" class="align-middle">Name</th>
                    <th scope="col" class="align-middle">Employee No</th>
                    <th scope="col" class="align-middle">Type</th>
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
                <h5 class="modal-title" id="addModalLabel">Add Login Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group" id="addForm">
                        <label for="empNo">Employee No</label>
                        <select class="form-control" id="empNo">
                        <?php
                            $root =  $_SERVER['DOCUMENT_ROOT'];
                            include $root.'/koneksi.php';
                            $data1 = mysqli_query($koneksi,"CALL get_available_employee");
                            while($employees = mysqli_fetch_assoc($data1)){
                        ?>
                            <option value="<?php echo $employees['no']; ?>"><?php echo $employees['no']; ?> - <?php echo $employees['full_name']; ?></option>
                        <?php
                            }
                            $koneksi->next_result();
                        ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="pass">Password</label>
                        <input type="password" class="form-control" id="pass" required>
                    </div>
                    <div class="custom-control form-group custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="isAdmin">
                        <label class="custom-control-label" for="isAdmin">Admin</label>
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
        let empNo = $('#empNo').val();
        let pass = $('#pass').val();
        let isAdmin = document.querySelector("#isAdmin").checked;
        $.ajax({
                type: "POST",
                url: '/pages/master_data/crud/login_data_script.php?p=add',
                data: "empNo="+empNo+"&pass="+pass+"&isAdmin="+isAdmin,
                success: function(data) {
                    viewData();
                    $('#addForm').html(data);
                }
        })
    }

    function viewData() {
        $.ajax({
            type: "GET",
            url: '/pages/master_data/crud/login_data_script.php?p=view',
            success: function(data) {
                $('tbody').html(data);
            }
        });
    }
    function deleteData(str) {
        let id=str;
        $.ajax({
            type: "POST",
            url: '/pages/master_data/crud/login_data_script.php?p=delete',
            data: "id="+id,
            success: function () {
                viewData();
            }
        })
    }
    function updateData(str) {
        $('.modal-backdrop').remove();
        let empNo = str;
        let pass = $('#pass-'+empNo).val();
        let isAdmin = document.querySelector("#isAdmin-"+empNo).checked;

        $.ajax({
            type: "POST",
            url: "/pages/master_data/crud/login_data_script.php?p=edit",
            data: "empNo="+empNo+"&pass="+pass+"&isAdmin="+isAdmin,
            success: function() {
                viewData();
            }
        })
    }
    </script>
</body>
</html>