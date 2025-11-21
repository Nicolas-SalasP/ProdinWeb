<?
require("../datos/connection.php");
mysql_select_db("$database", $con);

$query2=mysql_query("SELECT * FROM remojo ORDER BY id DESC ", $con);
if($query2 == true) {

echo "<table border = '1' width='100%'   > \n";
echo "<tr>
      <th>ID</th><th>FECHA</th><th>PRODUCTO</th><th>ORIGEN</th><th>N_BIDON</th><th>N_MALLAS</th><th>F/FAENA</th><th>GRUPO</th><th>F/PRODUCCION</th></tr> \n";
 while ($row2=mysql_fetch_row($query2)) {
   echo "<tr>
      <td>$row2[0]</td><td>$row2[1]</td><td>$row2[2]</td><td>$row2[3]</td><td>$row2[4]</td><td>$row2[5]</td><td>$row2[6]</td><td>$row2[7]</td><td>$row2[8]</td>
   </tr> \n";
}
echo "</table> \n";
}
?>