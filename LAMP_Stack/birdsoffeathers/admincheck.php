<?php
   //session_start();
   //if user is not admin , redirect to home page
   if($_SESSION['login_role'] !== 'Admin'){
      header("location: index.php");
   }
?>