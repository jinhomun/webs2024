<header id="header" role="banner">
        <div class="header__inner container">
            <div class="left">
                <a href="../index.html">
                    <span class="blind">메인으로</span>
                </a>
            </div>
            <div class="logo">
                <a href="../main/main.php"> Debeloper Blog</a>
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
                <li><a href="../blog/blogCate.php?category=최신정보">최신 정보</a></li>
                <li><a href="../blog/blogCate.php?category=해외축구정보">해외축구 정보</a></li>
                <li><a href="../blog/blogCate.php?category=국내축구정보">국내축구 정보</a></li>
                <li><a href="../board/board.php">게시판</a></li>
            </ul>
        </nav>
</header>