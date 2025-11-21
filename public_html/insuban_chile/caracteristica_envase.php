<?
if($id_caracenv){
$sql="SELECT * FROM caract_envases where id_caract_envases='$id_caracenv' and caract_envases != '' order by id_caract_envases desc";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);
}else{
$sql="SELECT * FROM caract_envases where id_caract_envases = id_caract_envases and caract_envases != '' and id_caract_envases != 0 order by id_caract_envases desc";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);
if(!$op) $op=0;
$sql="SELECT * FROM caract_envases WHERE id_caract_envases=id_caract_envases and caract_envases != '' and id_caract_envases != 0 order by id_caract_envases desc LIMIT $op , 1";
$result=mysql_query($sql);
$ante=$op - 1;
$next=$op + 1;
$ultimo=$cuantos - 1;
}
  if($grabar_x and $caract_envases){
  
      $sqlus=" select * from caract_envases where caract_envases='$caract_envases'";
   $restus=mysql_query($sqlus);
   $cuantos_hay=mysql_num_rows($restus);
   if(!$cuantos_hay){
  
  $sql_nuevo="insert into caract_envases (caract_envases) values ('$caract_envases')";
   $result_nuevo=mysql_query($sql_nuevo,$link);
  //header( 'Location: index.php?modulo=medidas_productos.php&op='.( $cuantos++ ) );
  echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=caracteristica_envase.php\">";
  exit;
    }else{
  $mensaje="La Caraceristica de envase ya existe en nuestra bases de datos<br>";
  }
  }
  
   if($borrar){
   $sql_borrar="delete from caract_envases where id_caract_envases = $borrar";
   $r=mysql_query($sql_borrar,$link);
   echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=caracteristica_envase.php&op=$op\">";
   exit;
  }//fin borrar

if($modificar){
 $sql_modificar="UPDATE  caract_envases set caract_envases='$caract_envases' where id_caract_envases=$id_caract_envases";
$rest=mysql_query($sql_modificar);
  if($id_caracenv){
 echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=caracteristica_envase.php&id_caracenv=$id_caracenv\">";
 exit;
 }else{
 echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=caracteristica_envase.php&op=$op\">";
 exit;
 }
}
/*
if($modificarlistar || $eliminar){
foreach ($_POST as $key => $value)
{
 $dat=split("-",$key);
 if ($dat[0] == 'unidad_medida')
	{
    $id=$dat[1];
    $unidad_medida=$_POST["unidad_medida-$id"];
		
	$sql_mod="UPDATE unidad_medida SET  unidad_medida='$unidad_medida' where id_medidas_productos = $id";
	$rest=mysql_query($sql_mod);
	}
}
if ($elim)
	    {
 		foreach ( $elim as $key => $value)
     	{
	 	$sql_elim="delete from unidad_medida where id_unidad_medida = $value";
	 	$r=mysql_query($sql_elim);
	 	} 
}
}*/
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

