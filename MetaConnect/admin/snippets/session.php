<?php
	// page created to be reutilized by all the pages protected via session cookies

   include('config.php');
   session_start();
   
   $user_logged = $_SESSION['login_user'];

   $user_type = $_SESSION['login_user_type'];
   
   if(!isset($_SESSION['login_user'])){
      header("location: page-login.php");
   }
?>