<?php
    require("db.php");
    $tool = new Tools();
    $result = $tool->selectDB("data","*","","");
    echo json_encode($result);
?>