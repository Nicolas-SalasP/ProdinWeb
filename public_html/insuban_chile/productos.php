<? 
if($id_pro){
$sql="SELECT * FROM producto WHERE id_producto='$id_pro' and producto != '' order by id_producto desc";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);
}else{
$sql="SELECT * FROM producto where id_producto != 0 and producto != '' order by id_producto desc";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);

if(!$op) $op=0;
$sql="SELECT * FROM producto WHERE id_producto=id_producto and producto != '' and id_producto != 0 order by id_producto  desc LIMIT $op , 1";
$result=mysql_query($sql);
$ante=$op - 1;
$next=$op + 1;
$ultimo=$cuantos - 1;
}
  if($grabar_x and $producto){
  $sqlus=" select * from producto where producto='$producto'";
   $restus=mysql_query($sqlus);
   $cuantos_hay=mysql_num_rows($restus);
   if(!$cuantos_hay){
  $sql_nuevo="insert into producto (id_unidad_medida,id_especie,id_sector,id_tipo,id_estado,producto,codigo1,codigo2,codigo3,rendimiento,codigosop) values ($id_unidad_medida,$id_especie,$id_sector,$id_tipo,$id_estado,'$producto','$codigo1','$codigo2','$codigo3','$rendimiento','$codigosop')";
  $result_nuevo=mysql_query($sql_nuevo,$link);
  echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=productos.php\">";
  exit;
   }else{
  $mensaje="El Producto ya existe en nuestra bases de datos<br>";
  }
  }
  
 if($borrar){
   $sql_borrar="delete from producto where id_producto = $borrar";
   $r=mysql_query($sql_borrar,$link);
   echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=productos.php\">";
   exit;
  }//fin borrar
  
if($modificar_x){
//echo "ESTOY DENTRO de modificar";
 $sql_modificar="UPDATE  producto set id_unidad_medida='$id_unidad_medida', id_especie='$id_especie', id_sector='$id_sector', id_tipo='$id_tipo', id_estado='$id_estado', producto='$producto', codigo1='$codigo1', codigo2='$codigo2', codigo3='$codigo3', rendimiento='$rendimiento', codigosop='$codigosop', espanol='$espanol', ingles='$ingles', portugues='$portugues', italiano='$italiano', otro='$otro' where id_producto=$id_producto";
 $rest=mysql_query($sql_modificar);
 if($id_pro){
 echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=productos.php&id_pro=$id_pro\">";
 exit;
 }else{
 echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=productos.php&op=$op\">";
 exit;
 }
}

