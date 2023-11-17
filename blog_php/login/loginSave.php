
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Go!교복</title>
    
    <link rel="stylesheet" href="../assets/css/login.css">
    <style>
        .joinEnd__inner form {
            display: flex;
        }
        .joinEnd__inner p {
            font-size: 1.5rem;
            font-size: 1.2rem;
            text-align: center;
            color: #555555;
            margin-top: 20px;
        }
        .joinEnd__inner h2 {
            font-size: 2.3rem;
            text-align: center;
            padding-top: 2rem;
        }

    </style>

    <!-- CSS -->
    <?php include "../include/head.php" ?>

</head>
<body>
    <?php include "../include/skip.php" ?>
    <!-- //skip -->

    <?php include "../include/header.php" ?>
    <!-- //header -->


    <main id="main" role="main">

        <section class="joinEnd__inner join__inner container">
            <img class="ico_join fail_x" src="../assets/img/x_mark.png" alt="check">
            <h2>로그인 실패</h2>
            <p>😅 아이디 또는 비밀번호가 틀렸습니다. 다시 한번 확인해주세요!</p>
            <div class="join__form">
                <form action="#" name="#" method="post">
                    <a href="../login/login.php" class="joinEnd__btn__style1">로그인</a>
                    <a href="../main/main.php" class="joinEnd__btn__style2">메인으로</a>
                </form>
            </div>
        </section>

<?php
        include "../connect/connect.php";
        include "../connect/session.php";

        $youId = $_POST['youId'];
        $youPass = $_POST['youPass'];

        // echo $youEmail, $youPass;

        // 메시지 출력  
        function msg($alert){
            echo "<p>$alert</p>";
        }

        // 데이터 조회
        // members 데이터 중에 이메일/비밀번호
        $sql = "SELECT memberId, youName, youId, youPass FROM blog_myMembers WHERE youId = '$youId' AND youPass = '$youPass'";
        $result = $connect -> query($sql);

        if($result){
            $count = $result -> num_rows;

            if($count == 0) {
                //msg("아이디 또는 비밀번호가 틀렸습니다. 다시 한번 확인해주세요!");
            } else {
                $memberInfo = $result -> fetch_array(MYSQLI_ASSOC);

                // echo"<pre>";
                // var_dump($memberInfo);
                // echo"</pre>";

                // 로그인 성공 --> 세션 생성
                $_SESSION['memberId'] = $memberInfo['memberId'];
                $_SESSION['youId'] = $memberInfo['youId'];
                $_SESSION['youName'] = $memberInfo['youName'];
                
                Header("location: ../main/main.php");
            }
        }
?>
    </main>

    <?php include "../include/footer.php" ?>
    <!-- //footer -->


</body>
</html>