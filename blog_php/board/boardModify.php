<?php
    include "../connect/connect.php";
    include "../connect/session.php";
    include "../connect/sessionCheck.php";
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
            <h2>수다방 글 수정하기</h2>
            <p>😊 여기서 게시글 수정해주세요!</p>
            <div class="board__form">
            <form action="boardModifySave.php?boardID=<?= $_GET['boardID']?>" name="boardModifySave.php" method="post">
<?php
    $boardId = $_GET['boardId'];

    $sql = "SELECT * FROM Community WHERE boardId = {$boardId}";
    $result = $connect -> query($sql);

    if($result){// 보드 아이디를 불러와 해당 테이블의 제목 내용을 보여준다.
        $info = $result -> fetch_array(MYSQLI_ASSOC);

        echo "<div style='display:none'><label for='boardId'>번호</label><input type='text' id='boardId' name='boardId' class='input__style' value='".$info['boardId']."'></div>";
        echo "<div><label for='boardTitle'>제목</label><input type='text' id='boardTitle' name='boardTitle' class='input__style' value='".$info['boardTitle']."'></div>";
        echo "<div><label for='boardContents'>내용</label><textarea id='boardContents' name='boardContents' rows='20' class='input__style'>".$info['boardContents']."</textarea></div>";
    }
?>
                    <div class="file">
                        <label for="boardFile" class="blind"></label>
                        <input type="file" id="boardFile" name="boardFile" accept=".jpg, .jpeg, .png, .gif, .webp">
                        <p>* jpg, gif, png, webp 파일만 넣을 수 있습니다. 이미지 용량은 1MB를 넘길 수 없습니다.</p>
                    </div>
                        
<?php
    $boardId = $_GET['boardId'];

    $sql = "SELECT * FROM Community WHERE boardId = {$boardId}";
    $result = $connect -> query($sql);

    if($result){// 보드 아이디를 불러와 해당 테이블의 제목 내용을 보여준다.
        $info = $result -> fetch_array(MYSQLI_ASSOC);
        echo "<div class='mt50'><label for='boardPass'></label><input type='password' id='boardPass' name='boardPass' class='input__style' autocomplete='off' placeholder='비밀번호를 입력해주세요' required></div>";
    }
?>
                        
                        <div class="board__btns">
                            <button type="Update" class="btn__style3 update-button">수정</button>
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