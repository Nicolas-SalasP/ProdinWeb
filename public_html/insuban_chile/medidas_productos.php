<?
if($id_med){
$sql="SELECT * FROM medidas_productos where id_medidas_productos='$id_med' and medidas_productos != '' order by id_medidas_productos desc";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);
}else{
$sql="SELECT * FROM medidas_productos where id_medidas_productos = id_medidas_productos and medidas_productos != '' and id_medidas_productos != 0 order by id_medidas_productos desc";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);
if(!$op) $op=0;
$sql="SELECT * FROM medidas_productos WHERE id_medidas_productos=id_medidas_productos and medidas_productos != '' and id_medidas_productos != 0 order by id_medidas_productos desc LIMIT $op , 1";
$result=mysql_query($sql);
$ante=$op - 1;
$next=$op + 1;
$ultimo=$cuantos - 1;
}
  if($grabar_x and $medidas_productos){
  $sqlus=" select * from medidas_productos where medidas_productos='$medidas_productos'";
   $restus=mysql_query($sqlus);
   $cuantos_hay=mysql_num_rows($restus);
   if(!$cuantos_hay){
  $sql_nuevo="insert into medidas_productos (medidas_productos,pcod_barras) values ('$medidas_productos','$pcod_barras')";
   $result_nuevo=mysql_query($sql_nuevo,$link);
  //header( 'Location: index.php?modulo=medidas_productos.php&op='.( $cuantos++ ) );
  echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=medidas_productos.php\">";
  exit;
    }else{
  $mensaje="La medida ya existe en nuestra bases de datos<br>";
  }
  }
  
   if($borrar){
   $sql_borrar="delete from medidas_productos where id_medidas_productos = $borrar";
   $r=mysql_query($sql_borrar,$link);
   echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=medidas_productos.php\">";
   exit;
  }//fin borrar

