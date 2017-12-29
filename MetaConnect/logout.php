<?php
include("restrito.php");
include 'configs/config.php'; //meta DB
session_start();
session_destroy();
header('Location: index.php');
exit;
?>