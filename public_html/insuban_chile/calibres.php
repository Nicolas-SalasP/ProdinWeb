<?
if($id_cali){
$sql="SELECT * FROM calibre where id_calibre='$id_cali' and calibre != '' order by id_calibre desc";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);
}else{
$sql="SELECT * FROM calibre where id_calibre = id_calibre and calibre != '' and id_calibre != 0 order by id_calibre desc";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);
if(!$op) $op=0;
$sql="SELECT * FROM calibre WHERE id_calibre=id_calibre and calibre != '' and id_calibre != 0 order by id_calibre desc LIMIT $op , 1";
$result=mysql_query($sql);
$ante=$op - 1;
$next=$op + 1;
$ultimo=$cuantos - 1;
} 
if($grabar_x and $nombre_calibre){
  $sqlus=" select * from calibre where calibre='$nombre_calibre'";
   $restus=mysql_query($sqlus);
   $cuantos_hay=mysql_num_rows($restus);
   if(!$cuantos_hay){
  $sql_nuevo="insert into calibre (calibre,color,calibre_cod_barra,condicion_cod_barra,carasteristica_cod_barra) values ('$nombre_calibre','$color','$calibre_cod_barra','$condicion_cod_barra','$carasteristica_cod_barra')";
   $result_nuevo=mysql_query($sql_nuevo,$link);
  //header( 'Location: index.php?modulo=bodegas.php&op='.( $cuantos++ ) );
  echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=calibres.php\">";
  exit;
     }else{
  $mensaje="El Calibre ya existe en nuestra bases de datos<br>";
  }
}

 if($borrar){
   $sql_borrar="delete from calibre where id_calibre = $borrar";
   $r=mysql_query($sql_borrar,$link);
   echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=calibres.php&op=$op\">";
   exit;
  }//fin borrar

if($modificar_x){
 $sql_modificar="UPDATE  calibre set calibre='$nombre_calibre', color='$color', calibre_cod_barra='$calibre_cod_barra', condicion_cod_barra='$condicion_cod_barra', carasteristica_cod_barra='$carasteristica_cod_barra' where id_calibre=$id_calibre";
$rest=mysql_query($sql_modificar);
//echo $sql_modificar;
 if($id_cali){
 echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=calibres.php&id_cali=$id_cali\">";
 exit;
 }else{
 echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=calibres.php&op=$op\">";
 exit;
 }
}

