<?php
// Include necessary database connection file
include "../connect/connect.php";
include "../connect/session.php";

if (isset($_POST['youPass'])) {
    $youPass = $_POST['youPass'];

    // 데이터베이스에서 해당 사용자의 해싱된 비밀번호를 가져옵니다.
    $memberId = $_SESSION['memberId'];

    $checkPasswordSql = "SELECT youPass FROM blog_myMembers WHERE memberId = '$memberId'";
    $result = $connect->query($checkPasswordSql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $storedPassword = $row['youPass'];

        // 해싱된 비밀번호와 사용자가 입력한 비밀번호를 비교합니다.
        if (password_verify($youPass, $storedPassword)) {
            echo json_encode(array("result" => "good"));
        } else {
            echo json_encode(array("result" => "bad"));
        }
    } else {
        echo json_encode(array("result" => "bad"));
    }
} else {
    echo json_encode(array("result" => "bad"));
}
?>