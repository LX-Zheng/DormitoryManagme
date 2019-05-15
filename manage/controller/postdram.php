<?php
    require("db.php");
    $name = $_GET["name"];
    $content = $_GET["content"];
    $user_name = $_GET["user_name"];
    $user_dorm = $_GET["user_dorm"];
    $date = $_GET["date"];
    $tool = new Tools();
    $arrcol = array("dorm","name","detail_name","detail","date","state");
    $arrValue = array("$user_dorm","$user_name","$name","$content","$date","2");
    $result = $tool->insertDB("dorm",$arrcol,$arrValue);
    echo json_encode($result);
?>