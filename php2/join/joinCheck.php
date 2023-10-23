<?php
    include "../connect/connect.php";

    $type = $_POST['type'];
    $jsonResult = "bad";

    if( $type == "isIdCheck" ){
        $youId = $connect -> real_escape_string(trim($_POST['youId']));
        $sql = "SELECT youId FROM myMembers WHERE youId = '{$youId}'";
    }
    $result = $connect -> query($sql);
    if($result -> num_rows == 0){
        $jsonResult = "good";
    }

    echo json_encode(array("result" => $jsonResult));
?>