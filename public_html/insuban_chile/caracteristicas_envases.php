
<?

if($id_p){
$sql="SELECT * FROM  cruce_plant_caract_envases   WHERE id_producto = $id_p and id_cruce_plant_caract_envases != 0 GROUP BY id_producto order by id_cruce_plant_caract_envases  desc";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);
}else{

$sql="SELECT * FROM  cruce_plant_caract_envases  WHERE id_producto = id_producto and id_cruce_plant_caract_envases != 0 GROUP BY id_producto order by id_cruce_plant_caract_envases desc";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);


if(!$op) $op=0;
$sql="SELECT * FROM  cruce_plant_caract_envases  WHERE id_producto = id_producto and id_cruce_plant_caract_envases != 0 GROUP BY id_producto order by id_cruce_plant_caract_envases desc LIMIT $op , 1";
$result=mysql_query($sql);
$ante=$op - 1;
$next=$op + 1;
$ultimo=$cuantos - 1;
}

if($grabar_x)
{

foreach ($_POST as $key => $value)
{
 $dat=split("-",$key); 
 //echo "key $key , Value $value <br>"; 
  if ($dat[0] == 'id_caract_envases')
	{
    $id=$dat[1];
   	$id_caract_envases=$_POST["id_caract_envases-$id"];
	$sql_mod="insert cruce_plant_caract_envases  (id_producto,id_caract_envases,ordencaractenvases) values ($id_producto,$id_caract_envases,$id)";
	$result_cruce=mysql_query($sql_mod,$link);
	//echo "SQL AGREGAR $sql_mod";
	}
  
}echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=caracteristicas_envases.php\">";
 exit;
}


if($modificar_x){
 $sql_borrar="delete from cruce_plant_caract_envases   where id_producto = $id_producto";
  $r=mysql_query($sql_borrar,$link);
  $sql_borrar;
foreach ($_POST as $key => $value)
{ 
 $dat=split("-",$key); 
//echo "key $key , Value $value vac - $v<br>"; 
 
 if($value != 0){
 
   if ($dat[0] == 'id_caract_envases')
    {$v++;
	$id=$dat[1];
   	$id_caract_envases=$_POST["id_caract_envases-$id"];
	$sql_mod="insert cruce_plant_caract_envases  (id_producto,id_caract_envases,ordencaractenvases) values ($id_producto,$id_caract_envases,$v)";
	$result_cruce=mysql_query($sql_mod,$link);
   }else{
   //echo "$sql_mod <br>";
   
   echo "";
   
   }
   }

}echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=caracteristicas_envases.php\">";
 exit;
}


