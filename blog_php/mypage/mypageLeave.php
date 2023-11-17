<?php
    include "../connect/connect.php";
    include "../connect/session.php";

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
            min-height: 90vh;
        }
        .join__form div.check {
            margin: 10px 0 3rem;
        }
        .join__form div.check label {
            font-weight: 100;
            font-size: 15px;
            display: flex;
            align-items: center;
            line-height: 1.5;
            padding-top: 5px;
            justify-content: flex-end;
        }
        .join__form div.check input {
            margin-right: 6px;
            margin-bottom: 4px;
            width: 17px;
            height: 17px;
        }
        .join__form.join__form__cont {
            margin: 0;
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
            }
            .agree__text {
                font-size: 13px;
                overflow: auto;
            }
            .join__form div.check label {
                justify-content: flex-start;
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
    
    <main id="main">
        <?php include "../mypage/mypageAside.php" ?>
        <section class="join__inner join__join mypage__inner container">
            <h2>회원 탈퇴하기</h2>
            <p>😭 Go교복! 회원 탈퇴를 위해 약관 동의를 해주세요.</p>
            <div class="join__form join__form__cont">
                <form action="LeaveEnd.php" name="LeaveEnd" method="post" onsubmit="return joinChecks();">
                    <div class="join__agree">
                        <div class="agree__box">
                            <div class="agree__text" style="white-space: pre; text-align: left; font-weight: 100;">[회원탈퇴 약관]

회원탈퇴 신청 전 안내 사항을 확인해주세요.
회원탈퇴를 신청하시면 현재 로그인 된 아이디는 사용하실 수 없습니다. 
회원탈퇴를 하더라도, 서비스 약관 및 개인정보 취급방침 동의하에 따라 일정 기간동안 
회원 개인정보를 보관합니다. 

- 회원 정보
- 게시글 작성 및 댓글, 좋아요 클릭 수</div>
                            
                        </div>
                        
                    </div>
                    <div class="check">
                        <label for="agreeCheck">
                            <input type="checkbox" name="agreeCheck" id="agreeCheck">
                            안내 사항을 모두 확인하였으며, 이에 동의합니다.
                        </label>
                    </div>
                    <button type="button" class="btn__style mt100 join_result_btn" style="color: #fff;" onclick="confirmLeave()">탈퇴하기</button>

                </form>
            </div>
        </section>
    </main>
    <!-- //main -->

    <?php include "../include/footer.php" ?>
    <!-- //footer -->

    <script>
        function confirmLeave() {
            var agreeCheck = document.getElementById('agreeCheck').checked;
            if (agreeCheck) {
                // 확인 알림 대화 상자 표시
                if (confirm("정말로 회원 탈퇴를 하시겠습니까?")) {
                    // 확인 버튼을 클릭한 경우
                    // LeaveEnd.php 파일로 제출
                    document.forms["LeaveEnd"].submit();
                }
            } else {
                alert("먼저 약관 동의를 해주세요.");
            }
        }
    </script>


</body>
</html>