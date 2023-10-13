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
    <title>PHP 블로그 만들기</title>

    <!-- CSS -->
    <?php include "../include/head.php" ?>
</head>
<body class="gray"> 
    <?php include "../include/skip.php" ?>
    <!-- //skip -->

    <?php include "../include/header.php" ?>
    <!-- //header -->

    <main id="main" role="main">
        <div class="intro__inner bmStyle container">
            <div class="intro__img small">
                <img srcset="../assets/img/intro04-min.jpg 1x,../assets/img/intro04@2x-min.jpg 2x ,../assets/img/intro04@3x-min.jpg 3x " alt="소개 이미지">
            </div>
            <div class="intro__text">
                <h2>게시글 작성하기</h2>
                <p>
                    웹디자이너, 웹 퍼블리셔, 프론트엔트 개발자를 위한 게시판입니다.<br>게시글 작성은 여기서 작성하세요!
                </p>
            </div>
        </div>
        <section class="board__inner container" >
                <div class="board__write">
                    <form action="boardWriteSave.php" name="boardWriteSave" method="post">
                        <fieldset>
                            <legend class="blind">게시글 작성하기</legend>
                            <div>
                                <label for="boardTitle">제목</label>
                                <input type="text" id="boardTitle" name="boardTitle" class="input__style">
                            </div>
                            <div>
                                <label for="boardContents">내용</label>
                                <textarea name="boardContents" id="boardContents" rows="20" class="input__style"></textarea>
                            </div>
                            <div class="board__btns">
                                <button type="sumit" class="btn__style3">저장하기</button>
                            </div>
                        </fieldset>
                    </form>
                </div>
        </section>
    </main>
    <!-- //main -->

    <?php include "../include/footer.php" ?>
    <!-- //foter -->
</body>
</html>