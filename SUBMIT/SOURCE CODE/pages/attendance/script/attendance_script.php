<?php
    $root =  $_SERVER['DOCUMENT_ROOT'];
    include $root.'/koneksi.php';    
    $empId = $_POST['empId'];
    $locId = $_POST['locId'];
    $notes = $_POST['notes'];
    $fileName = $_POST['fileName'];
    $type = $_POST['type'];
    mysqli_query($koneksi,"CALL record_attendance('$empId', '$locId',  '$notes', '$fileName', '$type')");
    echo "CALL record_attendance('$empId', '$locId',  '$notes', '$fileName', '$type')";
?>