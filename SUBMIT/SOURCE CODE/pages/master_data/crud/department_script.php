<?php
    $root =  $_SERVER['DOCUMENT_ROOT'];
    include $root.'/koneksi.php';    
    $page = isset($_GET['p'])?$_GET['p']:'';

    if ($page=='view') {
        $no = 1;
        $data = mysqli_query($koneksi,"CALL get_departments");
        while($d = mysqli_fetch_array($data)){
        ?>
        <tr>
            <th class="align-middle" scope="row"><?php echo $no++; ?></th>
            <td class="align-middle"><?php echo $d['name']; ?></td>
            <td class="py-1 align-middle">
                <button type="button" class="btn btn-secondary btn-sm mx-1 d-print-none" data-toggle="modal" data-target="#editModal-<?php echo $d['id']; ?>"><i class="fas fa-edit"></i>  Edit</button>
                <div class="modal fade text-left" id="editModal-<?php echo $d['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel-<?php echo $d['id']; ?>">Edit Department</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-group">
                                    <input type="hidden" id="<?php echo $d['id']; ?>" value="<?php echo $d['id']; ?>">
                                    <label for="name-<?php echo $d['id']; ?>">Department Name</label>
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
                <button onClick="deleteData(<?php echo $d['id']; ?>)" type="button" class="btn btn-danger btn-sm mx-1 d-print-none"><i class="fas fa-trash-alt"></i>  Delete</button>
            </td>
        </tr>

        <?php 
        }
    }elseif ($page=='add') {
        $name = $_POST['name'];
        mysqli_query($koneksi,"CALL add_department('$name')");
    }elseif ($page=='delete'){
        $id = $_POST['id'];
        $data = mysqli_query($koneksi,"CALL delete_department($id)");
    }elseif ($page=='edit'){
        $id = $_POST['id'];
        $name = $_POST['name'];
        mysqli_query($koneksi,"CALL edit_department('$id', '$name')");
    }

?>