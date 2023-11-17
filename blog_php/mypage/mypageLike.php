<?php
    include "../connect/connect.php";
    include "../connect/session.php";


    $blogSql = "SELECT count(blogID) FROM blogs";
    $blogInfo = $connect->query($blogSql);
    $blogTotalCount = $blogInfo->fetch_assoc();
    $blogTotalCount = $blogTotalCount['count(blogID)'];
    $blogSql = "SELECT * FROM blogs WHERE blogDelete = 1 ORDER BY blogId DESC";
    $blogInfo = $connect->query($blogSql);

    $viewNum = 10; // 한 페이지에 보여줄 게시물 수

    // 현재 페이지 설정
    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
    $startFrom = ($page - 1) * $viewNum; // 현재 페이지의 시작 위치

    // 게시물 조회 쿼리를 변경하여 현재 페이지에서 10개의 게시물만 가져오도록 합니다.
    $blogSql = "SELECT * FROM blogs WHERE blogDelete = 1 ORDER BY blogId DESC LIMIT $startFrom, $viewNum";
    $blogInfo = $connect->query($blogSql);
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Go!교복</title>
    
    <link rel="stylesheet" href="../assets/css/cummunity.css">
    <link rel="stylesheet" href="../assets/css/mypage.css">
    <style>
        .mypage__inner {
            padding: 5rem 0;
        }
        .mypage__inner h2 {
            font-size: 2.3rem;
            text-align: center;
            margin-bottom: 0.5rem;
        }
        .mypage__inner > p {
            font-size: 1.2rem;
            text-align: center;
            color: #555555;
            word-break: keep-all;
            font-weight: 100;
        }
        aside.mypage__aside {
                display: block;
            }
        @media only screen and (max-width: 768px) {
            aside.mypage__aside {
                display: none;
            }
            .mypage__inner h2 {
                font-size: 2rem;
            }
            .mypage__inner > p {
                width: 90%;
                margin: 0 auto;
            }
        }
    </style>
    <!-- CSS -->
    <?php include "../include/head.php" ?>

</head>
<body>
    <?php include "../include/skip.php" ?>
    <!-- //skip -->

    <?php include "../include/header.php" ?>
    
    <main id="main">
        <?php include "../mypage/mypageAside.php" ?>
        <section class="board__inner mypage__inner container">
            <h2>내가 좋아한 글</h2>
            <p>💕 수다방에서 내가 좋아한 게시글을 볼 수 있습니다.</p>
            <div class="board__search">
                <div class="left">
                    * 총 <em><?=$blogTotalCount?></em>건의 게시물이 등록되어 있습니다.
                </div>
                <div class="right board__select">
                    
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
$displayBlogId = $blogTotalCount; 
foreach ($blogInfo as $blog) { ?>
    <tr>
        <td><?= $displayBlogId ?></td>
        <td><a href="communityView.php?blogId=<?= $blog['blogId'] ?>"><?= $blog['blogTitle'] ?></a></td>
        <td><?= $blog['blogAuthor'] ?></td>
        <td><?= date('Y-m-d', $blog['blogRegTime']) ?></td>
        <td><?= $blog['blogView'] ?></td>
        <td><?= $blog['blogLike'] ?></td>
    </tr>
<?php 
$displayBlogId--;
} ?>



                          
                    </tbody>
                </table>
            </div>







<div class="board__pages">
    <ul>
        <?php

        // 총 페이지 갯수
        $blogTotalCount = ceil($blogTotalCount/$viewNum);


        // 현재 페이지 주변에 몇 개의 페이지 번호를 표시할 것인지 설정합니다.
        $pageView = 5;
        $startPage = $page - $pageView;
        $endPage = $page + $pageView;

        // 처음 페이지 초기화 / 마지막 페이지 초기화
        if ($startPage < 1) $startPage = 1;
        if ($endPage > $blogTotalCount) $endPage = $blogTotalCount;

        // 처음으로/이전 페이지
        if ($page != 1) {
            $prevPage = $page - 1;
            echo "<li class='first'><a href='cummunity.php?page=1'><svg xmlns='http://www.w3.org/2000/svg' height='1em' viewBox='0 0 512 512'><style>svg{fill:#303030}</style><path d='M41.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 256 246.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160zm352-160l-160 160c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L301.3 256 438.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0z'/></svg></a></li>";
            echo "<li class='prev'><a href='cummunity.php?page={$prevPage}'><svg xmlns='http://www.w3.org/2000/svg' height='1em' viewBox='0 0 320 512'><style>svg{fill:#303030}</style><path d='M41.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 256 246.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z'/></svg></a></li>";
        }

        // 페이지 번호 표시
        for ($i = $startPage; $i <= $endPage; $i++) {
            $active = ($i == $page) ? "active" : "";
            echo "<li class='{$active}'><a href='cummunity.php?page={$i}'>{$i}</a></li>";
        }


        // 마지막으로/다음 페이지
        if ($page != $blogTotalCount) {
            $nextPage = $page + 1;
            echo "<li class='next'><a href='cummunity.php?page={$nextPage}'><svg xmlns='http://www.w3.org/2000/svg' height='1em' viewBox='0 0 320 512'><style>svg{fill:#303030}</style><path d='M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z'/></svg></a></li>";
            echo "<li class='last'><a href='cummunity.php?page={$blogTotalCount}'><svg xmlns='http://www.w3.org/2000/svg' height='1em' viewBox='0 0 512 512'><style>svg{fill:#303030}</style><path d='M470.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 256 265.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160zm-352 160l160-160c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L210.7 256 73.4 393.4c-12.5 12.5-12.5 32.8 0-45.3s32.8 12.5 45.3 0z'/></svg></a></li>";
        }
        ?>
    </ul>
</div>
        </section>
    </main>
    <!-- //main -->

    <?php include "../include/footer.php" ?>
    <!-- //footer -->
</body>
</html>