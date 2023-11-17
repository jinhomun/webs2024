<?php

include "../connect/connect.php";
include "../connect/session.php";

// 세션에서 멤버 정보 가져오기
$memberId = $_SESSION['memberId'];
$blogAuthor = $_SESSION['youName'];

// 게시물 정보 가져오기
$blogId = $_POST['blogId'];
$blogTitle = $_POST['blogTitle'];
$blogPass = $_POST['blogPass'];
$blogContents = nl2br($_POST['blogContents']);

// 기존 이미지 정보 가져오기
$sql = "SELECT blogImgFile FROM blogs WHERE blogId = $blogId";
$result = $connect->query($sql);
$existingImage = $result->fetch_assoc()['blogImgFile'];

$blogImgType = $_FILES['blogFile']['type'];
$blogImgSize = $_FILES['blogFile']['size'];
$blogImgName = $_FILES['blogFile']['name'];
$blogImgTmp = $_FILES['blogFile']['tmp_name'];
$blogImgDir = "../assets/blog/";

// 이미지 파일이 업로드되었는지 확인
if (!empty($blogImgType)) {
    // 이미지 파일 처리 로직
    $fileTypeExtension = explode("/", $blogImgType);
    $fileType = $fileTypeExtension[0]; // image
    $fileExtension = $fileTypeExtension[1]; // 이미지 확장자

    // 이미지 타입 확인
    if ($fileType === "image") {
        // 이미지 파일 형식 확인
        if (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
            $blogImgName = "Img_" . time() . rand(1, 99999) . "." . $fileExtension;

            // 이미지 사이즈 확인
            if ($blogImgSize > 10000000) {
                echo "<script>alert('이미지 파일 용량이 10MB를 초과했습니다. 사이즈를 줄여주세요.');</script>";
                exit;
            }

            // 이미지 업로드
            if (move_uploaded_file($blogImgTmp, $blogImgDir . $blogImgName)) {
                // 기존 이미지 삭제
                if ($existingImage && file_exists($blogImgDir . $existingImage)) {
                    unlink($blogImgDir . $existingImage);
                }
            } else {
                echo "<script>alert('이미지 업로드에 실패했습니다.');</script>";
                exit;
            }
        } else {
            echo "<script>alert('이미지 파일 형식이 아닙니다.');</script>";
            exit;
        }
    } else {
        echo "<script>alert('이미지 파일이 아닙니다.');</script>";
        exit;
    }
} else {
    // 새 이미지가 업로드되지 않았고, 기존 이미지 삭제가 요청되었는지 확인
    if (isset($_POST['deleteExistingImage']) && $_POST['deleteExistingImage'] === 'yes') {
        if ($existingImage && file_exists($blogImgDir . $existingImage)) {
            unlink($blogImgDir . $existingImage); // 기존 이미지 파일 삭제
            $blogImgName = ""; // 데이터베이스 업데이트를 위해 이미지 이름을 비워둠
        }
    } else {
        $blogImgName = $existingImage; // 기존 이미지 이름을 그대로 유지
    }
}

// 비밀번호 확인 및 게시물 업데이트 로직
$sql = "SELECT youPass FROM blog_myMembers WHERE memberId = $memberId";
$result = $connect->query($sql);
$info = $result->fetch_array(MYSQLI_ASSOC);

if ($info['youPass'] === $blogPass) {
    // 비밀번호가 일치하는 경우 게시물 업데이트
    $blogTitle = $connect->real_escape_string($blogTitle);
    $blogContents = $connect->real_escape_string($blogContents);
    $blogRegTime = time();

    $updateSql = "UPDATE blogs SET blogTitle = '$blogTitle', blogContents = '$blogContents', blogAuthor = '$blogAuthor', blogRegTime = '$blogRegTime', blogImgFile = '$blogImgName' WHERE blogId = $blogId";
    $updateResult = $connect->query($updateSql);

    if ($updateResult) {
        echo "<script>alert('게시글이 성공적으로 수정되었습니다.')</script>";
        echo '<script>window.location.href = "cummunity.php";</script>';
    } else {
        echo "<script>alert('게시글 업데이트에 실패했습니다.')</script>";
    }
} else {
    echo "<script>alert('비밀번호가 틀렸습니다. 다시 한번 확인해주세요!')</script>";
    echo "<script>window.history.back()</script>";
}


?>