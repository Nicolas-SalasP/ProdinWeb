<?
if($id_da){
$sql="SELECT * FROM datos_empresa  where id_datos_empresa='$id_da' order by id_datos_empresa desc";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);
}else{
$sql="SELECT * FROM datos_empresa where id_datos_empresa = id_datos_empresa and id_datos_empresa != 0 order by id_datos_empresa desc";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);
if(!$op) $op=0;
$sql="SELECT * FROM datos_empresa WHERE id_datos_empresa=id_datos_empresa and id_datos_empresa != 0 order by id_datos_empresa desc LIMIT $op , 1";
$result=mysql_query($sql);
$ante=$op - 1;
$next=$op + 1;
$ultimo=$cuantos - 1;
}

  if($grabar_x and $nombreemp){
  
   $sqlus=" select * from datos_empresa where nombreemp='$nombreemp' ";
   $restus=mysql_query($sqlus);
   $cuantos_hay=mysql_num_rows($restus);
  if(!$cuantos_hay){ 
  $sql_nuevo="insert into datos_empresa (nombreemp,direccion,comuna,ciudad,telefono,fax,rut) values ('$nombreemp','$direccion','$comuna','$ciudad','$telefono','$fax','$rut')";
  $result_nuevo=mysql_query($sql_nuevo,$link);
  echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=datos_empresa.php\">";
  exit;
  }else{
  $mensaje="La Empresa, ya existe en nuestra bases de datos<br>";
  }
  
  
  }
  

   if($borrar){
   $sql_borrar="delete from datos_empresa where id_datos_empresa = $borrar";
   $r=mysql_query($sql_borrar,$link);
   echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=datos_empresa.php\">";
   exit;
  }//fin borrar
  
  
  if($modificar_x){
 $sql_modificar="UPDATE  datos_empresa set nombreemp='$nombreemp', direccion='$direccion', comuna='$comuna',ciudad='$ciudad', telefono='$telefono', fax='$fax', rut='$rut' where id_datos_empresa=$id_datos_empresa";
//echo "$sql_modificar";
$rest=mysql_query($sql_modificar);

 if($id_da){
 echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=datos_empresa.php&id_da=$id_da\">";
 exit;
 }else{
 echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=datos_empresa.php&op=$op\">";
 exit;
 }
}

if($modificarlistar || $eliminar){
foreach ($_POST as $key => $value)
{
 $dat=split("-",$key);
 if ($dat[0] == 'nombre')
	{
    $id=$dat[1];
    $nombre=$_POST["nombre-$id"];
	$apellido=$_POST["apellido-$id"];
	$iniciales=$_POST["iniciales-$id"];
	$ficha=$_POST["ficha-$id"];
	$cod_remun=$_POST["cod_remun-$id"];
	$id_funcion_operarios=$_POST["id_funcion_operarios-$id"];
	$id_estado=$_POST["id_estado-$id"];
	
	$sql_mod="UPDATE operarios SET  id_funcion_operarios='$id_funcion_operarios', id_estado='$id_estado', nombreemp='$nombreemp', apellido='$apellido', iniciales='$iniciales', ficha='$ficha', cod_remun='$cod_remun' where id_operarios = $id";
	$rest=mysql_query($sql_mod);
	}
}
if ($elim)
	    {
 		foreach ( $elim as $key => $value)
     	{
	 	$sql_elim="delete from operarios where id_operarios = $value";
	 	$r=mysql_query($sql_elim);
	 	} 
}
} 

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

if (document.form1.nombreemp.value=="") {     
    alert('Debe ingresar Nombre Empresa');
    document.form1.nombreemp.onfocus;
    return false;
}
if (document.form1.direccion.value=="") {     
    alert('Debe ingresar Dirección');
    document.form1.direccion.onfocus;
    return false;
}
if (document.form1.comuna.value=="") {     
    alert('Debe ingresar Comuna');
    document.form1.comuna.onfocus;
    return false;
}

