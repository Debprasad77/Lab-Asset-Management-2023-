<?php
include('config.php');
session_destroy();
setcookie('remember_token', '', time()-3600, "/");
header("Location:../Html/index.php");
exit;
?>