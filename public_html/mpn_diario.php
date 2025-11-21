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

$sql= "INSERT INTO mpn_diario
(mpn_diario_fecha,
id_mat_prima_nacional,
comprobante_num,
factura_mp,
origen,
producto,
contenido,
estado_material)
SELECT * FROM temp_mpn_diario";
 /*
if ($conn->query($sql) === TRUE) {
    echo "Copia realizada";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
*/
$conn->close();
?>