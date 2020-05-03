<?php
$root =  $_SERVER['DOCUMENT_ROOT'];
include $root.'/koneksi.php';    

if (!empty($_POST)) {
    $name = mysqli_real_escape_string($koneksi, $_POST["departmentName"]);
    mysqli_query($koneksi,"CALL add_department('$name')");
    header('Location: ../department.php'); //Later add page=dept
}
?>