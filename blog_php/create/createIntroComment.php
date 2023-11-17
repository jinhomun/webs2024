<?php
    include "../connect/connect.php";

    $sql = "CREATE TABLE IntroComment (";
    $sql .= "commentId int(10) unsigned auto_increment,";
    $sql .= "memberId int(10) unsigned,";
    $sql .= "introId varchar(20) NOT NULL,";
    $sql .= "commentName varchar(20) NOT NULL,"; 
    $sql .= "commentLike int(10) DEFAULT 0,";
    $sql .= "commentMsg varchar(225) NOT NULL,";
    $sql .= "commentDelete int(11) NOT NULL,";
    $sql .= "regTime int(20) NOT NULL,";
    $sql .= "PRIMARY KEY (CommentId)";
    $sql .= ") charset=utf8";

    $connect -> query($sql);
?>
