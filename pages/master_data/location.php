<?php
    $root =  $_SERVER['DOCUMENT_ROOT'];
    if (isset($_SESSION['no'])) {
        $userNo = $_SESSION['no'];
        $type = $_SESSION['type'];
        if ($type!='Admin') {
            include $root.'/pages/login/need_admin.php';
            return;
        }
    }else{
        include $root.'/pages/login/login.php';
        return;
    }
?>
<!DOCTYPE html>
<html lang="en">
<body onload="viewData()">
    <h2 class="text-center mt-4 mb-0">LOCATION MASTER DATA</h2>
    <div class="container-fluid mb-5">
    <button type="button" class="btn btn-success btn-sm d-print-none" onclick="printTable()">Print</button>
    <button type="button" data-toggle="modal" data-target="#addModal" class="btn btn-primary btn-sm mb-2 float-right d-print-none"><i class="fas fa-plus"></i>  Add</button>
        <div class="table-responsive">
            <table class="table table-hover mx-auto m-0  text-center">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col" class="align-middle">No</th>
                    <th scope="col" class="align-middle">Location Name</th>
                    <th scope="col" class="align-middle d-print-none">Action</th>
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
                <h5 class="modal-title" id="addModalLabel">Add Location</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="name">Location Name</label>
                        <input type="text" class="form-control" id="name" required>
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
    function printTable() {
        window.print();
    }
    function insertData() {
        let name = $('#name').val();
        if (name!="") {
            $.ajax({
                type: "POST",
                url: '/pages/master_data/crud/location_script.php?p=add',
                data: "name="+name,
                success: function(msg) {
                    viewData();
                }
            })
        }
    }

    function viewData() {
        $.ajax({
            type: "GET",
            url: '/pages/master_data/crud/location_script.php?p=view',
            success: function(data) {
                $('tbody').html(data);
            }
        });
    }
    function deleteData(str) {
        let id=str;
        $.ajax({
            type: "POST",
            url: '/pages/master_data/crud/location_script.php?p=delete',
            data: "id="+id,
            success: function () {
                viewData();
            }
        })
    }
    function updateData(str) {
        $('.modal-backdrop').remove();
        let id = str;
        let name = $('#name-'+id).val();
        console.log(name);
        $.ajax({
            type: "POST",
            url: "/pages/master_data/crud/location_script.php?p=edit",
            data: "name="+name+"&id="+id,
            success: function() {
                viewData();
            }
        })
    }
    </script>
</body>
</html>