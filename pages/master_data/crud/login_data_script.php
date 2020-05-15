<?php
    $root =  $_SERVER['DOCUMENT_ROOT'];
    include $root.'/koneksi.php';    
    $page = isset($_GET['p'])?$_GET['p']:'';

    if ($page=='view') {
        $no = 1;
        $data = mysqli_query($koneksi,"CALL get_login_datas");
        while($d = mysqli_fetch_array($data)){
        ?>
        <tr>
            <th class="align-middle" scope="row"><?php echo $no++; ?></th>
            <td class="align-middle"><?php echo $d['full_name']; ?></td>
            <td class="align-middle"><?php echo $d['employee_no']; ?></td>
            <!-- password di hide aja -->
            <td class="align-middle"><?php echo $d['type']; ?></td>
            <td class="py-1 align-middle">
                <button type="button" class="btn btn-secondary btn-sm mx-1" data-toggle="modal" data-target="#editModal-<?php echo $d['employee_no']; ?>"><i class="fas fa-edit"></i>  Edit</button>
                <div class="modal fade text-left" id="editModal-<?php echo $d['employee_no']; ?>" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel-<?php echo $d['employee_no']; ?>">Edit Login Data - <?php echo $d['employee_no']; ?> <?php echo $d['full_name']; ?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                            <input type="hidden" id="empNo-<?php echo $d['employee_no']; ?>" value="<?php echo $d['employee_no']; ?>">
                                <div class="form-group">
                                    <label for="pass-<?php echo $d['employee_no']; ?>">Password</label>
                                    <input type="password" class="form-control" id="pass-<?php echo $d['employee_no']; ?>" value="<?php echo $d['password']; ?>" required>
                                </div>
                                <div class="custom-control form-group custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="isAdmin-<?php echo $d['employee_no']; ?>" <?php echo $d['check']; ?>>
                                    <label class="custom-control-label" for="isAdmin-<?php echo $d['employee_no']; ?>">Admin</label>
                                </div>
                                <input type="submit" name="edit" id="edit-<?php echo $d['employee_no']; ?>" value="Update" class="btn btn-success btn-sm" onClick="updateData(<?php echo $d['employee_no']; ?>)" data-dismiss="modal">
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                        </div>
                    </div>
                </div>
                <button onClick="deleteData(<?php echo $d['employee_no']; ?>)" type="button" class="btn btn-danger btn-sm mx-1"><i class="fas fa-trash-alt"></i>  Delete</button>
            </td>
        </tr>

        <?php 
        }
    }elseif ($page=='add') {
        $empNo = $_POST['empNo'];
        $pass = $_POST['pass'];
        $isAdmin = $_POST['isAdmin'];
        mysqli_query($koneksi,"CALL add_login_data('$empNo', '$pass', $isAdmin)");
        ?>
        <label for="empNo">Employee No</label>
        <select class="form-control" id="empNo">
        <?php
            $data1 = mysqli_query($koneksi,"CALL get_available_employee");
            while($employees = mysqli_fetch_assoc($data1)){
        ?>
            <option value="<?php echo $employees['no']; ?>"><?php echo $employees['no']; ?> - <?php echo $employees['full_name']; ?></option>
        <?php
            }
            $koneksi->next_result();
        ?>
        </select>
        <?php
    }elseif ($page=='delete'){
        $id = $_POST['id'];
        $data = mysqli_query($koneksi,"CALL delete_login_data($id)");
    }elseif ($page=='edit'){
        $id = $_POST['empNo'];
        $pass = $_POST['pass'];
        $isAdmin = $_POST['isAdmin'];
        mysqli_query($koneksi,"CALL edit_login_data('$id', '$pass', $isAdmin)");
    }

?>