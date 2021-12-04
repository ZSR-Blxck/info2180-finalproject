<?php
   include('dbconfig.php');
   session_start();
   $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $_password = $_POST['password'];
   $_SESSION["login_user"]= $_POST['email'];
   
   $user_check = $_SESSION['login_user'];

   if(!isset($_SESSION['login_user'])){
      header("location:login.php");
      die();
   }
?>