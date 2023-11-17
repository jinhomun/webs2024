<?php
    include "../connect/connect.php";
    include "../connect/session.php";
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Go!교복</title>
    
    <link rel="stylesheet" href="../assets/css/login.css">
    <link rel="stylesheet" href="../assets/css/mypage.css">
    <style>
        .mypage__inner {
            padding: 5rem 0;
            min-height: 90vh;
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
    <!-- CSS -->
    <?php include "../include/head.php" ?>

</head>
<body>
    <?php include "../include/skip.php" ?>
    <!-- //skip -->

    <?php include "../include/header.php" ?>
    
    <main id="main">
        <?php include "../mypage/mypageAside.php" ?>
        <section class="join__inner join__join mypage__inner container">
            <h2>비밀번호 변경</h2>
            <p>😎 새로운 비밀번호를 입력해주세요.</p>
            <div class="join__form join__form__cont">
                <form action="joinEnd.php" name="joinEnd" method="post" onsubmit="return joinChecks();">
                    <div class="check_input">
                        <label for="youPass" class="required">비밀번호</label>
                        <input type="password" id="youPass" name="youPass" placeholder="비밀번호를 적어주세요!" class="input__style">  
                        <p class="msg" id="youPassComment"></p>
                    </div>
                    <div class="check_input">
                        <label for="youPassC" class="required">비밀번호 확인</label>
                        <input type="password" id="youPassC" name="youPassC" placeholder="다시 한번 비밀번호를 적어주세요!" class="input__style">
                        <p class="msg" id="youPassCComment"></p>
                    </div>

                    <button type="submit" class="btn__style mt100 join_result_btn" style="color: #fff;">변경하기</button>
                </form>
            </div>
        </section>
    </main>
    <!-- //main -->

    <?php include "../include/footer.php" ?>
    <!-- //footer -->
</body>
</html>