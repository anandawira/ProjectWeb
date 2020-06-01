<?php
    $root =  $_SERVER['DOCUMENT_ROOT'];
    include $root.'/koneksi.php';
    $empNo = $_POST['empNo'];
    $pass = $_POST['pass'];
    $result = mysqli_query($koneksi,"CALL check_login('$empNo', '$pass')");
    $count = mysqli_num_rows($result);
    if ($count==1) {
        session_start();
        $data= mysqli_fetch_assoc($result);
        $_SESSION["no"] = $data['employee_no'];
        $_SESSION["type"] = $data['type'];
    }

    echo $count;
?>