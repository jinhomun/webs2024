<?php
include "../connect/connect.php";
include "../connect/session.php";

// 좋아요 상위 10개의 학교 이름을 가져오는 쿼리
$sql = "SELECT introId, SUM(introLike) AS Likes
        FROM IntroLikes 
        GROUP BY introId 
        ORDER BY Likes DESC 
        LIMIT 30";

$result = $connect->query($sql);

$schoolLikes = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $schoolLikes[$row['introId']] = $row['Likes'];
    }
} else {
    echo "0 results";
}

// 싫어요 상위 10개의 학교 이름을 가져오는 쿼리
$sql = "SELECT introId, SUM(introDislike) AS Dislikes
        FROM IntroLikes 
        GROUP BY introId 
        ORDER BY Dislikes DESC 
        LIMIT 30";

$result = $connect->query($sql);

$schoolDislikes = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $schoolDislikes[$row['introId']] = $row['Dislikes'];
    }
} else {
    echo "0 results";
}

// 조회수가 높은 상위 10개의 학교 이름을 가져오는 쿼리
$sql = "SELECT introId, SUM(introView) AS Views
        FROM Intro
        GROUP BY introId
        ORDER BY Views DESC
        LIMIT 30";

$result = $connect->query($sql);

$schoolViews = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $schoolViews[$row['introId']] = $row['Views'];
    }
} else {
    echo "0 results";
}

// JSON 데이터를 로드합니다.
$json_data = file_get_contents('../json/gobok.json');
$uniforms = json_decode($json_data, true);

// 학교 이름에 해당하는 교복 이미지를 찾습니다.
$rankedUniforms = [];
foreach ($schoolViews as $schoolId => $views) {
    foreach ($uniforms as $uniform) {
        if ($uniform['school'] == $schoolId) {
            $uniform['likes'] = isset($schoolLikes[$schoolId]) ? $schoolLikes[$schoolId] : 0;
            $uniform['dislikes'] = isset($schoolDislikes[$schoolId]) ? $schoolDislikes[$schoolId] : 0;
            $uniform['views'] = $views; // 조회수를 추가합니다.
            $rankedUniforms[] = $uniform;
            break;
        }
    }
}
?>


<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Go!교복</title>

    <link rel="stylesheet" href="../assets/css/introduce.css">

    <!-- CSS -->
    <?php include "../include/head.php" ?>
    <style>
    #top {
        position: fixed;
        top: 86%;
        right: 5%;
        width: 70px;
        height: 70px;
        background-color: #1976DE;
        border-radius: 50%;
        color: #fff;
        font-size: 1rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: 0.7s ease;
    }

    #top a {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 1rem;

    }

    #top svg {
        width: 100%;
        fill: #fff;
    }
    </style>
</head>

<body>
    <?php include "../include/skip.php" ?>
    <!-- //skip -->

    <?php include "../include/header.php" ?>
    <div id="schoolName"></div>
    <main id="main">
        <div class="intro__inner ranking__inner">
            <div class="intro__text">
                <h2>인기순위</h2>
                <p>
                    🥳 우리 학교 교복순위를 찾아보세요!
                </p>
            </div>
        </div>

        <div id="contents">
            <div class="tab">
                <div class="tab_menu">
                    <a href="#" class="active">조회수 순</a>
                    <a href="#">좋아요 순</a>
                    <a href="#">싫어요 순</a>
                </div>
            </div>

            <section class="card__wrap container tab_cont">
                <div class="view_list">
                    <div class="card__inner column5">
                        <?php
                        usort($rankedUniforms, function ($a, $b) {
                            return $b['views'] - $a['views'];
                        });

                        foreach ($rankedUniforms as $key => $uniform):
                            ?>
                        <div class="card__list">
                            <a href="../introduce/introDetail.php?introId=<?= $uniform['school'] ?>">
                                <figure>
                                    <div class="medal_ranking">
                                        <img src="../assets/img/ranking.png" alt="">
                                        <span>
                                            <?= $key + 1 ?>위
                                        </span>
                                    </div>
                                    <?php if (!empty($uniform['uniform_img'])): ?>
                                    <?= html_entity_decode($uniform['uniform_img'][0]) // 첫 번째 이미지만 표시 ?>
                                    <?php endif; ?>
                                </figure>
                                <div class="card__list__text">
                                    <p class="region">
                                        <?= $uniform['region'] ?>
                                    </p>
                                    <p class="school__name">
                                        <?= $uniform['school'] ?>
                                    </p>
                                    <div class="views">
                                        <p class="view-count"><img src="../assets/img/view.svg" alt="">
                                            <?= $uniform['views'] ?>
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="good_list">
                    <div class="card__inner column5">
                        <?php
                        usort($rankedUniforms, function ($a, $b) {
                            return $b['likes'] - $a['likes'];
                        });
                        ?>
                        <?php foreach ($rankedUniforms as $key => $uniform): ?>
                        <div class="card__list">
                            <a href="../introduce/introDetail.php?introId=<?= $uniform['school'] ?>">
                                <figure>
                                    <div class="medal_ranking">
                                        <img src="../assets/img/ranking.png" alt="">
                                        <span>
                                            <?= $key + 1 ?>위
                                        </span>
                                    </div>
                                    <?php if (!empty($uniform['uniform_img'])): ?>
                                    <?= html_entity_decode($uniform['uniform_img'][0]) // 첫 번째 이미지만 표시 ?>
                                    <?php endif; ?>
                                </figure>
                                <div class="card__list__text">
                                    <p class="region">
                                        <?= $uniform['region'] ?>
                                    </p>
                                    <p class="school__name">
                                        <?= $uniform['school'] ?>
                                    </p>
                                    <div class="views">
                                        <p class="view-count"><img src="../assets/img/good.svg" alt="">
                                            <?= $uniform['likes'] ?>
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="bad_list">
                    <div class="card__inner column5">
                        <?php
                        usort($rankedUniforms, function ($a, $b) {
                            return $b['dislikes'] - $a['dislikes'];
                        });
                        ?>
                        <?php foreach ($rankedUniforms as $key => $uniform): ?>
                        <div class="card__list">
                            <a href="../introduce/introDetail.php?introId=<?= $uniform['school'] ?>">
                                <figure>
                                    <div class="medal_ranking">
                                        <img src="../assets/img/ranking.png" alt="">
                                        <span>
                                            <?= $key + 1 ?>위
                                        </span>
                                    </div>
                                    <?php if (!empty($uniform['uniform_img'])): ?>
                                    <?= html_entity_decode($uniform['uniform_img'][0]) // 첫 번째 이미지만 표시 ?>
                                    <?php endif; ?>
                                </figure>
                                <div class="card__list__text">
                                    <p class="region">
                                        <?= $uniform['region'] ?>
                                    </p>
                                    <p class="school__name">
                                        <?= $uniform['school'] ?>
                                    </p>
                                    <div class="views">
                                        <p class="view-count"><img src="../assets/img/hate.svg" alt="">
                                            <?= $uniform['dislikes'] ?>
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
        </div>
        <!-- //card__wrap -->
    </main>
    <!-- //main -->

    <div id="top">
        <a>
            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                <!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                <path
                    d="M201.4 137.4c12.5-12.5 32.8-12.5 45.3 0l160 160c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L224 205.3 86.6 342.6c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3l160-160z" />
            </svg>
            TOP
        </a>
    </div>

    <?php include "../include/footer.php" ?>
    <!-- //footer -->


</body>

</html>