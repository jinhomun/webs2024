<?php
include "../connect/connect.php";
include "../connect/session.php";

if (isset($_SESSION['memberId'])) {
    $memberId = $_SESSION['memberId'];
} else {
    $memberId = 0;
}

if (isset($_GET['blogId'])) {
    $blogId = $_GET['blogId'];
} else {
    Header("Location: cummunity.php");
}


$isUserLoggedIn = isset($_SESSION["memberId"]);
$loggedInMemberId = isset($_SESSION["memberId"]) ? $_SESSION['memberId'] : '';



// 조회수 추가
$updateViewSql = "UPDATE blogs SET blogView = blogView + 1 WHERE blogId = " . $blogId;
$connect->query($updateViewSql);

// 블로그 정보 가져오기
$blogSql = "SELECT * FROM blogs WHERE blogId = " . $blogId;
$blogResult = $connect->query($blogSql);
$blogInfo = $blogResult->fetch_array(MYSQLI_ASSOC);

// 블로그 좋아요 정보 가져오기
$blogLikesSql = "SELECT * FROM blogsLikes WHERE memberId = " . $memberId;
$blogLikesResult = $connect->query($blogLikesSql);
$blogLikesInfo = $blogLikesResult->fetch_all(MYSQLI_ASSOC);

foreach ($blogLikesInfo as $BlikesInfo) {
    if ($BlikesInfo['memberId'] === $loggedInMemberId) {
        $loggedInUserLikesblogIds[] = $BlikesInfo['blogId'];
    }
}

$commentName = isset($_SESSION['youId']) ? $_SESSION['youId'] : '';
$commentPass = isset($_SESSION['youPass']) ? $_SESSION['youPass'] : '';

// 댓글 정보 가져오기
$commentSql = "SELECT * FROM blogComments WHERE blogId = '$blogId' AND commentDelete = '1' ORDER BY commentId DESC";
$commentResult = $connect->query($commentSql);
$commentInfo = $commentResult->fetch_array(MYSQLI_ASSOC);

// 댓글 좋아요 정보 가져오기
$commentLikesSql = "SELECT * FROM commentLikes WHERE memberId = " . $memberId;
$commentLikesResult = $connect->query($commentLikesSql);
$commentLikesInfo = $commentLikesResult->fetch_all(MYSQLI_ASSOC);

$loggedInUserLikesCommentIds = [];

foreach ($commentLikesInfo as $likesInfo) {
    if ($likesInfo['memberId'] === $loggedInMemberId) {
        $loggedInUserLikesCommentIds[] = $likesInfo['commentId'];
    }
}
?>


<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Go!교복</title>

    <link rel="stylesheet" href="../assets/css/communityD.css">

    <!-- CSS -->
    <?php include "../include/head.php" ?>
</head>

