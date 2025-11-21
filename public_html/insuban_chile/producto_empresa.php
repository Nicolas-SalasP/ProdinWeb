
<?

if($grabar_x)
{

foreach ($_POST as $key => $value)
{
 $dat=split("-",$key); 
 //echo "key $key , Value $value <br>"; 
  if ($dat[0] == 'id_origen')
	{
    $id=$dat[1];
   	$id_origen=$_POST["id_origen-$id"];
	
	$sql_mod="insert cruce_producto_empresa (id_producto,id_origen,orden) values ($id_p,$id_origen,$id)";
	$result_cruce=mysql_query($sql_mod,$link);
	//echo "SQL AGREGAR $sql_mod";
	}
  
}echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=producto_empresa.php&id_p=$id_p&id_esp=$id_esp\">";
 exit;
}


if($modificar_x){

  $sql_borrar="delete from cruce_producto_empresa  where id_producto = $id_producto";
  $r=mysql_query($sql_borrar,$link);
  $sql_borrar;
foreach ($_POST as $key => $value)
{ 
 $dat=split("-",$key); 
 if($value != 0)
 {
   if ($dat[0] == 'id_origen')
    {$v++;
	$id=$dat[1];
   	$id_origen=$_POST["id_origen-$id"];
	
	$sql_mod="insert cruce_producto_empresa (id_producto,id_origen,orden) values ($id_producto,$id_origen,$v)";
	$result_cruce=mysql_query($sql_mod,$link);
	
	//echo "$ultimo_id<br>";
   }
 }

}echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=producto_empresa.php&id_p=$id_p&id_esp=$id_esp\">";
 exit;
}


