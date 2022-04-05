<?php
session_start();
unset($_SESSION["Uname"]);
session_destroy();
header("location: http://localhost/PayRoll_Management_system/index.html");
?>