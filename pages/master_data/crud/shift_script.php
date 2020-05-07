<?php
    $root =  $_SERVER['DOCUMENT_ROOT'];
    include $root.'/koneksi.php';    
    $page = isset($_GET['p'])?$_GET['p']:'';

    if ($page=='view') {
        $no = 1;
        $data = mysqli_query($koneksi,"CALL get_shifts");
        while($d = mysqli_fetch_array($data)){
        ?>
        <tr>
            <th class="align-middle" scope="row"><?php echo $no++; ?></th>
            <td class="align-middle"><?php echo $d['in_time']; ?> WIB</td>
            <td class="align-middle"><?php echo $d['out_time']; ?> WIB</td>
            <td class="py-1 align-middle">
                <button type="button" class="btn btn-secondary btn-sm mx-1" data-toggle="modal" data-target="#editModal-<?php echo $d['id']; ?>"><i class="fas fa-edit"></i>  Edit</button>
                <div class="modal fade text-left" id="editModal-<?php echo $d['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addModalLabel-<?php echo $d['id']; ?>">Edit Shift</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <input type="hidden" id="<?php echo $d['id']; ?>" value="<?php echo $d['id']; ?>">
                                <h6 class="font-weight-bold">IN TIME</h6>
                                <div class="row">
                                    <div class="col form-group col-sm-3">
                                        <label for="inHour-<?php echo $d['id']; ?>">Hour</label>
                                        <select class="form-control" style="text-align-last: center;" id="inHour-<?php echo $d['id']; ?>">
                                            <?php
                                            $selected = date("G", strtotime($d['in_time']));
                                            for ($x = 1; $x <= 24; $x++) {
                                                if ($selected==$x) {
                                                    if($x>9){
                                                        echo "<option selected>$x</option>";
                                                    }else{
                                                        echo "<option selected>0$x</option>";
                                                    }
                                                }else{
                                                    if($x>9){
                                                        echo "<option>$x</option>";
                                                    }else{
                                                        echo "<option>0$x</option>";
                                                    }
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col form-group col-sm-3">
                                        <label for="inMinute-<?php echo $d['id']; ?>">Minute</label>
                                        <select class="form-control" style="text-align-last: center;" id="inMinute-<?php echo $d['id']; ?>">
                                            <?php
                                            $selected = date("i", strtotime($d['in_time']));
                                            for ($x = 0; $x <= 55; $x+=5) {
                                                if ($selected==$x) {
                                                    if($x>9){
                                                        echo "<option selected>$x</option>";
                                                    }else{
                                                        echo "<option selected>0$x</option>";
                                                    }
                                                }else{
                                                    if($x>9){
                                                        echo "<option>$x</option>";
                                                    }else{
                                                        echo "<option>0$x</option>";
                                                    }
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <h6 class="font-weight-bold">OUT TIME</h6>
                                <div class="row">
                                    <div class="col form-group col-sm-3">
                                        <label for="outHour-<?php echo $d['id']; ?>">Hour</label>
                                        <select class="form-control" style="text-align-last: center;" id="outHour-<?php echo $d['id']; ?>">
                                        <?php
                                            $selected = date("G", strtotime($d['out_time']));
                                            for ($x = 1; $x <= 24; $x++) {
                                                if ($selected==$x) {
                                                    if($x>9){
                                                        echo "<option selected>$x</option>";
                                                    }else{
                                                        echo "<option selected>0$x</option>";
                                                    }
                                                }else{
                                                    if($x>9){
                                                        echo "<option>$x</option>";
                                                    }else{
                                                        echo "<option>0$x</option>";
                                                    }
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col form-group col-sm-3">
                                        <label for="outMinute-<?php echo $d['id']; ?>">Minute</label>
                                        <select class="form-control" style="text-align-last: center;" id="outMinute-<?php echo $d['id']; ?>">
                                        <?php
                                            $selected = date("i", strtotime($d['out_time']));
                                            for ($x = 0; $x <= 55; $x+=5) {
                                                if ($selected==$x) {
                                                    if($x>9){
                                                        echo "<option selected>$x</option>";
                                                    }else{
                                                        echo "<option selected>0$x</option>";
                                                    }
                                                }else{
                                                    if($x>9){
                                                        echo "<option>$x</option>";
                                                    }else{
                                                        echo "<option>0$x</option>";
                                                    }
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-success btn-sm" onClick="updateData(<?php echo $d['id']; ?>)" data-dismiss="modal">
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
        $inTime = $_POST['inTime'];
        $outTime = $_POST['outTime'];
        mysqli_query($koneksi,"CALL add_shift('$inTime','$outTime')");
    }elseif ($page=='delete'){
        $id = $_POST['id'];
        $data = mysqli_query($koneksi,"CALL delete_shift($id)");
    }elseif ($page=='edit'){
        $id = $_POST['id'];
        $inTime = $_POST['inTime'];
        $outTime = $_POST['outTime'];
        mysqli_query($koneksi,"CALL edit_shift('$id', '$inTime','$outTime')");
    }

?>