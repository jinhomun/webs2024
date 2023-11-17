<?php
include "../connect/connect.php";
include "../connect/session.php";

if (isset($_SESSION['memberId'])) {
    $memberId = $_SESSION['memberId'];
} else {
    $memberId = 0;
}

if (isset($_POST['introId'])) {
    $introId = $_POST['introId'];
} else {
    echo json_encode(array("error" => "학교 정보를 찾을 수 없습니다."));
    exit;
}

$youId = $_SESSION['youId'];
$commentName = $youId;
$commentWrite = $_POST['msg'];
$regTime = time();

// 2. introId에 해당하는 유효한 학교 정보인지 확인
$introIdSql = "SELECT introId FROM Intro WHERE introId = ?";
$introIdStatement = $connect->prepare($introIdSql);
$introIdStatement->bind_param("s", $introId);
$introIdStatement->execute();
$introIdResult = $introIdStatement->get_result();

if ($introIdResult->num_rows === 0) {
    echo json_encode(array("error" => "유효한 학교 정보를 찾을 수 없습니다."));
    exit;
}

// 쿼리 생성 및 실행
$sql = "INSERT INTO IntroComment (memberId, introId, commentName, commentLike, commentMsg, commentDelete, regTime) VALUES (?, ?, ?, 0, ?, '1', ?)";
$statement = $connect->prepare($sql);
$statement->bind_param("isssi", $memberId, $introId, $commentName, $commentWrite, $regTime);
$result = $statement->execute();

if ($result) {
    echo json_encode(array("info" => $introId), JSON_UNESCAPED_UNICODE);
} else {
    echo json_encode(array("error" => "댓글 작성 중 오류가 발생했습니다."));
}
?>