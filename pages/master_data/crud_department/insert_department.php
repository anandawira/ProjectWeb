<?php
$root = dirname(dirname(dirname(dirname(__FILE__))));
include $root.'/koneksi.php';    

if (!empty($_POST)) {
    $name = mysqli_real_escape_string($koneksi, $_POST["departmentName"]);
    mysqli_query($koneksi,"CALL `add_department`($name)");
}
?>