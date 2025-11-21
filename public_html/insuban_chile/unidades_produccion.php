<?
if($id_un){
$sql="SELECT * FROM unidad_produccion where id_unidad_produccion='$id_un'";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);
}else{
$sql="SELECT * FROM unidad_produccion where id_unidad_produccion = id_unidad_produccion and id_unidad_produccion != 0 order by id_unidad_produccion desc";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);
if(!$op) $op=0;
$sql="SELECT * FROM unidad_produccion WHERE id_unidad_produccion =id_unidad_produccion and id_unidad_produccion != 0 order by id_unidad_produccion desc LIMIT $op , 1";
$result=mysql_query($sql);
$ante=$op - 1;
$next=$op + 1;
$ultimo=$cuantos - 1;
}

if($grabar_x and $nombreuni){

  $sqlus=" select * from unidad_produccion where nombreuni='$nombreuni' ";
   $restus=mysql_query($sqlus);
   $cuantos_hay=mysql_num_rows($restus);
   if(!$cuantos_hay){ 

  $sql_nuevo="insert into unidad_produccion (id_etapa,nombreuni,direccion,comuna,ciudad,pais,telefono,encargado,reg_sag,nombre_faja,fajas_emitidas,cod_nombre_suc,etiquetas_emitidas) values ('$id_etapa','$nombreuni','$direccion','$comuna','$ciudad','$pais','$telefono','$encargado','$reg_sag','$nombre_faja','$fajas_e mitidas','$cod_nombre_suc','$etiquetas_emitidas')";
  $result_nuevo=mysql_query($sql_nuevo,$link);

/*$id_unidad_produccion=mysql_insert_id();

if ($id_especie) { 
 foreach ($id_especie as $key)
 {
 $sql="insert into cruce_unidad_produc_especie  (id_unidad_produccion,id_especie) values ($id_unidad_produccion,$key)";
 $res=mysql_query($sql);
 //echo "--> $sql <br>";
 }//fin for
}// if ($id_mat)*/

  echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=unidades_produccion.php\">";
  exit;
    }else{
  $mensaje="La Unidad de Medida ya existe en nuestra bases de datos<br>";
  }
}


  if($borrar){
  $sql_borrar="delete from unidad_produccion where id_unidad_produccion = $borrar";
  $r=mysql_query($sql_borrar,$link);
   echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=unidades_produccion.php\">";
   exit;
  }//fin borrar

if($modificar_x){
 $sql_modificar="UPDATE unidad_produccion set id_etapa='$id_etapa', nombreuni='$nombreuni', direccion='$direccion', comuna='$comuna', ciudad='$ciudad', pais='$pais', telefono='$telefono', encargado='$encargado', reg_sag='$reg_sag', nombre_faja='$nombre_faja', fajas_emitidas='$fajas_emitidas', cod_nombre_suc='$cod_nombre_suc', etiquetas_emitidas='$etiquetas_emitidas' where id_unidad_produccion=$id_unidad_produccion";
 //echo $sql_modificar;
  $rest=mysql_query($sql_modificar);

if ($id_especie) { 
$sql="delete from cruce_unidad_produc_especie where  id_unidad_produccion=$id_unidad_produccion";
 
 $res=mysql_query($sql);
 foreach ($id_especie as $key)
 {
 $sql="insert into cruce_unidad_produc_especie  (id_unidad_produccion,id_especie) values ($id_unidad_produccion,$key)";
 //echo "-->$sql<br>";
 $res=mysql_query($sql);
 }//fin for
}// if ($id_mat)


 if($id_un){
 echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=unidades_produccion.php&id_un=$id_un\">";
 exit;
 }else{
echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=unidades_produccion.php&op=$op\">";
 exit;
 }

}
/*
if($modificarlistar || $eliminar){
foreach ($_POST as $key => $value)
{
 $dat=split("-",$key);
 if ($dat[0] == 'bodegas')
	{
    $id=$dat[1];
    $bodegas=$_POST["bodegas-$id"];
    $sql_mod="UPDATE unidad_produccion SET  bodegas='$bodegas' where id_unidad_produccion = $id";
	$rest=mysql_query($sql_mod);
	}
}
if ($elim)
	    {
 		foreach ( $elim as $key => $value)
     	{
	 	$sql_elim="delete from unidad_produccion where id_unidad_produccion = $value";
	 	$r=mysql_query($sql_elim);
	 	} 
}
}
*/

