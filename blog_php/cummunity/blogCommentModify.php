<?php
include "../connect/connect.php";
$commentMsg = $_POST['commentMsg'];
$commentPass = $_POST['commentPass'];
$commentId = $_POST['commentId'];

$sql = "SELECT commentPass FROM blogComments WHERE commentPass = '$commentPass'";
$result = $connect->query($sql);

if ($result->num_rows == 0) {
    $jsonResult = "bad";
} else {
    $updateSql = "UPDATE blogComments SET commentMsg = '$commentMsg' WHERE commentPass = '$commentPass'";
    $connect->query($updateSql);
    $jsonResult = "good";
}
echo json_encode(array("result" => $jsonResult));
?>