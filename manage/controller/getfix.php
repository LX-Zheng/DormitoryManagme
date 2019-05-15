<?php
    require("db.php");
    $tool = new Tools();
    $result = $tool->selectDB("dorm","*","state","2");
    echo json_encode($result);
?>  