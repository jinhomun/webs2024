<?php
include "../connect/connect.php";
include "../connect/session.php";

$youId = mysqli_real_escape_string($connect, $_POST['youId']);
$youName = mysqli_real_escape_string($connect, $_POST['youName']);
$youEmail = mysqli_real_escape_string($connect, $_POST['youEmail']);
$youPass = mysqli_real_escape_string($connect, $_POST['youPass']);
$youAddress2 = mysqli_real_escape_string($connect, $_POST['youAddress2']);
$youAddress3 = mysqli_real_escape_string($connect, $_POST['youAddress3']);
$youAddress = $youAddress2 . ' ' . $youAddress3;
$youPhone = mysqli_real_escape_string($connect, $_POST['youPhone']);
$youRegTime = time();

$sql = "INSERT INTO blog_myMembers(youId, youName, youEmail, youPass, youAddress, youPhone, youRegTime) VALUES('$youId', '$youName', '$youEmail', '$youPass', '$youAddress', '$youPhone', '$youRegTime')";
$connect->query($sql);

// 데이터 베이스 연결 닫기
mysqli_close($connect);
?>


<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Go!교복</title>

    <link rel="stylesheet" href="../assets/css/login.css">

    <!-- CSS -->
    <?php include "../include/head.php" ?>
    <style>
        .join__form form {
            display: flex;
        }
    </style>
</head>

<body>
    <?php include "../include/skip.php" ?>
    <!-- //skip -->

    <?php include "../include/header.php" ?>
    <!-- //header -->


    <main id="main" role="main">

        <section class="joinEnd__inner join__inner container">

            <img class="ico_join" src="../assets/img/check.png" alt="check">

            <h2>회원가입을 환영합니다.</h2>
            <p>🥳 로그인하고 Go교복!의 다양한 컨텐츠를 경험하세요!</p>
            <div class="join__form">
                <form action="#" name="#" method="post">
                    <a href="../login/login.php" class="joinEnd__btn__style1">로그인</a>
                    <a href="../main/main.php" class="joinEnd__btn__style2">메인으로</a>
                </form>
            </div>
        </section>
    </main>
    <!-- //main -->

    <?php include "../include/footer.php" ?>
    <!-- //footer -->
</body>

</html>