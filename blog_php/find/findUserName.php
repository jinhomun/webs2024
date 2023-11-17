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
            $foundUsername = "";

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // 사용자로부터 입력 받은 연락처와 이름
                $youPhone = $_POST["youPhone"];
                $youName = $_POST["youName"];

                // 데이터베이스 연결 및 쿼리 실행
                include "../connect/connect.php"; // 데이터베이스 연결 파일
                $sql = "SELECT youId FROM blog_myMembers WHERE youPhone = '$youPhone' AND youName = '$youName'";
                $result = $connect->query($sql);

                if ($result) {
                    $row = $result->fetch_assoc();
                    if ($row) {
                        $foundUsername = $row["youId"];
                    }
                }

                // 데이터베이스 연결 종료
                $connect->close();
            }
            ?>
            <?php if (!empty($foundUsername)) { ?>
            <img class="ico_join" src="../assets/img/check.png" alt="check">
            <h2>아이디 찾기 완료</h2>
            <p>😎 <em>
                    <?php echo $youName; ?>
                </em> 님의 아이디는 <em style="color: #1976DE;">
                    <?php echo $foundUsername; ?>
                </em> 입니다.</p>
            <div class="join__form">
                <form action="#" name="#" method="post">
                    <a href="../login/login.php" class="joinEnd__btn__style1">로그인</a>
                    <a href="../main/main.php" class="joinEnd__btn__style2">메인으로</a>
                </form>
            </div>
            <?php } else { ?>
            <img class="ico_join fail_x" src="../assets/img/x_mark.png" alt="check">
            <h2>아이디 찾기 실패</h2>
            <p>😅 일치하는 정보를 찾을 수 없습니다. 다시 한번 확인해주세요!</p>
            <div class="join__form">
                <form action="#" name="#" method="post">
                    <a href="../find/findId.php" class="joinEnd__btn__style1">다시찾기</a>
                    <a href="../login/login.php" class="joinEnd__btn__style2">로그인</a>
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