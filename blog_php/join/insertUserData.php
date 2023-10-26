<!-- <?php
include "../connect/connect.php";

// 사용자가 입력한 데이터 수신
$youId = $connect->real_escape_string(trim($_POST['youId']));
$youName = $connect->real_escape_string(trim($_POST['youName']));
$youEmail = $connect->real_escape_string(trim($_POST['youEmail']));
$youPass = $connect->real_escape_string(trim($_POST['youPass']));
$regTime = time();

// 필요한 유효성 검사를 수행
if (empty($youId) || empty($youName) || empty($youEmail) || empty($youPass)) {
    echo json_encode(array("result" => "error", "message" => "모든 필수 정보를 입력해주세요"));
} else {
    // 데이터베이스에 사용자 데이터 삽입
    $sql = "INSERT INTO blog_myMembers (youId, youName, youEmail, youPass, regTime) VALUES ('$youId', '$youName', '$youEmail', '$youPass', '$regTime')";
    if ($connect->query($sql)) {
        echo json_encode(array("result" => "success"));
    } else {
        echo json_encode(array("result" => "error", "message" => "에러 발생: 관리자에게 문의하세요"));
    }
}
?>
 -->

<?php
    include "../connect/connect.php";
    include "../connect/session.php";

    $youId = mysqli_real_escape_string($connect, $_POST['youId']);
    $youName = mysqli_real_escape_string($connect, $_POST['youName']);
    $youEmail = mysqli_real_escape_string($connect, $_POST['youEmail']);
    $youPass = mysqli_real_escape_string($connect, $_POST['youPass']);
    $youPhone = mysqli_real_escape_string($connect, $_POST['youPhone']);
    $youRegTime = time();

    $sql = "INSERT INTO blog_myMembers(youId, youName, youEmail, youPass, youPhone, youRegTime) VALUES('$youId', '$youName', '$youEmail', '$youPass', '$youPhone', '$youRegTime')"
    $connect -> query($sql);

    // 데이터 베이스 연결 닫기
    mysqli_close($connect);
?>