<?php
    include "../connect/connect.php";

    $sql = "create table blog_myMembers(";
    $sql .= "memberId int(10) unsigned auto_increment,";
    $sql .= "youId varchar(40) NOT NULL,";
    $sql .= "youName varchar(40) NOT NULL,";
    $sql .= "youEmail varchar(40) NOT NULL,";
    $sql .= "youPass varchar(40) NOT NULL,";
    $sql .= "youRegTime int(40) NOT NULL,";
    $sql .= "youAddress varchar(255) DEFAULT NULL,";
    $sql .= "youSite varchar(255) DEFAULT NULL,";
    $sql .= "youInstagram varchar(255) DEFAULT NULL,";
    $sql .= "youCodepen varchar(255) DEFAULT NULL,";
    $sql .= "youGithub varchar(255) DEFAULT NULL,";
    $sql .= "youIntro varchar(255) DEFAULT NULL,";
    $sql .= "youBirth varchar(40) DEFAULT NULL,";
    $sql .= "youPhone varchar(40) DEFAULT NULL,";
    $sql .= "youImgSrc varchar(40) DEFAULT NULL,";
    $sql .= "youImgSize varchar(40) DEFAULT NULL,";
    $sql .= "youDelete int(10) DEFAULT 1,";
    $sql .= "youModTime int(40) DEFAULT NULL,";
    $sql .= "PRIMARY KEY(memberId)";
    $sql .= ") charset=utf8;";

    $result = $connect -> query($sql);

    if($result){
        echo "Create Tables Complete";
    } else {
        echo "Create Tables False";
    }
?>