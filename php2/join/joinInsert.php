<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>회원가입 페이지</title>

    <!-- CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">

    <style>
        #layer {
            position: fixed;
            overflow: hidden;
            z-index: 1;
            -webkit-overflow-scrolling: touch;
        }
        #layer img {
            position: absolute;
            right: -3px;
            top: -3px;
            width: 20px;
            height: 20px;
            z-index: 1;
            cursor: pointer;
        }
    </style>
    </style>
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
                    <li><a href="../join/joinAgree.php">회원가입</a></li>
                </ul>
            </div>
        </div>
        <nav class="nav__inner">
            <ul>
                <li><a href="../join/joinAgree.php">회원가입</a></li>
                <li><a href="../login/login.php">로그인</a></li>
                <li><a href="../board/board.php">게시판</a></li>
                <li><a href="../blog/blog.php">블로그</a></li>
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
            <h2>이용약관</h2>
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
                            <label for="youName" class="required">이름</label>
                            <input type="text" id="youName" name="youName" placeholder="이름을 적어주세요!" class="input__style">
                            <p class="msg" id="youNameComment"></p>
                        </div>

                        <div class="join">
                            <label for="youEmail" class="required">이메일</label>
                            <div class="check">
                                <input type="email" id="youEmail" name="youEmail" placeholder="이메일을 적어주세요!" class="input__style">
                                <div class="btn" onclick="emailChecking()">이메일 중복 검사</div>
                            </div>
                            <p class="msg" id="youEmailComment"></p>
                        </div>

                        <div class="join">
                            <label for="youPass" class="required">비밀번호</label>
                            <input type="text" id="youPass" name="youPass" placeholder="비밀번호를 적어주세요!" autocomplete="off" class="input__style">
                            <p class="msg" id="youPassComment"></p>
                        </div>

                        <div class="join">
                            <label for="youPassC" class="required">비밀번호 확인</label>
                            <input type="password" id="youPassC" name="youPassC" placeholder="다시 한번 비밀번호를 적어주세요!" autocomplete="off" class="input__style">
                            <p class="msg" id="youPassCComment"></p>
                        </div>
                    
                        <div class="join">
                            <label for="youAddress1" class="required">주소</label>
                            <div class="check">
                                <input type="text" id="youAddress1" name="youAddress1" placeholder="우편번호" class="input__style">
                                <div class="btn" id="addressCheck">주소 찾기</div>
                            </div>
                            <label for="youAddress2" class="required blind">주소</label>
                            <input type="text" id="youAddress2" name="youAddress2" placeholder="주소" class="input__style">
                            <label for="youAddress3" class="required blind">상세 주소</label>
                            <input type="text" id="youAddress3" name="youAddress3" placeholder="상세 주소" class="input__style">
                            <p class="msg" id="youAddressComment"></p>
                        </div>

                        <div class="join">
                            <label for="youPhone">연락처</label>
                            <input type="text" id="youPhone" name="youPhone" placeholder="연락처는 공백없이 적어주세요!" class="input__style">
                            <p class="msg" id="youPhoneComment"></p>
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

    <div id='layer'>
        <img src="//t1.daumcdn.net/postcode/resource/images/close.png" id="btnCloseLayer" alt="닫기 버튼">
    </div>

    
    <script src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
    <script>
        // 우편번호 찾기 화면을 넣을 element
        const layer = document.querySelector("#layer");
        const searchIcon = document.querySelector("#addressCheck");
        const layerCloseBtn = document.querySelector("#btnCloseLayer");

        searchIcon.addEventListener('click', searchBtnClick);
        layerCloseBtn.addEventListener('click', closeDaumPostcode);

        function closeDaumPostcode() {
            // iframe을 넣은 element를 안보이게 한다.
            layer.style.display = 'none';
        }

        const themeObj = {
            //bgColor: "", //바탕 배경색
            searchBgColor: "#0B65C8", //검색창 배경색
            //contentBgColor: "", //본문 배경색(검색결과,결과없음,첫화면,검색서제스트)
            //pageBgColor: "", //페이지 배경색
            //textColor: "", //기본 글자색
            queryTextColor: "#FFFFFF" //검색창 글자색
            //postcodeTextColor: "", //우편번호 글자색
            //emphTextColor: "", //강조 글자색
            //outlineColor: "", //테두리
        };

        function searchBtnClick() {
            new daum.Postcode({
                theme: themeObj,
                oncomplete: function (data) {
                    // 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

                    // 각 주소의 노출 규칙에 따라 주소를 조합한다.
                    // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
                    let addr = ''; // 주소 변수
                    let extraAddr = ''; // 참고항목 변수

                    //사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
                    if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                        addr = data.roadAddress;
                    } else { // 사용자가 지번 주소를 선택했을 경우(J)
                        addr = data.jibunAddress;
                    }

                    /*
                    // 사용자가 선택한 주소가 도로명 타입일때 참고항목을 조합한다.
                    if (data.userSelectedType === 'R') {
                        // 법정동명이 있을 경우 추가한다. (법정리는 제외)
                        // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
                        if (data.bname !== '' && /[동|로|가]$/g.test(data.bname)) {
                            extraAddr += data.bname;
                        }
                        // 건물명이 있고, 공동주택일 경우 추가한다.
                        if (data.buildingName !== '' && data.apartment === 'Y') {
                            extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                        }
                        // 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
                        if (extraAddr !== '') {
                            extraAddr = ' (' + extraAddr + ')';
                        }
                        // 조합된 참고항목을 해당 필드에 넣는다.
                        document.getElementById("sample2_extraAddress").value = extraAddr;

                    } else {
                        document.getElementById("sample2_extraAddress").value = '';
                    }
                    */


                    document.querySelector('#youAddress1').value = data.zonecode; // 우편번호
                    document.querySelector("#youAddress2").value = addr; // 주소
                    document.querySelector("#youAddress3").focus();

                    // iframe을 넣은 element를 안보이게 한다.
                    // (autoClose:false 기능을 이용한다면, 아래 코드를 제거해야 화면에서 사라지지 않는다.)
                    layer.style.display = 'none';
                },
                width: '100%',
                height: '100%',
                maxSuggestItems: 5
            }).embed(layer);

            // iframe을 넣은 element를 보이게 한다.
            layer.style.display = 'block';

            // iframe을 넣은 element의 위치를 화면의 가운데로 이동시킨다.
            initLayerPosition();
        }

        // 브라우저의 크기 변경에 따라 레이어를 가운데로 이동시키고자 하실때에는
        // resize이벤트나, orientationchange이벤트를 이용하여 값이 변경될때마다 아래 함수를 실행 시켜 주시거나,
        // 직접 layer의 top,left값을 수정해 주시면 됩니다.
        function initLayerPosition() {
            const width = 500; //우편번호서비스가 들어갈 element의 width
            const height = 500; //우편번호서비스가 들어갈 element의 height
            const borderWidth = 5; //샘플에서 사용하는 border의 두께

            // 위에서 선언한 값들을 실제 element에 넣는다.
            layer.style.width = width + 'px';
            layer.style.height = height + 'px';
            layer.style.border = borderWidth + 'px solid';
            // 실행되는 순간의 화면 너비와 높이 값을 가져와서 중앙에 뜰 수 있도록 위치를 계산한다.
            layer.style.left = (((window.innerWidth || document.documentElement.clientWidth) - width) / 2 - borderWidth) + 'px';
            layer.style.top = (((window.innerHeight || document.documentElement.clientHeight) - height) / 2 - borderWidth) + 'px';
        }
    </script>
    <!-- // 주소찾기 -->
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>
        let isIdCheck = false;
        let isEmailCheck = false;

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

        function emailChecking(){
            let youEmail = $("#youEmail").val();

            if (youEmail == null || youEmail == ''){
                $("#youEmailComment").text("** 이메일을 입력해주세요!!!");
            } else {
                // 이메일 유효성 검사
                let getYouEmail = RegExp(/^[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([\-.]?[0-9a-zA-Z])*\.[a-zA-Z]{2,3}$/i);

                if(!getYouEmail.test($("#youEmail").val())){
                    $("#youEmailComment").text("** 올바른 이메일 주소를 입력해주세요!");
                    $("#youEmail").val('')
                    $("#youEmail").focus();
                    return false;
                } else {
                    $("#youEmailComment").text("올바른 이메일입니다.");
                }

                $.ajax({
                    type: "POST",
                    url: "joinCheck.php",
                    data: {"youEmail": youEmail, "type": "isEmailCheck"},
                    dataType: "json",
                    success: function(data){
                        if(data.result == "good"){
                            $("#youEmailComment").text("사용 가능한 이메일입니다.");
                            isEmailCheck = true;
                        } else {
                            $("#youEmailComment").text("이미 존재하는 이메일입니다.");
                            isEmailCheck = false;
                        }
                    }
                })
            }
        }

        function joinChecks(){
            // 중복 확인이 이루어 졌는지 검사
            if(!isIdCheck || !isEmailCheck){
                alert("중복 검사를 먼저 진행해주세요!");
                return false;
            }

            // 이름 유효성 검사 
            if( $("#youName").val() == '' ){
                $("#youNameComment").text("이름을 입력해주세요!");
                $("#youName").focus();
                return false;
            } else {
                let getYouName = RegExp(/^[가-힣]{3,5}$/);

                if(!getYouName.test($("#youName").val())){
                    $("#youNameComment").text("이름은 한글(3~5글자)만 사용할 수 있습니다.");
                    $("#youName").val(''); 
                    $("#youName").focus(); 
                    return false;
                }
            }

            // 비밀번호 유효성 검사
            if( $("#youPass").val() == '' ){
                $("#youPassComment").text("비밀번호를 입력해주세요!");
                $("#youPass").focus();
                return false; 
            } else {
                let getYouPass = $("#youPass").val();
                let getYouPassNum = getYouPass.search(/[0-9]/g);
                let getYouPassEng = getYouPass.search(/[a-z]/ig);
                let getYouPassSpe = getYouPass.search(/[`~!@@#$%^&*|₩₩₩'₩";:₩/?]/gi);

                if(getYouPass.length < 8 || getYouPass.length > 20){
                    $("#youPassComment").text("➟ 8자리 ~ 20자리 이내로 입력해주세요");
                    return false;
                } else if (getYouPass.search(/\s/) != -1){
                    $("#youPassComment").text("➟ 비밀번호는 공백없이 입력해주세요!");
                    return false;
                } else if (getYouPassNum < 0 || getYouPassEng < 0 || getYouPassSpe < 0 ){
                    $("#youPassComment").text("➟ 영문, 숫자, 특수문자를 혼합하여 입력해주세요!");
                    return false;
                } 
            }

            // 비밀번호 확인 유효성 검사
            if($("#youPassC").val() == ''){
                $("#youPassCComment").text("➟ 확인 비밀번호를 입력해주세요!");
                $("#youPassC").focus();
                return false;
            }

            // 비밀번호 동일한지 체크
            if($("#youPass").val() !== $("#youPassC").val()){
                $("#youPassCComment").text("➟ 비밀번호가 일치하지 않습니다.");
                $("#youPass").focus();
                return false;
            } 

            // 연락처 유효성 검사
            let getYouPhone = RegExp(/^[0-9]{10,11}$/); // 10자리 또는 11자리 숫자);

            if(!getYouPhone.test($("#youPhone").val())){
                $("#youPhoneComment").text("➟ 휴대폰 번호가 정확하지 않습니다.(하이픈 없이 숫자만 적어주세요!)");
                $("#youPhone").val('');
                $("#youPhone").focus();
            }
        }
    </script>
</body>
</html>