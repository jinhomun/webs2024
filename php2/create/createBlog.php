<?php
    include "../connect/connect.php";

    $sql = "CREATE TABLE blog (";
    $sql .= "blogId int(10) unsigned auto_increment,";
    $sql .= "memberId int(10) unsigned NOT NULL,";
    $sql .= "blogTitle varchar(255) NOT NULL,";
    $sql .= "blogContents longtext NOT NULL,";
    $sql .= "blogCategory varchar(10) NOT NULL,";
    $sql .= "blogAuthor varchar(10) NOT NULL,";
    $sql .= "blogRegTime int(10) NOT NULL,";
    $sql .= "blogView int(10) DEFAULT NULL,";
    $sql .= "blogLike int(10) DEFAULT NULL,";
    $sql .= "blogImgFile varchar(100) DEFAULT NULL,";
    $sql .= "blogImgSize varchar(100) DEFAULT NULL,";
    $sql .= "blogModTime int(10) DEFAULT NULL,";
    $sql .= "blogDelete int(10) DEFAULT 1,";
    $sql .= "PRIMARY KEY (blogId)";
    $sql .= ") charset=utf8";

    $connect -> query($sql);
?>