<?php
    $host = "localhost";
    $user = "answlsgh95";
    $pw = "dkstks5116!";
    $db = "answlsgh95";

    $connect = new mysqli($host, $user, $pw, $db );
    $connect -> set_charset("utf-8");

    // if(mysqli_connect_errno()){
    //     echo"DATABASE Connect False";
    // }else {
    //     echo "DATABASE Connect True";
    // }
?>