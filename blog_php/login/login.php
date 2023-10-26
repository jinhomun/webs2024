<?php
    include "../connect/connect.php";
    include "../connect/session.php";

    // echo "<pre>";
    // var_dump($_SESSION);
    // echo "</pre>";
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

</head>
<body>
    <?php include "../include/skip.php" ?>
    <!-- //skip -->

    <?php include "../include/header.php" ?>
    <!-- //header -->


    <main id="main" role="main">

        <section class="join__inner container">
            <h2>로그인</h2>
            <p>🥳 로그인하고 Go교복!의 다양한 컨텐츠를 경험하세요!</p>
            <div class="join__form login__form">
                <form action="loginSave.php" name="loginSave" method="post">
                    <div class="check_input">
                        <label for="youId" class="required">아이디</label>
                        <input type="text" id="youId" name="youId" class="input__style" placeholder="아이디를 입력해주세요." required>
                    </div>
                    <div class="check_input">
                        <label for="youPass" class="required">비밀번호</label>
                        <input type="password" id="youPass" name="youPass" class="input__style" autocomplete="off" placeholder="비밀번호를 입력해주세요." required>
                    </div>

                    <div class="join__login">
                        <p>계정이 없으신가요? &nbsp;<a href="../join/join.php">회원가입</a></p>
                        <div class="find">
                            <a href="../find/findId.php">아이디 찾기</a>
                            &nbsp;|&nbsp;
                            <a href="../find/findPass.php">비밀번호 찾기</a>
                        </div>
                    </div>
                    <button type="submit" class="btn__style mt100">로그인</button>
                </form>
            </div>
        </section>
    </main>

    <?php include "../include/footer.php" ?>
    <!-- //footer -->
</body>
</html>