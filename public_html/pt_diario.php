<?php
$servername = "190.107.176.73:3306";
$username = "prodinwe_stgo391";
$password = "391stgo.*.";
$dbname = "prodinwe_insubanchile";
$url="http://190.107.176.73/~prodinwe/insuban_chile";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql= "INSERT INTO pt_diario
(pt_diario_fecha,
pt_diario_codigo,
pt_diario_folio,
pt_diario_estado,
pt_diario_producto,
pt_diario_calibre,
pt_diario_umedida,
pt_diario_medida,
pt_diario_cproducto,
pt_diario_cenvase,
pt_diario_contenido)
SELECT * FROM temp_pt_diario ";
/*
if ($conn->query($sql) === TRUE) {
    echo "Copia realizada";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
*/
$conn->close();
?>