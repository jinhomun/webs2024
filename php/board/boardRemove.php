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
include "../connect/sessionCheck.php";

$boardID = $_GET['boardID'];
$memberID = $_GET['memberID'];

if (isset($_SESSION['memberID'])) {
    // 게시글 소유자 확인
    $sql = "SELECT memberID FROM board WHERE boardID = {$boardID}";
    $result = $connect->query($sql);

    if ($result) {
        $info = $result->fetch_array(MYSQLI_ASSOC);
        $boardOwnerID = $info['memberID'];

        // 로그인 ID와 게시글 소유자 ID 일치 여부 확인
        if ($memberID == $boardOwnerID) {
            $sql = "DELETE FROM board WHERE boardID = {$boardID}";
            $connect->query($sql);
            echo "<script>alert('게시글이 삭제되었습니다.');</script>";
        } else {
            echo "<script>alert('게시글 소유자만 삭제할 수 있습니다.');</script>";
        }
    } else {
        echo "<script>alert('관리자에게 문의해주세요!');</script>";
    }
} else {
    echo "<script>alert('로그인을 해주세요!');</script>";
}

?>

    <script>
    location.href = "board.php";
    </script>

</body>

</html>