<?php
include "../connect/connect.php";
include "../connect/session.php";

if (isset($_GET['boardId'])) {
    $boardId = $_GET['boardId'];

    // 게시글 복구
    $sql = "UPDATE Community SET deleted = 0 WHERE boardId = $boardId";
    $result = $connect->query($sql);

    if ($result) {
        echo "<script>alert('게시글이 복구되었습니다.');</script>";
    } else {
        echo "<script>alert('게시글 복구에 실패했습니다.');</script>";
    }
}

// 게시글 목록 페이지로 리다이렉트
echo "<script>location.href = 'cummunity.php';</script>";
?>