<?php
    include "../connect/session.php";

    unset($_SESSION['memberId']);
    unset($_SESSION['youId']);
    unset($_SESSION['youName']);

    Header("Location: ../main/main.php");
?>