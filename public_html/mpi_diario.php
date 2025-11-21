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

$sql= "INSERT INTO mpi_diario
(mpi_diario_fecha,
cruce_tablas_id,
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
SELECT * FROM temp_mpi_diario";
/*
if ($conn->query($sql) === TRUE) {
    echo "Copia realizada";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
*/
$conn->close();
?>