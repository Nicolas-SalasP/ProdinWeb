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

$sql= "INSERT INTO temp_mpn_diario
(id_mat_prima_nacional,
comprobante_num,
factura_mp,
origen,
producto,
contenido,
estado_material)
SELECT mpn.id_mat_prima_nacional, mpn.comprobante_num,  mpn.factura_mp,    org.origen ,   prd.producto,  contenido, est.estado_material
FROM mat_prima_nacional as mpn, origenes as org, producto as prd, estado_material as est 
WHERE mpn.id_origen = org.id_origen
and mpn.id_producto = prd.id_producto
and mpn.id_estado_material = est.id_estado_material 
and ano between 2015 and 2017";
/*
if ($conn->query($sql) === TRUE) {
    echo "Nuevo registro creado correctamente";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
*/
$conn->close();
?>