<?php
include "../connect/connect.php";
$commentPass = $_POST['commentPass'];
$commentId = $_POST['commentId'];

// 입력한 패스워드와 댓글 ID에 해당하는 댓글의 패스워드를 조회합니다.
$sql = "SELECT commentPass FROM blogComments WHERE commentId = '$commentId'";
$result = $connect->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $storedPass = $row['commentPass'];

    // 입력한 패스워드와 저장된 패스워드를 비교하여 삭제 수행 여부를 결정합니다.
    if ($storedPass === $commentPass) {
        // 댓글 삭제 쿼리를 실행합니다.
        $deleteSql = "DELETE FROM blogComments WHERE commentId = '$commentId'";
        $connect->query($deleteSql);

        // 해당 댓글에 대한 좋아요 데이터도 함께 삭제합니다.
        $deleteLikesSql = "DELETE FROM commentLikes WHERE commentId = '$commentId'";
        $connect->query($deleteLikesSql);

        $jsonResult = "good";
    } else {
        $jsonResult = "bad";
    }
} else {
    $jsonResult = "bad";
}

echo json_encode(array("result" => $jsonResult));
?>