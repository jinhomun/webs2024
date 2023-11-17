<?php
include "../connect/connect.php";

if (isset($_POST['introId'])) {
    $introId = $_POST['introId'];

    // $introId를 사용하여 데이터베이스에서 정보를 가져옴 (이 부분은 실제 데이터베이스 구조에 따라 다름)
    $sql = "SELECT COUNT(*) AS viewCount FROM IntroView WHERE introId = ?";
    $statement = $connect->prepare($sql);
    $statement->bind_param("s", $introId);
    $statement->execute();
    $result = $statement->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $ViewCount = $row['ViewCount'];
        echo $ViewCount; // 정보를 반환
    } else {
        echo '0'; // 결과가 없는 경우 기본값
    }
} else {
    echo '0'; // introId가 전달되지 않은 경우에도 기본값 반환
}
?>