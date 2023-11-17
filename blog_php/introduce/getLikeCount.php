<?php
include "../connect/connect.php";

if (isset($_GET['introId'])) {
    $introId = $connect->real_escape_string($_GET['introId']);

    // 좋아요 수 조회 쿼리 작성
    $getLikesCountSql = "SELECT COUNT(*) as likeCount FROM IntroLikes WHERE introId = '$introId' AND introLike = 1";
    $getDislikesCountSql = "SELECT COUNT(*) as dislikeCount FROM IntroLikes WHERE introId = '$introId' AND introDislike = 1";
    $likesCountResult = $connect->query($getLikesCountSql);
    $dislikesCountResult = $connect->query($getDislikesCountSql);

    // 좋아요 수 가져오기
    if ($likesCountResult !== false) {
        $likesCountInfo = $likesCountResult->fetch_array(MYSQLI_ASSOC);
        $likeCount = $likesCountInfo['likeCount'];
    } else {
        $likeCount = 0;
    }

    // 싫어요 수 가져오기
    if ($dislikesCountResult !== false) {
        $dislikesCountInfo = $dislikesCountResult->fetch_array(MYSQLI_ASSOC);
        $dislikeCount = $dislikesCountInfo['dislikeCount'];
    } else {
        $dislikeCount = 0;
    }

    // 결과 반환 (JSON 형식)
    $response = array(
        'likeCount' => $likeCount,
        'dislikeCount' => $dislikeCount
    );

    echo json_encode($response);
}
?>
