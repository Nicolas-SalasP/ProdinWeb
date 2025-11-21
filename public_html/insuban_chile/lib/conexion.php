<?php

error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_WARNING);

$localhost = "localhost";
$user = "root";
$pass = "";
$db = "sistema_insuban";

$link = mysqli_connect($localhost, $user, $pass, $db);

if (!$link) {
    die("Error de conexión: " . mysqli_connect_error());
}


if (!function_exists('mysql_query')) {
    function mysql_query($query, $link_identifier = null) {
        global $link;
        $conn = $link_identifier ? $link_identifier : $link;
        return mysqli_query($conn, $query);
    }
}

if (!function_exists('mysql_fetch_array')) {
    function mysql_fetch_array($result) {
        return mysqli_fetch_array($result);
    }
}

if (!function_exists('mysql_num_rows')) {
    function mysql_num_rows($result) {
        return mysqli_num_rows($result);
    }
}

if (!function_exists('mysql_select_db')) {
    function mysql_select_db($database_name, $link_identifier = null) {
        return true; 
    }
}

if (!function_exists('mysql_error')) {
    function mysql_error($link_identifier = null) {
        global $link;
        return mysqli_error($link);
    }
}
?>