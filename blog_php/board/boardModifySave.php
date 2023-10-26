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

    $boardId = $_POST['boardId'];
    $boardTitle = $_POST['boardTitle'];
    $boardContents = $_POST['boardContents'];
    $boardPass = $_POST['boardPass'];
    $memberId = $_SESSION['memberId'];

    // echo $boardID, $boardTitle, $boardContents, $boardPass, $memberID;

    $boardTitle = $connect -> real_escape_string($boardTitle);
    $boardContents = $connect -> real_escape_string($boardContents);
    $boardPass = $connect -> real_escape_string($boardPass);

    $sql = "SELECT * FROM blog_myMembers WHERE memberId = {$memberId}";
    $result = $connect -> query($sql);

    if($result){
        $info = $result -> fetch_array(MYSQLI_ASSOC);

        if($info['memberId'] === $memberId && $info['youPass'] === $boardPass){
            //수정
            $sql = "UPDATE Community SET boardTitle = '{$boardTitle}', boardContents = '{$boardContents}' WHERE boardId = '{$boardId}'";
            $connect -> query($sql);
            echo "<script>alert('게시글이 성공적으로 수정되었습니다.')</script>";
            echo '<script>window.location.href = "community.php";</script>';
        } else {
            echo "<script>alert('비밀번호가 틀렸습니다. 다시 한번 확인해주세요!')</script>";
            echo "<script>window.history.back()</script>";
        }
    } else {
        echo "<script>alert('관리자에게 문의하세요!')</script>";
    }
?>
</body>
</html>