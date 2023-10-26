<?php
    include "../connect/connect.php";
    include "../connect/session.php";

    // 총 페이지 갯수
    $sql = "SELECT count(boardId) FROM Community";
    $result = $connect -> query($sql);
    
    $boardTotalCount = $result -> fetch_array(MYSQLI_ASSOC);
    $boardTotalCount = $boardTotalCount['count(boardId)'];
        
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    
    <title>Go!교복</title>
    <link rel="stylesheet" href="../assets/css/cummunity.css">

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

    <main id="main">
        <div class="intro__inner community_inner">
            <div class="intro__text">
                <h2>수다방</h2>
                <p>
                    🥳 교복 커뮤니티에 오신걸 환영합니다!
                </p>
            </div>
        </div>
        <section class="board__inner container">
            <div class="board__search">
                <div class="left">
                    * 총 <em><?=$boardTotalCount?></em>건의 게시물이 등록되어 있습니다.
                </div>
                <div class="right board__select">
                    <form action="boardSearch.php" name="boardSearch" method="get">
                        <fieldset>
                            <input type="search" name="searchKeyword" id="searchKeyword" placeholder="검색어를 입력하세요!" required>
                            <select name="searchOption" id="searchOption">
                                <option value="title">제목</option>
                                <option value="content">내용</option>
                                <option value="name">등록자</option>
                            </select>
                            <button type="submit" class="btn__style3 white">검색</button>
                            <a href="boardWrite.php" class="btn__style3">글쓰기</a>
                        </fieldset>
                    </form>
                </div>
            </div>
            <div class="board__table">
                <table>
                    <colgroup>
                        <col style="width: 5%;">
                        <col>
                        <col style="width: 10%;">
                        <col style="width: 15%;">
                        <col style="width: 7%;">
                        <col style="width: 7%;">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Title</th>
                            <th>Name</th>
                            <th>Date</th>
                            <th>View</th>
                            <th>Like</th>

                        </tr>
                    </thead>
                    <tbody>
<?php
    if(isset($_GET['page'])){
        $page = (int) $_GET['page'];
    } else {
        $page = 1;
    }

    $viewNum = 10;
    $viewLimit = ($viewNum * $page) - $viewNum;

    //1~10  LIMIT 1,  10  --> page1 ($viewNum * 1) - $viewNum
    //11~20 LIMIT 10, 10  --> page2 ($viewNum * 2) - $viewNum
    //21~30 LIMIT 20, 10  --> page3 ($viewNum * 3) - $viewNum
    //31~40 LIMIT 30, 10  --> page4 ($viewNum * 4) - $viewNum

    $sql = "SELECT b.boardId, b.boardTitle, m.youName, b.regTime, b.boardView ,b.boardLike FROM Community b JOIN blog_myMembers m ON(b.memberId = m.memberId) ORDER BY boardId DESC LIMIT {$viewLimit}, {$viewNum}";
    $result = $connect -> query($sql);

    if($result){
        $count = $result -> num_rows;

        if($count > 0){
            for($i=0; $i<$count; $i++){
                $info = $result -> fetch_array(MYSQLI_ASSOC);

                echo "<tr>";
                echo "<td>".$info['boardId']."</td>";
                echo "<td><a href='community_view.php?boardId={$info['boardId']}'>".$info['boardTitle']."</a></td>";
                echo "<td>".$info['youName']."</td>";
                echo "<td>".date('Y-m-d', $info['regTime'])."</td>";
                echo "<td>".$info['boardView']."</td>";
                echo "<td>".$info['boardLike']."</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>게시글이 없습니다.</td></tr>";
        }
    } else {
        echo "관리자에게 문의해주세요!!";
    }
?>                         
                    </tbody>
                </table>
            </div>
            <div class="board__pages">
                <ul>
                <?php
    // 총 페이지 갯수
    $boardTotalCount = ceil($boardTotalCount/$viewNum);

    // 1 2 3 4 5 6 [7] 8 9 10 11 12 13
    $pageView = 5;
    $startPage = $page - $pageView;
    $endPage = $page + $pageView;

    // 처음 페이지 초기화 / 마지막 페이지 초기화
    if($startPage < 1) $startPage = 1;
    if($endPage >= $boardTotalCount) $endPage = $boardTotalCount;

   // 처음으로/이전
    if ($page != 1) {
        $prevPage = $page - 1;
        echo "<li class='first'><a href='community.php?page=1'><svg xmlns='http://www.w3.org/2000/svg' height='1em' viewBox='0 0 512 512'><style>svg{fill:#303030}</style><path d='M41.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 256 246.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160zm352-160l-160 160c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L301.3 256 438.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0z'/></svg></a></li>";
        echo "<li class='prev'><a href='community.php?page={$prevPage}'><svg xmlns='http://www.w3.org/2000/svg' height='1em' viewBox='0 0 320 512'><style>svg{fill:#303030}</style><path d='M41.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 256 246.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z'/></svg></a></li>";
    }

    // 페이지
    for ($i = $startPage; $i <= $endPage; $i++) {
        $active = "";
        if ($i == $page) $active = "active";

        echo "<li class='{$active}'><a href='community.php?page={$i}'>${i}</a></li>";
    }

    // 마지막으로/다음
    if ($page != $boardTotalCount) {
        $nextPage = $page + 1;
        echo "<li class='next'><a href='community.php?page={$nextPage}'><svg xmlns='http://www.w3.org/2000/svg' height='1em' viewBox='0 0 320 512'><style>svg{fill:#303030}</style><path d='M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z'/></svg></a></li>";
        echo "<li class='last'><a href='community.php?page={$boardTotalCount}'><svg xmlns='http://www.w3.org/2000/svg' height='1em' viewBox='0 0 512 512'><style>svg{fill:#303030}</style><path d='M470.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 256 265.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160zm-352 160l160-160c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L210.7 256 73.4 393.4c-12.5 12.5-12.5 32.8 0-45.3s32.8 12.5 45.3 0z'/></svg></a></li>";
    }
?>
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