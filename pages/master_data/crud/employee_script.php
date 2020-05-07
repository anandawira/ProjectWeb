<?php
    $root =  $_SERVER['DOCUMENT_ROOT'];
    include $root.'/koneksi.php';    
    $page = isset($_GET['p'])?$_GET['p']:'';

    if ($page=='view') {
        $no = 1;
        $data = mysqli_query($koneksi,"CALL get_employees");
        while($d = mysqli_fetch_array($data)){
        ?>
        <tr>
            <th class="align-middle" scope="row"><?php echo $no++; ?></th>
            <td class="align-middle"><?php echo $d['no']; ?></td>
            <td class="align-middle"><?php echo $d['full_name']; ?></td>
            <td class="align-middle"><?php echo $d['department']; ?></td>
            <td class="align-middle"><?php echo $d['position']; ?></td>
            <td class="align-middle"><?php echo $d['in_time']; ?> WIB - <?php echo $d['out_time']; ?> WIB</td>
            <td class="py-1 align-middle">
                <button type="button" class="btn btn-secondary btn-sm mx-1" data-toggle="modal" data-target="#editModal-<?php echo $d['id']; ?>"><i class="fas fa-edit"></i>  Edit</button>
                <div class="modal fade text-left" id="editModal-<?php echo $d['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel-<?php echo $d['id']; ?>">Edit Location</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-group">
                                    <input type="hidden" id="<?php echo $d['id']; ?>" value="<?php echo $d['id']; ?>">
                                    <label for="name-<?php echo $d['id']; ?>">Location Name</label>
                                    <input type="text" class="form-control" id="name-<?php echo $d['id']; ?>" value="<?php echo $d['name']; ?>" required>
                                </div>
                                <input type="submit" name="edit" id="edit" value="Update" class="btn btn-success btn-sm" onClick="updateData(<?php echo $d['id']; ?>)" data-dismiss="modal">
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                        </div>
                    </div>
                </div>
                <button onClick="deleteData(<?php echo $d['id']; ?>)" type="button" class="btn btn-danger btn-sm mx-1"><i class="fas fa-trash-alt"></i>  Delete</button>
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
        $data = mysqli_query($koneksi,"CALL delete_location($id)");
    }elseif ($page=='edit'){
        $id = $_POST['id'];
        $name = $_POST['name'];
        mysqli_query($koneksi,"CALL edit_location('$id', '$name')");
    }

?>