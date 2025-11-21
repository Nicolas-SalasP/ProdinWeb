
<style type="text/css">
<!--
.cajas {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.titulo {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; }
-->
</style>
<form id="form1" name="form1" method="post" action="">
<table width="800" height="180" border="0" align="center">
  <tr>
    <td valign="top"><table width="100%" border="1" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="14" colspan="6" bgcolor="#CCCCCC" class="titulo">
          <?
        $estado= crea_estado_onchange($link,$row[id_estado]);
			echo $estado;
		?>
          <?
$sql="SELECT * FROM operarios AS o, estado AS e where o.id_operarios != 0 and o.id_estado=e.id_estado ";

if($id_estado){
$sql.= " and e.id_estado = '$id_estado'";
}else{
$sql.= " and e.id_estado = 1";
}
	
$sql.= " order by e.estado, o.apellido asc";
$result=mysql_query($sql);
//echo "sql $sql<br>";
$cuantos=mysql_num_rows($result);
?>
/          
        </td>
        <td height="14" colspan="3" align="center" bgcolor="#CCCCCC" class="titulo"><a href="?modulo=operarios.php&amp;nuevo=1" >Ingresar Nuevo</a></td>
        </tr>
      <tr>
        <td width="24" height="14" bgcolor="#CCCCCC" class="titulo">&nbsp;N&ordm;</td>
        <td width="51" bgcolor="#CCCCCC" class="titulo">&nbsp;Estado</td>
        <td width="114" bgcolor="#CCCCCC" class="titulo">Centro de Costo</td>
        <td width="79" height="14" bgcolor="#CCCCCC" class="titulo">&nbsp;Nombre</td>
        <td width="130" bgcolor="#CCCCCC" class="titulo">&nbsp;Apellidos</td>
        <td width="77" bgcolor="#CCCCCC" class="titulo"> Letra</td>
        <td width="143" bgcolor="#CCCCCC" class="titulo">Linea de Proceso</td>
        <td width="81" bgcolor="#CCCCCC" class="titulo">Grupo</td>
        <td width="75" bgcolor="#CCCCCC" class="titulo">&nbsp;<span class="linknegro">ID </span></td>
      </tr>
      <?
	$i=0;
	while ($row=mysql_fetch_array($result))
    { 
	$id_operarios=$row[id_operarios];
	$letra=$row[letra];
	$id_ldp=$row[id_ldp];
	$centrocosto=$row[centrocosto];
	$id_grupo=$row[id_grupo];
	$i++;
	?>
      <tr>
        <td nowrap="nowrap" class="cajas">&nbsp;<? echo $i;?></td>
        <td nowrap="nowrap" class="cajas">&nbsp;<a href="?modulo=operarios.php&id_op=<?echo $row[id_operarios]?>"><?echo $row[estado]?></a>&nbsp;</td>
        <td nowrap="nowrap" class="cajas">&nbsp;<? echo $centrocosto?></td>
        <td nowrap="nowrap" class="cajas">&nbsp;<a href="?modulo=operarios.php&id_op=<?echo $row[id_operarios]?>"><?
        $nombreop = strtoupper($row[nombreop]);	echo $nombreop?></a>&nbsp;</td>
        <td nowrap="nowrap" class="cajas">&nbsp;<a href="?modulo=operarios.php&id_op=<?echo $row[id_operarios]?>"><?  $apellido = strtoupper($row[apellido]); echo $apellido?></a>&nbsp;</td>
        <td nowrap="nowrap" class="cajas">&nbsp;
        <?
        		
		$sqlg="SELECT * FROM operarios AS o, grupo AS g where o.id_operarios = $id_operarios and o.id_grupo = g.id_grupo";
	    $resultg=mysql_query($sqlg);
	    $cuantosg=mysql_num_rows($resultg);
		if ($rowg=mysql_fetch_array($resultg))
    	{ 
		$grupo=$rowg[grupo];
		echo "$grupo";
		}
		
		
		?>
        </td>
        <td nowrap="nowrap" class="cajas">&nbsp;
		<?
		
		$sqldd="SELECT * FROM lineas_de_procesos where id_ldp = $id_ldp";
	    $resultdd=mysql_query($sqldd);
	    $cuantosdd=mysql_num_rows($resultdd);
		if ($rowdd=mysql_fetch_array($resultdd))
    	{ 
		$ldp=$rowdd[ldp];
		$ldp = strtoupper($ldp);
		echo "$ldp";
		
		}
		
		?>
        </td>
        <td nowrap="nowrap" class="cajas">&nbsp;<? echo $id_grupo?></td>
        <td nowrap="nowrap" class="cajas">&nbsp;<? echo $id_operarios;?></td>
      </tr>
      <? }?>
    </table></td>
  </tr>
</table>
</form>