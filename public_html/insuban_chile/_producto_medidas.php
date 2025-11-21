
<?
if($id_p){
$sql="SELECT * FROM  cruce_plant_unidad_medida  WHERE id_producto = $id_p GROUP BY id_producto order by id_cruce_plant_unidad_medida  desc";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);
}else{

$sql="SELECT * FROM  cruce_plant_unidad_medida  WHERE id_producto = id_producto GROUP BY id_producto order by id_cruce_plant_unidad_medida  desc";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);


if(!$op) $op=0;
$sql="SELECT * FROM  cruce_plant_unidad_medida  WHERE id_producto = id_producto GROUP BY id_producto order by id_cruce_plant_unidad_medida  desc LIMIT $op , 1";
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
  if ($dat[0] == 'id_unidad_medida')
	{
    $id=$dat[1];
   	$id_unidad_medida=$_POST["id_unidad_medida-$id"];
	$sql_mod="insert cruce_plant_unidad_medida  (id_producto,id_unidad_medida,ordenunidad_medida) values ($id_producto,$id_unidad_medida,$id)";
	$result_cruce=mysql_query($sql_mod,$link);
	}
  
}echo"<meta http-equiv=\"refresh\" content=\"0;URL=index.php?modulo=producto_unidad_medida.php\">";
  exit;
}


if($modificar_x){
 $sql_borrar="delete from cruce_plant_unidad_medida  where id_producto = $id_producto";
  $r=mysql_query($sql_borrar,$link);
  $sql_borrar;
foreach ($_POST as $key => $value)
{ 
 $dat=split("-",$key); 
//echo "key $key , Value $value vac - $v<br>"; 
 
 if($value != 0){
 
   if ($dat[0] == 'id_unidad_medida')
    {$v++;
	$id=$dat[1];
   	$id_unidad_medida=$_POST["id_unidad_medida-$id"];
	$sql_mod="insert cruce_plant_unidad_medida (id_producto,id_unidad_medida,ordenunidad_medida) values ($id_producto,$id_unidad_medida,$v)";
	$result_cruce=mysql_query($sql_mod,$link);
   }else{
   //echo "$sql_mod <br>";
   
   echo "";
   
   }
   }

}echo"<meta http-equiv=\"refresh\" content=\"0;URL=index.php?modulo=producto_unidad_medida.php\">";
 exit;
}


