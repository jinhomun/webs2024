<?php
include "../connect/connect.php";
include "../connect/session.php";

// 1. 세션에서 youId 가져오기
$youId = $_SESSION['youId'];
$memberId = $_POST['memberId'];
$blogId = $_POST['blogId'];
$commentName = $youId;

// 2. youId에 해당하는 youPass 가져오기
$youPassSql = "SELECT youPass FROM blog_myMembers WHERE youId = '$youId'";
$youPassResult = $connect->query($youPassSql);
$youPassRow = $youPassResult->fetch_assoc();
$commentPass = $youPassRow['youPass'];

$commentWrite = $_POST['msg'];
$regTime = time();

$sql = "INSERT INTO blogComments(memberId, blogId, commentName, commentPass, commentMsg, CommentDelete, regTime) VALUES('$memberId', '$blogId', '$commentName', '$commentPass', '$commentWrite', '1', '$regTime')";
$result = $connect->query($sql);

echo json_encode(array("info" => $blogId));
?>