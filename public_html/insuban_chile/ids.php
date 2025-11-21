<?
if($id_id){
$sql="SELECT * FROM ids where id_ids='$id_id'";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);
}else{
$sql="SELECT * FROM ids";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);
if(!$op) $op=0;
$sql="SELECT * FROM ids WHERE id_ids=id_ids LIMIT $op , 1";
$result=mysql_query($sql);
$ante=$op - 1;
$next=$op + 1;
$ultimo=$cuantos - 1;
}
if($grabar){
  $sql_nuevo="insert into ids (tabla,descripcion,next_id) values ('$tabla','$descripcion','$next_id')";
  $result_nuevo=mysql_query($sql_nuevo,$link);
  //header( 'Location: index.php?modulo=ids.php&op='.( $cuantos++ ) );
  echo"<meta http-equiv=\"refresh\" content=\"0;URL=index.php?modulo=ids.php&op=$cuantos++\">";
  exit;
  }
  
  if($borrar){
  $sql_borrar="delete from ids where id_ids = $borrar";
  $r=mysql_query($sql_borrar,$link);
  if($op == -1)
   { 
   echo"<meta http-equiv=\"refresh\" content=\"0;URL=index.php?modulo=ids.php&op=0\">";
   exit;
   }
  if($op == 0)
   { 
   echo"<meta http-equiv=\"refresh\" content=\"0;URL=index.php?modulo=ids.php&op=1\">";
   exit;
   }
  //op para dejar el paginador en 0 si es -1
   //echo "estoy dentro de borrar";
   //header( 'Location: index.php?modulo=calibres.php');
   echo"<meta http-equiv=\"refresh\" content=\"0;URL=index.php?modulo=ids.php&op=$op\">";
   exit;
  }//fin borrar


if($modificar){
 $sql_modificar="UPDATE  ids set tabla='$tabla', descripcion='$descripcion', next_id=$next_id where id_ids=$id_ids";
 $rest=mysql_query($sql_modificar);
  if($id_id){
 echo"<meta http-equiv=\"refresh\" content=\"0;URL=index.php?modulo=ids.php&id_id=$id_id\">";
 exit;
 }else{
 echo"<meta http-equiv=\"refresh\" content=\"0;URL=index.php?modulo=ids.php&op=$op\">";
 exit;
 }
 
}

