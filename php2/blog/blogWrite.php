

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
                <a href="../main/main.php"> Debeloper Blog</a>
            </div>
            <div class="right">
                    <ul>
                        <li><a href="#">문진호님 환영합니다.</a></li>
                        <li><a href="../login/logout.php">로그아웃</a></li>
                    </ul>
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
        <div class="intro__inner blogStyle bmStyle container">
            <div class="intro__img main">
                <img srcset="../assets/img/intro01.jpg 1x, ../assets/img/intro01@2x.jpg 2x, ../assets/img/intro01@3x.jpg 3x"  alt="소개 이미지">
            </div>
            <div class="intro__text">
                <h3>블로그 글쓰기</h3>
                <p>최신 정보와 관련된 블로그 글을 쓸 수 있습니다.</p>
            </div>
        </div>

        <div class="blog__layout container">
            <div class="blog__contents">
                <section class="blog__write">
                    <form action="blogWriteSave.php" name="blogWriteSave" method="post" enctype="multipart/form-data">
                        <fieldset>
                            <legend class="blind">게시글 작성하기</legend>
                            <div>
                                <label for="blogCategory" class="blind">카테고리</label>
                                <select name="blogCategory" id="blogCategory">
                                    <option value="최신정보">최신 정보</option>
                                    <option value="해외축구정보">해외축구 정보</option>
                                    <option value="국내축구정보">국내축구 정보</option>
                                </select>
                            </div>
                            <div>
                                <label for="blogTitle" class="blind">제목</label>
                                <input type="text" id="blogTitle" name="blogTitle" placeholder="제목을 적어주세요!" class="input__style" required>
                            </div>
                            <div>
                                <label for="blogContents" class="blind">내용</label>
                                <textarea id="blogContents" name="blogContents" placeholder="내용을 적어주세요!"></textarea>
                            </div>
                            <div class="file">
                                <label for="blogFile" class="blind">파일</label>
                                <input type="file" id="blogFile" name="blogFile" accept=".jpg, .jpeg, .png, .gif, .webp">
                                <p>* jpg, gif, png, webp 파일만 넣을 수 있습니다. 이미지 용량은 1MB를 넘길 수 없습니다.</p>
                            </div>
                            <div class="btn">
                                <button type="submit" class="btn__style3">저장하기</button>
                            </div>
                        </fieldset>
                    </form>
                </section>
            </div>
            <div class="blog__aside">
                <article class="blog__ad">
                    <script src="https://ads-partners.coupang.com/g.js"></script>
                    <script>new PartnersCoupang.G({"id":722571,"template":"carousel","trackingCode":"AF6202415","width":"300","height":"300","tsource":""});</script>
                </article>                <!-- //blog__ad -->

                <article class="blog__intro">blog__intro</article>                <!-- //blogIntro -->

                <article class="blog__category">blog__category</article>                <!-- //blogCategory -->

                <article class="blog__popular">blog__popular</article>                <!-- //blogPopular -->
                
                <article class="blog__comment">blog__comment</article>                <!-- //blogComment -->
            </div>
        </div>
    </main>
    <!-- //main -->

    <footer id="footer" role="contentinfo">
        <div class="footer__inner container btStyle">
            <div>Copyright 2023 jinhomun</div>
            <div>blog by webs</div>
        </div>
</footer>    <!-- //foter -->

    <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/translations/ko.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#blogContents'), {
                language: 'ko' 
            })
            .catch(error => {
                console.error(error);
            });
    </script>
</body>
</html>