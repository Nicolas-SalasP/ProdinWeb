<?
if($id_li){
$sql="SELECT * FROM lineas_procesos where id_lineas_procesos='$id_li'";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);
}else{
$sql="SELECT * FROM lineas_procesos where id_lineas_procesos = id_lineas_procesos and id_lineas_procesos != 0 order by id_lineas_procesos desc";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);
if(!$op) $op=0;
$sql="SELECT * FROM lineas_procesos WHERE id_lineas_procesos=id_lineas_procesos and id_lineas_procesos != 0 order by id_lineas_procesos desc LIMIT $op , 1";
$result=mysql_query($sql);
$ante=$op - 1;
$next=$op + 1;
$ultimo=$cuantos - 1;
}
if($grabar_x and $nombre){
  $sql_nuevo="insert into lineas_procesos (nombre,sector) values ('$nombre','$sector')";
  $result_nuevo=mysql_query($sql_nuevo,$link);
  echo"<meta http-equiv=\"refresh\" content=\"0;URL=index.php?modulo=lineas_procesos.php\">";
  exit;
  }
  
  if($borrar){
  $sql_borrar="delete from lineas_procesos where id_lineas_procesos = $borrar";
  $r=mysql_query($sql_borrar,$link);
  if($op == -1)
   { 
   echo"<meta http-equiv=\"refresh\" content=\"0;URL=index.php?modulo=lineas_procesos.php&op=0\">";
   exit;
   }
  if($op == 0)
   { 
   echo"<meta http-equiv=\"refresh\" content=\"0;URL=index.php?modulo=lineas_procesos.php&op=1\">";
   exit;
   }
   echo"<meta http-equiv=\"refresh\" content=\"0;URL=index.php?modulo=lineas_procesos.php&op=$op\">";
   exit;
  }//fin borrar
  

if($modificar_x){
 $sql_modificar="UPDATE  lineas_procesos set nombre='$nombre', sector='$sector' where id_lineas_procesos=$id_lineas_procesos";
 $rest=mysql_query($sql_modificar);
 if($id_li){
 echo"<meta http-equiv=\"refresh\" content=\"0;URL=index.php?modulo=lineas_procesos.php&id_li=$id_li\">";
 exit;
 }else{
 echo"<meta http-equiv=\"refresh\" content=\"0;URL=index.php?modulo=lineas_procesos.php&op=$op\">";
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
	$sector=$_POST["sector-$id"];
    $sql_mod="UPDATE lineas_procesos SET  nombre='$nombre', sector='$sector' where id_lineas_procesos = $id";
	$rest=mysql_query($sql_mod);
	}
}
if ($elim)
	    {
 		foreach ( $elim as $key => $value)
     	{
	 	$sql_elim="delete from lineas_procesos where id_lineas_procesos = $value";
	 	$r=mysql_query($sql_elim);
	 	} 
}
} 
  
?>
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
    <td width="839" height="30" class="titulo">Lineas de Proceso </td>
  </tr>
  <tr>
    <td><? if(!$nuevo){?>
      <?
	  $i=$op;
      while ($row=mysql_fetch_array($result))
      { 
	  $id_lineas_procesos=$row[id_lineas_procesos];
      $i++;
      ?>
      <span class="titulo1">
      <input name="id_lineas_procesos" type="hidden" value="<?echo $row[id_lineas_procesos]?>" />
      </span>
      <table width="600" height="250" border="1" align="center" bordercolor="#999999">
        <tr>
          <td width="600"><table width="433" border="0" align="center">
            <tr>
              <td width="69" class="titulo" >Nombre</td>
              <td width="354"><input name="nombre" type="text" class="cajas" id="nombre" value="<?echo $row[nombre]?>" size="50" maxlength="30" /></td>
            </tr>
            <tr>
              <td class="titulo"  >Sector</td>
              <td><input name="sector" type="text" class="cajas" id="sector" value="<?echo $row[sector]?>" size="50" maxlength="30" /></td>
            </tr>
            <tr>
              <td  >&nbsp;</td>
              <td><? $id_bode=$row[id_lineas_procesos];?></td>
            </tr>
          </table></td>
        </tr>
      </table>
      <? }}?>
      <? if($nuevo){?>
      <table width="600" height="250" border="1" align="center" bordercolor="#999999">
        <tr>
          <td width="600"><table width="433" border="0" align="center">
              <tr>
                <td width="69" class="titulo" >Nombre</td>
                <td width="354"><input name="nombre" type="text" class="cajas" id="nombre" size="50" maxlength="30" /></td>
              </tr>
              <tr>
                <td class="titulo"  >Sector</td>
                <td><input name="sector" type="text" class="cajas" id="sector"  size="50" maxlength="30" /></td>
              </tr>
              <tr>
                <td  >&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
          </table></td>
        </tr>
      </table>
      <? }?>
      <table width="335" border="0" align="center">
        <tr>
          <td class="style2"><a href="?modulo=lineas_procesos.php&amp;op=<? echo $ultimo?>"><img src="jpg/primero.jpg" width="54" height="13" border="0" /></a></td>
          <td class="style2"><? if ($cuantos > $next and !$nuevo){ ?>
              <a href="?modulo=lineas_procesos.php&amp;op=<? echo $next?>" ><img src="jpg/anterior.jpg" width="58" height="13" border="0" /></a>
              <? }else{?>
            &nbsp;
            <? }?></td>
          <td><span class="style2">
            <? if($ante >= 0){ ?>
            <a href="?modulo=lineas_procesos.php&amp;op=<? echo $ante?>" ><img src="jpg/siguiente.jpg" width="54" height="13" border="0" /></a>
            <? }else{?>
            &nbsp;
            <? }?>
          </span></td>
          <td><? if ($cuantos){ ?>
              <a href="?modulo=lineas_procesos.php&amp;cancelar=1"><img src="jpg/ultimo.jpg" width="47" height="13" border="0" /></a>
              <? }?>
          </td>
          <td width="47"><a href="?modulo=lineas_procesos.php&amp;nuevo=1" ><img src="jpg/nuevo.jpg" width="47" height="13" border="0" /></a> </td>
          <td width="55"><a href="?modulo=lineas_procesos.php&amp;cancelar=1"><img src="jpg/cancelar.jpg" width="55" height="13" border="0" /></a></td>
          <td width="62"><? if(!$nuevo and $cuantos){?>
              <a href="javascript: document.form1.submit();">
              <label>
              <input type="image" name="modificar" src="jpg/modificar.jpg" />
              </label>
              </a>
              <? }?>
          </td>
          <td width="55"><? if(!$cuantos or $nuevo or $mantsec ){?>
              <a href="javascript: document.form1.submit();">
              <label>
              <input type="image" name="grabar" src="jpg/guardar.jpg" />
              </label>
              </a>
              <? }?>
          </td>
          <td width="45"><? if(!$nuevo and $cuantos){?>
              <a href="?modulo=lineas_procesos.php&amp;borrar=<?=$id_bode?>" > <img src="jpg/borrar.jpg" width="45" height="13" border="0" /> </a>
              <? }?>
          </td>
          <td width="45"><? if(!$nuevo and $cuantos){?>
              <a href="?modulo=lineas_procesos_listar.php"><img src="jpg/listar.jpg" width="45" height="13" border="0" /></a>
              <? }?>
          </td>
        </tr>
      </table></td>
  </tr>
</table>
</form>