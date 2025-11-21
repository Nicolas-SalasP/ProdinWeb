<?
ini_set('memory_limit', '-1');
if($id_et){
$sql="SELECT * FROM etiquetas where id_etiquetas='$id_et' order by id_etiquetas desc";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);
}else{
$sql="SELECT * FROM etiquetas where id_etiquetas = id_etiquetas and id_etiquetas != 0 order by id_etiquetas desc";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);
if(!$op) $op=0;
$sql="SELECT * FROM etiquetas WHERE id_etiquetas=id_etiquetas and id_etiquetas != 0 order by id_etiquetas desc LIMIT $op , 1";
$result=mysql_query($sql);
$ante=$op - 1;
$next=$op + 1;
$ultimo=$cuantos - 1;
}
if($grabar_x){
  $sql_nuevo="insert into etiquetas (etiquetas,descripcion) values ('$etiquetas','$descripcion')";
  $result_nuevo=mysql_query($sql_nuevo,$link);
  //header( 'Location: index.php?modulo=etiquetas.php&op='.( $cuantos++ ) );
  echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=etiquetas.php\">";
  exit;
  }
  
  if($borrar){
  $sql_borrar="delete from etiquetas where id_etiquetas = $borrar";
  $r=mysql_query($sql_borrar,$link);
  if($op == -1)
   { 
   echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=etiquetas.php&op=0\">";
   exit;
   }
  if($op == 0)
   { 
   echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=etiquetas.php&op=1\">";
   exit;
   }
  //op para dejar el paginador en 0 si es -1
   //echo "estoy dentro de borrar";
   //header( 'Location: index.php?modulo=calibres.php');
   echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=etiquetas.php&op=$op\">";
   exit;
  }//fin borrar


if($modificar_x){
 $sql_modificar="UPDATE  etiquetas set etiquetas='$etiquetas', descripcion='$descripcion' where id_etiquetas=$id_etiquetas";
 $rest=mysql_query($sql_modificar);
  if($id_et){
 echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=etiquetas.php&id_et=$id_et\">";
 exit;
 }else{
 echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=etiquetas.php&op=$op\">";
 exit;
 }
 
}

