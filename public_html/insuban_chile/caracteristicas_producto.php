<?
if($id_caracpro){
$sql="SELECT * FROM caract_producto where id_caract_producto='$id_caracpro' and caract_producto != '' order by id_caract_producto desc";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);
}else{
$sql="SELECT * FROM caract_producto  where id_caract_producto = id_caract_producto and caract_producto != '' and id_caract_producto != 0 order by id_caract_producto desc";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);
if(!$op) $op=0;
$sql="SELECT * FROM caract_producto  WHERE id_caract_producto=id_caract_producto and caract_producto != '' and id_caract_producto != 0 order by id_caract_producto desc LIMIT $op , 1";
$result=mysql_query($sql);
$ante=$op - 1;
$next=$op + 1;
$ultimo=$cuantos - 1;
}
  if($grabar_x and $caract_producto){
	  
   $sqlus=" select * from caract_producto where caract_producto='$caract_producto' ";
   $restus=mysql_query($sqlus);
   $cuantos_hay=mysql_num_rows($restus);

  if(!$cuantos_hay){ 
  $sql_nuevo="insert into caract_producto (caract_producto) values ('$caract_producto')";
   $result_nuevo=mysql_query($sql_nuevo,$link);
  //header( 'Location: index.php?modulo=medidas_productos.php&op='.( $cuantos++ ) );
  echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=caracteristicas_producto.php\">";
  exit;
  }else{
  $mensaje="La Caracteristica ya existe en nuestra bases de datos<br>";
  }
  }
  
   if($borrar){
   $sql_borrar="delete from caract_producto where id_caract_producto = $borrar";
   $r=mysql_query($sql_borrar,$link);
   echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=caracteristicas_producto.php\">";
   exit;
  }//fin borrar

if($modificar){
 $sql_modificar="UPDATE  caract_producto set caract_producto='$caract_producto' where id_caract_producto=$id_caract_producto";
$rest=mysql_query($sql_modificar);
  if($id_caracpro){
 echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=caracteristicas_producto.php&id_caracpro=$id_caracpro\">";
 exit;
 }else{
 echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=caracteristicas_producto.php&op=$op\">";
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

if (document.form1.caract_producto.value=="") {     
    alert('Debe ingresar Caracteristica');
    document.form1.caract_producto.onfocus;
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
    <td width="614" height="14" bgcolor="#CCCCCC" class="titulo">Caracteristica Producto </td>
    <td width="32" bgcolor="#CCCCCC" class="cajas"><a href="?modulo=caracteristicas_producto_listar.php">Volver</a></td>
  </tr>
  <tr>
    <td colspan="2"><? if(!$nuevo){?>
      <?
	  $i=$op;
      while ($row=mysql_fetch_array($result))
      { 
      $i++;
	  $id_caract_producto=$row[id_caract_producto];
      ?>
      <span class="titulo">
      <input name="id_caract_producto" type="hidden" value="<?echo $row[id_caract_producto]?>" />
      </span>
      <table width="650" height="250" border="1" align="center" bordercolor="#999999">
        <tr>
          <td width="600" height="191"><table width="317" border="0" align="center">
            <tr>
              <td width="141" align="right" class="titulo" >Caract. Producto:</td>
              <td width="150"><input name="caract_producto" type="text" class="cajas" id="caract_producto" value="<?echo $row[caract_producto]?>" size="30" maxlength="50" /></td>
              <td width="12"><span class="style8">(*)</span></td>
              </tr>
            <tr>
              <td width="141" align="right" class="titulo" >&nbsp;</td>
              <td colspan="2"><span class="style8">(*) Datos obligatorios</span></td>
              </tr>
            <tr>
              <td >&nbsp;</td>
              <td colspan="2" ><? $id_bode=$row[id_caract_producto];?></td>
              </tr>
          </table></td>
        </tr>
      </table>
      <?}}?>
      <? if($nuevo){?>
      <table width="650" height="250" border="1" align="center" bordercolor="#999999">
        <tr>
          <td width="600"><table width="317" border="0" align="center">
              <tr>
                <td width="127" align="right" class="titulo" >Caract. Producto:</td>
                <td width="161"><input name="caract_producto" type="text" class="cajas" id="caract_producto" size="30" maxlength="20" /></td>
                <td width="15"><span class="style8">(*)</span></td>
                </tr>
              <tr>
                <td >&nbsp;</td>
                <td colspan="2" ><span class="style8">(*) Datos obligatorios</span></td>
                </tr>
              <tr>
                <td colspan="3" align="center" ><span class="style4">
                  <? if($mensaje) echo $mensaje?>
                </span></td>
                </tr>
          </table></td>
        </tr>
      </table>
      <? }?>
      <table width="335" border="0" align="center">
        <tr>
          <td class="style2"><a href="?modulo=caracteristicas_producto.php&amp;op=<? echo $ultimo?>"><img src="jpg/primero.jpg" width="54" height="13" border="0" /></a></td>
          <td class="style2"><? if ($cuantos > $next and !$nuevo){ ?>
              <a href="?modulo=caracteristicas_producto.php&amp;op=<? echo $next?>" ><img src="jpg/anterior.jpg" width="58" height="13" border="0" /></a>
              <? }else{?>
            &nbsp;
            <? }?></td>
          <td><span class="style2">
            <? if($ante >= 0){ ?>
            <a href="?modulo=caracteristicas_producto.php&amp;op=<? echo $ante?>" ><img src="jpg/siguiente.jpg" width="54" height="13" border="0" /></a>
            <? }else{?>
            &nbsp;
            <? }?>
          </span></td>
          <td><? if ($cuantos){ ?>
              <a href="?modulo=caracteristicas_producto.php&amp;cancelar=1"><img src="jpg/ultimo.jpg" width="47" height="13" border="0" /></a>
              <? }?>          </td>
          <td width="47"><? if($permiso6 == 1){?><a href="?modulo=caracteristicas_producto.php&amp;nuevo=1" >           
            <img src="jpg/nuevo.jpg" width="47" height="13" border="0" /></a><? } ?></td>
          <td width="55"><a href="?modulo=caracteristicas_producto.php&amp;cancelar=1"><img src="jpg/cancelar.jpg" width="55" height="13" border="0" /></a></td>
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
              <? }?><? }?>           </td>
          <td width="45">
		  <? if($permiso6 == 1){?>
		  <? if(!$nuevo and $cuantos){?>
		  <? 
		     $sqlsi="SELECT * from cruce_plant_caract_producto  where id_caract_producto = $id_caract_producto";
		     $resultsi=mysql_query($sqlsi);
             $siexiste=mysql_num_rows($resultsi);
		  if(!$siexiste){?>
          <a href="?modulo=caracteristicas_producto.php&amp;borrar=<?=$id_bode?>" onClick='return Confirmar(this.form1)' > <img src="jpg/borrar.jpg" width="45" height="13" border="0" /></a>
		  <? }?>
		  <? }?>
		  <? }?>
		  </td>
          <td width="45"><? if(!$nuevo and $cuantos){?>
              <a href="?modulo=caracteristicas_producto_listar.php"><img src="jpg/listar.jpg" width="45" height="13" border="0" /></a>
              <? }?>          </td>
        </tr>
      </table></td>
  </tr>
</table>
</form>