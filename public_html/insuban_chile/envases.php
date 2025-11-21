<?
if($id_en){
$sql="SELECT * FROM envases where id_envases='$id_en'";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);
}else{
$sql="SELECT * FROM envases where id_envases = id_envases and id_envases != 0 order by id_envases desc";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);
if(!$op) $op=0;
$sql="SELECT * FROM envases WHERE id_envases=id_envases and id_envases != 0 order by id_envases desc LIMIT $op , 1";
$result=mysql_query($sql);
$ante=$op - 1;
$next=$op + 1;
$ultimo=$cuantos - 1;
}
  if($grabar_x and $envases){
  
   $sqlus=" select * from envases where envases='$envases' ";
   $restus=mysql_query($sqlus);
   $cuantos_hay=mysql_num_rows($restus);
   if(!$cuantos_hay){ 
  $sql_nuevo="insert into envases (envases ,unidades,peso_tara) values ('$envases ','$unidades','$peso_tara')";
  $result_nuevo=mysql_query($sql_nuevo,$link);
  echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=envases.php\">";
  exit;
  }else{
  $mensaje="El Envase ya existe en nuestra bases de datos<br>";
  }
  }
  
   if($borrar){
   $sql_borrar="delete from envases where id_envases = $borrar";
  $r=mysql_query($sql_borrar,$link);
   echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=envases.php\">";
   exit;
  }//fin borrar
  
  
  if($modificar_x){
 $sql_modificar="UPDATE  envases set envases ='$envases', unidades='$unidades', peso_tara='$peso_tara' where id_envases=$id_envases";
 $rest=mysql_query($sql_modificar);
 //echo "$sql_modificar";
  if($id_en){
 echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=envases.php&id_en=$id_en\">";
 exit;
 }else{
 echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=envases.php&op=$op\">";
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
    $envases=$_POST["envases-$id"];
	$unidades=$_POST["unidades-$id"];
	$peso_tara=$_POST["peso_tara-$id"];
    $sql_mod="UPDATE envases SET  envases='$envases',unidades='$unidades',peso_tara='$peso_tara' where id_envases = $id";
	$rest=mysql_query($sql_mod);
	}
}
if ($elim)
	    {
 		foreach ( $elim as $key => $value)
     	{
	 	$sql_elim="delete from envases where id_envases = $value";
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

if (document.form1.envases.value=="") {     
    alert('Debe ingresar Envases');
    document.form1.envases.onfocus;
    return false;
}
if (document.form1.unidades.value=="") {     
    alert('Debe ingresar Unidades');
    document.form1.unidades.onfocus;
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
<table width="600" border="0" align="center">
  <tr>
    <td width="611" bgcolor="#CCCCCC" class="titulo">&nbsp;Envase</td>
    <td width="35" bgcolor="#CCCCCC" class="cajas"><a href="?modulo=envases_listar.php">Volver </a></td>
  </tr>
  <tr>
    <td colspan="2"><? if(!$nuevo){?>
      <?
	  $i=$op;
      while ($row=mysql_fetch_array($result))
      { 
	  $id_envases=$row[id_envases];
      $i++;
      ?>
      <span class="titulo">
      <input name="id_envases" type="hidden" value="<?echo $row[id_envases]?>" />
      </span>
      <table width="650" height="250" border="1" align="center" bordercolor="#999999">
        <tr>
          <td width="600"><table width="365" border="0" align="center">

            <tr>
              <td width="89" class="titulo"  ><div align="right">Envase:</div></td>
              <td width="250"><input name="envases" type="text" class="cajas" id="envases" value="<?echo $row[envases]?>" size="50" maxlength="30" /></td>
              <td width="12"><span class="style8">(*)</span></td>
            </tr>
            <tr>
              <td class="titulo"  ><div align="right">Unidades:</div></td>
              <td><input name="unidades" type="text" class="cajas" id="unidades" value="<?echo $row[unidades]?>" size="50" maxlength="30" /></td>
              <td><span class="style8">(*)</span></td>
            </tr>
            <tr>
              <td class="titulo"  ><div align="right">Peso Tara: </div></td>
              <td ><input name="peso_tara" type="text" class="cajas" id="peso_tara" value="<?echo $row[peso_tara]?>" size="50" maxlength="30" /></td>
              <td >&nbsp;</td>
            </tr>
            <tr>
              <td  >&nbsp;</td>
              <td colspan="2" ><? $id_bode=$row[id_envases];?>
                <span class="style8">(*)</span> <span class="style8">Datos obligatorios</span></td>
              </tr>
          </table></td>
        </tr>
      </table>
      <?}}?>
      <? if($nuevo){?>
      <table width="650" height="250" border="1" align="center" bordercolor="#999999">
        <tr>
          <td width="600"><table width="364" border="0" align="center">
              <tr>
                <td width="90" class="titulo"  ><div align="right">Envase:</div></td>
                <td width="250"><input name="envases" type="text" class="cajas" id="envases" size="50" maxlength="30" /></td>
                <td width="10"><span class="style8">(*)</span></td>
              </tr>
              <tr>
                <td class="titulo"  ><div align="right">Unidades:</div></td>
                <td><input name="unidades" type="text" class="cajas" id="unidades" size="50" maxlength="30" /></td>
                <td><span class="style8">(*)</span></td>
              </tr>
              <tr>
                <td class="titulo"  ><div align="right">Peso Tara: </div></td>
                <td ><input name="peso_tara" type="text" class="cajas" id="peso_tara" size="50" maxlength="30" /></td>
                <td >&nbsp;</td>
              </tr>
              <tr>
                <td  >&nbsp;</td>
                <td colspan="2" ><span class="style8">(*)</span> <span class="style8">Datos obligatorios</span></td>
              </tr>
              <tr>
                <td colspan="3"  ><div align="center"><span class="style4">
                  <? if($mensaje) echo $mensaje?>
                </span></div></td>
                </tr>
          </table></td>
        </tr>
      </table>
      <? }?>
      <table width="335" border="0" align="center">
        <tr>
          <td class="style2"><a href="?modulo=envases.php&amp;op=<? echo $ultimo?>"><img src="jpg/primero.jpg" width="54" height="13" border="0" /></a></td>
          <td class="style2"><? if ($cuantos > $next and !$nuevo){ ?>
              <a href="?modulo=envases.php&amp;op=<? echo $next?>" ><img src="jpg/anterior.jpg" width="58" height="13" border="0" /></a>
              <? }else{?>
            &nbsp;
            <? }?></td>
          <td><span class="style2">
            <? if($ante >= 0){ ?>
            <a href="?modulo=envases.php&amp;op=<? echo $ante?>" ><img src="jpg/siguiente.jpg" width="54" height="13" border="0" /></a>
            <? }else{?>
            &nbsp;
            <? }?>
          </span></td>
          <td><? if ($cuantos){ ?>
              <a href="?modulo=envases.php&amp;cancelar=1"><img src="jpg/ultimo.jpg" width="47" height="13" border="0" /></a>
              <? }?>          </td>
          <td width="47"><? if($permiso11 == 1){?><a href="?modulo=envases.php&amp;nuevo=1" ><img src="jpg/nuevo.jpg" width="47" height="13" border="0" /></a><? }?></td>
          <td width="55"><a href="?modulo=envases.php&amp;cancelar=1"><img src="jpg/cancelar.jpg" width="55" height="13" border="0" /></a></td>
          <td width="62"><? if($permiso11 == 1){?><? if(!$nuevo and $cuantos){?>
              <a href="javascript: document.form1.submit();">
              <label>
              <input type="image" name="modificar" src="jpg/modificar.jpg" />
              </label>
              </a>
              <? }?> <? }?></td>
          <td width="55"><? if($permiso11 == 1){?><? if(!$cuantos or $nuevo or $mantsec ){?>
              <a href="javascript: document.form1.submit();">
              <label>
              <input type="image" name="grabar" src="jpg/guardar.jpg" />
              </label>
              </a>
              <? }?> <? }?></td>
          <td width="45"><? if($permiso11 == 1){?><? if(!$nuevo and $cuantos){?>
              <a href="?modulo=envases.php&amp;borrar=<?=$id_bode?>" onclick='return Confirmar(this.form1)'> <img src="jpg/borrar.jpg" width="45" height="13" border="0" /> </a>
              <? }?> <? }?></td>
          <td width="45"><? if(!$nuevo and $cuantos){?>
              <a href="?modulo=envases_listar.php"><img src="jpg/listar.jpg" width="45" height="13" border="0" /></a>
              <? }?>          </td>
        </tr>
      </table></td>
  </tr>
</table>
</form>