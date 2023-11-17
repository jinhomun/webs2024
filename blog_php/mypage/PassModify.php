<?php
// 데이터베이스 연결 설정
include "../connect/connect.php";
include "../connect/session.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 폼에서 제출된 현재 비밀번호와 새로운 비밀번호 가져오기
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];

    // 현재 로그인된 사용자의 아이디 가져오기 (세션을 통해 또는 사용자의 로그인 상태를 확인하여)
    $memberId = $_SESSION['memberId'];

    // 현재 비밀번호가 맞는지 확인
    $checkPasswordSql = "SELECT youPass FROM blog_myMembers WHERE memberId = '$memberId'";
    $result = $connect->query($checkPasswordSql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $currentPasswordFromDB = $row['youPass'];

        // 현재 비밀번호와 데이터베이스에 저장된 비밀번호 비교
        if ($currentPassword === $currentPasswordFromDB) {
            // 새 비밀번호 유효성 검사
            $newPasswordNum = preg_match("/[0-9]/", $newPassword);
            $newPasswordEng = preg_match("/[a-zA-Z]/", $newPassword);
            $newPasswordSpe = preg_match("/[!@#$%^&*()\-_=+{};:,<.>ยท~]/", $newPassword);

            if (strlen($newPassword) < 8 || strlen($newPassword) > 20 || !$newPasswordNum || !$newPasswordEng || !$newPasswordSpe) {
                echo "<script>alert('비밀번호는 8-20자리이어야 하며, 영문, 숫자, 특수문자를 혼합하여 입력해야 합니다.'); window.location = 'mypagePass.php';</script>";
            } else {
                // 현재 비밀번호가 일치하면 새 비밀번호를 데이터베이스에 업데이트
                $updatePasswordSql = "UPDATE blog_myMembers SET youPass = '$newPassword' WHERE memberId = '$memberId'";
                if ($connect->query($updatePasswordSql)) {
                    // 비밀번호 변경 완료 후 사용자를 다른 페이지로 리디렉션하거나 메시지를 표시할 수 있습니다.
                    echo "<script>window.location = 'mypagePassEnd.php';</script>";
                } else {
                    echo "비밀번호 변경 중 오류가 발생했습니다: " . $connect->error;
                }
            }
        } else {
            echo "<script>alert('현재 비밀번호가 올바르지 않습니다.'); window.location = 'mypagePass.php';</script>";
        }
    } else {
        echo "<script>alert('사용자를 찾을 수 없습니다.'); window.location = 'mypagePass.php';</script>";
    }
}
?>