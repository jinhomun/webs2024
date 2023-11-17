<?php
    include "../connect/connect.php";

    for($i=1; $i<=5; $i++){
        $regTime = time();

        $sql = "INSERT INTO IntroComment(commentId, memberId, introId, commentName, commentLike, commentMsg, commentDelete, regTime) VALUES('1', '1', '인제기린고등학교', 'dbwls8151', '5', '여기 개량한복 느낌 너무 조타', '1', '$regTime')";
        $connect -> query($sql);
    }
?>