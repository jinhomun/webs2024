<?php
    include "../connect/connect.php";
    include "../connect/session.php";


    $youId = mysqli_real_escape_string($connect, $_POST['youId']);
    $youName = mysqli_real_escape_string($connect, $_POST['youName']);
    $youEmail = mysqli_real_escape_string($connect, $_POST['youEmail']);
    $youPass = mysqli_real_escape_string($connect, $_POST['youPass']);
    $youAddress1 = mysqli_real_escape_string($connect, $_POST['youAddress1']);
    $youAddress2 = mysqli_real_escape_string($connect, $_POST['youAddress2']);
    $youAddress3 = mysqli_real_escape_string($connect, $_POST['youAddress3']);
    $youPhone = mysqli_real_escape_string($connect, $_POST['youPhone']);
    $youRegTime = time();

    $sql = "INSERT INTO myMembers(youId, youName, youEmail, youPass, youAddress, youPhone, youRegTime) VALUES ('$youId', '$youName', '$youEmail', '$youPass', '$youAddress1 $youAddress2 $youAddress3', '$youPhone', '$youRegTime')";
    $connect -> query($sql);

    //데이터 베이스 연결 닫기
    mysqli_close($connect);
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>회원가입 페이지</title>

    <!-- CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="gray"> 
    <div id="skip">
        <a href="#header">헤더 영역 바로가기</a>
        <a href="#main">콘텐츠 영역 바로가기</a>
        <a href="#footer">푸터 영역 바로가기</a>
    </div>

    <header id="header" role="banner">
        <div class="header__inner container">
            <div class="left">
                <a href="../index.html">
                    <span class="blind">메인으로</span>
                </a>
            </div>
            <div class="logo">
                <a href="main.html">Developer Blog</a>
            </div>
            <div class="right">
                <ul>
                    <li><a href="../join/joinAgree.php">회원가입</a></li>
                </ul>
            </div>
        </div>
        <nav class="nav__inner">
            <ul>
                <li><a href="../join/joinAgree.php">회원가입</a></li>
                <li><a href="../login/login.php">로그인</a></li>
                <li><a href="../board/board.php">게시판</a></li>
                <li><a href="../blog/blog.php">블로그</a></li>
            </ul>
        </nav>
    </header>
    <!-- //header -->

    <main id="main" role="main">
        <div class="intro__inner bmStyle container">
            <div class="intro__img">
                <img srcset="../assets/img/intro02-min.jpg 1x, ../assets/img/intro02@2x-min.jpg 2x, ../assets/img/intro02@3x-min.jpg 3x"  alt="소개 이미지">
            </div>
            <!-- <div class="intro__text">
                회원가입을 해주시면 다양한 정보를 자유롭게 볼 수 있습니다. 
            </div> -->
        </div>
        <section class="join__inner container">
            <h2>회원가입 완료</h2>
            <div class="join__index">
                <ul>
                    <li>1</li>
                    <li>2</li>
                    <li class="active">3</li>
                </ul>
                <img src="../assets/img/result01.png" alt="축하이미지">
                <p>
                    회원가입을 축하드립니다. 환영합니다.<br>
                    로그인해주세요!
                </p>
                <button type="submit" class="btn__style mt100">로그인</button>
            </div>
        </section>
    </main>
    <!-- //main -->

    <footer id="footer" role="contentinfo">
        <div class="footer__inner container btStyle">
            <div>Copyright 2023 jinhomun</div>
            <div>blog by webs</div>
        </div>
    </footer>
    <!-- //foter -->
</body>
</html>