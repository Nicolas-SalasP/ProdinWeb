<meta charset="utf-8">
<form name="form" method="POST" action="">
   <tr>
      <td>Fecha producción<input type="date" name="fecha" value="<? echo $fecha ?>"></td>
      <input type="submit" name="buscar" value="Buscar"> (Solo Entubado)
   </tr>
</form>
<style type="text/css">
   
   th {
      background: orange;
      color: black;
   }

</style>
<?
if ($buscar) {

$query2=mysql_query("SELECT asp.id_prfap, asp.id_folio_mpn_mpi, org.origen, ldp.ldp, asp.fecha_asig_producc, mpn.contenido as cont1, mpi.contenido as cont2
FROM planilla_registro_fecha_asig_produccion As asp 
left outer join origenes As org on org.id_origen = asp.id_origen
left outer join lineas_de_procesos As ldp on ldp.id_ldp = asp.id_ldp
left outer join mat_prima_nacional as mpn on mpn.id_mat_prima_nacional = asp.id_folio_mpn_mpi
left outer join mat_prima_importada as mpi on mpi.id_mat_prima_importada = asp.id_folio_mpn_mpi 
where asp.fecha_asig_producc = '$fecha' and asp.id_ldp = 1 ");
if($query2 == true) {

echo "<table border = '1' width='100%' > \n";
echo "<tr>
      <th>ID</th><th>FOLIO_MPN_MPI</th><th>ORIGEN</th><th>L.D.P.</th><th>FECHA_ASIG_PRODUCC</th><th>CONT.MPN</th><th>CONT.MPI</th></tr> \n";}
 while ($row2=mysql_fetch_row($query2)) {

$sum5+=$row2[5];
$sum6+=$row2[6];
$sumtot=$sum6 + $sum5;

   echo "<tr>
      <td>$row2[0]</td><td>$row2[1]</td><td>$row2[2]</td><td>$row2[3]</td><td>$row2[4]</td><td align='center'>$row2[5]</td><td align='center'>$row2[6]</td></tr> \n";
}
echo "</table> \n";

 echo "<table border ='0' width='100%'>";
echo "<tr>
            <td width='530' nowrap='nowrap'></td>    
            <td nowrap='nowrap' style='background-color:yellow'><strong>SUBTOTAL :</strong></td>
            <td width='120' nowrap='nowrap' style='background-color:yellow'><b> $sum5 </b></td>
            <td width='110' nowrap='nowrap' style='background-color:yellow'><b> $sum6 </b></td></tr>";
 echo "<tr>
            <td width='530' nowrap='nowrap'></td>    
            <td nowrap='nowrap' style='background-color:yellow'><strong>TOTAL :</strong></td>
            <td width='120' nowrap='nowrap' style='background-color:yellow'>&nbsp;</td>            
            <td width='110' nowrap='nowrap' style='background-color:yellow'><b> $sumtot </b></td></tr>";
echo "</table>";


}
?>