if($modificarlistar || $eliminar){
//echo "estoy dentro de Foreach";
foreach ($_POST as $key => $value)
{
 $dat=split("-",$key);
 if ($dat[0] == 'nombre')
	{
    $id=$dat[1];
    $nombre_producto=$_POST["nombre_producto-$id"];
	$codigo1=$_POST["codigo1-$id"];
	$codigo2=$_POST["codigo2-$id"];
	$codigo3=$_POST["codigo3-$id"];
	$rendimiento=$_POST["rendimiento-$id"];
	$codigosop=$_POST["codigosop-$id"];
	$espanol=$_POST["espanol-$id"];
	$ingles=$_POST["ingles-$id"];
	$portugues=$_POST["portugues-$id"];
	$italiano=$_POST["italiano-$id"];
	$id_unidad_medida=$_POST["id_unidad_medida-$id"];
	$id_especie=$_POST["id_especie-$id"];
	$id_sector=$_POST["id_sector-$id"];
	$id_tipo=$_POST["id_tipo-$id"];
	$id_estado=$_POST["id_estado-$id"];

    $sql_mod="UPDATE producto SET  id_unidad_medida='$id_unidad_medida', id_especie='$id_especie', id_sector='$id_sector', id_tipo='$id_tipo', id_estado='$id_estado', nombre='$nombre_producto', codigo1='$codigo1', codigo2='$codigo2', codigo3='$codigo3', rendimiento='$rendimiento', codigosop='$codigosop', espanol='$espanol', ingles='$ingles', portugues='$portugues', italiano='$italiano', otro='$otro'  where id_producto = $id";
	$rest=mysql_query($sql_mod);
	}
}
if ($elim)
	    {
 		foreach ( $elim as $key => $value)
     	{
	 	$sql_elim="delete from producto where id_producto = $value";
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

if (document.form1.producto.value=="") {     
    alert('Debe ingresar Producto');
    document.form1.producto.onfocus;
    return false;
}
if (document.form1.id_especie.value==0) {     
    alert('Debe ingresar Especie');
    document.form1.id_especie.onfocus;
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
    <td width="611" height="14" bgcolor="#CCCCCC" class="titulo">Producto</td>
    <td width="35" bgcolor="#CCCCCC" class="cajas"><a href="?modulo=productos_listar.php">Volver </a></td>
  </tr>
  
  <tr>
    <td colspan="2">
	  <? if(!$nuevo){?>
      <?
	  while ($row=mysql_fetch_array($result))
      { 
      $i++;
	  $id_producto=$row[id_producto];
	       ?>
      <input name="id_producto" type="hidden" value="<?echo $row[id_producto]?>" />
      <table width="650" height="250" border="1" align="center" bordercolor="#999999">
        <tr>
          <td height="250"><table width="370" border="0" align="center">
            <tr>
              <td width="146" class="titulo"><div align="right">Producto:</div></td>
              <td width="200"><input name="producto" type="text" class="cajas" id="producto" value="<?echo $row[producto]?>" size="40" maxlength="30" /></td>
              <td width="10" class="titulo"><span class="style8">(*)</span></td>
              </tr>
            <tr>
              <td class="titulo"><div align="right">Codigo SOP:</div></td>
              <td><input name="codigosop" type="text" class="cajas" id="codigosop" value="<?echo $row[codigosop]?>" size="40" maxlength="10"/></td>
              <td class="titulo">&nbsp;</td>
              </tr>
            <tr>
              <td class="titulo"><div align="right">Unidad de Medida:</div></td>
              <td><? 
		 	$unidad_medida= crea_unidad_medida($link,$row[id_unidad_medida]);
			echo $unidad_medida;
						
			?></td>
              <td>&nbsp;</td>
              </tr>
            <tr>
              <td class="titulo"><div align="right">Especie:</div></td>
              <td><? 
			  
			$especie= crea_especie($link,$row[id_especie]);
			echo $especie;
			?></td>
              <td class="titulo"><span class="style8">(*)</span></td>
              </tr>
            <tr>
              <td class="titulo"><div align="right">Sector:</div></td>
              <td><? 
		 	
			$sector= crea_sector($link,$row[id_sector]);
			echo $sector;
			?></td>
              <td class="titulo">&nbsp;</td>
              </tr>
            <tr>
              <td class="titulo"><div align="right">Tipo:</div></td>
              <td class="titulo"><? 
		 	$tipo= crea_tipo($link,$row[id_tipo]);
			echo $tipo;
			?></td>
              <td class="titulo">&nbsp;</td>
              </tr>
            <tr>
              <td class="titulo"><div align="right">Estado:</div></td>
              <td><? 
		 	$estado= crea_estado($link,$row[id_estado]);
			echo $estado;
			
			
			
			
			?></td>
              <td class="titulo">&nbsp;</td>
              </tr>
            <tr>
              <td>&nbsp;</td>
              <td><? $id_bode=$row[id_producto];?>
                <span class="style8">(*) Datos obligatorios</span></td>
              <td>&nbsp;</td>
              </tr>
          </table></td>
        </tr>
      </table>
      <? }}?>
	  
      <? if($nuevo){?>
      <table width="650" height="250" border="1" align="center" bordercolor="#999999">
        <tr>
          <td height="250"><table width="371" border="0" align="center">

              <tr>
                <td width="147" class="titulo"><div align="right">Producto:</div></td>
                <td width="200"><input name="producto" type="text" class="cajas" id="producto" value="<? echo $producto?>" size="40" maxlength="30" /></td>
                <td width="10" class="titulo"><span class="style8">(*)</span></td>
                </tr>
              <tr>
                <td class="titulo"><div align="right">Codigo SOP:</div></td>
                <td><input name="codigosop" type="text" class="cajas" id="codigosop" value="<? echo $codigosop?>" size="40" maxlength="10"/></td>
                <td class="titulo">&nbsp;</td>
                </tr>
              <tr>
                <td class="titulo"><div align="right">Unidad de Medida:</div></td>
                <td><? 
		 	$unidad_medida= crea_unidad_medida($link,$id_unidad_medida);
			echo $unidad_medida;
						
			?></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td class="titulo"><div align="right">Especie:</div></td>
                <td><? 
			  
			$especie= crea_especie($link,$id_especie);
			echo $especie;
			?></td>
                <td class="titulo"><span class="style8">(*)</span></td>
              </tr>
              <tr>
                <td class="titulo"><div align="right">Sector:</div></td>
                <td><? 
		 	
			$sector= crea_sector($link,$id_sector);
			echo $sector;
			?></td>
                <td class="titulo">&nbsp;</td>
                </tr>
              <tr>
                <td class="titulo"><div align="right">Tipo:</div></td>
                <td><? 
		 	$tipo= crea_tipo($link,$id_tipo);
			echo $tipo;
			?></td>
                <td class="titulo">&nbsp;</td>
                </tr>
              <tr>
                <td class="titulo"><div align="right">Estado</div></td>
                <td><? 
		 	$estado= crea_estado($link,$id_estado);
			echo $estado;
			
			
			
			
			?></td>
                <td class="titulo">&nbsp;</td>
                </tr>
              <tr>
                <td>&nbsp;</td>
                <td><span class="style8">(*) Datos obligatorios</span></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td colspan="3"><div align="center"><span class="style4">
                  <? if($mensaje) echo $mensaje?>
                </span></div></td>
                </tr>
          </table></td>
        </tr>
      </table>
      <? }?>
      <table width="335" border="0" align="center">
        <tr>
          <td class="style2"><a href="?modulo=productos.php&amp;op=<? echo $ultimo?>"><img src="jpg/primero.jpg" width="54" height="13" border="0" /></a></td>
          <td class="style2"><? if ($cuantos > $next and !$nuevo){ ?>
              <a href="?modulo=productos.php&amp;op=<? echo $next?>" ><img src="jpg/anterior.jpg" width="58" height="13" border="0" /></a>
              <? }else{?>
            &nbsp;
            <? }?></td>
          <td><span class="style2">
            <? if($ante >= 0){ ?>
            <a href="?modulo=productos.php&amp;op=<? echo $ante?>" ><img src="jpg/siguiente.jpg" width="54" height="13" border="0" /></a>
            <? }else{?>
            &nbsp;
            <? }?>
          </span></td>
          <td><? if ($cuantos){ ?>
              <a href="?modulo=productos.php&amp;cancelar=1"><img src="jpg/ultimo.jpg" width="47" height="13" border="0" /></a>
              <? }?>          </td>
          <td width="47"><a href="?modulo=productos.php&amp;nuevo=1" >
            <? if($permiso2 == 1){?>
            <img src="jpg/nuevo.jpg" width="47" height="13" border="0" />
            <? }?>
          </a> </td>
          <td width="55"><a href="?modulo=productos.php&amp;cancelar=1"><img src="jpg/cancelar.jpg" width="55" height="13" border="0" /></a></td>
          <td width="62">
		    <? if($permiso2 == 1){?>
		     <? if(!$nuevo and $cuantos){?>
              <a href="javascript: document.form1.submit();">
              <label>
              <input type="image" name="modificar" src="jpg/modificar.jpg" />
              </label>
              </a>
              <? }?> <? }?>          </td>
          <td width="55">
		  <? if($permiso2 == 1){?>
		  <? if(!$cuantos or $nuevo or $mantsec ){?>
              <a href="javascript: document.form1.submit();">
              <label>
              <input type="image" name="grabar" src="jpg/guardar.jpg" />
              </label>
              </a>
              <? }?> <? }?> </td>
          <td width="45">
		     <? if($permiso2 == 1){?><? if(!$nuevo and $cuantos){?>
			 <? 
			 $sqlsi="SELECT * from cruce_tablas
   where id_producto  = $id_producto ";
		     $resultsi=mysql_query($sqlsi);
             $siexiste=mysql_num_rows($resultsi);
			if(!$siexiste){?>
              <a href="?modulo=productos.php&amp;borrar=<?=$id_bode?>" onClick='return Confirmar(this.form1)' > <img src="jpg/borrar.jpg" width="45" height="13" border="0" /> </a>
              <? }?> <? }?>  <? }?>         </td>
          <td width="45"><? if(!$nuevo and $cuantos){?>
              <a href="?modulo=productos_listar.php"><img src="jpg/listar.jpg" width="45" height="13" border="0" /></a>
              <? }?>          </td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
</table>
</form>