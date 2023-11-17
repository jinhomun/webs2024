<?php
include "../connect/connect.php";
include "../connect/session.php";

// 로그인한 사용자의 ID를 가져옵니다.
$memberId = $_SESSION['memberId'] ?? null;
if ($memberId === null) {
    // 로그인이 되어있지 않다면, 로그인 페이지로 리디렉트
    header('Location: login.php');
    exit;
}

// 현재 사용자가 좋아요를 누른 교복의 ID 목록을 가져옵니다.
$likedQuery = "SELECT introId FROM IntroLikes WHERE memberId = ?";
$likedStmt = $connect->prepare($likedQuery);
$likedStmt->bind_param("i", $memberId);
$likedStmt->execute();
$likedResult = $likedStmt->get_result();

$likedIds = [];
while ($row = $likedResult->fetch_assoc()) {
    $likedIds[] = $row['introId'];
}

// SQL 쿼리 생성
$sql = "SELECT introId, introComment,introView FROM Intro";

// MySQL에서 데이터 가져오기
$result = mysqli_query($connect, $sql);

// introId 및 introComment 값을 저장할 배열 생성
$introData = [];

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $introData[] = [
            'introId' => $row['introId'],
            'introComment' => $row['introComment'],
            'introView' => $row['introView']
        ];

    }
} else {
    echo "데이터를 가져오는 중에 오류가 발생했습니다.";
}

// PHP 배열을 JavaScript 배열로 출력
echo '<script>let introData = ' . json_encode($introData) . ';</script>';
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Go!교복</title>
    <link rel="stylesheet" href="../assets/css/introduce.css">
    <link rel="stylesheet" href="../assets/css/mypage.css">
    <style>
        .mypage__inner {
            padding: 5rem 0;
            min-height: 90vh;
        }
        .mypage__inner h2 {
            font-size: 2.3rem;
            text-align: center;
            margin-bottom: 0.5rem;
            width: 100%;
            padding: 0;
            margin-top: 0;
            border: none;
        }
        .mypage__inner > p {
            font-size: 1.2rem;
            text-align: center;
            color: #555555;
            word-break: keep-all;
            font-weight: 100;
        }
        .mypage__inner > p em { 
            color: #1976DE;
        }
        .uniforms.card__inner {
            margin-top: 2.5rem;
        }
        .card__list {
            margin: 0 0.5rem;
            margin-bottom: 2rem;
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
                font-size: 1rem;
            }
            .card__list {
                margin: 0 0;
                margin-bottom: 2rem;
                width: 48%;
            }
            
        }
        @media only screen and (max-width: 500px) {
            .card__inner>div figure img {
                height: 220px;
            }
            .card__list__text p.school__name {
                font-weight: 300;
                font-size: 16px;
                color: #000;
            }
            .card__list__text p.region {
                font-size: 14px;
                color: #7d7d7d;
                font-weight: 100;
            }
        }
    </style>
    <!-- CSS -->
    <?php include "../include/head.php"; ?>
</head>
<body>
    <?php include "../include/skip.php"; ?>
    <!-- //skip -->
    <?php include "../include/header.php"; ?>
    <!-- //header -->
    
    <main id="main">
        <?php include "../mypage/mypageAside.php"; ?>
        <!-- //mypageAside -->
        <section class="mypage__inner card__wrap bmStyle2 container">
            <h2>내가 좋아한 교복</h2>
            <p>전국 교복 중에서 <em>좋아요👍</em>를 누른 목록을 볼 수 있습니다.</p>
            <div class="card__inner uniforms" id="likedUniformsContainer"></div>
        </section>    
        
    </main>
    <!-- //main -->

    <?php include "../include/footer.php"; ?>
    <!-- //footer -->

    <script>
    //선택자
    const regionElement = document.querySelector('.region');
    const NameElement = document.querySelector('.name');
    const cityElement = document.querySelector('#city');
    const contents = document.querySelector('#contentsInner');
    const schoolName = document.querySelector('#schoolName');

    let gobokInfo = []; // 교복 정보를 저장할 전역 배열


    const fetchGobok = () => {
        fetch("https://raw.githubusercontent.com/jinhomun/webs2024/main/blog_phpJSON/gobok.json")
            .then(res => res.json())
            .then(items => {
                gobokInfo = items.map(item => ({
                    infoRegion: item.region,
                    infoName: item.school,
                    infoUniformtypes: item.uniform_types,
                    infoUniformimg: item.uniform_img
                }));

                // 좋아요 클릭한 교복들만 필터링
                const likedUniforms = gobokInfo.filter(gobok => <?= json_encode($likedIds) ?>.includes(gobok.infoName));
                displayLikedUniforms(likedUniforms);
            });
        };

        
        const displayLikedUniforms = (likedUniforms) => {
            const container = document.getElementById('likedUniformsContainer');
            // 기존의 자식 요소들을 모두 지우기
            while (container.firstChild) {
                container.removeChild(container.firstChild);
            }

            likedUniforms.forEach(uniform => {
                const cardList = document.createElement('div');
                const matchingIntro = introData.find(intro => intro.introId === uniform.infoName);
                const isMatched = matchingIntro ? 'matched' : '';
                const introComment = matchingIntro ? matchingIntro.introComment : '';
                const introView = matchingIntro ? matchingIntro.introView : '';

                // 이후의 코드는 동일
                const commentCountSpan = document.getElementById(`comment-count-span-${uniform.infoName}`);
                const ViewCountSpan = document.getElementById(`view-count-span-${uniform.infoName}`);
                if (commentCountSpan) {
                    commentCountSpan.textContent = introComment;
                    viewCountSpan.textContent = introView;
                }
                cardList.classList.add('card__list');
                cardList.innerHTML = `
                    <a href="../introduce/introDetail.php?introId=${uniform.infoName}">
                        <figure>
                            ${uniform.infoUniformimg[0]}
                        </figure>
                        <div class="card__list__text">
                            <p class="region">${uniform.infoRegion}</p>
                            <p class="school__name ${isMatched}">${uniform.infoName}</p>
                            <div class="views">
                                <p class="view-count"><img src="../assets/img/view.svg" alt=""> <span id="view-count-span-${uniform.infoName}">${introView}</span></p>
                                <p class="comment-count"><img src="../assets/img/chat.svg" alt=""> <span id="comment-count-span-${uniform.infoName}">${introComment}</span></p>
                            </div>
                        </div>
                    </a>
                `;
                container.appendChild(cardList);
            });
        };

    // 페이지가 로드된 후 실행
    document.addEventListener("DOMContentLoaded", fetchGobok);
    </script>
</body>
</html>