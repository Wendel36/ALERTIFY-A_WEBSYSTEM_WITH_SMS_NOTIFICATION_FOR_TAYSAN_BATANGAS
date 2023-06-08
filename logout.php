<?php
session_start();
unset($_SESSION['UserLogin']);
unset($_SESSION['Access']);
    $_SESSION['alert'] = "Logout Success!";
    $_SESSION['alert_code'] = "success";
echo header("Location: index.php");

?>