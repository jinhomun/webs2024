<?php
include "../connect/connect.php";
include "../connect/session.php";

// SQL 쿼리 생성
$sql = "SELECT introId, introComment, introView FROM Intro";

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
        <div class="intro__inner introduce_inner">
            <div class="intro__text">
                <h2>교복소개</h2>
                <p>
                    😊 모든 고등학교의 교복을 여기서 찾아보세요!
                </p>
            </div>
        </div>

        <section class="board__inner container">
            <div class="board__search">
                <div class="left board__select">
                    <select name="city" id="city" class="city">
                        <option selected>지역별</option>
                        <option value="1">강원</option>
                        <option value="2">경기</option>
                        <option value="3">경남</option>
                        <option value="4">경북</option>
                        <option value="5">대구</option>
                        <option value="6">대전</option>
                        <option value="7">부산</option>
                        <option value="8">서울</option>
                        <option value="9">세종</option>
                        <option value="10">울산</option>
                        <option value="11">인천</option>
                        <option value="12">전남</option>
                        <option value="13">전북</option>
                        <option value="14">제주도</option>
                        <option value="15">충남</option>
                        <option value="16">충북</option>
                    </select>
                </div>
                <div class="right board__select">
                    <form onsubmit="handleSearch(event)">
                        <fieldset>
                            <input type="search" name="searchKeyword" id="searchKeyword" placeholder="검색어를 입력하세요!"
                                required>
                            <button type="submit" class="btn__style3 white">검색</button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </section>

        <div id="contents">
            <section class="card__wrap bmStyle2 container">
                <div class="card__inner column5" id="contentsInner"></div>

                <div class="board__pages">
                    <ul id="pagination"></ul>
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

    <script>
    $("#top").click(function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });



    //선택자
    const regionElement = document.querySelector('.region');
    const NameElement = document.querySelector('.name');
    const cityElement = document.querySelector('#city');
    const contents = document.querySelector('#contentsInner');
    const schoolName = document.querySelector('#schoolName');

    let gobokInfo = []; // 교복 정보를 저장할 전역 배열

    // 페이지네이션을 위한 전역 변수
    let currentPage = 1;
    const itemsPerPage = 20;
    let totalPages = 0;

    // 페이지네이션 생성 함수
    function createPagination(totalItems) {
        totalPages = Math.ceil(totalItems / itemsPerPage);
        let paginationHTML = '';
        let startPage, endPage;

        if (totalPages <= 5) {
            startPage = 1;
            endPage = totalPages;
        } else if (currentPage <= 3) {
            startPage = 1;
            endPage = 5;
        } else if (currentPage + 2 >= totalPages) {
            startPage = totalPages - 4;
            endPage = totalPages;
        } else {
            startPage = currentPage - 2;
            endPage = currentPage + 2;
        }

        // 처음으로 가기
        paginationHTML += currentPage === 1 ? '' :
            `<li class='first'><a href="#" onclick="changePage(1)"><svg xmlns='http://www.w3.org/2000/svg' height='1em' viewBox='0 0 512 512'><style>svg{fill:#303030}</style><path d='M41.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 256 246.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160zm352-160l-160 160c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L301.3 256 438.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0z'/></svg></a></li>`;

        // 이전 페이지로 가기
        paginationHTML += currentPage === 1 ? '' :
            `<li class='prev'><a href="#" onclick="changePage(${currentPage - 1})"><svg xmlns='http://www.w3.org/2000/svg' height='1em' viewBox='0 0 320 512'><style>svg{fill:#303030}</style><path d='M41.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 256 246.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z'/></svg></a></li>`;

        // 페이지 번호
        for (let i = startPage; i <= endPage; i++) {
            paginationHTML +=
                `<li class="${i === currentPage ? 'active' : ''}"><a href="#" onclick="changePage(${i})">${i}</a></li>`;
        }

        // 다음 페이지로 가기
        paginationHTML += currentPage === totalPages ? '' :
            `<li class='next'><a href="#" onclick="changePage(${currentPage + 1})"><svg xmlns='http://www.w3.org/2000/svg' height='1em' viewBox='0 0 320 512'><style>svg{fill:#303030}</style><path d='M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z'/></svg></a></li>`;

        // 마지막으로 가기
        paginationHTML += currentPage === totalPages ? '' :
            `<li class='last'><a href="#" onclick="changePage(${totalPages})"><svg xmlns='http://www.w3.org/2000/svg' height='1em' viewBox='0 0 512 512'><style>svg{fill:#303030}</style><path d='M470.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 256 265.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160zm-352 160l160-160c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L210.7 256 73.4 393.4c-12.5 12.5-12.5 32.8 0-45.3s32.8 12.5 45.3 0z'/></svg></a></li>`;

        document.getElementById('pagination').innerHTML = paginationHTML;
    }

    // 페이지 변경 함수
    function changePage(page) {
        if (page < 1) page = 1;
        if (page > totalPages) page = totalPages;
        currentPage = page;
        updateGobok(gobokInfo);
    }

    // 정보 가져오기
    const fetchgGobok = (selectedRegion = '') => {
        fetch("https://raw.githubusercontent.com/jinhomun/webs2024/main/blog_phpJSON/gobok.json")
            .then(res => res.json())
            .then(items => {
                gobokInfo = items.map((item, index) => {
                    return {
                        infoRegion: item.region,
                        infoName: item.school,
                        infoUniformtypes: item.uniform_types,
                        infoUniformimg: item.uniform_img
                    };
                });

                if (selectedRegion && selectedRegion !== '지역별') {
                    // 선택된 지역에 해당하는 교복 정보만 필터링
                    gobokInfo = gobokInfo.filter(gobok => gobok.infoRegion === selectedRegion);
                }

                updateGobok(gobokInfo); // 필터링된 정보로 교복 정보 업데이트


            });
    }
    // 정보 출력 함수
    const updateGobok = (gobokInfo) => {
        const start = (currentPage - 1) * itemsPerPage;
        const end = start + itemsPerPage;
        const paginatedItems = gobokInfo.slice(start, end); // 현재 페이지에 해당하는 아이템들을 담는 배열

        const displayItems = paginatedItems.map(gobok => {
            // introData 배열에서 현재의 infoName과 일치하는 introId를 찾아냄
            const matchingIntro = introData.find(intro => intro.introId === gobok.infoName);
            const isMatched = matchingIntro ? 'matched' : '';
            const introComment = matchingIntro ? matchingIntro.introComment : '0';
            const introView = matchingIntro ? matchingIntro.introView : '0';


            // 아이템을 HTML로 변환
            return `
        <!-- 이미지를 표시할 공간 -->
<div class="card__list">
    <a href="introDetail.php?introId=${gobok.infoName}">
        <figure> 
            <img src="${gobok.infoUniformimg[0].replace(/<img src='([^']+)'>/, '$1')}" alt="${gobok.infoName}">
        </figure>
        <div class="card__list__text">
            <p class="region">${gobok.infoRegion}</p>
            <p class="school__name ${isMatched}">${gobok.infoName}</p>
            <div class="views">
                <p class="view-count"><img src="../assets/img/view.svg" alt="조회수 아이콘"> <span>${introView}</span></p>
                <p class="comment-count"><img src="../assets/img/chat.svg" alt="댓글 아이콘"> <span>${introComment}</span></p>
            </div>
        </div>
    </a>
</div>

        `;
        }).join('');

        contents.innerHTML = displayItems; // 변환된 HTML을 페이지에 삽입

        // 페이지네이션 생성
        createPagination(gobokInfo.length);
    }


    function handleSearch(event) {
        event.preventDefault(); // 전통적인 방식으로 폼 제출 방지
        const searchKeyword = document.getElementById('searchKeyword').value.trim().toLowerCase();

        // 검색 키워드를 기반으로 gobokInfo 배열 필터링
        const filteredGobokInfo = gobokInfo.filter(gobok =>
            gobok.infoName.toLowerCase().includes(searchKeyword) ||
            gobok.infoRegion.toLowerCase().includes(searchKeyword)
        );

        // 필터링된 결과로 디스플레이 업데이트
        updateGobok(filteredGobokInfo);
    }

    // 선택한 지역에 따라 데이터를 필터링하고 페이지를 초기화하는 함수
    function updateDataAndPagination(selectedRegion = '') {
        fetchgGobok(selectedRegion);
        currentPage = 1;
        localStorage.setItem('selectedRegion', selectedRegion); // Local Storage에 선택된 지역 저장
    }

    // 지역 선택 이벤트 리스너
    cityElement.addEventListener('change', function() {
        const selectedRegion = cityElement.options[cityElement.selectedIndex].text;
        updateDataAndPagination(selectedRegion);
    });

    // 페이지가 로드된 후 실행
    document.addEventListener("DOMContentLoaded", () => {
        const selectedRegion = localStorage.getItem('selectedRegion');
        if (selectedRegion && selectedRegion !== '지역별') {
            for (let i = 0; i < cityElement.options.length; i++) {
                if (cityElement.options[i].text === selectedRegion) {
                    cityElement.selectedIndex = i;
                    break;
                }
            }
            updateDataAndPagination(selectedRegion); // Local Storage에서 가져온 지역으로 데이터 로드
        } else {
            updateDataAndPagination(); // 지역 선택하지 않은 상태에서 호출
        }
    });
    </script>
</body>

</html>