if($modificarlistar || $eliminar){
foreach ($_POST as $key => $value)
{
 $dat=split("-",$key);
 if ($dat[0] == 'etiquetas')
	{
    $id=$dat[1];
    $etiquetas=$_POST["etiquetas-$id"];
	$descripcion=$_POST["descripcion-$id"];
    $sql_mod="UPDATE etiquetas SET  etiquetas='$etiquetas', descripcion='$descripcion' where id_etiquetas = $id";
	$rest=mysql_query($sql_mod);
	}
}
if ($elim)
	    {
 		foreach ( $elim as $key => $value)
     	{
	 	$sql_elim="delete from etiquetas where id_etiquetas = $value";
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
    <td width="561" bgcolor="#CCCCCC" class="titulo">Etiqueta</td>
    <td width="35" bgcolor="#CCCCCC" class="cajas"><a href="?modulo=etiquetas_listar.php">Volver </a></td>
  </tr>
  <tr>
    <td colspan="2"><? if(!$nuevo){?>
      <?
	   if($listar){
	  $sql="SELECT * FROM etiquetas";
	  $result=mysql_query($sql);
	  $cuantos=mysql_num_rows($result);
	  }
	  $i=$op;
      while ($row=mysql_fetch_array($result))
      { 
	  $id_etiquetas=$row[id_etiquetas];
      $i++;
      ?>
      <span class="titulo1">
      <input name="id_etiquetas" type="hidden" value="<?echo $row[id_etiquetas]?>" />
      </span>
      <table width="600" height="250" border="1" align="center" bordercolor="#CCCCCC">
        <tr>
          <td><table width="433" border="0" align="center">
            <tr>
              <td width="123" class="titulo" >Nombre</td>
              <td><input name="etiquetas" type="text" class="cajas" id="etiquetas" value="<?echo $row[etiquetas]?>" size="50" maxlength="30" /></td>
              </tr>
            <tr>
              <td class="titulo"  >Descripci&oacute;n</td>
              <td><input name="descripcion" type="text" class="cajas" id="descripcion" value="<?echo $row[descripcion]?>" size="50" maxlength="30" /></td>
              </tr>
            <tr>
              <td  >&nbsp;</td>
              <td><? $id_bode=$row[id_etiquetas];?></td>
              </tr>
          </table></td>
        </tr>
      </table>
      <? }}?>
      <? if($nuevo){?>
      <table width="600" height="250" border="1" align="center" bordercolor="#CCCCCC">
        <tr>
          <td><table width="433" border="0" align="center">
              <tr>
                <td width="123" class="titulo" >Nombre</td>
                <td><input name="etiquetas" type="text" class="cajas" id="etiquetas2" size="50" maxlength="30" /></td>
              </tr>
              <tr>
                <td class="titulo"  >Descripci&oacute;n</td>
                <td><input name="descripcion" type="text" class="cajas" id="descripcion"  size="50" maxlength="30" /></td>
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
          <td class="style2"><a href="?modulo=etiquetas.php&amp;op=<? echo $ultimo?>"><img src="jpg/primero.jpg" width="54" height="13" border="0" /></a></td>
          <td class="style2"><? if ($cuantos > $next and !$nuevo){ ?>
              <a href="?modulo=etiquetas.php&amp;op=<? echo $next?>" ><img src="jpg/anterior.jpg" width="58" height="13" border="0" /></a>
              <? }else{?>
            &nbsp;
            <? }?></td>
          <td><span class="style2">
            <? if($ante >= 0){ ?>
            <a href="?modulo=etiquetas.php&amp;op=<? echo $ante?>" ><img src="jpg/siguiente.jpg" width="54" height="13" border="0" /></a>
            <? }else{?>
            &nbsp;
            <? }?>
          </span></td>
          <td><? if ($cuantos){ ?>
              <a href="?modulo=etiquetas.php&amp;cancelar=1"><img src="jpg/ultimo.jpg" width="47" height="13" border="0" /></a>
              <? }?>          </td>
          <td width="47"><? if($permiso15 == 1){?><a href="?modulo=etiquetas.php&amp;nuevo=1" ><img src="jpg/nuevo.jpg" width="47" height="13" border="0" /></a><? }?></td>
          <td width="55"><a href="?modulo=etiquetas.php&amp;cancelar=1"><img src="jpg/cancelar.jpg" width="55" height="13" border="0" /></a></td>
          <td width="62"><? if($permiso15 == 1){?><? if(!$nuevo and $cuantos){?>
              <a href="javascript: document.form1.submit();">
              <label>
              <input type="image" name="modificar" src="jpg/modificar.jpg" />
              </label>
              </a>
              <? }?><? }?></td>
          <td width="55"><? if($permiso15 == 1){?><? if(!$cuantos or $nuevo or $mantsec ){?>
              <a href="javascript: document.form1.submit();">
              <label>
              <input type="image" name="grabar" src="jpg/guardar.jpg" />
              </label>
              </a>
              <? }?><? }?></td>
          <td width="45"><? if($permiso15 == 1){?><? if(!$nuevo and $cuantos){?>
              <a href="?modulo=etiquetas.php&amp;borrar=<?=$id_bode?>" onclick='return Confirmar(this.form1)'> <img src="jpg/borrar.jpg" width="45" height="13" border="0" /> </a>
              <? }?><? }?></td>
          <td width="45"><? if(!$nuevo and $cuantos){?>
              <a href="?modulo=etiquetas_listar.php"><img src="jpg/listar.jpg" width="45" height="13" border="0" /></a>
              <? }?>          </td>
        </tr>
      </table></td>
  </tr>
</table>
</form>