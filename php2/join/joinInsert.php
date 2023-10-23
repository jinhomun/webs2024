<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>회원가입 페이지</title>

    <!-- CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="gray"> 
    <div id="skip">
        <a href="#header">헤더 영역 바로가기</a>
        <a href="#main">콘텐츠 영역 바로가기</a>
        <a href="#footer">푸터 영역 바로가기</a>
    </div>

    <header id="header" role="banner">
        <div class="header__inner container">
            <div class="left">
                <a href="../index.html">
                    <span class="blind">메인으로</span>
                </a>
            </div>
            <div class="logo">
                <a href="main.html">Developer Blog</a>
            </div>
            <div class="right">
                <ul>
                    <li><a href="join.html">회원가입</a></li>
                </ul>
            </div>
        </div>
        <nav class="nav__inner">
            <ul>
                <li><a href="join.html">회원가입</a></li>
                <li><a href="login.html">로그인</a></li>
                <li><a href="board.html">게시판</a></li>
                <li><a href="blog.html">블로그</a></li>
            </ul>
        </nav>
    </header>
    <!-- //header -->

    <main id="main" role="main">
        <div class="intro__inner bmStyle container">
            <div class="intro__img">
                <img srcset="../assets/img/intro02-min.jpg 1x, ../assets/img/intro02@2x-min.jpg 2x, ../assets/img/intro02@3x-min.jpg 3x"  alt="소개 이미지">
            </div>
            <div class="intro__text">
                회원가입을 해주시면 다양한 정보를 자유롭게 볼 수 있습니다. 
            </div>
        </div>
        <section class="join__inner container">
            <h2>회원정보 입력</h2>
            <div class="join__index">
                <ul>
                    <li>1</li>
                    <li class="active">2</li>
                    <li>3</li>
                </ul>
            </div>
            <div class="join__insert">
                <form action="joinResult.php" name="joinResult" method="post" onsubmit="return joinChecks();">
                    <fieldset>
                        <legend class="blind">회원가입 영역</legend>
                        <div class="join">
                            <label for="youId" class="required">아이디</label>
                            <div class="check">
                                <input type="text" id="youId" name="youId" placeholder="아이디을 적어주세요!" class="input__style">
                                <div class="btn" onclick="idChecking()">아이디 중복 검사</div>
                            </div>
                            <p class="msg" id="youIdComment"></p>
                        </div>

                        <div class="join">
                            <label for="memberName" class="required">이름</label>
                            <input type="text" id="memberName" name="memberName" placeholder="이름을 적어주세요!" class="input__style">
                            <p class="msg" id="memberNameMsg"></p>
                        </div>

                        <div class="join">
                            <label for="memberEmail" class="required">이메일</label>
                            <div class="check">
                                <input type="email" id="memberEmail" name="memberEmail" placeholder="이메일을 적어주세요!" class="input__style">
                                <div class="btn" onclick="emailChecking()">이메일 중복 검사</div>
                            </div>
                            <p class="msg" id="memberEmailMsg"></p>
                        </div>

                        <div class="join">
                            <label for="memberPass" class="required">비밀번호</label>
                            <input type="text" id="memberPass" name="memberPass" placeholder="비밀번호를 적어주세요!" autocomplete="off" class="input__style">
                            <p class="msg" id="memberPassMsg"></p>
                        </div>

                        <div class="join">
                            <label for="memberPassC" class="required">비밀번호 확인</label>
                            <input type="password" id="memberPassC" name="memberPassC" placeholder="다시 한번 비밀번호를 적어주세요!" autocomplete="off" class="input__style">
                            <p class="msg" id="memberPassCMsg"></p>
                        </div>
                    
                        <div class="join">
                            <label for="memberAddress1" class="required">주소</label>
                            <div class="check">
                                <input type="text" id="memberAddress1" name="memberAddress1" placeholder="우편번호" class="input__style">
                                <button class="btn">주소 찾기</button>
                            </div>
                            <label for="memberAddress2" class="required blind">주소</label>
                            <input type="text" id="memberAddress2" name="memberAddress2" placeholder="주소" class="input__style">
                            <label for="memberAddress3" class="required blind">상세 주소</label>
                            <input type="text" id="memberAddress3" name="memberAddress3" placeholder="상세 주소" class="input__style">
                            <p class="msg" id="memberAddressMsg"></p>
                        </div>

                        <div class="join">
                            <label for="memberPhone">연락처</label>
                            <input type="text" id="memberPhone" name="memberPhone" placeholder="연락처는 공백없이 적어주세요!" class="input__style">
                            <p class="msg" id="memberPhoneMsg"></p>
                        </div> 

                        <button type="submit" id="submitBtn" class="btn__style mt100">회원가입 완료</button>
                    </fieldset>
                </form>
            </div>
        </section>
    </main>
    <!-- //main -->

    <footer id="footer" role="contentinfo">
        <div class="footer__inner container btStyle">
            <div>Copyright 2023 jinhomun</div>
            <div>blog by webs</div>
        </div>
    </footer>
    <!-- //foter -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>
        let isIdCheck = false;

        function idChecking(){
            let youId = $("#youId").val();

            if (youId == null || youId == ''){
                $("#youIdComment").text("** 아이디를 입력해주세요!!!");
            } else {
                // 아이디 유효성 검사
                let getYouId = RegExp(/^[a-zA-Z0-9_-]{4,20}$/);

                if(!getYouId.test($("#youId").val())){
                    $("#youIdComment").text("아이디는 영어와 숫자를 포함하여 4~20글자 이내로 작성이 가능합니다.");
                    $("#youId").val('')
                    $("#youId").focus();
                    return false;
                } else {
                    $("#youIdComment").text("멋진 아이디입니다.");
                    $("#youIdComment").addClass("green");
                }

                $.ajax({
                    type: "POST",
                    url: "joinCheck.php",
                    data: {"youId": youId, "type": "isIdCheck"},
                    dataType: "json",
                    success: function(data){
                        if(data.result == "good"){
                            $("#youIdComment").text("사용 가능한 아이디입니다.");
                            isIdCheck = true;
                        } else {
                            $("#youIdComment").text("이미 존재하는 아이디입니다.");
                            isIdCheck = false;
                        }
                    }
                })
            }
        }

        function joinChecks(){

            if( $("#youId").val() == '' ){
                $("#youIdComment").text("-> 아이디를 작성해주세요!");
                $("#youId").focus();
                return false;
            }
        }
    </script>
</body>
</html>