<body>
    <?php include "../include/skip.php" ?>
    <!-- //skip -->

    <?php include "../include/header.php" ?>


    <main id="main">
        <div class="container view_inner">
            <div class="article">
                <h2>
                    <?= $blogInfo['blogTitle'] ?>
                </h2>
                <div class="name">
                    <?= $blogInfo['blogAuthor'] ?>
                </div>
                <div class="hinfo">
                    <span class="dat"><img src="../assets/img/clock.svg" alt="Clock Icon">
                        <?= date('Y-m-d', $blogInfo['blogRegTime']) ?></span>
                    <span class="pv"><img src="../assets/img/read1.svg" alt="Clock Icon">
                        <?= $blogInfo['blogView'] ?>
                    </span>
                    <span class="cmt"><img src="../assets/img/thumbs.svg" alt="Clock Icon">
                        <?= $blogInfo['blogLike'] ?>
                    </span>
                </div>
            </div>

            <div class="content">
                <p>
                    <?= $blogInfo['blogContents'] ?>
                </p>
                <?php if (!empty($blogInfo['blogImgFile'])) { ?>
                <div class="contents_image">
                    <img src="../assets/blog/<?= $blogInfo['blogImgFile'] ?>" alt="<?= $blogInfo['blogTitle'] ?>">
                </div>
                <?php } ?>
            </div>

            <div class="comment_btn">
                <div class="cinfo" data-blogid="<?= $blogId ?>"
                    <?= in_array($blogInfo['blogId'], array_column($blogLikesInfo, 'blogId')) ? 'data-loggedinuser="true"' : ''; ?>>
                    <span id="likeButton" class="like" data-blogid="<?= $blogId ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path
                                d="M323.8 34.8c-38.2-10.9-78.1 11.2-89 49.4l-5.7 20c-3.7 13-10.4 25-19.5 35l-51.3 56.4c-8.9 9.8-8.2 25 1.6 33.9s25 8.2 33.9-1.6l51.3-56.4c14.1-15.5 24.4-34 30.1-54.1l5.7-20c3.6-12.7 16.9-20.1 29.7-16.5s20.1 16.9 16.5 29.7l-5.7 20c-5.7 19.9-14.7 38.7-26.6 55.5c-5.2 7.3-5.8 16.9-1.7 24.9s12.3 13 21.3 13L448 224c8.8 0 16 7.2 16 16c0 6.8-4.3 12.7-10.4 15c-7.4 2.8-13 9-14.9 16.7s.1 15.8 5.3 21.7c2.5 2.8 4 6.5 4 10.6c0 7.8-5.6 14.3-13 15.7c-8.2 1.6-15.1 7.3-18 15.1s-1.6 16.7 3.6 23.3c2.1 2.7 3.4 6.1 3.4 9.9c0 6.7-4.2 12.6-10.2 14.9c-11.5 4.5-17.7 16.9-14.4 28.8c.4 1.3 .6 2.8 .6 4.3c0 8.8-7.2 16-16 16H286.5c-12.6 0-25-3.7-35.5-10.7l-61.7-41.1c-11-7.4-25.9-4.4-33.3 6.7s-4.4 25.9 6.7 33.3l61.7 41.1c18.4 12.3 40 18.8 62.1 18.8H384c34.7 0 62.9-27.6 64-62c14.6-11.7 24-29.7 24-50c0-4.5-.5-8.8-1.3-13c15.4-11.7 25.3-30.2 25.3-51c0-6.5-1-12.8-2.8-18.7C504.8 273.7 512 257.7 512 240c0-35.3-28.6-64-64-64l-92.3 0c4.7-10.4 8.7-21.2 11.8-32.2l5.7-20c10.9-38.2-11.2-78.1-49.4-89zM32 192c-17.7 0-32 14.3-32 32V448c0 17.7 14.3 32 32 32H96c17.7 0 32-14.3 32-32V224c0-17.7-14.3-32-32-32H32z" />
                        </svg>
                        <em>좋아요</em>
                        <span id="likeCount" class="likeCount" data-blogid="<?= $blogId ?>">
                            <?= $blogInfo['blogLike'] ?>
                        </span>
                    </span>
                    <!-- 좋아요 수를 표시할 부분 -->
                </div>
                <div class="contents_btn">
                    <?php
                    session_start();
                    $blogId = $_GET['blogId'];

                    // 게시물 정보를 가져옵니다.
                    $sql = "SELECT b.blogTitle, m.youName, b.regTime, b.blogView, b.blogContents, b.memberId FROM blogs b JOIN Mymembers m ON (b.memberId = m.memberId) WHERE b.blogId = {$blogId}";
                    $result = $connect->query($sql);

                    if (isset($_SESSION['memberId'])) {
                        $currentUserId = $_SESSION['memberId'];
                        $blogAuthorId = $blogInfo['memberId'];
                        echo "<script>console.log('true')</script>";
                        // 현재 사용자와 게시물 작성자를 비교하여 수정 및 삭제 버튼을 표시합니다.
                        if ($currentUserId == $blogAuthorId) {
                            echo "<a href='boardModify.php?blogId=$blogId' class='btn'>수정하기</a>";
                            echo "<a href='boardRemove.php?blogId=$blogId' class='btn' onclick=\"return confirm('정말 삭제하시겠습니까?')\">삭제하기</a>";
                        }
                    }
                    ?>
                    <!-- <a href="boardModify.php?boardId=<?= $_GET['boardId'] ?>" class="btn">수정하기</a>
                    <a href="boardRemove.php?boardId=<?= $_GET['boardId'] ?>" class="btn" onclick="return confirm('정말 삭제하시겠습니까?')">삭제하기</a> -->
                    <a href="cummunity.php" class="btn listView_btn">목록보기</a>
                </div>
            </div>


            <div class="comments">
                <h3>댓글</h3>
                <!-- <form action="#" class="cmt_txt" method="post">
                    <fieldset class="input_container">
                        <input type="text" id="commentWrite" name="commentWrite" placeholder="댓글을 남겨주세요!" required>
                        <input type="hidden" name="memberId" value="<?= $memberId ?>">
                        <input type="hidden" name="blogId" value="<?= $blogId ?>">
                        <input type="hidden" name="youId" value="<?= $youId ?>">
                        <button type="button" id="commentWriteBtn"><img src="../assets/img/right.svg" alt="Clock Icon"></button>     
                    </fieldset>
                </form> -->
                <div id="" class="comment_area">
                    <div class="cmt_txt">
                        <label for="cmtTxt"></label>
                        <div class="input_container">
                            <input type="text" id="commentWrite" name="commentWrite" placeholder="댓글을 남겨주세요!">
                            <button type="button" id="commentWriteBtn"><img src="../assets/img/right.svg"
                                    alt="Clock Icon"></button>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            if ($commentResult->num_rows == 0) { ?>
            <div class="comment-container">
                <p class="name">댓글이 없습니다.</p>
                <p class="cmt_txt" style="margin-bottom: 15px;">😥 댓글을 작성해주세요ㅠ</p>
            </div>
            <?php } else {
                function maskName($name)
                {
                    if (strlen($name) <= 2) {
                        return $name; // 이름이 두 글자 이하일 경우, 마스킹하지 않음
                    }

                    $start = 2; // 마스킹 시작 위치 (두 번째 글자)
                    $length = strlen($name) - 4; // 마스킹할 글자 수 (중간 글자 제외)
                    $maskedPart = str_repeat('*', $length); // 글자 수만큼 '*'로 채움
                    $maskedName = substr_replace($name, $maskedPart, $start, $length); // 이름을 마스킹된 문자열로 교체
            
                    return $maskedName;
                }


                foreach ($commentResult as $comment) {
                    $commentName = $comment['commentName']; // 댓글 작성자의 이름
                    $maskedName = maskName($commentName, 2); // 중간 2 글자만 표시
                    // 이제 $maskedName을 사용할 수 있습니다.
            
                    ?>
            <div class="comment-container" data-commentid="<?= $comment['commentId'] ?>"
                <?= in_array($comment['commentId'], array_column($commentLikesInfo, 'commentId')) ? 'data-loggedinuser="true"' : ''; ?>>
                <div class="comment_profile">
                    <div class="avata"></div>
                    <div class="comment_msg">
                        <p class="name">
                            <?= $maskedName ?>
                        </p>
                        <p class="pass none">
                            <?= $comment['commentPass'] ?>
                        </p>
                        <p class="cmt_txt">
                            <?= $comment['commentMsg'] ?>
                        </p>
                    </div>
                </div>
                <div class="comment_info">
                    <span class="date"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"
                            fill="#616161">
                            <!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                            <path
                                d="M464 256A208 208 0 1 1 48 256a208 208 0 1 1 416 0zM0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM232 120V256c0 8 4 15.5 10.7 20l96 64c11 7.4 25.9 4.4 33.3-6.7s4.4-25.9-6.7-33.3L280 243.2V120c0-13.3-10.7-24-24-24s-24 10.7-24 24z" />
                        </svg>
                        <?= date('Y-m-d H:i', $comment['regTime']) ?>
                    </span>
                    <span class="comment_like" data-commentid="<?= $comment['commentId'] ?>">
                        <button class="commentLikeBtn" data-commentid="<?= $comment['commentId'] ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="#616161">
                                <!--! Font Awesome Pro 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                <path
                                    d="M323.8 34.8c-38.2-10.9-78.1 11.2-89 49.4l-5.7 20c-3.7 13-10.4 25-19.5 35l-51.3 56.4c-8.9 9.8-8.2 25 1.6 33.9s25 8.2 33.9-1.6l51.3-56.4c14.1-15.5 24.4-34 30.1-54.1l5.7-20c3.6-12.7 16.9-20.1 29.7-16.5s20.1 16.9 16.5 29.7l-5.7 20c-5.7 19.9-14.7 38.7-26.6 55.5c-5.2 7.3-5.8 16.9-1.7 24.9s12.3 13 21.3 13L448 224c8.8 0 16 7.2 16 16c0 6.8-4.3 12.7-10.4 15c-7.4 2.8-13 9-14.9 16.7s.1 15.8 5.3 21.7c2.5 2.8 4 6.5 4 10.6c0 7.8-5.6 14.3-13 15.7c-8.2 1.6-15.1 7.3-18 15.1s-1.6 16.7 3.6 23.3c2.1 2.7 3.4 6.1 3.4 9.9c0 6.7-4.2 12.6-10.2 14.9c-11.5 4.5-17.7 16.9-14.4 28.8c.4 1.3 .6 2.8 .6 4.3c0 8.8-7.2 16-16 16H286.5c-12.6 0-25-3.7-35.5-10.7l-61.7-41.1c-11-7.4-25.9-4.4-33.3 6.7s-4.4 25.9 6.7 33.3l61.7 41.1c18.4 12.3 40 18.8 62.1 18.8H384c34.7 0 62.9-27.6 64-62c14.6-11.7 24-29.7 24-50c0-4.5-.5-8.8-1.3-13c15.4-11.7 25.3-30.2 25.3-51c0-6.5-1-12.8-2.8-18.7C504.8 273.7 512 257.7 512 240c0-35.3-28.6-64-64-64l-92.3 0c4.7-10.4 8.7-21.2 11.8-32.2l5.7-20c10.9-38.2-11.2-78.1-49.4-89zM32 192c-17.7 0-32 14.3-32 32V448c0 17.7 14.3 32 32 32H96c17.7 0 32-14.3 32-32V224c0-17.7-14.3-32-32-32H32z" />
                            </svg>
                            좋아요
                        </button>
                        <span class="like-count" data-commentid="<?= $comment['commentId'] ?>">
                            <?= $comment['commentLike'] ?>
                        </span>
                    </span>
                    <span class="cmt">
                        <a href="#" class="modify" data-comment-id="<?= $comment['commentId'] ?>">수정</a>
                        &nbsp; | &nbsp;
                        <a href="#" class="delete" data-comment-id="<?= $comment['commentId'] ?>">삭제</a>
                    </span>
                </div>
            </div>
            <?php }
            }
            ?>

        </div>
    </main>

    <div id="popupDelete" class="none">
        <div class="comment__delete">
            <h4>댓글 삭제</h4>
            <label for="commentDeletePass" class="blind">비밀번호</label>
            <input type="password" id="commentDeletePass" name="commentDeletePass" placeholder="비밀번호">
            <p>* 댓글 작성시 등록한 비밀번호를 입력해주세요!</p>
            <div class="btn">
                <button id="commentDeleteCancel">취소</button>
                <button id="commentDeleteButton">삭제</button>
            </div>
        </div>
    </div>

    <div id="popupModify" class="none">
        <div class="comment__modify">
            <h4>댓글 수정</h4>
            <label for="commentModifyMsg" class="blind">댓글 내용</label>
            <textarea name="commentModifyMsg" id="commentModifyMsg" rows="4" placeholder="수정할 내용을 적어주세요!"></textarea>
            <label for="commentModifyPass" class="blind">비밀번호</label>
            <input type="password" id="commentModifyPass" name="commentModifyPass" placeholder="비밀번호">
            <p>* 회원가입 시 등록한 비밀번호를 입력해주세요!</p>
            <div class="btn">
                <button id="commentModifyCancel">취소</button>
                <button id="commentModifyButton">수정</button>
            </div>
        </div>
    </div>

    <?php include "../include/footer.php" ?>
    <!-- //footer -->



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>


    <script>
    document.addEventListener("DOMContentLoaded", function() {

        const loggedInUserblogs = document.querySelector('.cinfo[data-loggedinuser="true"]');
        if (loggedInUserblogs) {
            loggedInUserblogs.classList.add('active');
            console.log(loggedInUserblogs);
        }

        const loggedInUserComments = document.querySelectorAll('.comment-container[data-loggedinuser="true"]');
        if (loggedInUserComments.length > 0) {
            loggedInUserComments.forEach(loggedInUserComment => {
                console.log(loggedInUserComment); // 선택된 각 요소가 콘솔에 출력됩니다.
                loggedInUserComment.classList.add('active'); // 클래스를 추가합니다.
            });
        }


    });

    // 댓글 프로필 랜덤 돌리기
    const avataImages = [
        "AngrywithFang.svg",
        "Awe.svg",
        "Blank.svg",
        "Calm.svg",
        "Cheek.svg",
        "ConcernedFear.svg",
        "Concerned.svg",
        "Contempt.svg",
        "Cute.svg",
        "Cyclops.svg",
        "Driven.svg",
        "EatingHappy.svg",
        "Explaining.svg",
        "EyesClosed.svg",
        "Fear.svg",
        "Hectic.svg",
        "LovingGrin1.svg",
        "LovingGrin2.svg",
        "Monster.svg",
        "Old.svg",
        "Rage.svg",
        "Serious.svg",
        "SmileBig.svg",
        "SmileLOL.svg",
        "SmileTeeth Gap.svg",
        "Smile.svg",
        "Solemn.svg",
        "Suspicious.svg",
        "Tired.svg",
        "VeryAngry.svg",
    ]
    const commentViews = document.querySelectorAll(".comment_profile");
    commentViews.forEach((view, i) => {
        const avata = view.querySelector(".avata");
        const rand = avataImages[Math.floor(Math.random() * avataImages.length)];

        console.log(rand);
        avata.style.backgroundImage = `url(../assets/face/${rand})`;
    });

    $(document).ready(function() {
        let commentId = "";

        $("#commentWriteBtn").click(function() {
            if ($("#commentWrite").val() == "") {
                alert("댓글을 작성해주세요!");
                $("#commentWrite").focus();
            } else {

                if (!<?= $isUserLoggedIn ? 'true' : 'false' ?>) {
                    alert("회원만 이용 가능합니다. 로그인 후 다시 시도해주세요.");
                    return;
                }
                // 사용자가 로그인한 경우 댓글 작성 요청을 보냄
                $.ajax({
                    url: "blogCommentWrite.php",
                    method: "POST",
                    dataType: "json",
                    data: {
                        "blogId": <?= $blogId ?>,
                        "memberId": <?= $memberId ?>,
                        "name": "<?= $commentName ?>",
                        "pass": "<?= $commentPass ?>",
                        "msg": $("#commentWrite").val(),
                    },
                    success: function(data) {
                        console.log(data);
                        location.reload();
                    },
                    error: function(request, status, error) {
                        console.log("request", request);
                        console.log("status", status);
                        console.log("error", error);
                    }
                });
            }
        });
        $("#commentWrite").keypress(function(event) {
            if (event.which === 13) { // Enter 키의 키 코드는 13입니다.
                event.preventDefault();
                $("#commentWriteBtn").click();
            }
        });




        // 댓글 삭제 버튼
        $(".comment-container .delete").click(function(e) {
            e.preventDefault();
            $("#popupDelete").removeClass("none");
            commentId = $(this).data("comment-id");
        });

        // 댓글 삭제 버튼 -> 취소버튼
        $("#commentDeleteCancel").click(function() {
            $("#popupDelete").addClass("none");
        });

        // 댓글 삭제 버튼 -> 삭제버튼
        $("#commentDeleteButton").click(function() {
            if ($("#commentDeletePass").val() == "") {
                alert("댓글 작성시 비밀번호를 작성해주세요!");
                $("#commentDeletePass").focus();
            } else {
                $.ajax({
                    url: "blogCommentDelete.php",
                    method: "POST",
                    dataType: "json",
                    data: {
                        "commentPass": $("#commentDeletePass").val(),
                        "commentId": commentId,
                    },
                    success: function(data) {
                        console.log(data);
                        if (data.result == "bad") {
                            alert("비밀번호가 일치하지 않습니다.");
                        } else {
                            alert("댓글이 삭제되었습니다.");
                        }
                        location.reload();
                    },
                    error: function(request, status, error) {
                        console.log("request" + request);
                        console.log("status" + status);
                        console.log("error" + error);
                    }
                })
            }
        });


        // 댓글 수정 버튼
        $(".comment-container .modify").click(function(e) {
            e.preventDefault();
            $("#popupModify").removeClass("none");
            commentId = $(this).data("comment-id");

            let commentMsg = $(this).closest(".comment-container").find("p.cmt_txt").text();
            $("#commentModifyMsg").val(commentMsg);

        });

        // 댓글 수정 버튼 -> 취소버튼
        $("#commentModifyCancel").click(function() {
            $("#popupModify").addClass("none");
        });




        // 댓글 수정 버튼 -> 수정버튼
        $("#commentModifyButton").click(function() {
            if ($("#commentModifyPass").val() == "") {
                alert("회원가입 시 입력한 비밀번호를 작성해주세요!");
                $("#commentModifyPass").focus();
            } else {
                $.ajax({
                    url: "blogCommentModify.php",
                    method: "POST",
                    dataType: "json",
                    data: {
                        "commentMsg": $("#commentModifyMsg").val(),
                        "commentPass": $("#commentModifyPass").val(),
                    },
                    success: function(data) {
                        console.log(data);
                        if (data.result == "bad") {
                            alert("비밀번호가 일치하지 않습니다.");
                        } else {
                            alert("댓글이 수정되었습니다.");
                        }
                        location.reload();
                    },
                    error: function(request, status, error) {
                        console.log("request" + request);
                        console.log("status" + status);
                        console.log("error" + error);
                    }
                })
            }
        })
    });




    document.querySelectorAll(".commentLikeBtn").forEach(function(button) {
        button.addEventListener("click", function() {
            const commentContainer = this.closest(".comment-container");
            // 여기서 commentContainer에 active 클래스를 추가합니다
            commentContainer.classList.add("active");
            const commentId = this.getAttribute("data-commentid");
            this.disabled = true; // Disable the button immediately
            // AJAX request
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "commentLike.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        const likeCountElement = document.querySelector(
                            ".like-count[data-commentid='" + commentId + "']");

                        likeCountElement.textContent = response.newLikeCount;

                    } else {
                        alert("이미 클릭한 댓글 입니다");
                        button.disabled = false; // Re-enable the button if there was an error
                    }
                }
            };
            xhr.send("commentId=" + encodeURIComponent(commentId));
        });

    });



    document.getElementById("likeButton").addEventListener("click", function() {
        const blogContainer = this.closest(".cinfo");
        // 여기서 blogContainer에 active 클래스를 추가합니다
        blogContainer.classList.add("active");
        const blogId = this.getAttribute("data-blogid");
        this.disabled = true; // Disable the button immediately
        // AJAX request
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "blogLike.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                if (response.success) {
                    const likeCountElement = document.querySelector(".likeCount[data-blogid='" + blogId +
                        "']");
                    likeCountElement.style.display = "block";
                    likeCountElement.textContent = response.blogLikeCount;

                } else {
                    alert("이미 클릭한 게시글 입니다");
                    blogLikeBtn.disabled = false; // Re-enable the button if there was an error
                }
            }
        };
        xhr.send("blogId=" + encodeURIComponent(blogId));
    });
    </script>
</body>

</html>