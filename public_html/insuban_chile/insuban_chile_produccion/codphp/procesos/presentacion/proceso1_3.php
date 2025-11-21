<meta charset="utf-8">
<form name="form" method="POST" action="">
   <tr>
      <td>Fecha producción desde<input type="date" name="desde" value="<? echo $desde ?>"></td>
      <td>Fecha producción hasta<input type="date" name="hasta" value="<? echo $hasta ?>"></td>      
      <input type="submit" name="buscar" value="Buscar"> (Todos los Procesos)
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

$query2=mysql_query("SELECT asp.id_prfap, asp.id_folio_mpn_mpi, org.origen, ldp.ldp, asp.fecha_asig_producc, mpn.contenido as cont1, mpi.contenido as cont2, mpi.folio_m3_mpi, mpn.bidon_num, pro.producto
FROM planilla_registro_fecha_asig_produccion As asp 
left outer join origenes As org on org.id_origen = asp.id_origen
left outer join lineas_de_procesos As ldp on ldp.id_ldp = asp.id_ldp
left outer join mat_prima_nacional as mpn on mpn.id_mat_prima_nacional = asp.id_folio_mpn_mpi
left outer join mat_prima_importada as mpi on mpi.id_mat_prima_importada = asp.id_folio_mpn_mpi
left outer join etiquetados_folios as etf on etf.id_etiquetados_folios = asp.id_folio_mpn_mpi
left outer join producto as pro on mpn.id_producto = pro.id_producto 
where asp.fecha_asig_producc between '$desde' and '$hasta' ");
if($query2 == true) {

echo "<table border = '1' width='100%' > \n";
echo "<tr>
      <th>ID</th><th>FOLIO_MPN_MPI</th><th>FOLIO_M3</th><th>ORIGEN</th><th>PRODUCTO</th><th>N_BIDON</th><th>L.D.P.</th><th>FECHA_ASIG_PRODUCC</th><th>CONT.MPN</th><th>CONT.MPI</th></tr> \n";}
 while ($row2=mysql_fetch_row($query2)) {

$sum5+=$row2[5];
$sum6+=$row2[6];
$sumtot=$sum6 + $sum5;

   echo "<tr>
      <td>$row2[0]</td><td>$row2[1]</td><td>$row2[7]</td><td>$row2[2]</td><td>$row2[9]</td><td>$row2[8]</td><td>$row2[3]</td><td>$row2[4]</td><td align='center'>$row2[5]</td><td align='center'>$row2[6]</td></tr> \n";
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
