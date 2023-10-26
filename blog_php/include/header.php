<header id="header">
    <div class="header_wrap">
        <h1 class="logo">
            <a href="../main/main.php"><img src="../assets/img/logo.png" alt=""></a>
        </h1>
        <nav>
            <ul>
                <li><a href="../introduce/introduce.php">교복소개</a></li>
                <li><a href="../ranking/ranking.php">인기순위</a></li>
                <li><a href="../board/community.php">수다방</a></li>

                <?php if(isset($_SESSION['memberId'])){ ?>
                    <li class="login_head">
                        <em><?=$_SESSION['youName']?></em>&nbsp;님 환영합니다!
                        <a href="../login/logout.php"><img src="../assets/img/logout_btn.png"></a>
                    </li>
                <?php } else { ?>
                    <li><a href="../login/login.php">LOGIN</a></li>
                    <li><a href="../join/join.php">JOIN</a></li>
                <?php } ?>   

                
            </ul>
        </nav>    
        <div class="m_menu">
            <a class="menu-trigger" href="#">
                <span></span>
                <span></span>
                <span></span>
            </a>
        </div>
    </div>
</header>