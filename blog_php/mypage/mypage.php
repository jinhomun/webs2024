<?php
include "../connect/connect.php";
include "../connect/session.php";

// echo "<pre>";
// var_dump($_SESSION);
// echo "</pre>";

if (isset($_SESSION['youId'])) {
    $youId = $_SESSION['youId'];

    // 데이터베이스에서 사용자 정보 가져오기
    $query = "SELECT * FROM blog_myMembers WHERE youId = ?";

    if ($stmt = $connect->prepare($query)) {
        $stmt->bind_param("s", $youId);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $user_data = $result->fetch_assoc();
            // $user_data에 사용자 정보가 저장됨
            $youName = $user_data['youName'];
            $youEmail = $user_data['youEmail'];

            // 주소를 가져와서 일반 주소와 상세 주소로 나눔
            $youFullAddress = $user_data['youAddress'];
            $address_parts = explode(' ', $youFullAddress);

            // 주소의 공백이 5번째 이상인 경우 상세 주소로 처리
            $youAddress2 = '';
            $youAddress3 = '';
            for ($i = 0; $i < count($address_parts); $i++) {
                if ($i < 5) {
                    $youAddress2 .= $address_parts[$i] . ' ';
                } else {
                    $youAddress3 .= $address_parts[$i] . ' ';
                }
            }

            $youPhone = $user_data['youPhone'];
        }

        $stmt->close();
    }
} else {
    // 사용자가 로그인되지 않은 경우 처리
    // 사용자를 로그인 페이지로 리디렉션하거나 다른 조치를 취합니다.
}


?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Go!교복</title>

    <link rel="stylesheet" href="../assets/css/login.css">
    <link rel="stylesheet" href="../assets/css/mypage.css">
    <style>
        .mypage__inner {
            padding: 5rem 0;
        }

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

        #infoIframe {
            display: none;
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

            .mypage__inner>p {
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
    <!-- //header -->


    <main id="main" role="main">
        <?php include "../mypage/mypageAside.php" ?>
        <section id="infoChange" class="join__inner join__join mypage__inner container">
            <h2>내 정보 변경</h2>
            <p>😊 회원가입 시 등록한 내 정보를 수정할 수 있습니다.</p>
            <div class="join__form join__form__cont">
                <form action="mypageInfoEnd.php" name="mypageInfoEnd" method="post" onsubmit="return joinChecks();">
                    <div class="check_input">
                        <label for="youId" class="required">아이디</label>
                        <input type="text" id="youId" name="youId" value="<?php echo $youId; ?>" class="input__style"
                            disabled>
                        <p class="msg" id="youIdComment">**아이디는 변경할 수 없습니다.</p>
                    </div>
                    <div class="check_input">
                        <label for="youName" class="required">이름</label>
                        <input type="text" id="youName" name="youName" value="<?php echo $youName; ?>"
                            placeholder="이름을 적어주세요!" class="input__style">
                        <p class="msg" id="youNameComment"></p>
                    </div>
                    <div class="check_input">
                        <label for="youEmail" class="required">이메일</label>
                        <input type="email" id="youEmail" name="youEmail" value="<?php echo $youEmail; ?>"
                            placeholder="이메일을 적어주세요!" class="input__style" disabled>
                        <p class="msg" id="youEmailComment">**이메일은 변경할 수 없습니다.</p>
                    </div>

                    <div class="check_input confirm__adress">
                        <label for="youAddress1" class="required">주소</label>
                        <div class="confirm__input">
                            <input type="text" id="youAddress1" name="youAddress1" placeholder="우편번호"
                                class="input__style">
                            <div id="addressCheck">주소 검색</div>
                        </div>
                        <label for="youAddress2" class="required blind">주소</label>
                        <input type="text" id="youAddress2" name="youAddress2" value="<?php echo $youAddress2; ?>"
                            placeholder="주소" class="input__style">
                        <label for="youAddress3" class="required blind">상세 주소</label>
                        <input type="text" id="youAddress3" name="youAddress3" value="<?php echo $youAddress3; ?>"
                            placeholder="상세 주소" class="input__style">
                        <p class="msg" id="youAddressComment"></p>
                    </div>
                    <div class="check_input">
                        <label for="youPhone">연락처</label>
                        <input type="text" id="youPhone" name="youPhone" value="<?php echo $youPhone; ?>"
                            placeholder="연락처를 적어주세요!" class="input__style">
                        <p class="msg" id="youPhoneComment"></p>
                    </div>

                    <button type="submit" id="mypageSubmit" class="btn__style mt100 join_result_btn"
                        style="color: #fff;">정보 변경하기</button>
                </form>
            </div>
        </section>
    </main>

    <?php include "../include/footer.php" ?>
    <!-- //footer -->

    <div id="layer">
        <img src="//t1.daumcdn.net/postcode/resource/images/close.png" id="btnCloseLayer" alt="닫기 버튼">
    </div>


    <script src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>

    <script>
        function joinChecks() {

            // 이름 유효성 검사
            if ($("#youName").val() == '') {
                $("#youNameComment").text("이름을 입력해주세요.")
                $("#youName").focus();
                return false;
            } else {
                let getYouName = RegExp(/^[가-힣]{3,5}$/);

                if (!getYouName.test($("#youName").val())) {
                    $("#youNameComment").text("이름은 한글(3~5글자)만 사용할 수 있습니다.");
                    $("#youName").val('');
                    $("#youName").focus();
                    return false;
                }
            }


            // 연락처 유효성 검사
            if ($("#youPhone").val() === '') {
                $("#youPhoneComment").text("연락처를 입력해주세요.");
                $("#youPhone").focus();
                return false;
            } else {
                let phoneNumberPattern = /^(01[016789])-(\d{3,4})-(\d{4})$/;

                if (!phoneNumberPattern.test($("#youPhone").val())) {
                    $("#youPhoneComment").text("➟ 유효한 휴대폰 번호를 입력해주세요. (예: 010-1234-5678)");
                    $("#youPhone").val('');
                    $("#youPhone").focus();
                    return false;
                }
            }

        }
    </script>

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
            layer.style.left = (((window.innerWidth || document.documentElement.clientWidth) - width) / 2 - borderWidth) +
                'px';
            layer.style.top = (((window.innerHeight || document.documentElement.clientHeight) - height) / 2 - borderWidth) +
                'px';
        }
    </script>
</body>

</html>