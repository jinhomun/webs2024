<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    include "../connect/connect.php";
    include "../connect/session.php";

    $boardTitle = $_POST['boardTitle']; // 변수 이름 수정
    $boardContents = $_POST['boardContents'];
    $boardView = 1;
    $boardLike = 0;
    $regTime = time();
    $memberId = $_SESSION['memberId'];

    // 세션을 통해 사용자가 로그인되어 있는지 확인
    if (!isset($_SESSION['memberId'])) {
        echo "<script>alert('로그인 후에 게시글을 작성할 수 있습니다.');</script>";
        echo "<script>window.history.back()</script>";
    } else {
        $boardTitle = $connect->real_escape_string($boardTitle); // 변수 이름 수정
        $boardContents = $connect->real_escape_string($boardContents);

        $sql = "INSERT INTO Community(memberId, boardTitle, boardContents, boardView, boardLike , regTime) VALUES('$memberId', '$boardTitle', '$boardContents', '$boardView','$boardLike', '$regTime')"; // 테이블 이름 수정
        $connect->query($sql);

        echo "<script>alert('게시글이 성공적으로 작성되었습니다.');</script>";
        echo '<script>window.location.href = "community.php";</script>';
    }
?>
</body>
</html>