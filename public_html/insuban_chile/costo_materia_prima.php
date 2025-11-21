
<?

if($modificar){

foreach ($_POST as $key => $value)
{ 
 $dat=split("-",$key); 
 if($value != ''){
   if ($dat[0] == 'valor_cmp')
    {
	$id=$dat[1];
   	$valor_cmp=$_POST["valor_cmp-$id"];

	$sq_up="update cruce_producto_empresa set valor_cmp = $valor_cmp where id_cruce_producto_empresa = $id";
	$rest_up=mysql_query($sq_up);
	
	//echo "sq_up $sq_up<br>";
  }
   }

}echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=costo_materia_prima.php&id_p=$id_p&id_esp=$id_esp\">";
 exit;
}



if($id_p){
$sql="SELECT * FROM  cruce_producto_empresa  WHERE id_producto = $id_p";
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
    
<table width="603" height="100%" border="0" align="center">
  <tr>
    <td width="564" height="16" bgcolor="#CCCCCC" class="titulo">Ingresar Costos </td>
    <td width="32" bgcolor="#CCCCCC" class="cajas"><a href="?modulo=costo_materia_prima_listar.php">Volver</a></td>
  </tr>
  <tr>
    <td height="258" colspan="2" valign="top">
	  <table width="600" height="250" border="1" align="center" bordercolor="#999999">
        <tr>
          <td width="600" height="250">
		    	<input name="id_esp" type="hidden" value="<?echo $id_esp?>" />
			<input name="id_p" type="hidden" value="<?echo $id_p?>" />
			<table width="433" border="0" align="center">
			  <tr>
			    <td width="425" class="titulo"><?
                	
				$sqls="SELECT * FROM  producto WHERE id_producto  = $id_p";
			    $results=mysql_query($sqls);
                if ($rows=mysql_fetch_array($results))
    			{ 
				echo "$rows[producto] - [$id_p]";
				}
				?></td>
			    </tr>
			  </table>
		  
		  <table width="433" border="0" align="center">
		    <?  while ($row=mysql_fetch_array($result)){ 
		      $id_origen=$row[id_origen];
			  $id_producto=$row[id_producto];
			  $id_cruce_producto_empresa=$row[id_cruce_producto_empresa];
			
			  $sqlorig="SELECT * FROM  cruce_producto_empresa  AS cpe, origenes AS ori WHERE cpe.id_origen  = $id_origen and ori.id_origen = cpe.id_origen";
			  $resultorig=mysql_query($sqlorig);
			  $cuantosorig=mysql_num_rows($resultorig);
		  ?>
		    <tr>
                <td colspan="2" class="titulo">&nbsp;
            
                </td>
              </tr>
              <tr>
                <td width="189"><span class="cajas">
                 <? if ($rowori=mysql_fetch_array($resultorig)) { ?>
                 <? echo "$rowori[origen] (id: $rowori[id_origen])"; ?>
                 <? } ?>
                </span></td>
                <td width="234"><span class="titulo">
				<?
				//$valor_cmp_formateado=$row[valor_cmp];
		      // $valor_cmp_formateado=number_format($valor_cmp_formateado,0,",",".");
			  // $valor_cmp = (int) $row[valor_cmp];
				
				?>$
                  <input name="valor_cmp-<? echo $id_cruce_producto_empresa?>" type="text" id="valor_cmp" value="<? echo $row[valor_cmp]?>" size="10" maxlength="10" />
                </span></td>
              </tr><? }?>
              <tr>
                <td colspan="2">&nbsp;</td>
              </tr>
          </table>
		    <div align="center">
		       <? if(!$cuantos){?>
		       <input type="submit" name="modificar" id="modificar" value="Ingresar Costos">
      		   <? }else{?>
		       <input type="submit" name="modificar" id="modificar" value="Modificar Costos">
		       <? }?>
             </div></td>
        </tr>
      </table>
	  </td>
  </tr>
</table>
</form>