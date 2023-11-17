<?php
include "../connect/connect.php";

$sql = "CREATE TABLE introCommentLikes (";
$sql .= "likeId int(10) unsigned auto_increment,";
$sql .= "memberId int(10) unsigned,";
$sql .= "commentId int(10) unsigned,";
$sql .= "regTime int(20) NOT NULL,";
$sql .= "PRIMARY KEY (likeId),";
$sql .= "FOREIGN KEY (memberId) REFERENCES yourMembersTable(memberId),"; // replace 'yourMembersTable' with your actual members table name
$sql .= "FOREIGN KEY (commentId) REFERENCES blogComments(commentId)";
$sql .= ") charset=utf8";

$connect->query($sql);

?>