<?
if($id_uni){
$sql="SELECT * FROM unidad_medida where id_unidad_medida='$id_uni' and unidad_medida != '' order by id_unidad_medida desc";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);
}else{
$sql="SELECT * FROM unidad_medida where id_unidad_medida = id_unidad_medida and unidad_medida != '' and id_unidad_medida != 0 order by id_unidad_medida desc";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);
if(!$op) $op=0;
$sql="SELECT * FROM unidad_medida WHERE id_unidad_medida=id_unidad_medida and unidad_medida != '' and id_unidad_medida != 0 order by id_unidad_medida desc LIMIT $op , 1";
$result=mysql_query($sql);
$ante=$op - 1;
$next=$op + 1;
$ultimo=$cuantos - 1;
}
  if($grabar_x and $nombre_unidad_medida){
  $sql_nuevo="insert into unidad_medida (unidad_medida) values ('$nombre_unidad_medida')";
   $result_nuevo=mysql_query($sql_nuevo,$link);
  //header( 'Location: index.php?modulo=medidas_productos.php&op='.( $cuantos++ ) );
  echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=unidades_medidas.php\">";
  exit;
  }
  
   if($borrar){
   $sql_borrar="delete from unidad_medida where id_unidad_medida = $borrar";
   $r=mysql_query($sql_borrar,$link);
  if($op == -1)
   { 
   echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=unidades_medidas.php&op=0\">";
   exit;
   }
  if($op == 0)
   { 
   echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=unidades_medidas.php&op=1\">";
   exit;
   }
   echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=unidades_medidas.php&op=$op\">";
   exit;
  }//fin borrar

if($modificar_x){
 $sql_modificar="UPDATE  unidad_medida set unidad_medida='$nombre_unidad_medida' where id_unidad_medida=$id_unidad_medida";
$rest=mysql_query($sql_modificar);
  if($id_uni){
 echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=unidades_medidas.php&id_uni=$id_uni\">";
 exit;
 }else{
 echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=unidades_medidas.php&op=$op\">";
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
<style type="text/css">
<!--
.cajas {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.titulo {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; }
.style2 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14; font-weight: bold; }
-->
</style>
<form id="form1" name="form1" method="post" action="">
<table width="600" border="0" align="center">
  <tr>
    <td width="561" height="14" bgcolor="#CCCCCC" class="titulo">Unidad de Medida</td>
    <td width="35" bgcolor="#CCCCCC" class="cajas"><a href="?modulo=unidades_medidas_listar.php">Volver </a></td>
  </tr>
  <tr>
    <td colspan="2"><? if(!$nuevo){?>
      <?
	  $i=$op;
      while ($row=mysql_fetch_array($result))
      { 
      $i++;
	  $id_unidad_medida=$row[id_unidad_medida];
      ?>
      <span class="titulo">
      <input name="id_unidad_medida" type="hidden" value="<?echo $row[id_unidad_medida]?>" />
      </span>
      <table width="600" height="250" border="1" align="center" bordercolor="#999999">
        <tr>
          <td width="600" height="191"><table width="400" border="0" align="center">
            <tr>
              <td width="129" class="titulo" >Unidad de Medida </td>
              <td width="261"><input name="nombre_unidad_medida" type="text" class="cajas" id="nombre_unidad_medida" value="<?echo $row[unidad_medida]?>" size="30" maxlength="20" /></td>
              </tr>
            <tr>
              <td >&nbsp;</td>
              <td ><? $id_bode=$row[id_unidad_medida];?></td>
              </tr>
          </table></td>
        </tr>
      </table>
      <? }} ?>
	 		 <?
			 $sql="SELECT * from cruce_plant_unidad_medida   where id_unidad_medida = $id_unidad_medida";
		     $result=mysql_query($sql);
             $siexiste=mysql_num_rows($result);
			 ?>
      <? if($nuevo){?>
      <table width="600" height="250" border="1" align="center" bordercolor="#999999">
        <tr>
          <td width="600"><table width="400" border="0" align="center">
              <tr>
                <td width="116" class="titulo" >Unidad de Medida</td>
                <td width="274"><input name="nombre_unidad_medida" type="text" class="cajas" id="nombre_unidad_medida" size="30" maxlength="20" /></td>
                </tr>
              <tr>
                <td >&nbsp;</td>
                <td >&nbsp;</td>
              </tr>
          </table></td>
        </tr>
      </table>
      <? }?>
      <table width="335" border="0" align="center">
        <tr>
          <td class="style2"><a href="?modulo=unidades_medidas.php&amp;op=<? echo $ultimo?>"><img src="jpg/primero.jpg" width="54" height="13" border="0" /></a></td>
          <td class="style2"><? if ($cuantos > $next and !$nuevo){ ?>
              <a href="?modulo=unidades_medidas.php&amp;op=<? echo $next?>" ><img src="jpg/anterior.jpg" width="58" height="13" border="0" /></a>
              <? }else{?>
            &nbsp;
            <? }?></td>
          <td><span class="style2">
            <? if($ante >= 0){ ?>
            <a href="?modulo=unidades_medidas.php&amp;op=<? echo $ante?>" ><img src="jpg/siguiente.jpg" width="54" height="13" border="0" /></a>
            <? }else{?>
            &nbsp;
            <? }?>
          </span></td>
          <td><? if ($cuantos){ ?>
              <a href="?modulo=unidades_medidas.php&amp;cancelar=1"><img src="jpg/ultimo.jpg" width="47" height="13" border="0" /></a>
              <? }?>          </td>
          <td width="47"><? if($permiso3 == 1){?><a href="?modulo=unidades_medidas.php&amp;nuevo=1" ><img src="jpg/nuevo.jpg" width="47" height="13" border="0" /></a><? }?></td>
          <td width="55"><a href="?modulo=unidades_medidas.php&amp;cancelar=1"><img src="jpg/cancelar.jpg" width="55" height="13" border="0" /></a></td>
          <td width="62"><? if($permiso3 == 1){?>
            <? if(!$nuevo and $cuantos){?>
              <a href="javascript: document.form1.submit();">
              <label>
              <input type="image" name="modificar" src="jpg/modificar.jpg" />
              </label>
              </a>
            <? }?>
            <? }?></td>
          <td width="55"><? if($permiso3 == 1){?>
            <? if(!$cuantos or $nuevo or $mantsec ){?>
              <a href="javascript: document.form1.submit();">
              <label>
              <input type="image" name="grabar" src="jpg/guardar.jpg" />
              </label>
              </a>
              <? }?>
              <? }?></td>
          <td width="45">
		    <? if($permiso3 == 1){?>
            <? if(!$nuevo and $cuantos){?>
			<? if(!$siexiste){?>
            <a href="?modulo=unidades_medidas.php&amp;borrar=<?=$id_bode?>" onClick='return Confirmar(this.form1)'> <img src="jpg/borrar.jpg" width="45" height="13" border="0" /></a>
			<? }?>
            <? }?>
			<? }?>
		  </td>
          <td width="45"><? if(!$nuevo and $cuantos){?>
              <a href="?modulo=unidades_medidas_listar.php"><img src="jpg/listar.jpg" width="45" height="13" border="0" /></a>
              <? }?>          </td>
        </tr>
      </table></td>
  </tr>
</table>
</form>