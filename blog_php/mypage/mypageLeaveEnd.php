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
        .join__form form { 
            display: flex;
        }
        .joinEnd__inner.mypage__inner {
            padding: 13rem 0 !important;
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
            .mypage__inner > p {
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

            <h2>회원 탈퇴가 완료되었습니다.</h2>
            <p>우리와 함께했던 모든 순간을 기억하며, 언젠가 다시 만날 날을 기대하겠습니다.</p>
            <div class="join__form">
                <form action="#" name="#" method="post">
                    <a href="../join/join.php" class="joinEnd__btn__style1">회원가입</a>
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
