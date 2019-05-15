<?php
    require("db.php");
    $account = $_GET["account"];
    $password = $_GET["password"];
    $tool = new Tools();
    $array  = array("password", "name", "dorm", "bed_num");
    $accou = array($account);
    $result = $tool->selectDB("user", $array, "account", $accou);
    //echo json_encode($result[0]['password']);
    if ($result[0]['password'] == $password) {
        if($result[0]['name'] == 'admin'){
            echo json_encode(true);
        }else{
            echo json_encode($result);
        }
    } else {
        echo json_encode(false);
    }
?>