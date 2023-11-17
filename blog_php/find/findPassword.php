<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Go!교복</title>

    <link rel="stylesheet" href="../assets/css/login.css">

    <!-- CSS -->
    <?php include "../include/head.php"; ?>
    <style>
    .join__form form {
        display: flex;
    }

    .joinEnd__inner p em {
        font-weight: 500;
        color: #000;
    }

    .joinEnd__inner>p {
        margin-top: 20px;
    }
    </style>
</head>

<body>
    <?php include "../include/skip.php"; ?>
    <!-- //skip -->

    <?php include "../include/header.php"; ?>
    <!-- //header -->

    <main id="main" role="main">

        <section class="joinEnd__inner join__inner container">
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // 사용자로부터 입력 받은 아이디와 연락처
                $youId = $_POST["youId"];
                $youPhone = $_POST["youPhone"];

                // 데이터베이스 연결 및 쿼리 실행
                include "../connect/connect.php"; // 데이터베이스 연결 파일
                $sql = "SELECT youPass, youName FROM blog_myMembers WHERE youId = '$youId' AND youPhone = '$youPhone'";
                $result = $connect->query($sql);

                if ($result) {
                    $row = $result->fetch_assoc();
                    if ($row) {
                        $foundPassword = $row["youPass"];
                        $youName = $row["youName"]; // Retrieve the member's name
                        // 비밀번호 중간 일부를 가려주기
                        $length = strlen($foundPassword);
                        $visibleCharacters = 4; // 표시할 글자 수 (예: 4)
                        $hiddenCharacters = $length - $visibleCharacters;
                        $startVisible = 1; // 시작 글자
                        $endVisible = $startVisible + $visibleCharacters - 1;
                        $maskedPassword = substr($foundPassword, 0, $startVisible) .
                            str_repeat('*', $hiddenCharacters) .
                            substr($foundPassword, $endVisible);
                    } else {
                        // Display a message if the information is not found
                        ?>
            <img class="ico_join fail_x" src="../assets/img/x_mark.png" alt="check">
            <h2>비밀번호 찾기 실패</h2>
            <p>😅 일치하는 정보를 찾을 수 없습니다. 다시 한번 확인해주세요!</p>
            <div class="join__form">
                <form action="#" name="#" method="post">
                    <a href="../find/findPass.php" class="joinEnd__btn__style1">다시찾기</a>
                    <a href="../login/login.php" class="joinEnd__btn__style2">로그인</a>
                </form>
            </div>
            <?php
                    }
                } else {
                    echo "쿼리 실행 오류: " . $connect->error;
                }

                // 데이터베이스 연결 종료
                $connect->close();
            }
            ?>



            <?php if (isset($maskedPassword)) { ?>
            <img class="ico_join" src="../assets/img/check.png" alt="check">
            <h2>비밀번호 찾기 완료</h2>
            <p>😎 <em>
                    <?php echo $youName; ?>
                </em> 님의 비밀번호는 <em style="color: #1976DE;">
                    <?php echo $maskedPassword; ?>
                </em> 입니다.</p>
            <div class="join__form">
                <form action="#" name="#" method="post">
                    <a href="../login/login.php" class="joinEnd__btn__style1">로그인</a>
                    <a href="../main/main.php" class="joinEnd__btn__style2">메인으로</a>
                </form>
            </div>
            <?php } ?>
        </section>
    </main>
    <!-- //main -->

    <?php include "../include/footer.php"; ?>
    <!-- //footer -->
</body>

</html>