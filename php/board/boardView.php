<?php
    include "../connect/connect.php";
    include "../connect/session.php";    
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP 블로그 만들기</title>

    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="gray"> 
    <div id="skip">
    <a href="#header">헤더 영역 바로가기</a>
    <a href="#main">콘텐츠 영역 바로가기</a>
    <a href="#footer">푸터 영역 바로가기</a>
</div>    <!-- //skip -->

    <header id="header" role="banner">
    <div class="header__inner container">
        <div class="left">
            <a href="../index.html">
                <span class="blind">메인으로</span>
            </a>
        </div>
        <div class="logo">
            <a href="../main/main.php">Developer Blog</a>
        </div>
        <div class="right">
            <?php if(isset($_SESSION['memberID'])){ ?>
                <ul>
                    <li><a href="#"><?=$_SESSION['youName']?>님 환영합니다.</a></li>
                    <li><a href="../login/logout.php">로그아웃</a></li>
                </ul>
            <?php }else { ?>
                <ul>
                    <li><a href="../join/join.php">회원가입</a></li>
                </ul>
            <?php } ?>
        </div>
    </div>
    <nav class="nav__inner">
        <ul>
            <li><a href="../join/join.php">회원가입</a></li>
            <li><a href="../login/login.php">로그인</a></li>
            <li><a href="../board/board.php">게시판</a></li>
            <li><a href="../blog/blog.php">블로그</a></li>
        </ul>
    </nav>
</header>    <!-- //header -->

    <main id="main" role="main">
        <div class="intro__inner bmStyle container">
        <div class="intro__img">
                <img srcset="../assets/img/intro04-min.jpg 1x, ../assets/img/intro04@2x-min.jpg 2x, ../assets/img/intro04@3x-min.jpg 3x"  alt="소개 이미지">
            </div>
            <div class="intro__text">
                <h2>게시판</h2>
                <p>
                    웹디자이너, 웹 퍼블리셔, 프론트앤드 개발자를 위한 게시판입니다.<br>관련된 문의사항은 여기서 확인하세요!
                </p>
            </div>
        </div>
        <section class="board__inner container">
        <div class="board__view">
                <table>
                    <colgroup>
                        <col style="width: 20%;">
                        <col style="width: 80%;">
                    </colgroup>
                    <tbody>
<?php
    $boardID = $_GET['boardID'];

    // 보도 뷰 + 1
    $sql = "UPDATE board SET boardView = boardView + 1 WHERE boardID = {$boardID}";
    $connect -> query($sql);

    $sql = "SELECT b.boardTitle, m.youName, b.regTime, b.boardView, b.boardContents FROM board b JOIN members m ON(b.memberID = m.memberID) WHERE b.boardID = {$boardID}";
    $result = $connect -> query($sql);

    if($result){
        $info = $result -> fetch_array(MYSQLI_ASSOC);

        echo "<tr><th>제목</th><td>".$info['boardTitle']."</td></tr>";
        echo "<tr><th>등록자</th><td>".$info['youName']."</td></tr>";
        echo "<tr><th>등록일</th><td>".date('Y-m-d', $info['regTime'])."</td></tr>";
        echo "<tr><th>조회수</th><td>".$info['boardView']."</td></tr>";
        echo "<tr><th>내용</th><td>".$info['boardContents']."</td></tr>";
    }
?>
                        <!-- <tr>
                            <th>제목</th>
                            <td></td>
                        </tr>
                        <tr>
                            <th>등록자</th>
                            <td></td>
                        </tr>
                        <tr>
                            <th>등록일</th>
                            <td></td>
                        </tr>
                        <tr>
                            <th>조회수</th>
                            <td></td>
                        </tr>
                        <tr>
                            <th>내용</th>
                            <td>
                              
                            </td>
                        </tr> -->
                    </tbody>
                </table>
            </div>
            <div class="board__btns">
                <a href="boardModify.php?boardID=<?=$_GET['boardID']?>" class="btn__style3 mr10">수정하기</a>
                <a href="boardRemove.php?boardID=<?=$_GET['boardID']?>" class="btn__style3 mr10" onclick="return confirm('정말 삭제하시겠습니까?')">삭제하기</a>
                <a href="board.php" class="btn__style3">목록보기</a>
            </div>      
        </section>
    </main>
    <!-- //main -->

    <footer id="footer" role="contentinfo">
    <div class="footer__inner container btStyle">
        <div>Copyright 2023 webstoryboy</div>
        <div>blog by webs</div>
    </div>
</footer>    
<!-- //foter -->
</body>
</html>
