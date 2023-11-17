<?php
include "../connect/connect.php";

$sql = "CREATE TABLE blogsLikes (";
$sql .= "likeId int(10) unsigned auto_increment,";
$sql .= "memberId int(10) unsigned,";
$sql .= "blogId int(10) unsigned,";
$sql .= "regTime int(20) NOT NULL,";
$sql .= "PRIMARY KEY (likeId),";
$sql .= "FOREIGN KEY (memberId) REFERENCES myMembers(memberId),"; // replace 'yourMembersTable' with your actual members table name
$sql .= "FOREIGN KEY (blogId) REFERENCES blogs(blogId)";
$sql .= ") charset=utf8";

$connect->query($sql);

?>