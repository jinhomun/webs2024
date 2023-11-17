<?php
include "../connect/connect.php";
include "../connect/session.php";

$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$viewNum = 10;
$viewLimit = ($viewNum * $page) - $viewNum;

// 기본 SQL 쿼리
$sql = "SELECT b.blogId, b.blogTitle, b.blogContents, m.youName, b.blogRegTime, b.blogView, b.blogLike FROM blogs b JOIN blog_myMembers m ON (b.memberId = m.memberId) ";

// 검색 조건 적용
$where = "";
if (isset($_GET['searchKeyword']) && isset($_GET['searchOption'])) {
    $searchKeyword = $connect->real_escape_string(trim($_GET['searchKeyword']));
    $searchOption = $connect->real_escape_string(trim($_GET['searchOption']));

    switch ($searchOption) {
        case "title":
            $where = "WHERE b.blogTitle LIKE '%{$searchKeyword}%' ";
            break;
        case "content":
            $where = "WHERE b.blogContents LIKE '%{$searchKeyword}%' ";
            break;
        case "name":
            $where = "WHERE m.youName LIKE '%{$searchKeyword}%' ";
            break;
    }
    $sql .= $where;
}

// 총 게시물 수 계산
$totalSql = "SELECT COUNT(*) FROM blogs b JOIN blog_myMembers m ON (b.memberId = m.memberId) " . $where;
$totalResult = $connect->query($totalSql);
$totalRow = $totalResult->fetch_row();
$totalCount = $totalRow[0];

// 페이지네이션 적용한 쿼리 실행
$sql .= "ORDER BY b.blogId DESC LIMIT {$viewLimit}, {$viewNum}";
$result = $connect->query($sql);
?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Go!교복</title>

    <link rel="stylesheet" href="../assets/css/cummunity.css">

    <!-- CSS -->
    <?php include "../include/head.php" ?>

</head>

<body>
    <?php include "../include/skip.php" ?>
    <!-- //skip -->

    <?php include "../include/header.php" ?>

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
                    * 총 <em>
                        <?= $totalCount ?>
                    </em>건의 게시물이 검색 되었습니다.
                </div>
                <!-- 검색 폼 -->
                <div class="right board__select">
                    <form action="cummunitySearch.php" name="boardSearch" method="get">
                        <fieldset>
                            <input type="search" name="searchKeyword" id="searchKeyword" placeholder="검색어를 입력하세요!"
                                value="<?= isset($searchKeyword) ? $searchKeyword : '' ?>" required>
                            <select name="searchOption" id="searchOption">
                                <option value="title"
                                    <?= (isset($searchOption) && $searchOption == 'title') ? 'selected' : '' ?>>제목
                                </option>
                                <option value="content"
                                    <?= (isset($searchOption) && $searchOption == 'content') ? 'selected' : '' ?>>내용
                                </option>
                                <option value="name"
                                    <?= (isset($searchOption) && $searchOption == 'name') ? 'selected' : '' ?>>등록자
                                </option>
                            </select>
                            <button type="submit" class="btn__style3 white">검색</button>
                            <a href="boardWrite.php" class="btn__style3">글쓰기</a>
                        </fieldset>
                    </form>
                </div>
                <!-- <div class="right board__select">
                    <form action="boardSearch.php" name="boardSearch" method="get">
                        <fieldset>
                            <input type="search" name="searchKeyword" id="searchKeyword" placeholder="검색어를 입력하세요!"
                                required>
                            <select name="searchOption" id="searchOption">
                                <option value="title">제목</option>
                                <option value="content">내용</option>
                                <option value="name">등록자</option>
                            </select>
                            <button type="submit" class="btn__style3 white">검색</button>
                            <a href="boardWrite.php" class="btn__style3">글쓰기</a>
                        </fieldset>
                    </form>
                </div> -->
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
                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['blogId'] . "</td>";
                        echo "<td><a href='communityView.php?blogId={$row['blogId']}'>" . $row['blogTitle'] . "</a></td>";
                        echo "<td>" . $row['youName'] . "</td>";
                        echo "<td>" . date('Y-m-d', $row['blogRegTime']) . "</td>";
                        echo "<td>" . $row['blogView'] . "</td>";
                        echo "<td>" . $row['blogLike'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>검색된 게시물이 없습니다.</td></tr>";
                }
                ?>
                    </tbody>
                </table>
            </div>
            <div class="board__pages">
                <ul>
                    <?php
                    // 총 페이지 갯수
                    $boardTotalCount = ceil($boardTotalCount / $viewNum);

                    // 1 2 3 4 5 6 [7] 8 9 10 11 12 13
                    $pageView = 5;
                    $startPage = $page - $pageView;
                    $endPage = $page + $pageView;

                    // 처음 페이지 초기화 / 마지막 페이지 초기화
                    if ($startPage < 1)
                        $startPage = 1;
                    if ($endPage >= $boardTotalCount)
                        $endPage = $boardTotalCount;

                    // 처음으로/이전
                    if ($page != 1) {
                        $prevPage = $page - 1;
                        echo "<li class='first'><a href='cummunitySearch.php?page=1&searchKeyword={$searchKeyword}&searchOption={$searchOption}'><svg xmlns='http://www.w3.org/2000/svg' height='1em' viewBox='0 0 512 512'><style>svg{fill:#303030}</style><path d='M41.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 256 246.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160zm352-160l-160 160c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L301.3 256 438.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0z'/></svg></a></li>";
                        echo "<li class='prev'><a href='cummunitySearch.php?page={$prevPage}&searchKeyword={$searchKeyword}&searchOption={$searchOption}'><svg xmlns='http://www.w3.org/2000/svg' height='1em' viewBox='0 0 320 512'><style>svg{fill:#303030}</style><path d='M41.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 256 246.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z'/></svg></a></li>";
                    }

                    // 페이지
                    for ($i = $startPage; $i <= $endPage; $i++) {
                        $active = "";
                        if ($i == $page)
                            $active = "active";

                        echo "<li class='{$active}'><a href='cummunitySearch.php?page={$i}&searchKeyword={$searchKeyword}&searchOption={$searchOption}'>${i}</a></li>";
                    }

                    // 마지막으로/다음
                    if ($page != $boardTotalCount) {
                        $nextPage = $page + 1;
                        echo "<li class='next'><a href='cummunitySearch.php?page={$nextPage}&searchKeyword={$searchKeyword}&searchOption={$searchOption}'><svg xmlns='http://www.w3.org/2000/svg' height='1em' viewBox='0 0 320 512'><style>svg{fill:#303030}</style><path d='M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z'/></svg></a></li>";
                        echo "<li class='last'><a href='cummunitySearch.php?page={$boardTotalCount}&searchKeyword={$searchKeyword}&searchOption={$searchOption}'><svg xmlns='http://www.w3.org/2000/svg' height='1em' viewBox='0 0 512 512'><style>svg{fill:#303030}</style><path d='M470.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 256 265.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160zm-352 160l160-160c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L210.7 256 73.4 393.4c-12.5 12.5-12.5 32.8 0-45.3s32.8 12.5 45.3 0z'/></svg></a></li>";
                    }
                    ?>
            </div>
        </section>
    </main>
    <!-- //main -->

    <?php include "../include/footer.php" ?>
    <!-- //footer -->
</body>

</html>