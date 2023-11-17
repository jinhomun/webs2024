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

    <!-- CSS -->
    <?php include "../include/head.php" ?>
    <style>
    .file p {
        text-align: left;
        font-size: 14px;
        font-weight: 100;
        margin-bottom: 33px;
        margin-top: 5px;
    }
    </style>
</head>

<body>
    <?php include "../include/skip.php" ?>
    <!-- //skip -->
    ​
    <?php include "../include/header.php" ?>
    ​
    <main id="main" role="main">
        <section class="board__inner container">
            <h2>수다방 글 작성하기!</h2>
            <p>😊 여기서 게시글 작성해주세요!</p>
            <div class="board__form">
                <form action="boardWriteSave.php" name="boardWriteSave.php" method="post" enctype="multipart/form-data">
                    <div>
                        <label for="blogTitle"></label>
                        <input type="text" id="blogTitle" name="blogTitle" class="input__style"
                            placeholder="제목을 입력해주세요.">
                    </div>
                    <div>
                        <label for="blogContents"></label>
                        <textarea name="blogContents" id="blogContents" rows="20" class="input__style"
                            placeholder="내용을 입력해주세요."></textarea>
                    </div>
                    <div class="file">
                        <input type="file" id="blogFile" name="blogFile" class="input__style">
                        <p>* jpg, gif, png, webp 파일만 넣을 수 있습니다. 이미지 용량은 1MB를 넘길 수 없습니다.</p>
                    </div>
                    <!-- <div class="icon-container">
                        <div id="dropZone" class="drop-zone">
                            <button><img src="../assets/img/picture.svg" alt=""></button>
                            <p>드래그 파일 첨부</p>
                        </div>
                        <input type="file" id="fileUpload" accept="image/*" style="display: none;" multiple>
                        <p>* jpg, gif, png, webp 파일만 넣을 수 있습니다. 이미지 용량은 1MB를 넘길 수 없습니다.</p>
                    </div>  -->

                    <div class="board__btns">
                        <button type="submit" class="btn__style3 update-button" onclick="confirmAndUpdate()">등록</button>
                    </div>
                </form>
            </div>
        </section>
    </main>
    ​
    <?php include "../include/footer.php" ?>
    <!-- //footer -->

</body>

</html>