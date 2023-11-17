<?php
include "../connect/connect.php"; // 데이터베이스 연결 설정 파일

// introId를 POST 데이터로 받아옴
$introId = isset($_POST['introId']) ? $_POST['introId'] : '';

// introId에 해당하는 정보를 데이터베이스에서 가져옴
$sql = "SELECT commentCount FROM IntroComment WHERE introId = ?";
$statement = $connect->prepare($sql);
$statement->bind_param("s", $introId);
$statement->execute();
$result = $statement->get_result();

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    $commentCount = $row['commentCount'];

    // 결과를 JSON 형식으로 반환
    echo json_encode(array("commentCount" => $commentCount));
} else {
    // 결과가 없는 경우 JSON으로 반환
    echo json_encode(array("commentCount" => 0));
}
?>