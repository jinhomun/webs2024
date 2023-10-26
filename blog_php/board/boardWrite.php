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
    <link rel="stylesheet" href="../assets/css/modify.css">

    <link rel="stylesheet" href="../assets/css/common.css">
    <link rel="stylesheet" href="../assets/css/reset.css">
    <link rel="stylesheet" href="../assets/css/fonts.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Londrina+Solid:wght@400;900&display=swap" rel="stylesheet">
</head>
<body>
    <?php include "../include/header.php" ?>
        <!-- //header -->

    <main id="main" role="main">
        <section class="board__inner container">
            <h2>수다방 글 작성하기!</h2>
            <p>😊 여기서 게시글 작성해주세요!</p>
            <div class="board__form">
                <form action="boardWriteSave.php" name="boardWriteSave.php" method="post">
                    <div>
                        <label for="boardTitle"></label>
                        <input type="text" id="boardTitle" name="boardTitle" class="input__style" placeholder="제목을 입력해주세요.">
                    </div>
                    <div>
                        <label for="boardContents"></label>
                        <textarea name="boardContents" id="boardContents" rows="20" class="input__style"  placeholder="내용을 입력해주세요."></textarea>
                    </div>
                    <div class="file">
                        <label for="boardFile" class="blind"></label>
                        <input type="file" id="boardFile" name="boardFile" accept=".jpg, .jpeg, .png, .gif, .webp">
                        <p>* jpg, gif, png, webp 파일만 넣을 수 있습니다. 이미지 용량은 1MB를 넘길 수 없습니다.</p>
                    </div>
                        
                    <div class="board__btns">
                        <button type="update" class="btn__style3 update-button" onclick="confirmAndUpdate()">등록</button>
                    </div>
                </form>
            </div>
        </section>
    </main>
    <!-- //main -->

    <footer id="footer">
        <p>Copyright 2023 Gogyobok</p>
    </footer>

    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/common.js"></script>
</body>
</html>