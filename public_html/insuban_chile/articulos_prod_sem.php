<? 
if($id_art){
$sql="SELECT * FROM articulo_prod_sem where id_articulo_prod_sem='$id_art'";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);
}else{
$sql="SELECT * FROM articulo_prod_sem where id_articulo_prod_sem = id_articulo_prod_sem and id_articulo_prod_sem != 0 order by id_articulo_prod_sem desc";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);
if(!$op) $op=0;
$sql="SELECT * FROM articulo_prod_sem WHERE id_articulo_prod_sem=id_articulo_prod_sem and id_articulo_prod_sem != 0 order by id_articulo_prod_sem desc LIMIT $op , 1";
$result=mysql_query($sql);
$ante=$op - 1;
$next=$op + 1;
$ultimo=$cuantos - 1;
}
  if($grabar){
 
  $sql_nuevo="insert into articulo_prod_sem (id_rubro,id_origen,id_etapa,id_unidad_medida,id_estado,nombre,precio_nac,precio_dolar,precio_euro) values ($id_rubro,$id_origen,$id_etapa,$id_unidad_medida,$id_estado,'$nombre','$precio_nac',$precio_dolar,$precio_euro)";
  //echo"$sql_nuevo";
  $result_nuevo=mysql_query($sql_nuevo,$link);
  echo"<meta http-equiv=\"refresh\" content=\"0;URL=index.php?modulo=articulos_prod_sem.php\">";
  exit;
  }
  
  if($borrar){
  $sql_borrar="delete from articulo_prod_sem where id_articulo_prod_sem = $borrar";
  $r=mysql_query($sql_borrar,$link);
  if($op == -1)
   { 
   echo"<meta http-equiv=\"refresh\" content=\"0;URL=index.php?modulo=articulos_prod_sem.php&op=0\">";
   exit;
   }
  if($op == 0)
   { 
   echo"<meta http-equiv=\"refresh\" content=\"0;URL=index.php?modulo=articulos_prod_sem.php&op=1\">";
   exit;
   }
  //op para dejar el paginador en 0 si es -1
   //echo "estoy dentro de borrar";
   //header( 'Location: index.php?modulo=calibres.php');
   echo"<meta http-equiv=\"refresh\" content=\"0;URL=index.php?modulo=articulos_prod_sem.php&op=$op\">";
   exit;
  }//fin borrar
  
  
  if($modificar){
 $sql_modificar="UPDATE  articulo_prod_sem set id_rubro='$id_rubro',id_origen='$id_origen',id_etapa='$id_etapa',id_unidad_medida='$id_unidad_medida', id_estado='$id_estado',nombre='$nombre',precio_nac='$precio_nac',precio_dolar='$precio_dolar',precio_euro='$precio_euro' where id_articulo_prod_sem=$id_articulo_prod_sem";
$rest=mysql_query($sql_modificar);
  if($id_art){
 echo"<meta http-equiv=\"refresh\" content=\"0;URL=index.php?modulo=articulos_prod_sem.php&id_art=$id_art\">";
 exit;
 }else{
 echo"<meta http-equiv=\"refresh\" content=\"0;URL=index.php?modulo=articulos_prod_sem.php&op=$op\">";
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
	$precio_nac=$_POST["precio_nac-$id"];
	$precio_dolar=$_POST["precio_dolar-$id"];
	$precio_euro=$_POST["precio_euro-$id"];
	$id_rubro=$_POST["id_rubro-$id"];
	$id_origen=$_POST["id_origen-$id"];
	$id_etapa=$_POST["id_etapa-$id"];
	$id_unidad_medida=$_POST["id_unidad_medida-$id"];
	$id_estado=$_POST["id_estado-$id"];
	
	$sql_mod="UPDATE articulo_prod_sem SET  id_rubro='$id_rubro',id_origen='$id_origen', id_etapa='$id_etapa', id_unidad_medida='$id_unidad_medida', id_estado='$id_estado',nombre='$nombre', precio_nac='$precio_nac',precio_dolar='$precio_dolar',precio_euro='$precio_euro' where id_articulo_prod_sem = $id";
	 $rest=mysql_query($sql_mod);
	}
}
if ($elim)
	    {
 		foreach ( $elim as $key => $value)
     	{
	 	$sql_elim="delete from articulo_prod_sem where id_articulo_prod_sem = $value";
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
<table width="598" border="0" align="center">
  <tr>
    <td width="592" height="30" class="titulo">Articulos de Producci&oacute;n </td>
  </tr>
  <tr>
    <td><? if(!$nuevo){?>
        <?
	  $i=$op;
      while ($row=mysql_fetch_array($result))
      { 
	  $id_articulo_prod_sem=$row[id_articulo_prod_sem];
	  $i++;
      ?>
        <span class="titulo">
        <input name="id_articulo_prod_sem" type="hidden" value="<?echo $row[id_articulo_prod_sem]?>" />
        </span>
        <table width="600" height="250" border="1" align="center" bordercolor="#999999">
          <tr>
            <td width="600" height="250"><table width="400" border="0" align="center">
              <tr>
                <td width="135" class="titulo">Nombre</td>
                <td width="250"><input name="nombre" type="text" class="cajas" id="nombre" value="<?echo $row[nombre]?>" size="30" maxlength="30"/></td>
              </tr>
              <tr>
                <td class="titulo" >Rubro</td>
                <td><? 
		 	$rubro= crea_rubro($link,$row[id_rubro]);
			echo $rubro;
			?>                </td>
              </tr>
              <tr>
                <td class="titulo" >Origen</td>
                <td><? 
		 	$origen= crea_origen($link,$row[id_origen]);
			echo $origen;
			?></td>
              </tr>
              <tr>
                <td class="titulo" >Etapa de Prod. </td>
                <td><? 
		 	$dato=1;
			$etapa= crea_etapa($link,$row[id_etapa]);
			echo $etapa;
			?></td>
              </tr>
              <tr>
                <td class="titulo" >Unidad de Medida </td>
                <td><? 
		 	$unidad_medida= crea_unidad_medida($link,$row[id_unidad_medida]);
			echo $unidad_medida;
			?>                </td>
              </tr>
              <tr>
                <td class="titulo" >Precio $ </td>
                <td><input name="precio_nac" type="text" class="cajas" id="precio_nac" value="<?echo $row[precio_nac]?>" size="10"/></td>
              </tr>
              <tr>
                <td class="titulo" >Precio U$S </td>
                <td><input name="precio_dolar" type="text" class="cajas" id="precio_dolar" value="<?echo $row[precio_dolar]?>" size="10"/></td>
              </tr>
              <tr>
                <td class="titulo" >Precio E </td>
                <td><input name="precio_euro" type="text" class="cajas" value="<?echo $row[precio_euro]?>" size="10"/></td>
              </tr>
              <tr>
                <td class="titulo" >Estado</td>
                <td><? 
		 	$estado= crea_estado($link,$row[id_estado]);
			echo $estado;
			?>                </td>
              </tr>
              <tr>
                <td colspan="2" ><? $id_bode=$row[id_articulo_prod_sem];?></td>
                </tr>
            </table></td>
          </tr>
        </table>
        <?}}?>
        <? if($nuevo){?>
        <table width="600" height="250" border="1" align="center" bordercolor="#999999">
          <tr>
            <td width="600" height="250"><table width="400" border="0" align="center">
                <tr>
                  <td width="135" class="titulo">Nombre</td>
                  <td width="234"><input name="nombre" type="text" class="cajas" id="nombre" size="30" maxlength="30"/></td>
                </tr>
                <tr>
                  <td class="titulo" >Rubro</td>
                  <td><? 
		 	$rubro= crea_rubro($link,$row[id_rubro]);
			echo $rubro;
			?>                  </td>
                </tr>
                <tr>
                  <td class="titulo" >Origen</td>
                  <td><? 
		 	$origen= crea_origen($link,$row[id_origen]);
			echo $origen;
			?></td>
                </tr>
                <tr>
                  <td class="titulo" >Etapa de Prod. </td>
                  <td><? 
		 	$dato=1;
			$etapa= crea_etapa($link,$row[id_etapa]);
			echo $etapa;
			?></td>
                </tr>
                <tr>
                  <td class="titulo" >Unidad de Medida </td>
                  <td><? 
		 	$unidad_medida= crea_unidad_medida($link,$row[id_unidad_medida]);
			echo $unidad_medida;
			?>                  </td>
                </tr>
                <tr>
                  <td class="titulo" >Precio $ </td>
                  <td><input name="precio_nac" type="text" class="cajas" id="precio_nac" size="10"/></td>
                </tr>
                <tr>
                  <td class="titulo" >Precio U$S </td>
                  <td><input name="precio_dolar" type="text" class="cajas" id="precio_dolar" size="10"/></td>
                </tr>
                <tr>
                  <td class="titulo" >Precio E </td>
                  <td><input name="precio_euro" type="text" class="cajas" size="10"/></td>
                </tr>
                <tr>
                  <td class="titulo" >Estado</td>
                  <td><? 
		 	$estado= crea_estado($link,$row[id_estado]);
			echo $estado;
			?>                  </td>
                </tr>
                <tr>
                  <td colspan="2" >&nbsp;</td>
                </tr>
            </table></td>
          </tr>
        </table>
        <? }?>
        <table width="564" border="0" align="center">
          <tr>
            <td width="54" class="style2"><a href="?modulo=articulos_prod_sem.php&amp;cancelar=1" ><img src="jpg/primero.jpg" width="54" height="13" border="0" /></a></td>
            <td width="54" class="style2"><? if($ante >= 0){ ?>
                <a href="?modulo=articulos_prod_sem.php&amp;op=<? echo $ante?>" ><img src="jpg/anterior.jpg" width="54" height="13" border="0" /></a>
                <? }else{?>
              &nbsp;
              <? }?>
            </td>
            <td width="58"><? if ($cuantos > $next){ ?>
                <a href="?modulo=articulos_prod_sem.php&amp;op=<? echo $next?>" ><img src="jpg/siguiente.jpg" width="58" height="13" border="0" /></a>
                <? }else{?>
              &nbsp;
              <? }?>
            </td>
            <td width="47"><? if ($cuantos){ ?>
                <a href="?modulo=articulos_prod_sem.php&amp;op=<? echo $ultimo?>" ><img src="jpg/ultimo.jpg" width="47" height="13" border="0" /></a>
                <? }?>
            </td>
            <td width="47"><a href="?modulo=articulos_prod_sem.php&amp;nuevo=1" ><img src="jpg/nuevo.jpg" width="47" height="13" border="0" /></a></td>
            <td width="55"><a href="?modulo=articulos_prod_sem.php&amp;cancelar=1"><img src="jpg/cancelar.jpg" width="55" height="13" border="0" /></a></td>
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
            <td width="45"><p> <a href="?modulo=articulos_prod_sem.php&amp;borrar=<?=$id_bode?>&amp;op=<? echo "$ante"?>" ><img src="jpg/borrar.jpg" width="45" height="13" border="0" /></a><a href="javascript: document.form1.submit();"></a></p></td>
            <td width="45"><a href="?modulo=articulos_prod_sem_listar.php" ><img src="jpg/listar.jpg" width="45" height="13" border="0" /></a></td>
          </tr>
        </table></td>
  </tr>
</table>
</form>