<?php
include "../connect/connect.php";

$sql = "CREATE TABLE IF NOT EXISTS IntroLikes (";
$sql .= "likeId int(10) unsigned auto_increment,"; // PRIMARY KEY를 likeId로 변경
$sql .= "memberId INT(10) UNSIGNED NOT NULL,";
$sql .= "introId varchar(20) NOT NULL,";
$sql .= "introLike int(10) DEFAULT NULL,";
$sql .= "introDislike int(10) DEFAULT NULL,";
$sql .= "likeType int(10) DEFAULT NULL,";
$sql .= "isChanged tinyint(1) NOT NULL DEFAULT 0,"; // isChanged 필드 추가
$sql .= "regTime int(20) NOT NULL,";
$sql .= "PRIMARY KEY (likeId)"; // 불필요한 쉼표 제거
$sql .= ") CHARSET=utf8;"; // 불필요한 쉼표와 공백 제거

$connect->query($sql);
?>