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
            <h2>비밀번호 찾기</h2>
            <p>😎 아이디와 연락처를 입력하시면, 비밀번호를 재설정 할 수 있습니다!</p>
            <div class="join__form login__form">
                <form action="findPassword.php" method="post">
                    <div  class="check_input">
                        <label for="youId">아이디</label>
                        <input type="text" id="youId" name="youId" placeholder="아이디를 적어주세요!" class="input__style">
                        <p class="msg" id="youIdComment"></p>
                    </div>
                    <div  class="check_input">
                        <label for="youPhone">연락처</label>
                        <input type="text" id="youPhone" name="youPhone" placeholder="연락처를 적어주세요!" class="input__style">
                        <p class="msg" id="youPhoneComment"></p>
                    </div>

                    <div class="join__login">
                        <p>계정이 없으신가요? &nbsp;<a href="../join/join.php">회원가입</a></p>
                        <div class="find">
                            <a href="findId.php">아이디 찾기</a>
                            &nbsp;|&nbsp;
                            <a href="findPass.php">비밀번호 찾기</a>
                        </div>
                    </div>

                    <button type="submit" class="btn__style mt100">비밀번호 찾기</button>
                </form>
            </div>
        </section>
    </main>

    <?php include "../include/footer.php" ?>
    <!-- //footer -->
</body>
</html>