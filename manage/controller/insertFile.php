<?php
    require("db.php");
    $file_name = $_GET["file_name"];
    $tool = new Tools();
    $arrCols = array("name");
    $arrValues = array($file_name);
    $result = $tool->insertDB("data",$arrCols,$arrValues);
    echo $result;
?>