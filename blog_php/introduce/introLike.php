<?php
include "../connect/connect.php";
include "../connect/session.php";

if (!isset($_SESSION['memberId'])) {
    echo json_encode(['error' => '로그인이 필요합니다.']);
    exit;
}

$memberId = $_SESSION['memberId'];
$introId = $_POST['introId'] ?? '';
$likeType = $_POST['likeType'] ?? ''; // 'like' 또는 'dislike'

// 유효한 likeType 값인지 확인
if ($likeType !== 'like' && $likeType !== 'dislike') {
    echo json_encode(['error' => '올바르지 않은 좋아요 유형입니다.']);
    exit;
}

// 사용자가 이미 좋아요 또는 싫어요를 눌렀는지 확인
$checkSql = "SELECT introLike, introDislike, isChanged FROM IntroLikes WHERE memberId = ? AND introId = ?";
$checkStmt = $connect->prepare($checkSql);
$checkStmt->bind_param("is", $memberId, $introId);
$checkStmt->execute();
$result = $checkStmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // 이미 투표했을 경우, 변경 가능 여부 확인
    if ($row['isChanged'] == 1) {
        echo json_encode(['error' => '투표 변경은 한 번만 가능합니다.', 'alreadyChanged' => true]);
        exit;
    }
    // 다른 옵션으로 변경 가능
    $updateSql = "UPDATE IntroLikes SET introLike = ?, introDislike = ?, isChanged = 1 WHERE memberId = ? AND introId = ?";
    $like = $likeType === 'like' ? 1 : 0;
    $dislike = $likeType === 'dislike' ? 1 : 0;
    $updateStmt = $connect->prepare($updateSql);
    $updateStmt->bind_param("iiis", $like, $dislike, $memberId, $introId);
    $updateStmt->execute();
} else {
    // 최초 투표인 경우
    $insertSql = "INSERT INTO IntroLikes (memberId, introId, introLike, introDislike, isChanged, regTime) VALUES (?, ?, ?, ?, 0, UNIX_TIMESTAMP())";
    $like = $likeType === 'like' ? 1 : 0;
    $dislike = $likeType === 'dislike' ? 1 : 0;
    $insertStmt = $connect->prepare($insertSql);
    $insertStmt->bind_param("isii", $memberId, $introId, $like, $dislike);
    $insertStmt->execute();
}

// 좋아요 및 싫어요 수 업데이트 후 조회
$getLikesSql = "SELECT COUNT(*) as likeCount FROM IntroLikes WHERE introId = ? AND introLike = 1";
$likeCountStmt = $connect->prepare($getLikesSql);
$likeCountStmt->bind_param("s", $introId);
$likeCountStmt->execute();
$likeCountResult = $likeCountStmt->get_result();
$likeCount = $likeCountResult->fetch_assoc()['likeCount'];

$getDislikesSql = "SELECT COUNT(*) as dislikeCount FROM IntroLikes WHERE introId = ? AND introDislike = 1";
$dislikeCountStmt = $connect->prepare($getDislikesSql);
$dislikeCountStmt->bind_param("s", $introId);
$dislikeCountStmt->execute();
$dislikeCountResult = $dislikeCountStmt->get_result();
$dislikeCount = $dislikeCountResult->fetch_assoc()['dislikeCount'];

// 결과 반환
echo json_encode([
    'likeCount' => $likeCount,
    'dislikeCount' => $dislikeCount
]);
?>