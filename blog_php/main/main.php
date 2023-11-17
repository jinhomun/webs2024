<?php
include "../connect/connect.php";
include "../connect/session.php";

// echo "<pre>";
// var_dump($_SESSION);
// echo "</pre>";
?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Go!교복</title>

    <link rel="stylesheet" href="../assets/css/main.css">

    <!-- CSS -->
    <?php include "../include/head.php" ?>

    <script src="https://unpkg.com/split-type"></script>
</head>

<body>
    <?php include "../include/skip.php" ?>
    <!-- //skip -->

    <?php include "../include/header.php" ?>
    <!-- //header -->


    <main id="main">
        <div class="main_wrap wrap wrap1">
            <div class="main_visual">
                <div class="mainVisual_left">
                    <img class="i1" src="../assets/img/main_img.png" alt="">
                </div>
                <div class="mainVisual_right">
                    <h2 class="split">
                        HIGH SCHOOL
                        UNIFORM PREVIEW
                    </h2>
                    <span class="split_span">Community for students</span>
                    <div class="mainVisual_right_blue">
                        <p>교복입는 학생들을 위한 <span>커뮤니티</span></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- //main_wrap -->

        <div class="main_section">
            <section id="section01" class="wrap wrap2">
                <div class="section01_left">
                    <!-- <a href="#"><img src="assets/img/main_left.png" alt=""></a> -->

                    <article id="silder">
                        <div class="sliderWrap">
                            <div class="slider s1"></div>
                            <div class="slider s2"></div>
                            <div class="slider s3"></div>
                            <div class="slider s4"></div>
                            <div class="slider s5"></div>
                            <div class="slider s6"></div>
                        </div>
                    </article>
                    <!-- //silder -->
                </div>
                <div class="section01_right">
                    <div class="right_tag">
                        <img src="../assets/img/logo2.png" alt="">
                        <div class="tag">Community for students</div>
                    </div>
                    <div class="right_title">
                        <span>HIGH SCHOOL </span>
                        UNIFORM PREVIEW
                    </div>
                    <div class="right_cont">
                        <ul>
                            <li><img src="../assets/img/point01.png" alt="">찐 고딩들이 평가하는 교복 순위!</li>
                            <li><img src="../assets/img/point02.png" alt="">예쁜 교복부터 난해한 교복까지 한눈에 보기!</li>
                            <li><img src="../assets/img/point03.png" alt="">대학생이 아닌 청소년을 위한 커뮤니티</li>
                        </ul>
                    </div>
                </div>
            </section>
            <!-- //section01 -->

            <section id="section02">
                <div class="section02_left">
                    <img src="../assets/img/main_hover01.png" alt="">
                    <div class="section02_btn">
                        <p>전국 교복소개</p>
                        <a href="../introduce/introduce.php">교복소개 보러가기</a>
                    </div>
                </div>
                <div class="section02_right">
                    <img src="../assets/img/main_hover02.png" alt="">
                    <div class="section02_btn hide">
                        <p>전국 교복 인기순위</p>
                        <a href="../ranking/ranking.php">인기순위 보러가기</a>
                    </div>
                </div>
            </section>
            <!-- //section02 -->

            <section id="section03">
                <div class="section03__inner">
                    <h3>수다방 인기 게시글</h3>
                    <div class="community_suda">
                        <?php
                        if (isset($_GET['page'])) {
                            $page = (int) $_GET['page'];
                        } else {
                            $page = 1;
                        }

                        $viewNum = 5; // 각 table에 5개의 게시물 표시
                        $viewLimitStart = ($viewNum * $page) - $viewNum;

                        $sql = "SELECT b.blogId, b.blogTitle, b.blogAuthor, b.blogRegTime, b.blogView, b.blogLike 
            FROM blogs b 
            JOIN blog_myMembers m ON(b.memberId = m.memberId) 
            ORDER BY b.blogView DESC, b.blogId DESC
            LIMIT {$viewLimitStart}, " . (2 * $viewNum); // 각 table당 10개의 게시물 가져옴
                        
                        $result = $connect->query($sql);

                        if ($result) {
                            $count = $result->num_rows;
                            $sudaListCount = 0;

                            if ($count > 0) {
                                while ($info = $result->fetch_array(MYSQLI_ASSOC)) {
                                    // 각 suda_list에 5개의 tr로 묶이며, section 안에 묶임
                                    if ($sudaListCount % 5 == 0) {
                                        if ($sudaListCount > 0) {
                                            echo '</table></div>';
                                        }
                                        echo '<div class="suda_list"><table>';
                                    }

                                    echo "<tr>";
                                    echo "<td class='center'>" . $info['blogId'] . "</td>";
                                    echo "<td><a href='communityView.php?blogId={$info['blogId']}'>" . $info['blogTitle'] . "</a></td>";
                                    echo "<td class='center'>" . $info['blogAuthor'] . "</td>";
                                    echo "<td class='center'>" . date('Y.m.d', $info['blogRegTime']) . "</td>";
                                    echo "<td class='center'><img src='../assets/img/read.svg' alt=''>" . $info['blogView'] . "</td>";
                                    echo "<td class='center'><img src='../assets/img/good.svg' alt=''>" . $info['blogLike'] . "</td>";
                                    echo "</tr>";

                                    $sudaListCount++;
                                }

                                echo '</table></div>';

                            } else {
                                echo "<div class='suda_list'><table><tr><td colspan='5'>게시글이 없습니다.</td></tr></table></div>";
                            }
                        } else {
                            echo "관리자에게 문의해주세요!!" . $connect->error;
                            ;
                        }
                        ?>
                    </div>
                </div>
            </section>
            <!-- //section03 -->

            <section id="section04">
                <div class="section04_wrap">
                    <div class="section04_left">
                        <iframe id="videoIframe" width="100%" height="400px"
                            src="https://www.youtube.com/embed/6kp3_yDFPU8?autoplay=1&mute=1&controls=0&loop=1&playlist=6kp3_yDFPU8"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen></iframe>
                        <div class="section04_youtube">
                            <div class="youtube_box"
                                onclick="playVideo('https://www.youtube.com/embed/1jfwTPD9O28?autoplay=1&mute=1&controls=0&loop=1&playlist=1jfwTPD9O28')">
                                <p>
                                    <em>신비</em>
                                    10대 교복 아우터 코디
                                </p>
                                <div class="youtube_thum"><img src="../assets/img/sinbe.jpg" alt=""></div>
                                <a href="https://www.youtube.com/watch?v=1jfwTPD9O28" target="_blank"><img
                                        src="../assets/img/link_btn.png" alt=""></a>
                            </div>
                            <div class="line"></div>
                            <div class="youtube_box"
                                onclick="playVideo('https://www.youtube.com/embed/zlM9SWT7uYg?autoplay=1&mute=1&controls=0&loop=1&playlist=zlM9SWT7uYg')">
                                <p>
                                    <em>입시덕후</em>
                                    새학기 필수 코디 모음!
                                </p>
                                <div class="youtube_thum"><img src="../assets/img/ipsidokhoo.jpg" alt=""></div>
                                <a href="https://www.youtube.com/watch?v=zlM9SWT7uYg" target="_blank"><img
                                        src="../assets/img/link_btn.png" alt=""></a>
                            </div>
                            <div class="line"></div>
                            <div class="youtube_box"
                                onclick="playVideo('https://www.youtube.com/embed/IbVM7gXTtkw?autoplay=1&mute=1&controls=0&loop=1&playlist=IbVM7gXTtkw')">
                                <p>
                                    <em>예보링</em>
                                    SCHOOL LOOK BOOK
                                </p>
                                <div class="youtube_thum"><img src="../assets/img/yeboring.jpg" alt=""></div>
                                <a href="https://www.youtube.com/watch?v=IbVM7gXTtkw" target="_blank"><img
                                        src="../assets/img/link_btn.png" alt=""></a>
                            </div>
                        </div>
                    </div>
                    <script>
                        function playVideo(videoUrl) {
                            const videoIframe = document.getElementById('videoIframe');
                            videoIframe.src = videoUrl;
                        }
                    </script>
                    <div class="section04_right">
                        <div class="media_mark">
                            <img src="../assets/img/youtube_media_text.png" alt="">
                        </div>
                        <div class="media_text">
                            <div class="logo_text">
                                <img src="../assets/img/logo3.png" alt="">추천
                            </div>
                            <h3>SCHOOL LOOK BOOK</h3>
                            <p>우리 학교 <em>교복</em>에 어울리는 <em>코디 룩북</em></p>
                            <p class="small_p">
                                요즘엔 교복도 패션!<br>
                                우리 학교 교복에는 어떤 아우터가 어울릴지, 영상으로 참고해보세요.<br>
                                어떤 영상을 참고해야할지 모르겠다면? <em>Go교복!</em>이 추천해드릴게요!
                            </p>
                            <a href="https://www.youtube.com/" target="_blank"><img src="../assets/img/youtube_btn.png"
                                    alt=""></a>
                        </div>
                    </div>
                </div>
            </section>
            <!-- //section04 -->
        </div>
    </main>



    <?php include "../include/footer.php" ?>
    <!-- //footer -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>

    <script>
        const target = gsap.utils.toArray(".split");
        target.forEach(target => {
            let splitClient = new SplitType(target, {
                type: "char"
            });
            let chars = splitClient.chars;

            gsap.from(chars, {
                yPercent: 100,
                opacity: 0,
                rotation: 30,
                duration: 0.5,
                stagger: 0.05,
                scrollTrigger: {
                    trigger: target,
                    start: "top bottom",
                    end: "+400",
                }
            })
        });
    </script>

</body>

</html>