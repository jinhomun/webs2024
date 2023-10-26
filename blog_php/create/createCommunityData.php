<?php
    include "../connect/connect.php";

    for($i=1; $i<=100; $i++){
        $regTime = time();

        $sql = "INSERT INTO Community(memberId, boardTitle, boardContents, boardView, regTime) VALUES('1', 'OO학교 교복', '여기교복 어때?', '1', '$regTime')";
        $connect -> query($sql);
    }
?>