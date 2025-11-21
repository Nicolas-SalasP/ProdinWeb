<html> 

<body> 

<?php 
// Actualizamos en funcion del id que recibimos 

$id = $_GET['id']; 

require("../datos/connection.php");
mysql_select_db("$database", $con);   

$query = "delete from salado where idCodigo = '$id'";  
$result = mysql_query($query,$con);  

print("<script>window.location.replace('../presentacion/func.search_5.php');</script>");
?> 

</body> 

</html> 
