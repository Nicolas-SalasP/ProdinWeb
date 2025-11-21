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

$sql= "INSERT INTO temp_mpi_diario
(cruce_tablas_id,
id_mat_prima_importada,
estado_material,
contenido,
origen,
producto,
calibre,
unidad_medida,
medidas_productos,
caract_producto,
caract_envases)
SELECT mpi.cruce_tablas_id ,mpi.id_mat_prima_importada, est.estado_material,  mpi.contenido,    org.origen ,   prd.producto,  cal.calibre, um.unidad_medida, mp.medidas_productos, cp.caract_producto, ce.caract_envases
FROM mat_prima_importada as mpi, origenes as org, producto as prd, estado_material as est, calibre as cal, unidad_medida as um, medidas_productos as mp, caract_producto as cp, caract_envases as ce 
WHERE mpi.id_origen = org.id_origen
and mpi.id_producto = prd.id_producto
and mpi.id_estado_material = est.id_estado_material
and mpi.id_calibre = cal.id_calibre
and mpi.id_unidad_medida = um.id_unidad_medida
and mpi.id_medidas_productos = mp.id_medidas_productos
and mpi.id_caract_producto = cp.id_caract_producto
and mpi.id_caract_envases = ce.id_caract_envases 
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