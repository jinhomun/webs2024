<?php
    include "../connect/connect.php";
    
    $sql = "create table myMembers(";
    $sql .= "myMemberID int(10) unsigned auto_increment,";
    $sql .= "youId varchar(10) NOT NULL,";
    $sql .= "youName varchar(10) NOT NULL,";
    $sql .= "youPass varchar(40) NOT NULL,";
    $sql .= "youEmail varchar(40) NOT NULL,";
    $sql .= "youImgFile varchar(100) DEFAULT NULL,";
    $sql .= "youImgSize varchar(100) DEFAULT NULL,";
    $sql .= "youPhone varchar(40) DEFAULT NULL,";
    $sql .= "youGender enum('male', 'female') DEFAULT NULL comment '남 male , 여 female',";
    $sql .= "regTime int(20) NOT NULL,";
    $sql .= "PRIMARY KEY(myMemberID)";
    $sql .= ") charset=utf8";
   
    $result = $connect -> query($sql);
    
    if($result){
        echo "Create Tables Complete";
    } else {
        echo "Create Tables False";
    }
?>