<?php
    include "../connect/connect.php";
    
    $commentPass = $_POST['commentPass'];
    $commentId = $_POST['commentId'];

    $sql = "SELECT commentPass FROM blogComment WHERE commentPass = '$commentPass' AND commentId = '$commentId'";
    $result = $connect -> query($sql);

    if($result -> num_rows == 0){
        $jsonResult = "bad";
    } else {
        // $updateSql = "DELETE FROM blogComment WHERE commentId = '$commentId'";
        $updateSql = "UPDATE blogComment SET commentDelete = '0' WHERE commentId = '$commentId'";
        $connect -> query($updateSql);
        $jsonResult = "good";
    }
    echo json_encode(array("result" => $jsonResult));
?>