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
                <button type="button" class="btn btn-secondary btn-sm mx-1"><i class="fas fa-edit"></i>  Edit</button>
                <button onClick="deleteData(<?php echo $d['id']; ?>)" type="button" class="btn btn-danger btn-sm mx-1"><i class="fas fa-trash-alt"></i>  Delete</button>
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
    }

?>