<?
if($id_esp){
$sql="SELECT * FROM especie where id_especie='$id_esp' and especie != '' order by id_especie desc";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);
}else{
$sql="SELECT * FROM especie where id_especie = id_especie and especie != '' and id_especie != 0 order by id_especie desc";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);
if(!$op) $op=0;
$sql="SELECT * FROM especie WHERE id_especie=id_especie and especie != '' and id_especie != 0 order by id_especie desc LIMIT $op , 1";
$result=mysql_query($sql);
$ante=$op - 1;
$next=$op + 1;
$ultimo=$cuantos - 1;
}
  if($grabar_x and $especie){
   $sqlus=" select * from especie where especie='$especie'";
   $restus=mysql_query($sqlus);
   $cuantos_hay=mysql_num_rows($restus);
  if(!$cuantos_hay){
     $sql_nuevo="insert into especie (especie) values ('$especie')";
     $result_nuevo=mysql_query($sql_nuevo,$link);
     echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=especies.php\">";
     exit;
  }else{
  $mensaje="La Especie ya existe en nuestra bases de datos<br>";
  }
  }
  
   if($borrar){
   $sql_borrar="delete from especie where id_especie = $borrar";
   $r=mysql_query($sql_borrar,$link);
   echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=especies.php\">";
   exit;
  }//fin borrar

if($modificar){
 $sql_modificar="UPDATE  especie set especie='$especie' where id_especie=$id_especie";
$rest=mysql_query($sql_modificar);
  if($id_esp){
 echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=especies.php&id_esp=$id_esp\">";
 exit;
 }else{
 echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=especies.php&op=$op\">";
 exit;
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

if (document.form1.especie.value=="") {     
    alert('Debe ingresar Especie');
    document.form1.especie.onfocus;
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
  <table width="650" border="0" align="center">
  <tr>
    <td width="615" height="14" bgcolor="#CCCCCC" class="titulo">Especie</td>
    <td width="31" bgcolor="#CCCCCC" class="titulo"><a href="?modulo=especies_listar.php" class="cajas">Volver</a></td>
  </tr>
  <tr>
    <td colspan="2"><? if(!$nuevo){?>
      <?
	  $i=$op;
      while ($row=mysql_fetch_array($result))
      { 
      $i++;
	  $id_especie=$row[id_especie];
      ?>
      <span class="titulo">
      <input name="id_especie" type="hidden" value="<?echo $row[id_especie]?>" />
      </span>
      <table width="650" height="250" border="1" align="center" bordercolor="#999999">
        <tr>
          <td width="600" height="191"><table width="246" border="0" align="center">
            <tr>
              <td width="72" class="titulo" ><div align="right">Especie : </div></td>
              <td width="150"><input name="especie" type="text" class="cajas" id="especie" value="<?echo $row[especie]?>" size="30" maxlength="20" /></td>
              <td width="10"><span class="style8">(*)</span></td>
            </tr>
            <tr>
              <td >&nbsp;</td>
              <td ><? $id_bode=$row[id_especie];?>
                <span class="style8">(*) Datos obligatorios</span></td>
              <td >&nbsp;</td>
            </tr>
          </table></td>
        </tr>
      </table>
      <? }} ?>
	  	   
      <? if($nuevo){?>
      <table width="650" height="250" border="1" align="center" bordercolor="#999999">
        <tr>
          <td width="600"><table width="239" border="0" align="center">
              <tr>
                <td width="65" class="titulo" ><div align="right">Especie:</div></td>
                <td width="150"><input name="especie" type="text" class="cajas" id="especie" value="<? echo $especie?>" size="30" maxlength="20" /></td>
                <td width="10"><span class="style8">(*)</span></td>
              </tr>
              <tr>
                <td >&nbsp;</td>
                <td ><span class="style8">(*) Datos obligatorios</span></td>
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
          <td class="style2"><a href="?modulo=especies.php&amp;op=<? echo $ultimo?>"><img src="jpg/primero.jpg" width="54" height="13" border="0" /></a></td>
          <td class="style2"><? if ($cuantos > $next and !$nuevo){ ?>
              <a href="?modulo=especies.php&amp;op=<? echo $next?>" ><img src="jpg/anterior.jpg" width="58" height="13" border="0" /></a>
              <? }else{?>
            &nbsp;
            <? }?></td>
          <td><span class="style2">
            <? if($ante >= 0){ ?>
            <a href="?modulo=especies.php&amp;op=<? echo $ante?>" ><img src="jpg/siguiente.jpg" width="54" height="13" border="0" /></a>
            <? }else{?>
            &nbsp;
            <? }?>
          </span></td>
          <td><? if ($cuantos){ ?>
              <a href="?modulo=especies.php&amp;cancelar=1"><img src="jpg/ultimo.jpg" width="47" height="13" border="0" /></a>
              <? }?>
          </td>
          <td width="47"><? if($permiso1 == 1){?><a href="?modulo=especies.php&amp;nuevo=1" ><img src="jpg/nuevo.jpg" width="47" height="13" border="0" /></a><? }?></td>
          <td width="55"><a href="?modulo=especies.php&amp;cancelar=1"><img src="jpg/cancelar.jpg" width="55" height="13" border="0" /></a></td>
          <td width="62">
		  <? if($permiso1 == 1){?>
		  <? if(!$nuevo and $cuantos and !$mantsec){?>
              <a href="javascript: document.form1.submit();">
              <input type="hidden" name="modificar" value="modificar" />
              <img src="jpg/modificar.jpg" width="62" height="13" border="0" /> </a>
              <? }?>
			<? }?>  
          </td>
          <td width="55">
		   <? if($permiso1 == 1){?>
		  <? if(!$cuantos or $nuevo or $mantsec ){?>
              <a href="javascript: document.form1.submit();">
              <label>
              <input type="image" name="grabar" src="jpg/guardar.jpg" />
              </label>
              </a>
			  <? }?>
              <? }?>
          </td>
          <td width="45">
		  <? if($permiso1 == 1){?>
		  <? if(!$nuevo and $cuantos){?>
		  <? 
		     $sqlsi="SELECT * from cruce_plant_especie where id_especie = $id_especie";
		     $resultsi=mysql_query($sqlsi);
             $siexiste=mysql_num_rows($resultsi);
		  if(!$siexiste){?>
          <a href="?modulo=especies.php&amp;borrar=<?=$id_bode?>" onClick='return Confirmar(this.form1)'> <img src="jpg/borrar.jpg" width="45" height="13" border="0" /></a>
		  <? }?>
          <? }?>
		  <? }?> 
          </td>
          <td width="45"><? if(!$nuevo and $cuantos){?>
              <a href="?modulo=especies_listar.php"><img src="jpg/listar.jpg" width="45" height="13" border="0" /></a>
              <? }?>
          </td>
        </tr>
      </table></td>
  </tr>
</table>
</form>