?>
<script language="JavaScript" type="text/javascript"> 
<!-- 
function Confirmar(form1) { 

var borrar = confirm("Estás seguro/a de que desea eliminar el registro?"); 

return borrar; //true o false 

} 
//--> 
</script> 
<script language="JavaScript">
<!--
var nav4 = window.Event ? true : false;
function acceptNum(evt){	
// NOTE: Backspace = 8, Enter = 13, '0' = 48, '9' = 57	
var key = nav4 ? evt.which : evt.keyCode;	
return (key >= 48 && key <= 57);
}

function fixElement(element, message) {
alert(message);
element.focus();
}

function isMailReady(form1) {
var passed = false;

if (document.form1.nombreuni.value=="") {     
    alert('Debe ingresar Unidad Producción');
    document.form1.nombreuni.onfocus;
    return false;
}
if (document.form1.comuna.value=="") {     
    alert('Debe ingresar Comuna');
    document.form1.comuna.onfocus;
    return false;
}
if (document.form1.pais.value=="") {     
    alert('Debe ingresar País');
    document.form1.pais.onfocus;
    return false;
}
else {
getInfo(form1);
passed = true;
}
return passed;
}

function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</SCRIPT>
<style type="text/css">
<!--
.cajas {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.titulo {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; }
.style2 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14; font-weight: bold; }
.style4 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; color: #FF0000; }
.style6 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; color: #666666; }
.style8 {font-family: Arial, Helvetica, sans-serif; font-size: 10px; color: #666666; }
-->
</style>
<form id="form1" name="form1" method="post" action="" onsubmit = "return isMailReady(this);">
    
<table width="650" height="250" border="0" align="center">
  <tr>
    <td width="611" bgcolor="#CCCCCC" class="titulo">Unidad de Producci&oacute;n</td>
    <td width="35" bgcolor="#CCCCCC" class="cajas"><a href="?modulo=unidades_produccion_listar.php">Volver </a></td>
  </tr>
  <tr>
    <td colspan="2">
	  <? if(!$nuevo){?>
	  
	  <?
	  $i=$op;
      while ($row=mysql_fetch_array($result))
      { 
	  $id_unidad_produccion=$row[id_unidad_produccion];
      $i++;
	  
      ?>
	  
	  
	   <span class="titulo">
	   <input name="id_unidad_produccion" type="hidden" value="<?echo $row[id_unidad_produccion]?>" />
	   </span>
	   <table width="650" height="150" border="1" align="center" bordercolor="#999999">
         <tr>
           <td width="600"><table width="394" border="0" align="center">
             <tr>
               <td width="120" class="titulo"  ><div align="right">Unidad Producci&oacute;n:</div></td>
               <td><input name="nombreuni" type="text" class="cajas"  id="nombreuni" value="<?echo $row[nombreuni]?>" size="50" maxlength="30" /></td>
               <td><span class="style8">(*)</span></td>
             </tr>
             <tr>
               <td class="titulo"><div align="right">Comuna:</div></td>
               <td><input name="comuna" type="text" class="cajas"  id="comuna" value="<?echo $row[comuna]?>" size="50" maxlength="30"/></td>
               <td><span class="style8">(*)</span></td>
             </tr>
             <tr>
               <td class="titulo"><div align="right">Pa&iacute;s:</div></td>
               <td><input name="pais" type="text" class="cajas"  id="pais" value="<?echo $row[pais]?>" size="50" maxlength="30"/></td>
               <td><span class="style8">(*)</span></td>
             </tr>
             <tr>
               <td class="titulo"><div align="right">Tel&eacute;fono:</div></td>
               <td><input name="telefono" type="text" class="cajas"  id="telefono" value="<?echo $row[telefono]?>" size="50" maxlength="30"/></td>
               <td>&nbsp;</td>
             </tr>
             <tr>
               <td class="titulo"><div align="right">Encargado:</div></td>
               <td><input name="encargado" type="text" class="cajas"  id="encargado" value="<?echo $row[encargado]?>" size="50" maxlength="30"/></td>
               <td>&nbsp;</td>
             </tr>
             <tr>
               <td><div align="right"><span class="titulo">Direcci&oacute;n:</span></div></td>
               <td><input name="direccion" type="text" class="cajas"  id="direccion" value="<?echo $row[direccion]?>" size="50" maxlength="30" /></td>
               <td>&nbsp;</td>
             </tr>
             <tr>
               <td><div align="right"><span class="titulo">Ciudad:</span></div></td>
               <td><input name="ciudad" type="text" class="cajas"  id="ciudad" value="<?echo $row[ciudad]?>" size="50" maxlength="30"/></td>
               <td>&nbsp;</td>
             </tr>
             <tr>
               <td><div align="right"><span class="titulo">Estado:</span></div></td>
               <td><? 
			$etapa= crea_etapa($link,$row[id_etapa]);
			echo $etapa;
			?></td>
               <td>&nbsp;</td>
             </tr>
             <tr>
               <td><span class="titulo">Fajas</span></td>
               <td>&nbsp;</td>
               <td>&nbsp;</td>
             </tr>
             <tr>
               <td class="titulo"><div align="right">Reg. SAG: </div></td>
               <td width="250"><input name="reg_sag" type="text" class="cajas"  id="reg_sag" value="<?echo $row[reg_sag]?>" size="50" maxlength="10" /></td>
               <td width="10">&nbsp;</td>
             </tr>
             <tr>
               <td class="titulo"><div align="right">Nombre Faja: </div></td>
               <td><input name="nombre_faja" type="text" class="cajas"  id="nombre_faja" value="<?echo $row[nombre_faja]?>" size="50" maxlength="10"/></td>
               <td width="10">&nbsp;</td>
             </tr>
             <tr>
               <td class="titulo"><div align="right">Fajas Emitidas: </div></td>
               <td><input name="fajas_emitidas" type="text" class="cajas"  id="fajas_emitidas" value="<?echo $row[fajas_emitidas]?>" size="50" maxlength="10"/></td>
               <td width="10">&nbsp;</td>
             </tr>
             <tr>
               <td class="titulo"><div align="right">Etiquetas Internas </div></td>
               <td class="titulo">&nbsp;</td>
               <td width="10">&nbsp;</td>
             </tr>
             <tr>
               <td class="titulo"><div align="right">Cod. Nombre Suc.: </div></td>
               <td><input name="cod_nombre_suc" type="text" class="cajas"  id="cod_nombre_suc" value="<?echo $row[cod_nombre_suc]?>" size="50" maxlength="10" /></td>
               <td width="10">&nbsp;</td>
             </tr>
             <tr>
               <td class="titulo"><div align="right">Etiquetas Emitidas: </div></td>
               <td><input name="etiquetas_emitidas" type="text" class="cajas"  id="etiquetas_emitidas" value="<?echo $row[etiquetas_emitidas]?>" size="50" maxlength="10" /></td>
               <td width="10">&nbsp;</td>
             </tr>
             <tr>
               <td>&nbsp;</td>
               <td colspan="2"><? $id_bode=$row[id_unidad_produccion];?>
                 <span class="style8">(*)</span> <span class="style8">Datos obligatorios</span></td>
               </tr>
           </table></td>
         </tr>
       </table>
	   <? }}?>
	   <? if($nuevo){?>
	   <table width="650" height="150" border="1" align="center" bordercolor="#999999">
         <tr>
           <td width="600"><table width="397" border="0" align="center">
             <tr>
               <td width="123" class="titulo"  ><div align="right">Nombre:</div></td>
               <td><input name="nombreuni" type="text" class="cajas"  id="nombreuni" value="<? echo $nombreuni?>" size="50" maxlength="30" /></td>
               <td><span class="style8">(*)</span></td>
             </tr>
             <tr>
               <td class="titulo"><div align="right">Comuna:</div></td>
               <td><input name="comuna" type="text" class="cajas"  id="comuna" value="<? echo $comuna?>" size="50" maxlength="30"/></td>
               <td><span class="style8">(*)</span></td>
             </tr>
             <tr>
               <td class="titulo"><div align="right">Pa&iacute;s:</div></td>
               <td><input name="pais" type="text" class="cajas"  id="pais" value="<? echo $pais?>"  size="50" maxlength="30"/></td>
               <td><span class="style8">(*)</span></td>
             </tr>
             <tr>
               <td class="titulo"><div align="right">Tel&eacute;fono:</div></td>
               <td><input name="telefono" type="text" class="cajas"  id="telefono" value="<? echo $telefono?>" size="50" maxlength="30"/></td>
               <td>&nbsp;</td>
             </tr>
             <tr>
               <td class="titulo"><div align="right">Encargado:</div></td>
               <td><input name="encargado" type="text" class="cajas"  id="encargado" value="<? echo $encargado?>" size="50" maxlength="30"/></td>
               <td>&nbsp;</td>
             </tr>
             <tr>
               <td><div align="right"><span class="titulo">Direcci&oacute;n:</span></div></td>
               <td><input name="direccion" type="text" class="cajas"  id="direccion" value="<? echo $direccion?>" size="50" maxlength="30"/></td>
               <td>&nbsp;</td>
             </tr>
             <tr>
               <td><div align="right"><span class="titulo">Ciudad:</span></div></td>
               <td><input name="ciudad" type="text" class="cajas"  id="ciudad" value="<? echo $ciudad?>" size="50" maxlength="30"/></td>
               <td>&nbsp;</td>
             </tr>
             <tr>
               <td><div align="right"><span class="titulo">Estado:</span></div></td>
               <td><? 
			$etapa= crea_etapa($link,$id_etapa);
			echo $etapa;
			?></td>
               <td>&nbsp;</td>
             </tr>
             <tr>
               <td><div align="right"><span class="titulo">Fajas</span></div></td>
               <td>&nbsp;</td>
               <td>&nbsp;</td>
             </tr>
             <tr>
               <td class="titulo"><div align="right">Reg. SAG: </div></td>
               <td width="250"><input name="reg_sag" type="text" class="cajas"  id="reg_sag" value="<? echo $reg_sag?>" size="50" maxlength="10" /></td>
               <td width="10">&nbsp;</td>
             </tr>
             <tr>
               <td class="titulo"><div align="right">Nombre Faja: </div></td>
               <td><input name="nombre_faja" type="text" class="cajas"  id="nombre_faja" value="<? echo $nombre_faja?>"  size="50" maxlength="10"/></td>
               <td width="10">&nbsp;</td>
             </tr>
             <tr>
               <td class="titulo"><div align="right">Fajas Emitidas: </div></td>
               <td><input name="fajas_emitidas" type="text" class="cajas"  id="fajas_emitidas" value="<? echo $fajas_emitidas?>"  size="50" maxlength="10"/></td>
               <td width="10">&nbsp;</td>
             </tr>
             <tr>
               <td class="titulo"><div align="right">Etiquetas Internas </div></td>
               <td class="titulo">&nbsp;</td>
               <td width="10">&nbsp;</td>
             </tr>
             <tr>
               <td class="titulo"><div align="right">Cod. Nombre Suc.: </div></td>
               <td><input name="cod_nombre_suc" type="text" class="cajas"  id="cod_nombre_suc" value="<? echo $cod_nombre_suc?>"  size="50" maxlength="10" /></td>
               <td width="10">&nbsp;</td>
             </tr>
             <tr>
               <td class="titulo"><div align="right">Etiquetas Emitidas: </div></td>
               <td><input name="etiquetas_emitidas" type="text" class="cajas"  id="etiquetas_emitidas" value="<? echo $etiquetas_emitidas?>" size="50" maxlength="10" /></td>
               <td width="10">&nbsp;</td>
             </tr>
             <tr>
               <td>&nbsp;</td>
               <td><span class="style8">(*)</span> <span class="style8">Datos obligatorios</span></td>
               <td>&nbsp;</td>
             </tr>
             <tr>
               <td colspan="2"><div align="center">
                   <? if($mensaje) echo $mensaje?>
                 </div></td>
               <td>&nbsp;</td>
             </tr>
           </table></td>
         </tr>
       </table>
	   <? }?>
	   <table width="335" border="0" align="center">
         <tr>
           <td class="style2"><a href="?modulo=unidades_produccion.php&amp;op=<? echo $ultimo?>"><img src="jpg/primero.jpg" width="54" height="13" border="0" /></a></td>
           <td class="style2"><? if ($cuantos > $next and !$nuevo){ ?>
               <a href="?modulo=unidades_produccion.php&amp;op=<? echo $next?>" ><img src="jpg/anterior.jpg" width="58" height="13" border="0" /></a>
               <? }else{?>
             &nbsp;
             <? }?></td>
           <td><span class="style2">
             <? if($ante >= 0){ ?>
             <a href="?modulo=unidades_produccion.php&amp;op=<? echo $ante?>" ><img src="jpg/siguiente.jpg" width="54" height="13" border="0" /></a>
             <? }else{?>
             &nbsp;
             <? }?>
           </span></td>
           <td><? if ($cuantos){ ?>
               <a href="?modulo=unidades_produccion.php&amp;cancelar=1"><img src="jpg/ultimo.jpg" width="47" height="13" border="0" /></a>
               <? }?>           </td>
           <td width="47"><? if($permiso10 == 1){?><a href="?modulo=unidades_produccion.php&amp;nuevo=1" ><img src="jpg/nuevo.jpg" width="47" height="13" border="0" /></a><? }?></td>
           <td width="55"><a href="?modulo=unidades_produccion.php&amp;cancelar=1"><img src="jpg/cancelar.jpg" width="55" height="13" border="0" /></a></td>
           <td width="62"><? if($permiso10 == 1){?><? if(!$nuevo and $cuantos){?>
               <a href="javascript: document.form1.submit();">
               <label>
               <input type="image" name="modificar" src="jpg/modificar.jpg" />
               </label>
               </a>
               <? }?><? }?></td>
           <td width="55"><? if($permiso10 == 1){?><? if(!$cuantos or $nuevo or $mantsec ){?>
               <a href="javascript: document.form1.submit();">
               <label>
               <input type="image" name="grabar" src="jpg/guardar.jpg" />
               </label>
               </a>
               <? }?><? }?></td>
           <td width="45"><? if($permiso10 == 1){?><? if(!$nuevo and $cuantos){?>
               <a href="?modulo=unidades_produccion.php&amp;borrar=<?=$id_bode?>" onclick='return Confirmar(this.form1)'> <img src="jpg/borrar.jpg" width="45" height="13" border="0" /> </a>
               <? }?> <? }?></td>
           <td width="45"><? if(!$nuevo and $cuantos){?>
               <a href="?modulo=unidades_produccion_listar.php"><img src="jpg/listar.jpg" width="45" height="13" border="0" /></a>
               <? }?>           </td>
         </tr>
       </table></td>
  </tr>
</table>		  
</form>
