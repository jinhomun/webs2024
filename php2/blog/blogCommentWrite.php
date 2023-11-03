<?php
    include "../connect/connect.php";

    $memberId = $_POST['memberId'];
    $blogId = $_POST['blogId'];
    $commentName = $_POST['name'];
    $commentPass = $_POST['pass'];
    $commentWrite = $_POST['msg'];
    $regTime = time();

    $sql = "INSERT INTO blogComment(memberId, blogId, commentName, commentPass, commentMsg, CommentDelete, regTime) VALUES('$memberId', '$blogId', '$commentName', '$commentPass', '$commentWrite', '1', '$regTime')";
    $result = $connect -> query($sql);

    echo json_encode(array("info" => $blogId));
?>