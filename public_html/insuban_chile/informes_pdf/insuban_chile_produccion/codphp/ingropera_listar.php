<?

if($modificarx){

foreach ($_POST as $key => $value)
{ 
 $dat=split("-",$key); 
   if ($dat[0] == 'orden')
   {
	$id=$dat[1];
   	$ordenn=$_POST["orden-$id"];
	$id_operarios=$_POST["id_operarios-$id"];
	//echo "orden $orden / $id_operarios<br>";
	$sqlupdate="UPDATE operarios  set orden = $ordenn where id_operarios  = $id_operarios";
 	$resultupdate=mysql_query($sqlupdate);
	//echo "sqlupdate $sqlupdate<br>";
	
	//echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=ingropera_listar.php&id_ldp=$id_ldp\">";
    //exit;
   }
}

}


if($id_ldp){
$sql="SELECT o.id_operarios, o.apellido AS apellidoop, o.nombreop AS nombreop, o.iniciales AS iniciales, e.estado AS estado, o.fecha_ingreso AS fecha_ingreso, lp.ldp AS ldp, o.orden AS orden FROM operarios AS o, estado AS e, lineas_de_procesos AS lp where o.id_operarios != 0 and o.id_estado=e.id_estado and o.id_ldp = lp.id_ldp and lp.id_ldp = $id_ldp order by o.nombreop asc";
}else{
$sql="SELECT o.id_operarios, o.apellido AS apellidoop, o.nombreop AS nombreop, o.iniciales AS iniciales, e.estado AS estado, o.fecha_ingreso AS fecha_ingreso, lp.ldp AS ldp, o.id_ldp AS id_ldp, o.orden AS orden FROM operarios AS o, estado AS e, lineas_de_procesos AS lp where o.id_operarios != 0 and o.id_estado=e.id_estado and o.id_ldp = lp.id_ldp order by o.nombreop asc";
}
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);
//echo "cuantos $cuantos";


?>
<table width="98%" border="0">
  <tr>
    
    <td width="25" height="19" bgcolor="#FF9933"><? //echo $id_ldp?></td>
    <td colspan="7" bgcolor="#CCCCCC"><strong>&nbsp;Total Operarios: <?echo $cuantos?></strong></td>
  </tr>
  <tr>
    <td width="25" height="19" nowrap="nowrap" bgcolor="#FF9933"><center>
      <strong>&nbsp;N&ordm;</strong>
    </center></td>
    <td width="179" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;NOMBRE</strong></td>
    <td width="328" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;APELLIDOS</strong></td>
    <td width="85" align="center" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;INICIALES</strong></td>
    <td width="172" align="center" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;LINEA PRODUCCI&Oacute;N</strong></td>
    <td width="78" align="center" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;ORDEN</strong></td>
    <td width="90" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;F/INGRESO</strong></td>
    <td width="80" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;ESTADO</strong></td>
  </tr>
  <?
	if($cuantos){
    $i=$op;
    $color = "#000000";$i = 0;
    while ($row=mysql_fetch_array($result))
    {
	$i++;
	$color = ($color == "#CCCCCC") ? "#FFFFFF" : "#CCCCCC";
	$id_operarios=$row[id_operarios];
	$nombreop=$row[nombreop];
	$apellidoop=$row[apellidoop];
	$inicialesop=$row[iniciales];
	$estadoop=$row[estado];
	$ldp=$row[ldp];
	$id_ldp=$row[ldp];
	$orden=$row[orden];
    $fecha_ingreso=format_fecha_sin_hora($row[fecha_ingreso]);

  ?>
  <tr>
    <td height="19" nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $i?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<a href="?modulo=ingropera.php&id_operarios=<? echo $id_operarios?>"><? echo $nombreop?></a></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<a href="?modulo=ingropera.php&id_operarios=<? echo $id_operarios?>"><? echo $apellidoop?></a></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>"><center>&nbsp;<? echo $inicialesop?></center></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>"><center>&nbsp;<? echo $ldp ?></center></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>"><center>&nbsp;<input name="orden-<? echo $id_operarios ?>" type="text" id="orden" value="<? echo $orden?>" size="3" maxlength="3" /><input type="hidden" name="id_operarios-<? echo $id_operarios?>" id="id_operarios" value="<? echo $id_operarios?>" />
    </center></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $fecha_ingreso?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $estadoop?></td>
    <? }
	}
	?>
  </tr>
   <tr>
    <td height="19" nowrap="nowrap">&nbsp;</td>
    <td nowrap="nowrap">&nbsp;</td>
    <td nowrap="nowrap">&nbsp;</td>
    <td nowrap="nowrap">&nbsp;</td>
    <td nowrap="nowrap">&nbsp;</td>
    <td nowrap="nowrap">
    <? if($id_ldp){?>
    <input type="submit" name="modificarx" id="modificarx" value="Modificar" />
    <? } ?>
    </td>
    <td nowrap="nowrap">&nbsp;</td>
    <td nowrap="nowrap">&nbsp;</td>
  </tr>
</table>