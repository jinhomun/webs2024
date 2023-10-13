<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    // include "../connect/connect.php";
    // include "../connect/session.php";

    // $boradTitle = $_POST['boradTitle'];
    // $boardContents = $_POST['boardContents'];
    // $boardView = 1;
    // $regTime = time();
    // $memberID = $_SESSION['memberID'];

    // // echo $boradTitle, $boardContents, $memberID;

    // // 세션을 통해 사용자가 로그인되어 있는지 확인
    // if(!isset($_SESSION['memberID'])){
    //     echo "<script>alert('로그인 후에 게시글을 작성할 수 있습니다.');</script>";
    //     echo "<script>window.history.back()</script>";
    // } else {
    //     $boradTitle = $connect -> real_escape_string($boradTitle);
    //     $boardContents = $connect -> real_escape_string($boardContents);

    //     $sql = "INSERT INTO board(memberID, boardTitle, boardContents, boardView, regTime) VALUES('$memberID', '$boradTitle', '$boardContents', '$boardView', '$regTime')";
    //     $connect -> query($sql);

    //     echo "<script>alert('게시글이 성공적으로 작성되었습니다.');</script>";
    //     echo '<script>window.location.href = "board.php";</script>';
    // }
?>

<?php
    include "../connect/connect.php";
    $sql = "SELECT b.boardID, b.boardTitle, m.youName, b.regTime, b.boardView FROM board b JOIN members m ON(b.memberID = m.memberID) ORDER BY boardID DESC";

    for($i=1; $i<=300; $i++){
        $regTime = time();

        $sql = "INSERT INTO board(memberID, boardTitle, boardContents, boardView, regTime) VALUES('10', '게시판 타이틀${i}입니다.', '게시판 컨텐츠${i}입니다. 게시판 컨텐츠${i}입니다. 게시판 컨텐츠${i}입니다. 게시판 컨텐츠${i}입니다.', '1', '$regTime')";
        $connect -> query($sql);
    }
?>
</body>
</html>