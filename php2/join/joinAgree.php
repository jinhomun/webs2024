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
                <a href="/php2/index.html">
                    <span class="blind">메인으로</span>
                </a>
            </div>
            <div class="logo">
                <a href="main.html"> Developer Blog</a>
            </div>
            <div class="right">
                <ul>
                    <li><a href="join.html">회원가입</a></li>
                </ul>
            </div>
        </div>
        <nav class="nav__inner">
            <ul>
                <li><a href="#">회원가입</a></li>
                <li><a href="#">로그인</a></li>
                <li><a href="#">게시판</a></li>
                <li><a href="#">블로그</a></li>
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
                    <li class="active">1</li>
                    <li>2</li>
                    <li>3</li>
                </ul>
            </div>
            <div class="join__agree">
                <div class="agree__box">
                    <h3 class="blind">웹쓰 블로그 이용약관</h3>
                    <div class="scroll scroll__style">1. 서론
                        1.1 이 이용약관은 [블로그 이름] ("블로그" 또는 "저희")를 이용하는 모든 사용자(이하 "사용자" 또는 "회원")에게 적용됩니다. 이용약관을 읽고 이해하신 후, 본 블로그를 이용하시기 전에 본 이용약관을 주의 깊게 살펴보시기를 권장합니다.
                        
                        2. 이용자 권리와 책임
                        2.1 회원은 본 블로그를 사용함으로써 다음을 동의합니다:
                        2.1.1 다른 회원의 개인 정보를 존중하며 개인 정보 보호 정책을 준수합니다.
                        2.1.2 불법 콘텐츠의 게시, 공유, 또는 홍보를 하지 않으며 타인의 저작권 및 상표권을 존중합니다.
                        2.1.3 사용자들 간의 존중과 상호 작용을 촉진하기 위해 다른 회원에 대한 비방, 괴롭힘, 혐오 발언 등을 허용하지 않습니다.

                        3. 콘텐츠 관리
                        3.1 블로그 관리자는 회원이 게시한 콘텐츠를 심사하고 필요한 경우 수정, 삭제 또는 거부할 권리가 있습니다.
                        3.2 회원은 자신의 콘텐츠가 법률, 규정 또는 이용약관을 위반하지 않도록 주의하여야 합니다.

                        4. 저작권
                        4.1 회원이 게시한 콘텐츠의 권리는 해당 회원에게 속하며, 블로그는 회원의 콘텐츠를 상업적으로 이용하지 않습니다.

                        5. 책임 제한
                        5.1 블로그는 회원 간의 상호 작용 및 제3자 웹사이트나 서비스와의 연결에 대한 책임을 지지 않습니다.
                        5.2 블로그는 시스템 장애 또는 서비스 일시 중단으로 인한 손해에 대한 책임을 부인합니다.

                        6. 이용약관 변경
                        6.1 블로그는 언제든 이용약관을 변경하거나 수정할 권리를 보유하며, 변경된 약관은 블로그 내에서 공지됩니다.

                        7. 종료
                        7.1 회원은 언제든지 본 블로그 이용을 중단할 수 있으며, 블로그 또한 회원에 대한 액세스를 종료할 권리를 보유합니다.

                        8. 연락처 정보
                        8.1 본 블로그와 관련된 문의 사항 또는 불만 사항은 다음 연락처를 통해 문의할 수 있습니다:

                        이메일 주소: [이메일 주소]
                        주소: [주소]
                    </div>
                    <div class="check">
                        <label for="agreeCheck1">
                            블로그 이용약관에 동의합니다.
                            <input type="checkbox" name="agreeCheck1" id="agreeCheck1">
                            <span class="indicator"></span>
                        </label>
                    </div>
                </div>
                <div class="agree__box">
                    <h3 class="blind">웹쓰 블로그 개인정보취급방침</h3>
                    <div class="scroll scroll__style">1. 개인 정보 수집
                        1.1 본 블로그는 회원 가입 및 콘텐츠 작성을 위해 필요한 개인 정보를 수집할 수 있습니다. 수집되는 정보는 다음과 같을 수 있습니다:
                        - 이름, 이메일 주소, 프로필 사진, 기타 선택적 정보

                        1.2 개인 정보는 회원의 동의 하에 수집되며, 회원은 언제든지 개인 정보를 제공하지 않을 권리가 있습니다. 그러나 일부 정보는 블로그를 이용하기 위해 필요할 수 있습니다.

                        2. 개인 정보 사용
                        2.1 블로그는 수집한 개인 정보를 다음 목적으로 사용할 수 있습니다:
                        - 회원 가입 및 로그인 관리, 콘텐츠 작성 및 수정, 연락과 응답, 블로그 서비스의 향상, 법적 요구 사항 준수
                        
                        3. 개인 정보 보호
                        3.1 블로그는 회원의 개인 정보를 안전하게 보호하기 위해 적절한 보안 조치를 취하며, 무단 액세스, 유출, 변경 또는 파괴를 방지하기 위해 최선을 다합니다.

                        4. 개인 정보 공유
                        4.1 블로그는 회원의 개인 정보를 본 방침에 명시된 목적 외에는 공유하지 않으며, 법적 요구 사항이나 다른 합법적인 사유에 따라 정보를 공유할 수 있습니다.

                        5. 쿠키와 추적 기술
                        5.1 블로그는 쿠키와 유사한 기술을 사용하여 사용자의 활동을 추적하고 분석하는 목적으로 정보를 수집할 수 있습니다. 이 정보는 사용자 경험을 향상시키기 위해 사용됩니다.

                        6. 개인 정보 열람 및 수정
                        6.1 회원은 언제든지 자신의 개인 정보를 열람하고 수정할 권리가 있습니다. 개인 정보 열람 및 수정은 회원의 프로필 설정을 통해 가능합니다.

                        7. 개인 정보 보유 기간
                        7.1 블로그는 회원의 개인 정보를 더 이상 필요하지 않은 경우에만 보관하며, 법률적인 의무 또는 다른 합법적인 이유로 인해 정보를 보관할 수 있습니다.

                        8. 연락처 정보
                        8.1 본 블로그와 관련된 개인 정보 취급 방침과 관련된 문의 사항은 다음 연락처를 통해 문의할 수 있습니다:

                        이메일 주소: [이메일 주소]
                        주소: [주소]
                    </div>
                    <div class="check">
                        <label for="agreeCheck2">
                            블로그 개인정보 수집 및 이용에 동의합니다.
                            <input type="checkbox" name="agreeCheck2" id="agreeCheck2">
                            <span class="indicator"></span>
                        </label>
                    </div>
                </div>
                <button id="agreeButton" class="btn__style">동의하기</button>
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
    <!-- //footer -->

    <script>
        document.getElementById("agreeButton").addEventListener("click", () => {
            const agreeCheck1 = document.getElementById("agreeCheck1");
            const agreeCheck2 = document.getElementById("agreeCheck2");

            if(agreeCheck1.checked && agreeCheck2.checked){
                window.location.href = "joinInsert.php";
            } else {
                alert("이용약관 및 개인정보취급방침을 동의해주세요!");
            }
        });
    </script>
</body>
</html>