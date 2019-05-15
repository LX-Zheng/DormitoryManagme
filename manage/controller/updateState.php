<?php
    require("db.php");
    $id = $_GET["id"];
    $tool = new Tools();
    $result = $tool->updateDB("dorm",$id);
    echo $result;
?>