if($borrar){
  $sql_borrar="delete from cruce_plant_caract_envases   where id_producto = $borrar";
  $r=mysql_query($sql_borrar,$link);
  $sql_borrar;
  echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=caracteristicas_envases.php\">";
  exit;
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
    
<table width="455" height="100%" border="0" align="center">
  <tr>
    <td width="564" height="16" bgcolor="#CCCCCC" class="titulo">Asignar Caracteristicas de Envase </td>
    <td width="32" valign="bottom" bgcolor="#CCCCCC"><a href="?modulo=caracteristicas_envases_listar.php" class="cajas">Volver</a></td>
  </tr>
  <tr>
    <td colspan="2" valign="top">
	  <? if(!$nuevo){  ?>
	  
	  <table width="600" height="250" border="1" align="center" bordercolor="#999999">
        <tr>
          <td width="600" height="250">
		  <?  while ($row=mysql_fetch_array($result))    { 
		  
	$i++;
	  $id_cruce_plant_caract_envases =$row[id_cruce_plant_caract_envases];
      $sqli="SELECT id_producto FROM cruce_plant_caract_envases  WHERE id_cruce_plant_caract_envases  = $id_cruce_plant_caract_envases GROUP BY id_producto";
//echo "SQL $sqli";
      $respi=mysql_query($sqli);
	  $counti=mysql_num_rows($respi);
	  $rowi=mysql_fetch_array($respi);
	  $rowi[id_producto];

		  
$sc="SELECT * FROM  cruce_plant_caract_envases  WHERE id_producto =  $rowi[id_producto] order by id_producto desc";
$rc=mysql_query($sc);
$cuanrc=mysql_num_rows($rc);
	  
		  
		  ?>
		  <table width="433" border="0" align="center">
              <tr>
                <td width="123" class="titulo">Producto</td>
                <td width="300"><? $envas="envas";
			$producto= crea_producto_onChange_solo($link,$rowi[id_producto],$envas,1);
			echo $producto;
			?></td>
              </tr>
              <tr>
                <td colspan="2"><table width="319" border="0" align="center">
                    <tr>
                      <td width="171" nowrap="nowrap" class="titulo">Asignar Caracteristicas Envase </td>
                      <td width="30" nowrap="nowrap"><input name="cant2" type="text" id="cant2" value="<? echo $cant?>" size="5" maxlength="5" /></td>
                      <td width="104" nowrap="nowrap"><label>
                        <input name="asigmas" type="submit" id="asigmas" value="Asignar +" />
                      </label></td>
                    </tr>
                    <tr>
                      <td colspan="3" class="titulo">
					   <?
	   $sqln="select * from cruce_plant_caract_envases  where id_producto=$rowi[id_producto];";
	   // echo "SQLN $sqln<br>";
	   $restn=mysql_query($sqln);
	   $countn=mysql_num_rows($restn);
	 
	   while ($rn=mysql_fetch_array($restn))
	   {
		    $num=$rn[ordencaractenvases];
			$cal[$num]=$rn[id_caract_envases];
			$id_producto=$rn[id_producto];
	   }
	
	  ?>
					  <? 
			for($i=1;$i<= $countn;$i++){
					 	$caractenv= crea_caracteristicas_envase_ok($link,$cal[$i],"$i");
			echo "$i $caractenv<br>";
			}
			
			if($asigmas){
			
			$ca=$cant2;
		    for($iasi=1;$iasi<=$ca;$iasi++){$countn++;
					 	$caractenv= despliega_caracteristicas_envase($link,0,$countn);
			echo "$countn $caractenv<br>";
			}
			}
			
			?></td>
                    </tr>
                    <tr>
                      <td colspan="3" class="titulo">&nbsp;</td>	
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td colspan="2"><? $id_bode=$row[id_producto];?></td>
              </tr>
          </table>
		  <? }?>		  </td>
        </tr>
      </table>
	  <? } //!$nuevo?>
	  <? if($nuevo){?>
	<table width="600" height="250" border="1" align="center" bordercolor="#999999">
        <tr>
          <td width="600" height="250"><table width="433" border="0" align="center">
            <tr>
              <td width="123" class="titulo">Producto</td>
              <td width="300"><? $m="m";
			$producto= crea_producto($link,$id_producto,$m);
			
			//$producto= crea_producto_onChange_solo($link,$id_producto,$m);
			echo $producto;
			?></td>
            </tr>
            <tr>
              <td colspan="2"><table width="316" border="0" align="center">
                  <tr>
                    <td width="168" class="titulo">Crear Caracteristicas Envase </td>
                    <td width="33"><input name="cant" type="text" id="cant" value="<? echo $cant?>" size="5" maxlength="5" /></td>
                    <td width="101"><label>
                      <input name="crear" type="submit" id="crear" value="crear" />
                    </label></td>
                  </tr>
                  <tr>
                    <td colspan="3" class="titulo">&nbsp;</td>
                    </tr>
                  <tr>
                    <td colspan="3" class="titulo">
					
			<? 
			for($i=1;$i<=$cant;$i++){
					 	$caractenvase= despliega_caracteristicas_envase($link,0,$i);
			echo "$i $caractenvase<br>";
			}
			?></td>
                    </tr>
                  
              </table></td>
            </tr>
            <tr>
              <td colspan="2">&nbsp;</td>
            </tr>
          </table></td>
        </tr>
      </table><? }?>
      <table width="335" border="0" align="center">
        <tr>
          <td class="style2"><a href="?modulo=caracteristicas_envases.php&amp;op=<? echo $ultimo?>"><img src="jpg/primero.jpg" width="54" height="13" border="0" /></a></td>
          <td class="style2"><? if ($cuantos > $next and !$nuevo){ ?>
              <a href="?modulo=caracteristicas_envases.php&amp;op=<? echo $next?>" ><img src="jpg/anterior.jpg" width="58" height="13" border="0" /></a>
              <? }else{?>
            &nbsp;
            <? }?></td>
          <td><span class="style2">
            <? if($ante >= 0){ ?>
            <a href="?modulo=caracteristicas_envases.php&amp;op=<? echo $ante?>" ><img src="jpg/siguiente.jpg" width="54" height="13" border="0" /></a>
            <? }else{?>
            &nbsp;
            <? }?>
          </span></td>
          <td><? if ($cuantos){ ?>
              <a href="?modulo=caracteristicas_envases.php&amp;cancelar=1"><img src="jpg/ultimo.jpg" width="47" height="13" border="0" /></a>
              <? }?>          </td>
          <td width="47"><? if($permiso23 == 1){?><a href="?modulo=caracteristicas_envases.php&amp;nuevo=1" ><img src="jpg/nuevo.jpg" width="47" height="13" border="0" /></a><? }?> </td>
          <td width="55"><a href="?modulo=caracteristicas_envases.php&amp;cancelar=1"><img src="jpg/cancelar.jpg" width="55" height="13" border="0" /></a></td>
          <td width="62"><? if($permiso23 == 1){?><? if(!$nuevo and $cuantos){?>
              <a href="javascript: document.form1.submit();">
              <label>
              <input type="image" name="modificar" src="jpg/modificar.jpg" />
              </label>
              </a>
              <? }?><? }?></td>
          <td width="55"><? if($permiso23 == 1){?><? if(!$cuantos or $nuevo or $mantsec ){?>
              <a href="javascript: document.form1.submit();">
              <label>
              <input type="image" name="grabar" src="jpg/guardar.jpg" />
              </label>
              </a>
              <? }?><? }?></td>
          <td width="45"><? if($permiso23 == 1){?><? if(!$nuevo and $cuantos){?>
            <? }?>            <? }?></td>
          <td width="45"><? if(!$nuevo and $cuantos){?>
              <a href="?modulo=caracteristicas_envases_listar.php"><img src="jpg/listar.jpg" width="45" height="13" border="0" /></a>
              <? }?>          </td>
        </tr>
      </table></td>
  </tr>
</table>
</form>