if($borrar){
  $sql_borrar="delete from cruce_producto_empresa  where id_producto = $borrar";
  $r=mysql_query($sql_borrar,$link);
  $sql_borrar;
  echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=producto_empresa_listar.php\">";
  exit;
}
if($id_p){
$sql="SELECT * FROM  cruce_producto_empresa  WHERE id_producto = $id_p and id_cruce_producto_empresa != 0 GROUP BY id_producto order by id_cruce_producto_empresa  desc";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);
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
    <td width="595" height="14" bgcolor="#CCCCCC" class="titulo">Asignar Origenes al Producto </td>
    <td width="1" bgcolor="#CCCCCC" class="cajas"><a href="?modulo=producto_empresa_listar.php">Volver</a></td>
  </tr>
  <tr>
    <td colspan="2" valign="top">
	  <? if($cuantos){  ?>
	  
	  <table width="600" height="250" border="1" align="center" bordercolor="#999999">
        <tr>
          <td width="600" height="250">
		  <?  while ($row=mysql_fetch_array($result)){ 
		      $id_origen=$row[id_origen];
			  $id_producto=$row[id_producto];
		 $i++;
	 	 $id_cruce_producto_empresa=$row[id_cruce_producto_empresa];
      	 $sqli="SELECT id_producto FROM cruce_producto_empresa WHERE id_cruce_producto_empresa  = $id_cruce_producto_empresa GROUP BY id_producto";
//echo "SQL $sqli";
    	  $respi=mysql_query($sqli);
		  $counti=mysql_num_rows($respi);
	  	  $rowi=mysql_fetch_array($respi);
	     

		  
		  $sc="SELECT * FROM  cruce_producto_empresa WHERE id_producto = $id_producto order by id_producto desc";
		  $rc=mysql_query($sc);
		  $cuanrc=mysql_num_rows($rc);
	  
		  
		  ?>
		  <table width="433" border="0" align="center">
              <tr>
                <td width="52" class="titulo">&nbsp;</td>
                <td width="371">
				
				
				<?  //$m="m";
					//echo "id_p $id_p";
				  	//$producto= crea_producto_nombre_solo($link,$id_producto);
					//echo $producto;
					
					list ($id_producto, $producto, $id_especie) = crea_producto_nombre_solo($link,$id_producto);
			echo "$id_producto $producto $id_especie<br>";
					
					  //list ($id_origen, $origen) = crea_origen_ok($link,$cal[$i],1);
				  	//echo "$i $origen<br>";
				?>
				<input name="id_producto" type="hidden" value="<?echo $id_producto?>" />
				
				</td>
              </tr>
              <tr>
                <td colspan="2"><table width="319" border="0" align="center">
                    <tr>
                      <td width="171" nowrap="nowrap" class="titulo">Asignar Origenes </td>
                      <td width="30" nowrap="nowrap"><input name="cant2" type="text" id="cant2" value="<? echo $cant?>" size="5" maxlength="5" /></td>
                      <td width="104" nowrap="nowrap"><label>
                        <input name="asigmas" type="submit" id="asigmas" value="Asignar +" />
                      </label></td>
                    </tr>
                    <tr>
                      <td colspan="3" class="titulo">
	<?
	   $sqln="select * from cruce_producto_empresa where id_producto=$id_producto";
	   // echo "SQLN $sqln<br>";
	   $restn=mysql_query($sqln);
	   $countn=mysql_num_rows($restn);
	 
	   while ($rn=mysql_fetch_array($restn))
	   {
	   		
		    $num=$rn[orden];
			$cal[$num]=$rn[id_origen];
			$id_producto=$rn[id_producto];
			$id_c = $rn[id_cruce_producto_empresa];
	   }
	  
	
	?>
	<?      if($id_esp)
	           $id_especie=$id_esp;
	
		     
			for($i=1;$i<= $countn;$i++){
					 	$origen= crea_origen_ok($link,$cal[$i],"$i",$id_especie);
			echo "$i $origen<br>";
			}
			
			
			if($asigmas){
			
			$ca=$cant2;
		    for($iasi=1;$iasi<=$ca;$iasi++){
			$countn++;
			$origen= despliega_origenes($link,0,$countn,$id_especie);
			echo "$countn $origen<br>";
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
	   <?
			 //$sql="SELECT * from cruce_tablas   where id_origen = $id_origen";
		    // $result=mysql_query($sql);
             //$siexiste=mysql_num_rows($result);
			 ?>
	  <? if(!$cuantos){?>
	<table width="600" height="250" border="1" align="center" bordercolor="#999999">
        <tr>
          <td width="600" height="250"><table width="433" border="0" align="center">
            <tr>
              <td width="123" class="titulo">&nbsp;</td>
              <td width="300">
			  	<input name="id_esp" type="hidden" value="<?echo $id_esp?>" />
			<input name="id_p" type="hidden" value="<?echo $id_p?>" />
			  <? 
			list ($id_producto, $producto) = crea_producto_nombre_solo($link,$id_p);
			echo "$producto<br>";
			?>
		<br>
			</td>
            </tr>
            <tr>
              <td colspan="2"><table width="261" border="0" align="center">
                  <tr>
                    <td width="141" class="titulo">Crear Origenes </td>
                    <td width="110"><input name="cant" type="text" id="cant" value="<? echo $cant?>" size="5" maxlength="5" /></td>
                    <td width="110"><label>
                      <input name="crear" type="submit" id="crear" value="crear" />
                    </label></td>
                  </tr>
                  <tr>
                    <td colspan="3" class="titulo"><? 
			//for($i=1;$i<=$cant;$i++){
			//$medidas= despliega_medidas_productos($link,0,$i);
			//echo "$i $medidas<br>";
			//list ($id_origen, $origen) = crea_origen_ok($link,0,$i,$id_esp);
			//echo "$i $origen<br>";
			//}
			if($id_esp)
	           $id_especie=$id_esp;
			   
			for($i=1;$i<=$cant;$i++){
					 	$origen= despliega_origenes($link,0,$i,$id_especie);
			echo "$i $origen<br>";
			}
			
			?></td>
                    </tr>
                  <tr>
                    <td colspan="3" class="titulo">&nbsp;</td>
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
          <td class="style2"><a href="?modulo=producto_empresa.php&amp;op=<? echo $ultimo?>"><img src="jpg/primero.jpg" width="54" height="13" border="0" /></a></td>
          <td class="style2"><? if ($cuantos > $next and !$nuevo){ ?>
              <a href="?modulo=producto_empresa.php&amp;op=<? echo $next?>" ><img src="jpg/anterior.jpg" width="58" height="13" border="0" /></a>
              <? }else{?>
            &nbsp;
            <? }?></td>
          <td><span class="style2">
            <? if($ante >= 0){ ?>
            <a href="?modulo=producto_empresa.php&amp;op=<? echo $ante?>" ><img src="jpg/siguiente.jpg" width="54" height="13" border="0" /></a>
            <? }else{?>
            &nbsp;
            <? }?>
          </span></td>
          <td><? if ($cuantos){ ?>
              <a href="?modulo=producto_empresa.php&amp;cancelar=1"><img src="jpg/ultimo.jpg" width="47" height="13" border="0" /></a>
              <? }?>          </td>
          <td width="47">&nbsp;</td>
          <td width="55"><a href="?modulo=producto_empresa.php&amp;cancelar=1"><img src="jpg/cancelar.jpg" width="55" height="13" border="0" /></a></td>
          <td width="62"><? if($permiso20 == 1){?><? if(!$nuevo and $cuantos){?>
              <a href="javascript: document.form1.submit();">
              <label>
              <input type="image" name="modificar" src="jpg/modificar.jpg" />
              </label>
              </a>
              <? }?><? }?></td>
          <td width="55"><? if($permiso20 == 1){?><? if(!$cuantos or $nuevo or $mantsec ){?>
              <a href="javascript: document.form1.submit();">
              <label>
              <input type="image" name="grabar" src="jpg/guardar.jpg" />
              </label>
              </a>
              <? }?><? }?></td>
          <td width="45">
          <?
          $sqlsi="SELECT * FROM  producto AS pro, especie AS es, cruce_producto_empresa AS cpe WHERE pro.id_producto = cpe.id_producto and cpe.id_producto = $id_producto and pro.id_estado != 2 and pro.id_producto != 0 and pro.id_especie = es.id_especie group by cpe.id_producto order by es.id_especie ASC";
		 $resultsi=mysql_query($sqlsi);
		  $siexiste=mysql_num_rows($resultsi);
		  ?>
		  <? if($permiso20 == 1){?>
		  <? if(!$nuevo and $cuantos){?>
		  <? if(!$siexiste){?>
          <a href="?modulo=producto_empresa.php&amp;borrar=<? echo $id_bode?>" onclick='return Confirmar(this.form1)'> <img src="jpg/borrar.jpg" width="45" height="13" border="0" /></a>
		  <? }?>
		  <? }?>
		  <? }?>
		  </td>
          <td width="45"><? if(!$nuevo and $cuantos){?>
              <a href="?modulo=producto_empresa_listar.php"><img src="jpg/listar.jpg" width="45" height="13" border="0" /></a>
              <? }?>          </td>
        </tr>
      </table></td>
  </tr>
</table>
</form>