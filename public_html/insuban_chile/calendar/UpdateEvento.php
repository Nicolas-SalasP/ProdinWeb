<?php
date_default_timezone_set("America/Santiago");
setlocale(LC_ALL,"es_ES");

require "config.php";
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");
                        
$idEvento         = $_POST['idEvento'];
$notas            = $_REQUEST['notas'];

//$notasf=utf8_encode(trim(preg_replace('/[\t\n\r\s]+/', ' ',$notas))); 


$UpdateProd = ("UPDATE observaciones SET observacion='$notas' where id_pedido= '".$idEvento."' ");
$result = mysql_query($UpdateProd);

header("Location:index.php?ea=1");
?>