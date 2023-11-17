<?php
include "../connect/connect.php";
include "../connect/session.php";

if (isset($_POST["commentId"])) {
    $commentId = $_POST["commentId"];

    // 좋아요 수 업데이트 SQL 실행
    $sql = "UPDATE blogComments SET commentLike = commentLike + 1 WHERE commentId = $commentId";
    $result = $connect->query($sql);

    if ($result) {
        // 업데이트된 좋아요 수를 반환
        $newLikeCount = getNewLikeCount($commentId);
        echo json_encode(["success" => true, "likeCount" => $newLikeCount]);
    } else {
        echo json_encode(["success" => false]);
    }
} else {
    echo json_encode(["success" => false]);
}

function getNewLikeCount($commentId)
{
    global $connect;

    $sql = "SELECT commentLike FROM comment WHERE commentId = $commentId";
    $result = $connect->query($sql);
    $row = $result->fetch_assoc();
    return $row["commentLike"];
}


?>