if($borrar){
  $sql_borrar="delete from cruce_plant_unidad_medida  where id_producto = $borrar";
  $r=mysql_query($sql_borrar,$link);
  $sql_borrar;
  echo"<meta http-equiv=\"refresh\" content=\"0;URL=index.php?modulo=producto_unidad_medida.php\">";
  exit;
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
    
<table width="455" height="100%" border="0" align="center">
  <tr>
    <td width="449" height="30" class="titulo">Asignar Unidad de Medida a Producto </td>
  </tr>
  <tr>
    <td class="titulo">&nbsp;</td>
  </tr>
  <tr>
    <td valign="top">
	  <? if(!$nuevo){  ?>
	  
	  <table width="600" height="250" border="1" align="center" bordercolor="#999999">
        <tr>
          <td width="600" height="250">
		  <?  while ($row=mysql_fetch_array($result))    { 
		  
	  $i++;
	  $id_cruce_plant_unidad_medida=$row[id_cruce_plant_unidad_medida];
      $sqli="SELECT id_producto FROM cruce_plant_unidad_medida WHERE id_cruce_plant_unidad_medida = $id_cruce_plant_unidad_medida GROUP BY id_producto";
//echo "SQL $sqli";
      $respi=mysql_query($sqli);
	  $counti=mysql_num_rows($respi);
	  $rowi=mysql_fetch_array($respi);
	  $rowi[id_producto];

		  
$sc="SELECT * FROM  cruce_plant_unidad_medida WHERE id_producto =  $rowi[id_producto] order by id_producto desc";
$rc=mysql_query($sc);
$cuanrc=mysql_num_rows($rc);
	  
		  
		  ?>
		  <table width="433" border="0" align="center">
              <tr>
                <td width="123" class="titulo">Producto</td>
                <td width="300"><? 
			$producto= crea_producto_onChange_solo($link,$rowi[id_producto]);
			echo $producto;
			?></td>
              </tr>
              <tr>
                <td colspan="2"><table width="319" border="0" align="center">
                    <tr>
                      <td width="171" nowrap="nowrap" class="titulo">Asignar cantidad Calibre </td>
                      <td width="30" nowrap="nowrap"><input name="cant2" type="text" id="cant2" value="<? echo $cant?>" size="5" maxlength="5" /></td>
                      <td width="104" nowrap="nowrap"><label>
                        <input name="asigmas" type="submit" id="asigmas" value="Asignar +" />
                      </label></td>
                    </tr>
                    <tr>
                      <td colspan="3" class="titulo">
					   <?
	  $sqln="select * from cruce_plant_unidad_medida where id_producto=$rowi[id_producto];";
	 // echo "SQLN $sqln<br>";
	  $restn=mysql_query($sqln);
	   $countn=mysql_num_rows($restn);
	 
	  while ($rn=mysql_fetch_array($restn))
	       {
		    $num=$rn[ordenunidad_medida ];
			$cal[$num]=$rn[id_unidad_medida];
			$id_producto=$rn[id_producto];
		
		   }
	       
	  ?>
					  <? 
			for($i=1;$i<= $countn;$i++){
					 	$unidad_medida= crea_unidad_medida_ok($link,$cal[$i],"$i");
			echo "$i $unidad_medida<br>";
			}
			
			if($asigmas){
			
			$ca=$cant2;
		    for($iasi=1;$iasi<=$ca;$iasi++){$countn++;
					 	$unidad_medida= despliega_unidad_medida($link,0,$countn);
			echo "$countn $unidad_medida<br>";
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
		  <? }?>
		  </td>
        </tr>
      </table>
	  <? } //!$nuevo?>
	  <? if($nuevo){?>
	<table width="600" height="250" border="1" align="center" bordercolor="#999999">
        <tr>
          <td width="600" height="250"><table width="433" border="0" align="center">
            <tr>
              <td width="123" class="titulo">Producto</td>
              <td width="300"><? 
			$grupo_producto2= crea_producto($link,$id_producto);
			echo $grupo_producto2;
			?></td>
            </tr>
            <tr>
              <td colspan="2"><table width="261" border="0" align="center">
                  <tr>
                    <td width="141" class="titulo">Crear cantidad Calibre </td>
                    <td width="110"><input name="cant" type="text" id="cant" value="<? echo $cant?>" size="5" maxlength="5" /></td>
                    <td width="110"><label>
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
					 	$unidad_medida= despliega_unidad_medida($link,0,$i);
			echo "$i $unidad_medida<br>";
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
          <td class="style2"><a href="?modulo=producto_unidad_medida.php&amp;op=<? echo $ultimo?>"><img src="jpg/primero.jpg" width="54" height="13" border="0" /></a></td>
          <td class="style2"><? if ($cuantos > $next and !$nuevo){ ?>
              <a href="?modulo=producto_unidad_medida.php&amp;op=<? echo $next?>" ><img src="jpg/anterior.jpg" width="58" height="13" border="0" /></a>
              <? }else{?>
            &nbsp;
            <? }?></td>
          <td><span class="style2">
            <? if($ante >= 0){ ?>
            <a href="?modulo=producto_unidad_medida.php&amp;op=<? echo $ante?>" ><img src="jpg/siguiente.jpg" width="54" height="13" border="0" /></a>
            <? }else{?>
            &nbsp;
            <? }?>
          </span></td>
          <td><? if ($cuantos){ ?>
              <a href="?modulo=producto_unidad_medida.php&amp;cancelar=1"><img src="jpg/ultimo.jpg" width="47" height="13" border="0" /></a>
              <? }?>
          </td>
          <td width="47"><a href="?modulo=producto_unidad_medida.php&amp;nuevo=1" ><img src="jpg/nuevo.jpg" width="47" height="13" border="0" /></a> </td>
          <td width="55"><a href="?modulo=producto_unidad_medida.php&amp;cancelar=1"><img src="jpg/cancelar.jpg" width="55" height="13" border="0" /></a></td>
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
              <a href="?modulo=producto_unidad_medida.php&amp;borrar=<? echo $id_bode?>" > <img src="jpg/borrar.jpg" width="45" height="13" border="0" /> </a>
              <? }?>
          </td>
          <td width="45"><? if(!$nuevo and $cuantos){?>
              <a href="?modulo=producto_unidad_medida_listar.php"><img src="jpg/listar.jpg" width="45" height="13" border="0" /></a>
              <? }?>
          </td>
        </tr>
      </table></td>
  </tr>
</table>
</form>