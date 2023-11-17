<?php
include "../connect/connect.php";
include "../connect/session.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["introId"]) && isset($_POST["likeType"])) {
    $memberId = $_SESSION["memberId"];
    $introId = $_POST["introId"];
    $likeType = $_POST["likeType"];

    // 좋아요 또는 싫어요를 취소하는 쿼리 작성
    if ($likeType === 'like') {
        // 좋아요를 취소하는 경우
        $deleteStmt = $connect->prepare("DELETE FROM IntroLikes WHERE memberId = ? AND introId = ? AND likeType = 1");
    } elseif ($likeType === 'dislike') {
        // 싫어요를 취소하는 경우
        $deleteStmt = $connect->prepare("DELETE FROM IntroLikes WHERE memberId = ? AND introId = ? AND likeType = 0");
    }

    $deleteStmt->bind_param("ii", $memberId, $introId);
    $deleteStmt->execute();
    $deleteStmt->close();

    // 취소 후, 업데이트된 좋아요/싫어요 수 조회
    $likesStmt = $connect->prepare("SELECT COUNT(*) as likeCount FROM IntroLikes WHERE introId = ? AND likeType = 1");
    $likesStmt->bind_param("i", $introId);
    $likesStmt->execute();
    $newLikeCount = $likesStmt->get_result()->fetch_assoc()["likeCount"] ?? 0;
    $likesStmt->close();

    $dislikesStmt = $connect->prepare("SELECT COUNT(*) as dislikeCount FROM IntroLikes WHERE introId = ? AND likeType = 0");
    $dislikesStmt->bind_param("i", $introId);
    $dislikesStmt->execute();
    $newDislikeCount = $dislikesStmt->get_result()->fetch_assoc()["dislikeCount"] ?? 0;
    $dislikesStmt->close();

    echo json_encode([
        "success" => true,
        "newLikeCount" => $newLikeCount,
        "newDislikeCount" => $newDislikeCount
    ]);
    exit;
} else {
    echo json_encode(["error" => "올바르지 않은 요청입니다."]);
    exit;
}
?>