if($modificarlistar || $eliminar){
foreach ($_POST as $key => $value)
{
 $dat=split("-",$key);
 if ($dat[0] == 'tabla')
	{
    $id=$dat[1];
    $tabla=$_POST["tabla-$id"];
	$descripcion=$_POST["descripcion-$id"];
	$next_id=$_POST["next_id-$id"];
    $sql_mod="UPDATE ids SET  tabla='$tabla', descripcion='$descripcion', next_id=$next_id where id_ids = $id";
	$rest=mysql_query($sql_mod);
	}
}
if ($elim)
	    {
 		foreach ( $elim as $key => $value)
     	{
	 	$sql_elim="delete from ids where id_ids = $value";
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
-->
</style>
<form id="form1" name="form1" method="post" action="">
<table width="455" border="0" align="center">
  <tr>
    <td width="502" height="30" class="titulo">Ids </td>
  </tr>
  <tr>
    <td><? if(!$nuevo){?>
      <?
	  $i=$op;
      while ($row=mysql_fetch_array($result))
      { 
	  $id_ids=$row[id_ids];
      $i++;
      ?>
      <span class="titulo1">
      <input name="id_ids" type="hidden" value="<?echo $row[id_ids]?>" />
      </span>
      <table width="600" border="1" align="center" bordercolor="#CCCCCC">
        <tr>
          <td><table width="460" border="0" align="center">
            <tr>
              <td width="78" class="titulo" >Tabla</td>
              <td><input name="tabla" type="text" class="cajas" id="tabla" value="<?echo $row[tabla]?>" size="50" /></td>
              </tr>
            <tr>
              <td class="titulo"  >Descripci&oacute;n</td>
              <td><input name="descripcion" type="text" class="cajas" id="descripcion" value="<?echo $row[descripcion]?>" size="50" /></td>
              </tr>
            <tr>
              <td class="titulo"  >Next ID </td>
              <td><input name="next_id" type="text" class="cajas" id="next_id" value="<?echo $row[next_id]?>" size="50" /></td>
              </tr>
            <tr>
              <td  >&nbsp;</td>
              <td><? $id_bode=$row[id_ids];?></td>
            </tr>
          </table></td>
        </tr>
      </table>
      <? }}?>
      <? if($nuevo){?>
      <table width="600" border="1" align="center" bordercolor="#CCCCCC">
        <tr>
          <td><table width="433" border="0" align="center">
              <tr>
                <td width="81" class="titulo" >Tabla</td>
                <td width="342"><input name="tabla" type="text" class="cajas" id="tabla" size="50" /></td>
                </tr>
              <tr>
                <td class="titulo"  >Descripci&oacute;n</td>
                <td><input name="descripcion" type="text" class="cajas" id="descripcion" size="50" /></td>
                </tr>
              <tr>
                <td class="titulo"  >Next ID </td>
                <td><input name="next_id" type="text" class="cajas" id="next_id" size="50" /></td>
                </tr>
              <tr>
                <td  >&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
          </table></td>
        </tr>
      </table>
      <? }?>
        <table width="564" border="0" align="center">
          <tr>
            <td width="54" class="style2"><a href="?modulo=ids.php&amp;cancelar=1" ><img src="jpg/primero.jpg" width="54" height="13" border="0" /></a></td>
            <td width="54" class="style2"><? if($ante >= 0){ ?>
                <a href="?modulo=ids.php&amp;op=<? echo $ante?>" ><img src="jpg/anterior.jpg" width="54" height="13" border="0" /></a>
                <? }else{?>
              &nbsp;
              <? }?>
            </td>
            <td width="58"><? if ($cuantos > $next){ ?>
                <a href="?modulo=ids.php&amp;op=<? echo $next?>" ><img src="jpg/siguiente.jpg" width="58" height="13" border="0" /></a>
                <? }else{?>
              &nbsp;
              <? }?>
            </td>
            <td width="47"><? if ($cuantos){ ?>
                <a href="?modulo=ids.php&amp;op=<? echo $ultimo?>" ><img src="jpg/ultimo.jpg" width="47" height="13" border="0" /></a>
                <? }?>
            </td>
            <td width="47"><a href="?modulo=ids.php&amp;nuevo=1" ><img src="jpg/nuevo.jpg" width="47" height="13" border="0" /></a></td>
            <td width="55"><a href="?modulo=ids.php&amp;cancelar=1"><img src="jpg/cancelar.jpg" width="55" height="13" border="0" /></a></td>
            <td width="62"><a href="javascript: document.form1.submit();">
              <input type="hidden" name="modificar" value="modificar" />
              <img src="jpg/modificar.jpg" width="62" height="13" border="0" /></a><a href="javascript: document.form1.submit();"></a></td>
            <td width="55"><? if ($nuevo or !$cuantos){ ?>
                <input type="hidden" name="grabar" value="grabar" />
                <a href="javascript: document.form1.submit();"><img src="jpg/guardar.jpg" width="55" height="13" border="0" /></a>
                <? }else{?>
              &nbsp;
              <? }?>
            </td>
            <td width="45"><p> <a href="?modulo=ids.php&amp;borrar=<?=$id_bode?>&amp;op=<? echo "$ante"?>" ><img src="jpg/borrar.jpg" width="45" height="13" border="0" /></a><a href="javascript: document.form1.submit();"></a></p></td>
            <td width="45"><a href="?modulo=ids_listar.php" ><img src="jpg/listar.jpg" width="45" height="13" border="0" /></a></td>
          </tr>
        </table></td>
  </tr>
</table>
</form>