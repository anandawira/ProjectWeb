<?php
    $root =  $_SERVER['DOCUMENT_ROOT'];
    $uniqName = $_POST['uniqName'];
    $file = $_FILES['photo'];

    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];
    $fileType = $file['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png');

    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 1024000) {
                $fileNameNew = $uniqName.".".$fileActualExt;
                $fileDestination = $root.'/uploads/'.$fileNameNew;

                move_uploaded_file($fileTmpName, $fileDestination);
            }else{
                echo "Your file is too big! Please upload file under 1 MB";
            }
        }else{
            echo "There was an error on uploading your file!";
        }
    }else{
        echo "You cant upload files of this type!";
    }
?>