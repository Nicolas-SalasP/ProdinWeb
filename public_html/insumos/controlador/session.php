<?php
   include('../config/config.php');
   session_start();
   
   $user_check = $_SESSION['login_user'];
   
   $ses_sql = mysqli_query($db,"select us_nombre, us_perfil from ins_usuarios where us_nombre = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['us_nombre'];
   $perfil_session = $row['us_perfil'];   
   
   if(!isset($_SESSION['login_user'])){
      header("location:login.php");
      die();
   }
?>