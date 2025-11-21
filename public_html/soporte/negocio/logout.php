<?php
	session_start(); // Inicia a sesion
	session_destroy(); // destruye la sesion
	header("Location: login.php"); exit; // Redireciona 
?>