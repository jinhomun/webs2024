<?php
include "../connect/connect.php";

for ($i = 1; $i <= 50; $i++) {
    $regTime = time();

    $memberId = 1; // Replace with the appropriate member ID
    $blogTitle = "게시판 타이틀${i}입니다.";
    $blogContents = "게시판 컨텐츠${i}입니다.";
    $blogCategory = "YourCategory"; // Replace with the appropriate category
    $blogAuthor = 1; // Replace with the appropriate author
    $blogView = 1; // Set to the initial view count


    $blogLike = 0; // Set to the initial like count
    $blogImgFile = "YourImageFile"; // Replace with the appropriate image file
    $blogImgSize = "YourImageSize"; // Replace with the appropriate image size
    $blogDelete = 1; // Set to the initial delete status (1 for not deleted)

    $sql = "INSERT INTO blogs(memberId, blogTitle, blogContents, blogCategory, blogAuthor, blogRegTime, blogView, blogLike, blogImgFile, blogImgSize, blogDelete) VALUES ('$memberId', '$blogTitle', '$blogContents', '$blogCategory', '$blogAuthor', '$regTime', '$blogView', '$blogLike', '$blogImgFile', '$blogImgSize', '$blogDelete')";
    $connect->query($sql);

    echo "정상적으로 등록되었습니다";
}