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

$fech=date("Y-m-d");

$sql= "UPDATE temp_pt_diario SET pt_diario_fecha='$fech' ";
/*
if ($conn->query($sql) === TRUE) {
    echo "Actualizacion correcta";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
*/
$conn->close();
?>