<?php
include "../connect/connect.php";
include "../connect/session.php";

if (isset($_POST["blogId"])) {
    $blogId = $_POST["blogId"];

    // 좋아요 수 업데이트 SQL 실행
    $sql = "UPDATE blogs SET blogLike = blogLike + 1 WHERE blogId = $blogId";
    $result = $connect->query($sql);

    if ($result) {
        // 업데이트된 좋아요 수를 반환
        $newLikeCount = getNewLikeCount($blogId);
        echo json_encode(["success" => true, "likeCount" => $newLikeCount]);
    } else {
        echo json_encode(["success" => false]);
    }
} else {
    echo json_encode(["success" => false]);
}

function getNewLikeCount($blogId)
{
    global $connect;

    $sql = "SELECT blogLike FROM blogs WHERE blogId = $blogId";
    $result = $connect->query($sql);
    $row = $result->fetch_assoc();
    return $row["blogLike"];
}

?>