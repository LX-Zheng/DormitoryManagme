<?php
    require("db.php");
    $dorm = $_GET["dorm"];
    $tool = new Tools();
    $array = array($dorm);
    $result = $tool->selectDB("dorm","*","dorm",$array);
    echo json_encode($result);
?>