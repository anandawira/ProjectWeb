<?php
    $root =  $_SERVER['DOCUMENT_ROOT'];
    include $root.'/koneksi.php';    
    $page = isset($_GET['p'])?$_GET['p']:'';

    if ($page=='view') {
        $no = 1;
        $data = mysqli_query($koneksi,"CALL get_employees");
        $koneksi->next_result();
        while($d = mysqli_fetch_array($data)){
        ?>
        <tr>
            <th class="align-middle" scope="row"><?php echo $no++; ?></th>
            <td class="align-middle"><?php echo $d['no']; ?></td>
            <td class="align-middle"><?php echo $d['full_name']; ?></td>
            <td class="align-middle"><?php echo $d['department_name']; ?></td>
            <td class="align-middle"><?php echo $d['position']; ?></td>
            <td class="align-middle"><?php echo $d['in_time']; ?> WIB - <?php echo $d['out_time']; ?> WIB</td>
            <td class="py-1 align-middle">
                <button type="button" class="btn btn-secondary btn-sm mx-1" data-toggle="modal" data-target="#editModal-<?php echo $d['no']; ?>"><i class="fas fa-edit"></i>  Edit</button>
                <div class="modal fade text-left" id="editModal-<?php echo $d['no']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel-<?php echo $d['no']; ?>">Edit Employee</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-group">
                                    <label for="name">Employee Name</label>
                                    <input type="text" class="form-control" id="name-<?php echo $d['no']; ?>" value="<?php echo $d['full_name']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="department">Department</label>
                                    <select class="form-control" id="department-<?php echo $d['no']; ?>">
                                    <?php
                                        $data1 = mysqli_query($koneksi,"CALL get_departments");
                                        while($departments = mysqli_fetch_assoc($data1)){
                                            if($departments['id']==$d['dept_id']){
                                    ?>
                                            <option value="<?php echo $departments['id']; ?>" selected><?php echo $departments['name']; ?></option>
                                    <?php
                                            }else{
                                    ?>
                                            <option value="<?php echo $departments['id']; ?>"><?php echo $departments['name']; ?></option>
                                    <?php
                                            }
                                        }
                                        $koneksi->next_result();
                                    ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="position">Position</label>
                                    <select class="form-control" id="position-<?php echo $d['no']; ?>">
                                    <?php
                                        $positions = ['Operator', 'Engineer', 'Staff', 'Supervisor', 'Manager'];
                                        foreach($positions as $position){
                                            if ($position==$d['position']) {
                                    ?>
                                        <option selected><?php echo $position; ?></option>
                                    <?php
                                            }else{
                                    ?>
                                        <option><?php echo $position; ?></option>
                                    <?php
                                            }
                                          }
                                    ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="shift">Shift</label>
                                    <select class="form-control" id="shift-<?php echo $d['no']; ?>">
                                    <?php
                                        $data2 = $koneksi->query("CALL get_shifts");
                                        $koneksi->next_result();
                                        echo "SQLSTATE error: " . mysqli_sqlstate($koneksi);
                                        echo "<br>";
                                        echo "SQLSTATE error: " . mysqli_error($koneksi);
                                        while($shifts = $data2->fetch_assoc()){
                                            if($shifts['id']==$d['shift_id']){
                                    ?>
                                            <option value="<?php echo $shifts['id']; ?>" selected><?php echo $shifts['in_time']; ?> WIB - <?php echo $shifts['out_time']; ?> WIB</option>
                                    <?php
                                            }else{
                                    ?>
                                            <option value="<?php echo $shifts['id']; ?>"><?php echo $shifts['in_time']; ?> WIB - <?php echo $shifts['out_time']; ?> WIB</option>
                                    <?php
                                            }
                                        }
                                    ?>
                                    </select>
                                </div>
                                <input type="submit" name="edit" id="edit" value="Update" class="btn btn-success btn-sm" onClick="updateData(<?php echo $d['no']; ?>)" data-dismiss="modal">
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                        </div>
                    </div>
                </div>
                <button onClick="deleteData(<?php echo $d['no']; ?>)" type="button" class="btn btn-danger btn-sm mx-1"><i class="fas fa-trash-alt"></i>  Delete</button>
            </td>
        </tr>

        <?php 
        }
    }elseif ($page=='add') {
        $name = $_POST['name'];
        $dept = $_POST['dept'];
        $pos = $_POST['pos'];
        $shift = $_POST['shift'];
        mysqli_query($koneksi,"CALL add_employee('$name', '$dept', '$pos', '$shift')");
    }elseif ($page=='delete'){
        $id = $_POST['id'];
        $data = mysqli_query($koneksi,"CALL delete_employee($id)");
    }elseif ($page=='edit'){
        $id = $_POST['id'];
        $name = $_POST['name'];
        $dept = $_POST['dept'];
        $pos = $_POST['pos'];
        $shift = $_POST['shift'];
        mysqli_query($koneksi,"CALL edit_employee('$id', '$name', '$dept', '$pos', '$shift')");
    }

?>