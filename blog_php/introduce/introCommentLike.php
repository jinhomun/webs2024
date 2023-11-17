<?php
include "../connect/connect.php";
include "../connect/session.php"; 

$memberId = $_SESSION["memberId"];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["commentId"])) {
    $commentId = (int) $_POST["commentId"];

    // Check if the user has already liked the comment
    $checkStmt = $connect->prepare("SELECT * FROM introCommentLikes WHERE memberId = ? AND commentId = ?");
    $checkStmt->bind_param("ii", $memberId, $commentId);
    $checkStmt->execute();
    $result = $checkStmt->get_result();
    $checkStmt->close();

    if ($result->num_rows > 0) {
        // 이미 좋아요를 누른 경우 좋아요를 취소하고 좋아요 수를 1 줄입니다.
        $deleteStmt = $connect->prepare("DELETE FROM introCommentLikes WHERE memberId = ? AND commentId = ?");
        $deleteStmt->bind_param("ii", $memberId, $commentId);
        $deleteStmt->execute();
        $deleteStmt->close();

        $updateStmt = $connect->prepare("UPDATE IntroComment SET commentLike = GREATEST(COALESCE(commentLike, 0) - 1, 0) WHERE commentId = ?");
        $updateStmt->bind_param("i", $commentId);
        $updateStmt->execute();
        $updateStmt->close();
    } else {
        // 좋아요를 추가하는 경우
        $insertStmt = $connect->prepare("INSERT INTO introCommentLikes (memberId, commentId, regTime) VALUES (?, ?, ?)");
        $time = time();
        $insertStmt->bind_param("iii", $memberId, $commentId, $time);
        $insertStmt->execute();
        $insertStmt->close();

        $updateStmt = $connect->prepare("UPDATE IntroComment SET commentLike = COALESCE(commentLike, 0) + 1 WHERE commentId = ?");
        $updateStmt->bind_param("i", $commentId);
        $updateStmt->execute();
        $updateStmt->close();
    }

    // Get the updated commentLike value
    $likesStmt = $connect->prepare("SELECT commentLike FROM IntroComment WHERE commentId = ?");
    $likesStmt->bind_param("i", $commentId);
    $likesStmt->execute();
    $newLikes = $likesStmt->get_result()->fetch_assoc()["commentLike"] ?? 0;
    $likesStmt->close();

    echo json_encode(["success" => true, "newLikeCount" => $newLikes]);
    exit;
}
?>