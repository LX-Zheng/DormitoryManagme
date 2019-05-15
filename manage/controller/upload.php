<?php
    //$allowedExts = array("xls","xlsx");
    //$temp = explode(".",$_FILES["file"]["name"]);
    if ($_FILES['file']['error'] > 0) {
        echo "错误:".$_FILES['file']['error'].'<br/>';
    } else {
    
            //个人目录不存在，则新建
            if(!file_exists('../upload/')) {
                mkdir(dirname(__FILE__)."../upload/");
            }
            move_uploaded_file($_FILES['file']['tmp_name'],'../upload/'.$_FILES['file']['name']);
    }
    //header("location:file_view.php");
    echo $_FILES["file"]["name"];
?>