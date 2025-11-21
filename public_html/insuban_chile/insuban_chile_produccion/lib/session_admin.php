<?
session_start();

if (!$_SESSION['id_insuban'])
  {      $error_page = "index.php";
         $error_url = $error_page;
         $message='Usuario+No+autorizado';
         $error_url .= "?error=$message";
         $error_url .= "&tipo=1";
         Header( "Location: $error_url");
         exit;
  }
?>