<?

if($id_op){
$sql="SELECT * FROM operarios  where id_operarios='$id_op' order by id_operarios desc";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);
}else{
$sql="SELECT * FROM operarios where id_operarios = id_operarios and id_operarios != 0 order by id_operarios desc";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);
if(!$op) $op=0;
$sql="SELECT * FROM operarios WHERE id_operarios=id_operarios and id_operarios != 0 order by id_operarios desc LIMIT $op , 1";
$result=mysql_query($sql);
$ante=$op - 1;
$next=$op + 1;
$ultimo=$cuantos - 1;
}


  if($grabar_x and $nombreop){
   
     $sqlus=" select * from operarios where nombreop='$nombreop' and apellido='$apellido' ";
   $restus=mysql_query($sqlus);
   $cuantos_hay=mysql_num_rows($restus);
   if(!$cuantos_hay){
   
  $sql_nuevo="insert into operarios (nombreop,apellido,iniciales,id_funcion_operarios,id_grupo,id_ldp,cod_remun,centrocosto,id_estado) values ('$nombreop','$apellido','$iniciales','$id_funcion_operarios','$id_ldp','$id_grupo','$cod_remun','$centrocosto','$id_estado')";
   $result_nuevo=mysql_query($sql_nuevo,$link);
   echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=operarios.php\">";
   exit;
   }else{
  $mensaje="El Nombre y Apellido ya existe en nuestra bases de datos<br>";
  }
}
  
    
    if($borrar){
   $sql_borrar="delete from operarios where id_operarios = $borrar";
   $r=mysql_query($sql_borrar,$link);
   echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=operarios.php\">";
   exit;
  }//fin borrar
  
  
  if($modificar_x){
  
 $sql_modificar="UPDATE  operarios set id_funcion_operarios='$id_funcion_operarios', id_ldp='$id_ldp',id_estado='$id_estado',nombreop='$nombreop', apellido='$apellido', iniciales='$iniciales',id_grupo='$id_grupo',letra='$letra', cod_remun='$cod_remun', centrocosto='$centrocosto' where id_operarios=$id_operarios";

$rest=mysql_query($sql_modificar);

//echo "sql_modificar $sql_modificar";
 if($id_op){
 echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=operarios.php&id_op=$id_op\">";
 exit;
 }else{
 echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=operarios.php&op=$op\">";
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
    $nombreop=$_POST["nombreop-$id"];
	$apellido=$_POST["apellido-$id"];
	$iniciales=$_POST["iniciales-$id"];
	$ficha=$_POST["ficha-$id"];
	$cod_remun=$_POST["cod_remun-$id"];
	$id_funcion_operarios=$_POST["id_funcion_operarios-$id"];
	$id_estado=$_POST["id_estado-$id"];
	
	$sql_mod="UPDATE operarios SET  id_funcion_operarios='$id_funcion_operarios', id_estado='$id_estado', nombreop='$nombreop', apellido='$apellido', iniciales='$iniciales', ficha='$ficha', grupo='$grupo', cod_remun='$cod_remun' where id_operarios = $id";
	$rest=mysql_query($sql_mod);
	}
}
if ($elim)
	    {
 		foreach ( $elim as $key => $value)
     	{
	 	$sql_elim="delete from operarios where id_operarios = $value";
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

if (document.form1.nombreop.value=="") {     
    alert('Debe ingresar Nombre');
    document.form1.nombreop.onfocus;
    return false;
}
if (document.form1.apellido.value=="") {     
    alert('Debe ingresar Apellido');
    document.form1.apellido.onfocus;
    return false;
}
if (document.form1.iniciales.value=="") {     
    alert('Debe ingresar Iniciales');
    document.form1.iniciales.onfocus;
    return false;
}

if (document.form1.id_funcion_operarios.value==0) {     
    alert('Debe ingresar Función Operarios');
    document.form1.id_funcion_operarios.onfocus;
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
<form id="form1" name="form1" method="post" action="" onsubmit = "return isMailReady(this);">
	<table width="650" border="0" align="center">
  <tr>
    <td width="614" height="14" bgcolor="#CCCCCC" class="titulo">Operarios</td>
    <td width="32" bgcolor="#CCCCCC" class="cajas"><a href="?modulo=operarios_listar.php">Volver</a></td>
  </tr>
  <tr>
    <td colspan="2"><? if(!$nuevo){?>
      <?
	  $i=$op;
      while ($row=mysql_fetch_array($result))
      { 
	  $id_operarios=$row[id_operarios];
	  $i++;
      ?>
      <span class="titulo">
      <input name="id_operarios" type="hidden" value="<?echo $row[id_operarios]?>" />
      </span>
      <table width="650" height="250" border="1" align="center" bordercolor="#999999">
        <tr>
          <td width="600"><table width="490" border="0" align="center">
            <tr>
              <td width="148" class="titulo"  ><div align="right">Nombre:</div></td>
              <td><input name="nombreop" type="text" style="text-transform:uppercase" class="cajas" value="<?echo $row[nombreop]?>" size="50" maxlength="30" /></td>
              <td width="10"><span class="style8">(*)</span></td>
            </tr>
            <tr>
              <td class="titulo"><div align="right">Apellido:</div></td>
              <td><input name="apellido" type="text" style="text-transform:uppercase" class="cajas" value="<?echo $row[apellido]?>" size="50" maxlength="30" /></td>
              <td><span class="style8">(*)</span></td>
            </tr>
            <tr>
              <td class="titulo"><div align="right">Iniciales:</div></td>
              <td><input name="iniciales" type="text" class="cajas" style="text-transform:uppercase" value="<?echo $row[iniciales]?>" size="10" maxlength="5" /></td>
              <td><span class="style8">(*)</span></td>
            </tr>
            <tr>
              <td align="right" class="titulo">Funci&oacute;n:</td>
              <td><? 
			
			$grupo_funcion_operarios= crea_funcion_operarios($link,$row[id_funcion_operarios]);
			echo $grupo_funcion_operarios;
			?></td>
              <td><span class="style8">(*)</span></td>
            </tr>
            <tr>
              <td align="right" class="titulo">Grupo:</td>
              <td><? 
					           $grupo= crea_grupo_personas($link,$row[id_grupo]);
					            echo $grupo;
			?></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td class="titulo"><div align="right">Linea producci&oacute;n:</div></td>
              <td><? list ($ldp,$id_ldp) = crea_linea_produccion($link,$ldp,$row[id_ldp],0);
			  	echo "$ldp ";
			  ?></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td class="titulo"><div align="right">Cod. Remun.: </div></td>
              <td><input name="cod_remun" type="text" class="cajas" style="text-transform:uppercase" value="<?echo $row[cod_remun]?>" size="10" maxlength="10" /></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td align="right" class="titulo">Centro de Costo:</td>
              <td><input name="centrocosto" type="text" class="cajas" value="<?echo $row[centrocosto]?>" size="10" maxlength="10" /></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td class="titulo"><div align="right">Estado:</div></td>
              <td><? 
		 	
			$estado= crea_estado($link,$row[id_estado]);
			echo $estado;
						?></td>
              <td>&nbsp;</td>
            </tr>
			  
            <tr>
              <td >&nbsp;</td>
              <td ><? $id_bode=$row[id_operarios];?>
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
          <td width="600"><table width="499" border="0" align="center">
              <tr>
                <td width="123" class="titulo"  ><div align="right">Nombre:</div></td>
                <td><input name="nombreop" type="text" style="text-transform:uppercase" class="cajas" id="nombreop" value="<? echo $nombreop?>" size="50" maxlength="30" /></td>
                <td width="10"><span class="style8">(*)</span></td>
              </tr>
              <tr>
                <td class="titulo"><div align="right">Apellido:</div></td>
                <td><input name="apellido" type="text" style="text-transform:uppercase" class="cajas" id="apellido" value="<? echo $apellido?>" size="50" maxlength="30" /></td>
                <td><span class="style8">(*)</span></td>
              </tr>
              <tr>
                <td class="titulo"><div align="right">Iniciales:</div></td>
                <td><input name="iniciales" type="text" style="text-transform:uppercase" class="cajas" id="iniciales" value="<? echo $iniciales?>" size="10" maxlength="5" /></td>
                <td><span class="style8">(*)</span></td>
              </tr>
              <tr>
                <td class="titulo"><div align="right">Funci&oacute;n:</div></td>
                <td><? 
			
			$grupo_funcion_operarios= crea_funcion_operarios($link,$id_funcion_operarios);
			echo $grupo_funcion_operarios;
			
			  
			
			?>                </td>
                <td><span class="style8">(*)</span></td>
              </tr>
              <tr>
                <td align="right" class="titulo">Grupo:</td>
                <td><? 
					           $grupo= crea_grupo_personas($link,$id_grupo);
					            echo $grupo;
			?></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td align="right" class="titulo">Linea producci&oacute;n:</td>
                <td><?
                list ($ldp,$id_ldp) = crea_linea_produccion($link,$ldp,$id_ldp,2);
			  echo "$ldp ";
				
				?></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td class="titulo"><div align="right">Cod. Remun.:</div></td>
                <td><input name="cod_remun" type="text" style="text-transform:uppercase" class="cajas" id="cod_remun" value="<? echo $cod_remun?>" size="10" maxlength="10" /></td>
                <td rowspan="2">&nbsp;</td>
              </tr>
              <tr>
                <td align="right" class="titulo">Centro de Costo:</td>
                <td><input name="centrocosto" type="text" class="cajas" value="<?echo $centrocosto?>" size="10" maxlength="10" /></td>
              </tr>
              <tr>
                <td class="titulo"><div align="right">Estado:</div></td>
                <td><? 
		 	
			$estado= crea_estado($link,$id_estado);
			echo $estado;
						?></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td >&nbsp;</td>
                <td ><span class="style13"><span class="style8">(*)</span> <span class="style8">Datos obligatorios</span></span></td>
                <td >&nbsp;</td>
              </tr>
              <tr>
                <td colspan="3" ><div align="center"><span class="style4">
                  <? if($mensaje) echo $mensaje?>
                </span></div></td>
              </tr>
          </table></td>
        </tr>
      </table>
      <? }?>
      <table width="335" border="0" align="center">
        <tr>
          <td class="style2"><a href="?modulo=operarios.php&amp;op=<? echo $ultimo?>"><img src="jpg/primero.jpg" width="54" height="13" border="0" /></a></td>
          <td class="style2"><? if ($cuantos > $next and !$nuevo){ ?>
              <a href="?modulo=operarios.php&amp;op=<? echo $next?>" ><img src="jpg/anterior.jpg" width="58" height="13" border="0" /></a>
              <? }else{?>
            &nbsp;
            <? }?></td>
          <td><span class="style2">
            <? if($ante >= 0){ ?>
            <a href="?modulo=operarios.php&amp;op=<? echo $ante?>" ><img src="jpg/siguiente.jpg" width="54" height="13" border="0" /></a>
            <? }else{?>
            &nbsp;
            <? }?>
          </span></td>
          <td><? if ($cuantos){ ?>
              <a href="?modulo=operarios.php&amp;cancelar=1"><img src="jpg/ultimo.jpg" width="47" height="13" border="0" /></a>
              <? }?>          </td>
          <td width="47"><? if($permiso8 == 1){?><a href="?modulo=operarios.php&amp;nuevo=1" ><img src="jpg/nuevo.jpg" width="47" height="13" border="0" /></a><? }?> </td>
          <td width="55"><a href="?modulo=operarios.php&amp;cancelar=1"><img src="jpg/cancelar.jpg" width="55" height="13" border="0" /></a></td>
          <td width="62"><? if($permiso8 == 1){?><? if(!$nuevo and $cuantos){?>
              <a href="javascript: document.form1.submit();">
              <label>
              <input type="image" name="modificar" src="jpg/modificar.jpg" />
              </label>
              </a>
              <? }?><? }?> </td>
          <td width="55"><? if($permiso8 == 1){?><? if(!$cuantos or $nuevo or $mantsec ){?>
              <a href="javascript: document.form1.submit();">
              <label>
              <input type="image" name="grabar" src="jpg/guardar.jpg" />
              </label>
              </a>
              <? }?> <? }?></td>
          <td width="45"><? if($permiso8 == 1){?><? if(!$nuevo and $cuantos){?>
		      <? if(!$siexiste){?>
              <a href="?modulo=operarios.php&amp;borrar=<?=$id_bode?>" onClick='return Confirmar(this.form1)'> <img src="jpg/borrar.jpg" width="45" height="13" border="0" /></a><? }?>
              <? }?><? }?></td>
          <td width="45"><? if(!$nuevo and $cuantos){?>
              <a href="?modulo=operarios_listar.php"><img src="jpg/listar.jpg" width="45" height="13" border="0" /></a>
              <? }?>          </td>
        </tr>
      </table></td>
  </tr>
</table>
</form>