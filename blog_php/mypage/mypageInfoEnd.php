<?php
include "../connect/connect.php";
include "../connect/session.php";

$youId = $_SESSION['youId'];
// $youId = mysqli_real_escape_string($connect, $_POST['youId']);
$youName = mysqli_real_escape_string($connect, $_POST['youName']);
$youEmail = mysqli_real_escape_string($connect, $_POST['youEmail']);
$youPass = mysqli_real_escape_string($connect, $_POST['youPass']);
$youAddress2 = mysqli_real_escape_string($connect, $_POST['youAddress2']);
$youAddress3 = mysqli_real_escape_string($connect, $_POST['youAddress3']);
$youAddress = $youAddress2 . ' ' . $youAddress3;
$youPhone = mysqli_real_escape_string($connect, $_POST['youPhone']);
$youRegTime = time();

$sql = "UPDATE blog_myMembers
        SET youName = '$youName', youAddress = '$youAddress', youPhone = '$youPhone', youRegTime = '$youRegTime'
        WHERE youId = '$youId'";
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
    <link rel="stylesheet" href="../assets/css/mypage.css">

    <!-- CSS -->
    <?php include "../include/head.php" ?>
    <style>
        .joinEnd__inner.mypage__inner {
            padding: 13rem 0 !important;
        }

        .join__form form {
            display: flex;
            justify-content: center;
        }

        aside.mypage__aside {
            display: block;
        }

        @media only screen and (max-width: 768px) {
            aside.mypage__aside {
                display: none;
            }

            .mypage__inner h2 {
                font-size: 2rem;
            }

            .mypage__inner>p {
                width: 90%;
                margin: 0 auto;
            }
        }
    </style>
</head>

<body>
    <?php include "../include/skip.php" ?>
    <!-- //skip -->

    <?php include "../include/header.php" ?>
    <!-- //header -->


    <main id="main" role="main">
        <?php include "../mypage/mypageAside.php" ?>
        <section class="joinEnd__inner join__inner mypage__inner container">

            <img class="ico_join" src="../assets/img/check.png" alt="check">

            <h2>회원님의 정보 변경이 완료되었습니다.</h2>
            <p>🥳 정보 변경 확인을 위해 로그아웃 후, 재 로그인 해주세요!</p>
            <div class="join__form">
                <form action="#" name="#" method="post">
                    <a href="../login/logout.php" class="joinEnd__btn__style1">로그아웃</a>
                    <!-- <a href="../main/main.php" class="joinEnd__btn__style2">메인으로</a> -->
                </form>
            </div>
        </section>
    </main>
    <!-- //main -->

    <?php include "../include/footer.php" ?>
    <!-- //footer -->
</body>

</html>