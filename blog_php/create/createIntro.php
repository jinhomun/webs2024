<?php
include "../connect/connect.php";

$sql = "CREATE TABLE Intro (";
$sql .= "introId varchar(20) NOT NULL,";
$sql .= "introTitle varchar(255) NOT NULL,";
$sql .= "introContents longtext NOT NULL,";
$sql .= "introComment int(10) DEFAULT NULL,";
$sql .= "introRegTime int(10) NOT NULL,";
$sql .= "introView int(10) DEFAULT NULL,";
$sql .= "introLike int(10) DEFAULT NULL,";
$sql .= "introModTime int(10) DEFAULT NULL,";
$sql .= "introDelete int(10) DEFAULT 1,";
$sql .= "PRIMARY KEY(introId)";
$sql .= ") charset=utf8";

$connect->query($sql);
?>