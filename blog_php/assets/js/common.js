$(function () {
    //section01 이미지 슬라이드
    let currentIndex = 0;
    $(".sliderWrap").append($(".slider").first().clone(true));

    setInterval(function () {
        currentIndex++;
        $(".sliderWrap").animate({ marginLeft: -100 * currentIndex + "%" }, 600);

        if (currentIndex == 6) {
            setTimeout(function () {
                $(".sliderWrap").animate({ marginLeft: 0 }, 0);
                currentIndex = 0;
            }, 600);
        }
    }, 3000);


    function addCommentSlide() {
        $(".cont__bottom__comment").on("click", function () {
            $(".comment_page").animate({ left: 0 }, 600);
        });
        $(".cont__top span").on("click", function () {
            $(".comment_page").animate({ left: "100%" }, 600);
        });
    }

    function removeCommentSlide() {
        $(".cont__bottom__comment").off("click");
        $(".cont__top span").off("click");
    }

    // 화면 너비에 따라 이벤트 추가 또는 제거
    function checkScreenWidth() {
        if (window.innerWidth <= 800) {
            addCommentSlide();
        } else {
            removeCommentSlide();
        }
    }

    // 페이지 로드 시 및 리사이즈 이벤트에 대한 처리
    $(document).ready(function () {
        checkScreenWidth(); // 페이지 로드 시 초기 체크

        $(window).on("resize", function () {
            checkScreenWidth(); // 리사이즈 시 화면 너비 다시 확인
        });
    });



    // 인기순위 탭메뉴
    const tabBtn = $(".tab_menu > a");
    const tabCont = $(".tab_cont > div");
    tabCont.hide().eq(0).show();

    tabBtn.on("click", function () {
        const index = $(this).index();

        $(this).addClass("active").siblings().removeClass("active");
        tabCont.eq(index).show().siblings().hide();
    });



    // 햄버거 메뉴
    const menuTrigger = document.querySelector('.menu-trigger');
    const menuNav = document.querySelector("nav");
    const headerOn = document.querySelector("#header");

    menuTrigger.addEventListener('click', (event) => {
        if (menuTrigger.classList.contains('active-1')) {
            // 'active-1' 클래스가 이미 추가된 상태
            menuTrigger.classList.remove('active-1');
            menuNav.style.right = '-100%'; // 메뉴를 숨깁니다.
            headerOn.classList.remove("on");
        } else {
            // 'active-1' 클래스가 추가되지 않은 상태
            menuTrigger.classList.add('active-1');
            menuNav.style.right = '0'; // 메뉴를 보여줍니다.
            headerOn.classList.add("on");
        }

    });


    // section02 hover효과
    const hoverBtn = document.querySelector(".section02_right .section02_btn");
    const sectionRight = document.querySelector(".section02_right");

    sectionRight.addEventListener("mouseenter", () => {
        hoverBtn.classList.add("show");
        hoverBtn.classList.remove("hide");
    });
    sectionRight.addEventListener("mouseleave", () => {
        hoverBtn.classList.add("hide");
        hoverBtn.classList.remove("show");
    });


    // 회원가입 전체 동의
    // Get the checkboxes and the "전체 동의" checkbox
    const agreeCheckAll = document.getElementById("agreeCheckAll");
    const agreeCheck1 = document.getElementById("agreeCheck1");
    const agreeCheck2 = document.getElementById("agreeCheck2");
    const agreeCheck3 = document.getElementById("agreeCheck3");

    // Add an event listener to the "전체 동의" checkbox
    agreeCheckAll.addEventListener("change", function () {
        const isChecked = agreeCheckAll.checked;
        agreeCheck1.checked = isChecked;
        agreeCheck2.checked = isChecked;
        agreeCheck3.checked = isChecked;
    });

});