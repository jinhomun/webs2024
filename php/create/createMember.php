<?php
    include "../connect/connect.php";
    
    $sql = "create table members(";
    $sql .= "memberID int(10) unsigned auto_increment,";
    $sql .= "youEmail varchar(40) NOT NULL,";
    $sql .= "youName varchar(10) NOT NULL,";
    $sql .= "youPass varchar(50) NOT NULL,";
    $sql .= "youPhone varchar(20) NOT NULL,";
    $sql .= "regTime int(40) NOT NULL,";
    $sql .= "PRIMARY KEY(memberID)";
    $sql .= ") charset=utf8";
   
    $result = $connect -> query($sql);
    
    if($result){
        echo "Create Tables Complete";
    } else {
        echo "Create Tables False";
    }
?>