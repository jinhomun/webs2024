User
<?php
include "../connect/connect.php";
include "../connect/session.php";

// 회원 정보 삭제
$memberId = $_SESSION['memberId'];
$deleteUserSql = "DELETE FROM blog_myMembers WHERE memberId = '$memberId'";
$connect->query($deleteUserSql);

// 트랜잭션 커밋
$connect->query("COMMIT");

// 회원 정보 삭제 후 리다이렉션 등의 추가 작업을 수행할 수 있습니다.

unset($_SESSION['memberId']);
unset($_SESSION['youId']);
unset($_SESSION['youName']);

Header("Location: mypageLeaveEnd.php");
?>