if (document.form1.ciudad.value=="") {     
    alert('Debe ingresar Ciudad');
    document.form1.ciudad.onfocus;
    return false;
}
if (document.form1.rut.value=="") {     
    alert('Debe ingresar Rut');
    document.form1.rut.onfocus;
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
.style8 {font-family: Arial, Helvetica, sans-serif; font-size: 10px; color: #666666; }
.style4 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; color: #FF0000; }
-->
</style>

<form id="form1" name="form1" method="post" action="" onsubmit = "return isMailReady(this);">
<table width="600" border="0" align="center">
  <tr>
    <td width="614" bgcolor="#CCCCCC" class="titulo">Datos Empresa </td>
    <td width="32" bgcolor="#CCCCCC"><a href="?modulo=datos_empresa_listar.php" class="cajas">Volver</a></td>
  </tr>
  <tr>
    <td colspan="2"><? if(!$nuevo){?>
      <?
	  $i=$op;
      while ($row=mysql_fetch_array($result))
      { 
	  $id_datos_empresa=$row[id_datos_empresa];
	  $i++;
      ?>
      <span class="titulo">
      <input name="id_datos_empresa" type="hidden" value="<?echo $row[id_datos_empresa]?>" />
      </span>
      <table width="650" height="250" border="1" align="center" bordercolor="#999999">
        <tr>
          <td width="600"><table width="347" border="0" align="center">
            <tr>
              <td width="71" class="titulo"  ><div align="right">Empresa:</div></td>
              <td width="250"><input name="nombreemp" type="text" class="cajas" value="<?echo $row[nombreemp]?>" size="50" maxlength="30" /></td>
              <td width="12"><span class="style8">(*)</span></td>
            </tr>
            <tr>
              <td class="titulo"><div align="right">Direcci&oacute;n:</div></td>
              <td><input name="direccion" type="text" class="cajas" value="<?echo $row[direccion]?>" size="50" maxlength="30" /></td>
              <td><span class="style8">(*)</span></td>
            </tr>
            <tr>
              <td class="titulo"><div align="right">Comuna:</div></td>
              <td><input name="comuna" type="text" class="cajas" value="<?echo $row[comuna]?>" size="50" maxlength="20" /></td>
              <td><span class="style8">(*)</span></td>
            </tr>
            <tr>
              <td class="titulo"><div align="right">Ciudad:</div></td>
              <td><input name="ciudad" type="text" class="cajas" value="<?echo $row[ciudad]?>" size="50" maxlength="30" /></td>
              <td><span class="style8">(*)</span></td>
            </tr>
            <tr>
              <td class="titulo"><div align="right">Tel&eacute;fono:</div></td>
              <td><input name="telefono" type="text" class="cajas" value="<?echo $row[telefono]?>" size="50" maxlength="20" /></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td class="titulo"><div align="right">Fax:</div></td>
              <td><input name="fax" type="text" class="cajas" value="<?echo $row[fax]?>" size="50" maxlength="20" /></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td class="titulo"><div align="right">Rut:</div></td>
              <td><input name="rut" type="text" class="cajas" value="<?echo $row[rut]?>" size="50" maxlength="20" /></td>
              <td><span class="style8">(*)</span></td>
            </tr>
            <tr>
              <td >&nbsp;</td>
              <td colspan="2" ><? $id_bode=$row[id_datos_empresa];?> <span class="style8">(*)</span> <span class="style8">Datos obligatorios</span></td>
              </tr>
          </table></td>
        </tr>
      </table>
      <?}}?>
      <? if($nuevo){?>
      <table width="650" height="150" border="1" align="center" bordercolor="#999999">
        <tr>
          <td width="600"><table width="387" border="0" align="center">
            <tr>
              <td width="80" class="titulo"  ><div align="right">Empresa:</div></td>
              <td width="250"><input name="nombreemp" type="text" class="cajas" id="nombreemp" value="<? echo $nombreemp?>" size="50" maxlength="30" /></td>
              <td width="250"><span class="style8">(*)</span></td>
            </tr>
            <tr>
              <td class="titulo"><div align="right">Direcci&oacute;n:</div></td>
              <td><input name="direccion" type="text" class="cajas" value="<? echo $direccion?>" size="50" maxlength="30" /></td>
              <td><span class="style8">(*)</span></td>
            </tr>
            <tr>
              <td class="titulo"><div align="right">Comuna:</div></td>
              <td><input name="comuna" type="text" class="cajas" value="<? echo $comuna?>" size="50" maxlength="20" /></td>
              <td><span class="style8">(*)</span></td>
            </tr>
            <tr>
              <td class="titulo"><div align="right">Ciudad:</div></td>
              <td><input name="ciudad" type="text" class="cajas" value="<? echo $ciudad?>" size="50" maxlength="30" /></td>
              <td><span class="style8">(*)</span></td>
            </tr>
            <tr>
              <td class="titulo"><div align="right">Tel&eacute;fono:</div></td>
              <td><input name="telefono" type="text" class="cajas" value="<? echo $telefono?>" size="50" maxlength="20" /></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td class="titulo"><div align="right">Fax:</div></td>
              <td><input name="fax" type="text" class="cajas" value="<? echo $fax?>" size="50" maxlength="20" /></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td class="titulo"><div align="right">Rut:</div></td>
              <td><input name="rut" type="text" class="cajas" value="<? echo $rut?>" size="50" maxlength="20" /></td>
              <td><span class="style8">(*)</span></td>
            </tr>
            <tr>
              <td >&nbsp;</td>
              <td ><span class="style8">(*)</span> <span class="style8">Datos obligatorios</span></td>
              <td >&nbsp;</td>
            </tr>
            <tr>
              <td colspan="3" ><div align="center"><span class="style4">
                <? if($mensaje) echo $mensaje?>
              </span></div></td>
              </tr>
          </table></td>
        </tr>
      </table>
      <? }?>
      <table width="335" border="0" align="center">
        <tr>
          <td class="style2"><a href="?modulo=datos_empresa.php&amp;op=<? echo $ultimo?>"><img src="jpg/primero.jpg" width="54" height="13" border="0" /></a></td>
          <td class="style2"><? if ($cuantos > $next and !$nuevo){ ?>
              <a href="?modulo=datos_empresa.php&amp;op=<? echo $next?>" ><img src="jpg/anterior.jpg" width="58" height="13" border="0" /></a>
              <? }else{?>
            &nbsp;
            <? }?></td>
          <td><span class="style2">
            <? if($ante >= 0){ ?>
            <a href="?modulo=datos_empresa.php&amp;op=<? echo $ante?>" ><img src="jpg/siguiente.jpg" width="54" height="13" border="0" /></a>
            <? }else{?>
            &nbsp;
            <? }?>
          </span></td>
          <td><? if ($cuantos){ ?>
              <a href="?modulo=datos_empresa.php&amp;cancelar=1"><img src="jpg/ultimo.jpg" width="47" height="13" border="0" /></a>
              <? }?>          </td>
          <td width="47"><? if($permiso16 == 1){?><a href="?modulo=datos_empresa.php&amp;nuevo=1" ><img src="jpg/nuevo.jpg" width="47" height="13" border="0" /></a><? }?></td>
          <td width="55"><a href="?modulo=datos_empresa.php&amp;cancelar=1"><img src="jpg/cancelar.jpg" width="55" height="13" border="0" /></a></td>
          <td width="62"><? if($permiso16 == 1){?><? if(!$nuevo and $cuantos){?>
              <a href="javascript: document.form1.submit();">
              <label>
              <input type="image" name="modificar" src="jpg/modificar.jpg" />
              </label>
              </a>
              <? }?><? }?>          </td>
          <td width="55"><? if($permiso16 == 1){?><? if(!$cuantos or $nuevo or $mantsec ){?>
              <a href="javascript: document.form1.submit();">
              <label>
              <input type="image" name="grabar" src="jpg/guardar.jpg" />
              </label>
              </a>
              <? }?><? }?>          </td>
          <td width="45"><? if($permiso16 == 1){?><? if(!$nuevo and $cuantos){?>
              <a href="?modulo=datos_empresa.php&amp;borrar=<?=$id_bode?>" onclick='return Confirmar(this.form1)'> <img src="jpg/borrar.jpg" width="45" height="13" border="0" /> </a>
              <? }?><? }?>          </td>
          <td width="45"><? if(!$nuevo and $cuantos){?>
              <a href="?modulo=datos_empresa_listar.php"><img src="jpg/listar.jpg" width="45" height="13" border="0" /></a>
              <? }?>          </td>
        </tr>
      </table></td>
  </tr>
</table>
</form>