if($modificar){
 $sql_modificar="UPDATE  medidas_productos set medidas_productos='$medidas_productos', pcod_barras='$pcod_barras' where id_medidas_productos=$id_medidas_productos";
$rest=mysql_query($sql_modificar);
  if($id_med){
 echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=medidas_productos.php&id_med=$id_med\">";
 exit;
 }else{
 echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=medidas_productos.php&op=$op\">";
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
	$pcod_barras=$_POST["pcod_barras-$id"];
	
	$sql_mod="UPDATE medidas_productos SET  medidas_productos='$medidas_productos', pcod_barras='$pcod_barras' where id_medidas_productos = $id";
	$rest=mysql_query($sql_mod);
	}
}
if ($elim)
	    {
 		foreach ( $elim as $key => $value)
     	{
	 	$sql_elim="delete from medidas_productos where id_medidas_productos = $value";
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

if (document.form1.medidas_productos.value=="") {     
    alert('Debe ingresar Medida');
    document.form1.medidas_productos.onfocus;
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
.style9 {font-family: Arial, Helvetica, sans-serif; font-size: 10px; color: #666666; }
.style9 {font-family: Arial, Helvetica, sans-serif; font-size: 10px; color: #666666; }
.style10 {font-family: Arial, Helvetica, sans-serif; font-size: 10px; color: #666666; }
.style10 {font-family: Arial, Helvetica, sans-serif; font-size: 10px; color: #666666; }
.style11 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; color: #FF0000; }
.style11 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; color: #FF0000; }
-->
</style>
<form id="form1" name="form1" method="post" action="" onsubmit = "return isMailReady(this);">
<table width="650" border="0" align="center">
  <tr>
    <td width="564" height="14" bgcolor="#CCCCCC" class="titulo">Medida</td>
    <td width="32" bgcolor="#CCCCCC" class="cajas"><a href="?modulo=medidas_productos_listar.php">Volver</a></td>
  </tr>
  <tr>
    <td colspan="2"><? if(!$nuevo){?>
      <?
	  $i=$op;
      while ($row=mysql_fetch_array($result))
      { 
      $i++;
	  $id_medidas_productos=$row[id_medidas_productos];
      ?>
      <span class="titulo">
      <input name="id_medidas_productos" type="hidden" value="<?echo $row[id_medidas_productos]?>" />
      </span>
      <table width="650" height="250" border="1" align="center" bordercolor="#999999">
        <tr>
          <td width="600" height="191"><table width="335" border="0" align="center">
            <tr>
              <td width="114" class="titulo" ><div align="right">Nombre:</div></td>
              <td width="150"><input name="medidas_productos" type="text" class="cajas" id="medidas_productos" value="<?echo $row[medidas_productos]?>" size="30" maxlength="20" /></td>
              <td width="57"><span class="style10">(*)</span></td>
            </tr>
            <tr>
              <td height="22" class="titulo"><div align="right">P/C&oacute;d Barras:</div></td>
              <td><input name="pcod_barras" type="text" class="cajas" value="<?echo $row[pcod_barras]?>" size="30" maxlength="4" />              </td>
              <td class="cajas">&nbsp;</td>
            </tr>
            <tr>
              <td >&nbsp;</td>
              <td colspan="2" ><? $id_bode=$row[id_medidas_productos];?>
                <span class="style13"><span class="style9">(*)</span> <span class="style9">Datos obligatorios</span></span></td>
              </tr>
          </table></td>
        </tr>
      </table>
      <?}}?>
	 <? if($nuevo){?>
      <table width="650" height="250" border="1" align="center" bordercolor="#999999">
        <tr>
          <td width="600"><table width="345" border="0" align="center">
              <tr>
                <td width="123" class="titulo" ><div align="right">Nombre:</div></td>
                <td><input name="medidas_productos" type="text" class="cajas" id="medidas_productos" value="<? echo $medidas_productos?>" size="30" maxlength="20" /></td>
                <td><span class="style10">(*)</span></td>
              </tr>
              <tr>
                <td class="titulo"><div align="right">P/C&oacute;d Barras:</div></td>
                <td width="150"><input name="pcod_barras" type="text" class="cajas" value="<? echo $pcod_barras?>" size="30" maxlength="4" />                  </td>
                <td width="58" class="cajas">&nbsp;</td>
              </tr>
              <tr>
                <td >&nbsp;</td>
                <td ><span class="style13"><span class="style10">(*)</span> <span class="style10">Datos obligatorios</span></span></td>
                <td >&nbsp;</td>
              </tr>
              <tr>
                <td height="21" colspan="3" ><div align="center"><span class="style11">
                  <? if($mensaje) echo $mensaje?>
                </span></div></td>
                </tr>
          </table></td>
        </tr>
      </table>
      <? }?>
      <table width="335" border="0" align="center">
        <tr>
          <td class="style2"><a href="?modulo=medidas_productos.php&amp;op=<? echo $ultimo?>"><img src="jpg/primero.jpg" width="54" height="13" border="0" /></a></td>
          <td class="style2"><? if ($cuantos > $next and !$nuevo){ ?>
              <a href="?modulo=medidas_productos.php&amp;op=<? echo $next?>" ><img src="jpg/anterior.jpg" width="58" height="13" border="0" /></a>
              <? }else{?>
            &nbsp;
            <? }?></td>
          <td><span class="style2">
            <? if($ante >= 0){ ?>
            <a href="?modulo=medidas_productos.php&amp;op=<? echo $ante?>" ><img src="jpg/siguiente.jpg" width="54" height="13" border="0" /></a>
            <? }else{?>
            &nbsp;
            <? }?>
          </span></td>
          <td><? if ($cuantos){ ?>
              <a href="?modulo=medidas_productos.php&amp;cancelar=1"><img src="jpg/ultimo.jpg" width="47" height="13" border="0" /></a>
              <? }?>          </td>
          <td width="47"><? if($permiso4 == 1){?><a href="?modulo=medidas_productos.php&amp;nuevo=1" >
            <img src="jpg/nuevo.jpg" width="47" height="13" border="0" /></a><? }?></td>
          <td width="55"><a href="?modulo=medidas_productos.php&amp;cancelar=1"><img src="jpg/cancelar.jpg" width="55" height="13" border="0" /></a></td>
          <td width="62"><? if($permiso4 == 1){?><? if(!$nuevo and $cuantos and !$mantsec){?>
              <a href="javascript: document.form1.submit();">
              <input type="hidden" name="modificar" value="modificar" />
              <img src="jpg/modificar.jpg" width="62" height="13" border="0" /> </a>
              <? }?>   <? }?>         </td>
          <td width="55"><? if($permiso4 == 1){?><? if(!$cuantos or $nuevo or $mantsec ){?>
              <a href="javascript: document.form1.submit();">
              <label>
              <input type="image" name="grabar" src="jpg/guardar.jpg" />
              </label>
              </a>
              <? }?>  <? }?>         </td>
          <td width="45">
		  <? if($permiso4 == 1){?>
          <? if(!$nuevo and $cuantos){?>
		  <?
		     $sqlsi="SELECT * from cruce_plant_medidas_productos where id_medidas_productos  = $id_medidas_productos";
		     $resultsi=mysql_query($sqlsi);
             $siexiste=mysql_num_rows($resultsi);
		   if(!$siexiste){?>
          <a href="?modulo=medidas_productos.php&amp;borrar=<?=$id_bode?>" onClick='return Confirmar(this.form1)'> <img src="jpg/borrar.jpg" width="45" height="13" border="0" /></a>
		  <? }?>
          <? }?>
		  <? }?>
		  </td>
          <td width="45"><? if(!$nuevo and $cuantos){?>
              <a href="?modulo=medidas_productos_listar.php"><img src="jpg/listar.jpg" width="45" height="13" border="0" /></a>
              <? }?>          </td>
        </tr>
      </table></td>
  </tr>
</table>
</form>