if (document.form1.caract_envases.value=="") {     
    alert('Debe ingresar Caracteristica de envase');
    document.form1.caract_envases.onfocus;
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
    <td width="614" height="14" bgcolor="#CCCCCC" class="titulo">Caracteristica Envase </td>
    <td width="32" bgcolor="#CCCCCC" class="cajas"><a href="?modulo=caracteristica_envase_listar.php">Volver</a></td>
  </tr>
  <tr>
    <td colspan="2"><? if(!$nuevo){?>
      <?
	  $i=$op;
      while ($row=mysql_fetch_array($result))
      { 
      $i++;
	  $id_caract_envases=$row[id_caract_envases];
      ?>
      <span class="titulo">
      <input name="id_caract_envases" type="hidden" value="<?echo $row[id_caract_envases]?>" />
      </span>
      <table width="650" height="250" border="1" align="center" bordercolor="#999999">
        <tr>
          <td width="600" height="191"><table width="298" border="0" align="center">
            <tr>
              <td width="120" class="titulo" ><div align="right">Caract. Envase: </div></td>
              <td width="150"><input name="caract_envases" type="text" class="cajas" id="caract_envases" value="<?echo $row[caract_envases]?>" size="30" maxlength="20" /></td>
              <td width="14"><span class="style8">(*)</span></td>
            </tr>
            <tr>
              <td >&nbsp;</td>
              <td ><? $id_bode=$row[id_caract_envases];?>
                <span class="style13"><span class="style8">(*)</span> <span class="style8">Datos obligatorios</span></span></td>
              <td >&nbsp;</td>
            </tr>
          </table></td>
        </tr>
      </table>
      <?}}?>
      <? if($nuevo){?>
      <table width="650" height="250" border="1" align="center" bordercolor="#999999">
        <tr>
          <td width="600"><table width="296" border="0" align="center">
              <tr>
                <td width="121" class="titulo" ><div align="right">Caract. Envase: </div></td>
                <td width="153"><input name="caract_envases" type="text" class="cajas" id="caract_envases" value="<? echo $caract_envases?>" size="30" maxlength="20" /></td>
                <td width="10"><span class="style8">(*)</span></td>
              </tr>
              <tr>
                <td >&nbsp;</td>
                <td ><span class="style13"><span class="style8">(*)</span> <span class="style8">Datos obligatorios</span></span></td>
                <td >&nbsp;</td>
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
          <td class="style2"><a href="?modulo=caracteristica_envase.php&amp;op=<? echo $ultimo?>"><img src="jpg/primero.jpg" width="54" height="13" border="0" /></a></td>
          <td class="style2"><? if ($cuantos > $next and !$nuevo){ ?>
              <a href="?modulo=caracteristica_envase.php&amp;op=<? echo $next?>" ><img src="jpg/anterior.jpg" width="58" height="13" border="0" /></a>
              <? }else{?>
            &nbsp;
            <? }?></td>
          <td><span class="style2">
            <? if($ante >= 0){ ?>
            <a href="?modulo=caracteristica_envase.php&amp;op=<? echo $ante?>" ><img src="jpg/siguiente.jpg" width="54" height="13" border="0" /></a>
            <? }else{?>
            &nbsp;
            <? }?>
          </span></td>
          <td><? if ($cuantos){ ?>
              <a href="?modulo=caracteristica_envase.php&amp;cancelar=1"><img src="jpg/ultimo.jpg" width="47" height="13" border="0" /></a>
              <? }?>          </td>
          <td width="47"><? if($permiso7 == 1){?><a href="?modulo=caracteristica_envase.php&amp;nuevo=1" ><img src="jpg/nuevo.jpg" width="47" height="13" border="0" /></a><? }?> </td>
          <td width="55"><a href="?modulo=caracteristica_envase.php&amp;cancelar=1"><img src="jpg/cancelar.jpg" width="55" height="13" border="0" /></a></td>
          <td width="62"><? if($permiso6 == 1){?><? if(!$nuevo and $cuantos and !$mantsec){?>
              <a href="javascript: document.form1.submit();">
              <input type="hidden" name="modificar" value="modificar" />
              <img src="jpg/modificar.jpg" width="62" height="13" border="0" /> </a>
              <? }?> <? }?>          </td>
          <td width="55"><? if($permiso6 == 1){?><? if(!$cuantos or $nuevo or $mantsec ){?>
              <a href="javascript: document.form1.submit();">
              <label>
              <input type="image" name="grabar" src="jpg/guardar.jpg" />
              </label>
              </a>
              <? }?> <? }?>          </td>
          <td width="45">
		  <? if($permiso6 == 1){?>
		  <? if(!$nuevo and $cuantos){?>
		  <? 
		     //consulta para ver si id_caract_envases se encuentra asigando
		     $sqlsi="SELECT * from cruce_plant_caract_envases  where id_caract_envases = $id_caract_envases";
		     $resultsi=mysql_query($sqlsi);
             $siexiste=mysql_num_rows($resultsi);
		  
		  if(!$siexiste){?>
          <a href="?modulo=caracteristica_envase.php&amp;borrar=<?=$id_bode?>" onClick='return Confirmar(this.form1)'> <img src="jpg/borrar.jpg" width="45" height="13" border="0" /></a>
		  <? }?>
          <? }?>
		  <? }?>
		  </td>
          <td width="45"><? if(!$nuevo and $cuantos){?>
              <a href="?modulo=caracteristica_envase_listar.php"><img src="jpg/listar.jpg" width="45" height="13" border="0" /></a>
              <? }?>          </td>
        </tr>
      </table></td>
  </tr>
</table>
</form>