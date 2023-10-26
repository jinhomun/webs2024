<?php
include "../connect/connect.php";

$sql = "CREATE TABLE Community (";
$sql .= "boardId int(10) unsigned NOT NULL auto_increment, ";
$sql .= "memberId int(10) NOT NULL, ";
$sql .= "boardTitle varchar(100) NOT NULL, ";
$sql .= "boardContents longtext NOT NULL, ";
$sql .= "boardView int(10) NOT NULL, ";
$sql .= "boardLike int(10) NOT NULL, ";
$sql .= "boardImgFile varchar(100) DEFAULT NULL, ";
$sql .= "boardImgSize varchar(100) DEFAULT NULL, ";
$sql .= "regTime int(40) NOT NULL, ";
$sql .= "PRIMARY KEY(boardID) ";
$sql .= ") CHARACTER SET utf8";

if ($connect->query($sql) === TRUE) {
    echo "테이블이 성공적으로 생성되었습니다.";
} else {
    echo "테이블 생성에 실패했습니다: " . $connect->error;
}
?>