if($modificarlistar || $eliminar){
foreach ($_POST as $key => $value)
{
 $dat=split("-",$key);
 if ($dat[0] == 'calibre')
	{
    $id=$dat[1];
    $calibre=$_POST["calibre-$id"];
	$color=$_POST["color-$id"];
	$calibre_cod_barra=$_POST["calibre_cod_barra-$id"];
	$condicion_cod_barra=$_POST["condicion_cod_barra-$id"];
	$carasteristica_cod_barra=$_POST["carasteristica_cod_barra-$id"];
	$id_producto=$_POST["id_producto-$id"];
	
	$sql_mod="UPDATE calibre SET  id_producto='$id_producto', calibre='$calibre', color='$color', calibre_cod_barra='$calibre_cod_barra', condicion_cod_barra='$condicion_cod_barra', carasteristica_cod_barra='$carasteristica_cod_barra' where id_calibre = $id";
	
	//echo "$sql_mod ";
	
	$rest=mysql_query($sql_mod);
	}
}
if ($elim)
	    {
 		foreach ( $elim as $key => $value)
     	{
	 	$sql_elim="delete from calibre where id_calibre = $value";
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

if (document.form1.nombre_calibre.value=="") {     
    alert('Debe ingresar Calibre');
    document.form1.nombre_calibre.onfocus;
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
<table width="650" border="0" align="center">
  <tr>
    <td width="614" height="14" bgcolor="#CCCCCC" class="titulo">Calibre</td>
    <td width="32" bgcolor="#CCCCCC" class="cajas"><a href="?modulo=calibres_listar.php">Volver</a></td>
  </tr>
  <tr>
    <td colspan="2"><? if(!$nuevo){?>
      <?
	  $i=$op;
      while ($row=mysql_fetch_array($result))
      { 
      $i++;
	  $id_calibre=$row[id_calibre];
	  //echo "$id_calibre";
      ?>
      <span class="titulo">
      <input name="id_calibre" type="hidden" value="<?echo $row[id_calibre]?>" />
      </span>
      <table width="650" height="250" border="1" align="center" bordercolor="#999999">
        <tr>
          <td width="600"><table width="286" border="0" align="center">
            <tr>
              <td width="107" class="titulo" >                <div align="right">Calibre:</div></td>
              <td><input name="nombre_calibre" type="text" class="cajas" id="nombre_calibre" value="<?echo $row[calibre]?>" size="30" maxlength="20"/></td>
              <td><span class="style8">(*)</span></td>
            </tr>
            <tr>
              <td class="titulo" ><div align="right">Caracteristicas:</div></td>
              <td><input name="color" type="text" class="cajas" id="color" value="<?echo $row[color]?>" size="30" maxlength="20"/></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td >&nbsp;</td>
              <td >&nbsp;</td>
              <td >&nbsp;</td>
            </tr>
            <tr>
              <td colspan="2" class="titulo" >Para el Cod&iacute;go de Barras </td>
              <td class="titulo" >&nbsp;</td>
            </tr>
            <tr>
              <td class="titulo" ><div align="right">Calibre:</div></td>
              <td width="150" ><input name="calibre_cod_barra" type="text" class="cajas" id="calibre_cod_barra" value="<?echo $row[calibre_cod_barra]?>" size="30" maxlength="6"/></td>
              <td width="15" nowrap="nowrap" >&nbsp;</td>
            </tr>
            <tr>
              <td class="titulo" ><div align="right">Condici&oacute;n:</div></td>
              <td ><input name="condicion_cod_barra" type="text" class="cajas" id="condicion_cod_barra" value="<?echo $row[condicion_cod_barra]?>" size="30" maxlength="3"/></td>
              <td nowrap="nowrap" >&nbsp;</td>
            </tr>
            <tr>
              <td class="titulo" ><div align="right">Caracter&iacute;sticas:</div></td>
              <td ><input name="carasteristica_cod_barra" type="text" class="cajas" id="carasteristica_cod_barra" value="<?echo $row[carasteristica_cod_barra]?>" size="30" maxlength="3"/></td>
              <td nowrap="nowrap" >&nbsp;</td>
            </tr>
            <tr>
              <td class="titulo" >&nbsp;</td>
              <td class="titulo" ><? $id_bode=$row[id_calibre];?>
                <span class="style13"><span class="style8">(*)</span> <span class="style8">Datos obligatorios</span></span></td>
              <td class="titulo" >&nbsp;</td>
            </tr>
            <tr>
              <td colspan="3" >&nbsp;</td>
            </tr>
          </table></td>
        </tr>
      </table>
      <? }}?>
	      <? if($nuevo){?>
      <table width="650" height="250" border="1" align="center" bordercolor="#999999">
        <tr>
          <td width="600"><table width="295" border="0" align="center">
              <tr>
                <td width="120" class="titulo" ><div align="right">Calibre:</div></td>
                <td><input name="nombre_calibre" type="text" class="cajas" id="nombre_calibre" value="<? echo $nombre_calibre?>" size="30" maxlength="25"/></td>
                <td><span class="style8">(*)</span></td>
              </tr>
              <tr>
                <td class="titulo" ><div align="right">Color:</div></td>
                <td><input name="color" type="text" class="cajas" id="color" value="<? echo $color?>" size="30" maxlength="20"/></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td >&nbsp;</td>
                <td >&nbsp;</td>
                <td >&nbsp;</td>
              </tr>
              <tr>
                <td colspan="2" class="titulo" >Para el Cod&iacute;go de Barras </td>
                <td class="titulo" >&nbsp;</td>
              </tr>
              <tr>
                <td class="titulo" ><div align="right">Calibre:</div></td>
                <td width="150" ><input name="calibre_cod_barra" type="text" class="cajas" id="calibre_cod_barra" value="<? echo $calibre_cod_barra?>" size="30" maxlength="6"/></td>
                <td width="11" nowrap="nowrap" >&nbsp;</td>
              </tr>
              <tr>
                <td class="titulo" ><div align="right">Condici&oacute;n:</div></td>
                <td ><input name="condicion_cod_barra" type="text" class="cajas" id="condicion_cod_barra" value="<? echo $condicion_cod_barra?>" size="30" maxlength="3"/></td>
                <td nowrap="nowrap" >&nbsp;</td>
              </tr>
              <tr>
                <td class="titulo" ><div align="right">Caracter&iacute;sticas:</div></td>
                <td ><input name="carasteristica_cod_barra" type="text" class="cajas" id="carasteristica_cod_barra" value="<? echo $carasteristica_cod_barra?>" size="30" maxlength="3"/></td>
                <td nowrap="nowrap" >&nbsp;</td>
              </tr>
              <tr>
                <td class="titulo" >&nbsp;</td>
                <td class="titulo" ><span class="style13"><span class="style8">(*)</span> <span class="style8">Datos obligatorios</span></span></td>
                <td class="titulo" >&nbsp;</td>
              </tr>
              <tr>
                <td colspan="3" ><div align="center"><span class="style4"><? if($mensaje) echo $mensaje?></span></div></td>
              </tr>
          </table></td>
        </tr>
      </table>
      <? }?>
      <table width="335" border="0" align="center">
        <tr>
          <td class="style2"><a href="?modulo=calibres.php&amp;op=<? echo $ultimo?>"><img src="jpg/primero.jpg" width="54" height="13" border="0" /></a></td>
          <td class="style2"><? if ($cuantos > $next and !$nuevo){ ?>
              <a href="?modulo=calibres.php&amp;op=<? echo $next?>" ><img src="jpg/anterior.jpg" width="58" height="13" border="0" /></a>
              <? }else{?>
            &nbsp;
            <? }?></td>
          <td><span class="style2">
            <? if($ante >= 0){ ?>
            <a href="?modulo=calibres.php&amp;op=<? echo $ante?>" ><img src="jpg/siguiente.jpg" width="54" height="13" border="0" /></a>
            <? }else{?>
            &nbsp;
            <? }?>
          </span></td>
          <td><? if ($cuantos){ ?>
              <a href="?modulo=calibres.php&amp;cancelar=1"><img src="jpg/ultimo.jpg" width="47" height="13" border="0" /></a>
              <? }?>          </td>
          <td width="47"><? if($permiso5 == 1){?><a href="?modulo=calibres.php&amp;nuevo=1" >          
            <img src="jpg/nuevo.jpg" width="47" height="13" border="0" /></a><? }?></td>
          <td width="55"><a href="?modulo=calibres.php&amp;cancelar=1"><img src="jpg/cancelar.jpg" width="55" height="13" border="0" /></a></td>
          <td width="62"><? if($permiso5 == 1){?><? if(!$nuevo and $cuantos){?>
              <a href="javascript: document.form1.submit();">
              <label>
              <input type="image" name="modificar" src="jpg/modificar.jpg" />
              </label>
              </a>
              <? }?>    <? }?>      </td>
          <td width="55"><? if($permiso5 == 1){?><? if(!$cuantos or $nuevo or $mantsec ){?>
              <a href="javascript: document.form1.submit();">
              <label>
              <input type="image" name="grabar" src="jpg/guardar.jpg" />
              </label>
              </a>
              <? }?> <? }?>         </td>
          <td width="45">
		  <? if($permiso5 == 1){?>
		  <? if(!$nuevo and $cuantos){?>
		  <? 
		    $sqlsi="SELECT * from cruce_plant_calibre where id_calibre = $id_calibre";
		     $resultsi=mysql_query($sqlsi);
             $siexiste=mysql_num_rows($resultsi);
		  if(!$siexiste){?>
          <a href="?modulo=calibres.php&amp;borrar=<?=$id_bode?>" onClick='return Confirmar(this.form1)'> <img src="jpg/borrar.jpg" width="45" height="13" border="0" /></a>
		  <? }?>
          <? }?>
		  <? }?>
		  </td>
          <td width="45"><? if(!$nuevo and $cuantos){?>
              <a href="?modulo=calibres_listar.php"><img src="jpg/listar.jpg" width="45" height="13" border="0" /></a>
              <? }?>          </td>
        </tr>
      </table></td>
  </tr>
</table>
</form>