<?
if($id_bo){
$sql="SELECT * FROM bodegas where id_bodegas='$id_bo' order by id_bodegas desc";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);
}else{
$sql="SELECT * FROM bodegas where id_bodegas = id_bodegas and id_bodegas != 0 order by id_bodegas desc";
$result=mysql_query($sql);

$cuantos=mysql_num_rows($result);

if(!$op) $op=0;
$sql="SELECT * FROM bodegas WHERE id_bodegas=id_bodegas and id_bodegas != 0 order by id_bodegas desc LIMIT $op , 1";
$result=mysql_query($sql);
$ante=$op - 1;
$next=$op + 1;
$ultimo=$cuantos - 1;
}
  
if($grabar_x and $bodegas){
   
   $sqlus=" select * from bodegas where bodegas='$bodegas' ";
   $restus=mysql_query($sqlus);
   $cuantos_hay=mysql_num_rows($restus);

  if(!$cuantos_hay){ 
  $sql_nuevo="insert into bodegas (bodegas) values ('$bodegas')";
  $result_nuevo=mysql_query($sql_nuevo,$link);
  echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=bodegas.php\">";
  exit;
  }else{
  $mensaje="La Bodega ya existe en nuestra bases de datos<br>";
  }
}

 if($borrar){
   $sql_borrar="delete from bodegas where id_bodegas = $borrar";
   $r=mysql_query($sql_borrar,$link);
   echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=bodegas.php\">";
   exit;
  }//fin borrar


if($modificar_x){
 $sql_modificar="UPDATE  bodegas set bodegas='$bodegas' where id_bodegas=$id_bodegas";
 $rest=mysql_query($sql_modificar);
  if($id_bo){
 echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=bodegas.php&id_bo=$id_bo\">";
 exit;
 }else{
 echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=bodegas.php&op=$op\">";
 exit;
 }
}

if($modificarlistar || $eliminar){
foreach ($_POST as $key => $value)
{
 $dat=split("-",$key);
 if ($dat[0] == 'bodegas')
	{
    $id=$dat[1];
    $bodegas=$_POST["bodegas-$id"];
    $sql_mod="UPDATE bodegas SET  bodegas='$bodegas' where id_bodegas = $id";
	$rest=mysql_query($sql_mod);
	}
}
if ($elim)
	{
 	foreach ( $elim as $key => $value)
    {
	$sql_elim="delete from bodegas where id_bodegas = $value";
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

if (document.form1.bodegas.value=="") {     
    alert('Debe ingresar Bodega');
    document.form1.bodegas.onfocus;
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
<form id="form1" name="form1" method="post" action=""  onsubmit = "return isMailReady(this);">
    
<table width="650" height="250" border="0" align="center">
  <tr>
    <td width="614" bgcolor="#CCCCCC" class="titulo">Bodegas</td>
    <td width="32" bgcolor="#CCCCCC"><a href="?modulo=bodegas_listar.php" class="cajas">Volver</a></td>
  </tr>
  <tr>
    <td colspan="2">
	  <? if(!$nuevo){?>
	  
	  <?
	  $i=$op;
      while ($row=mysql_fetch_array($result))
      { 
	  $id_bodegas=$row[id_bodegas];
      $i++;
	  
      ?>
	  
	  <span class="titulo">
	  <input name="id_bodegas" type="hidden" value="<?echo $row[id_bodegas]?>" />
	  </span>
	  <table width="650" height="250" border="1" align="center" bordercolor="#999999">
        <tr>
          <td width="600"><table width="325" border="0" align="center">
            <tr>
              <td width="51" class="titulo"><div align="right">Bodega:</div></td>
              <td width="250"><input name="bodegas" type="text" class="cajas"  id="bodegas" value="<?echo $row[bodegas]?>" size="50" maxlength="30" /></td>
              <td width="10"><span class="style8">(*)</span></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td colspan="2"><span class="style8"> (*) Datos obligatorios</span></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td colspan="2" class="style4"><? $id_bode=$row[id_bodegas];?></td>
            </tr>
          </table></td>
        </tr>
      </table>
	  <? }}?>
	  <? if($nuevo){?>
	  <table width="650" height="250" border="1" align="center" bordercolor="#999999">
        <tr>
          <td width="600"><table width="325" border="0" align="center">
              <tr>
                <td width="51" class="titulo"><div align="right">Bodega:</div></td>
                <td width="250"><input name="bodegas" type="text" class="cajas"  id="bodegas" value="<? echo $bodega?>" size="50" maxlength="30" /></td>
                <td width="10"><span class="style8">(*)</span></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td colspan="2" class="style8">(*) Datos obligatorios</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td colspan="2" class="style4"><? if($mensaje) echo $mensaje?></td>
              </tr>
          </table></td>
        </tr>
      </table>
	  <? }?>
	  <table width="335" border="0" align="center">
        <tr>
          <td class="style2"><a href="?modulo=bodegas.php&amp;op=<? echo $ultimo?>"><img src="jpg/primero.jpg" width="54" height="13" border="0" /></a></td>
          <td class="style2"><? if ($cuantos > $next and !$nuevo){ ?>
              <a href="?modulo=bodegas.php&amp;op=<? echo $next?>" ><img src="jpg/anterior.jpg" width="58" height="13" border="0" /></a>
              <? }else{?>
            &nbsp;
            <? }?></td>
          <td><span class="style2">
            <? if($ante >= 0){ ?>
            <a href="?modulo=bodegas.php&amp;op=<? echo $ante?>" ><img src="jpg/siguiente.jpg" width="54" height="13" border="0" /></a>
            <? }else{?>
            &nbsp;
            <? }?>
          </span></td>
          <td><? if ($cuantos){ ?>
              <a href="?modulo=bodegas.php&amp;cancelar=1"><img src="jpg/ultimo.jpg" width="47" height="13" border="0" /></a>
              <? }?>          </td>
          <td width="47"><? if($permiso14 == 1){?><a href="?modulo=bodegas.php&amp;nuevo=1" ><img src="jpg/nuevo.jpg" width="47" height="13" border="0" /></a><? }?></td>
          <td width="55"><a href="?modulo=bodegas.php&amp;cancelar=1"><img src="jpg/cancelar.jpg" width="55" height="13" border="0" /></a></td>
          <td width="62"><? if($permiso14 == 1){?><? if(!$nuevo and $cuantos){?>
              <a href="javascript: document.form1.submit();">
              <label>
              <input type="image" name="modificar" src="jpg/modificar.jpg" />
              </label>
              </a>
              <? }?><? }?>          </td>
          <td width="55"><? if($permiso14 == 1){?><? if(!$cuantos or $nuevo or $mantsec ){?>
              <a href="javascript: document.form1.submit();">
              <label>
              <input type="image" name="grabar" src="jpg/guardar.jpg" />
              </label>
              </a>
              <? }?><? }?>          </td>
          <td width="45"><? if($permiso14 == 1){?><? if(!$nuevo and $cuantos){?>
              <a href="?modulo=bodegas.php&amp;borrar=<?=$id_bode?>" onclick='return Confirmar(this.form1)'> <img src="jpg/borrar.jpg" width="45" height="13" border="0" /> </a>
              <? }?><? }?>          </td>
          <td width="45"><? if(!$nuevo and $cuantos){?>
              <a href="?modulo=bodegas_listar.php"><img src="jpg/listar.jpg" width="45" height="13" border="0" /></a>
              <? }?>          </td>
        </tr>
      </table></td>
  </tr>
</table>		  
</form>
