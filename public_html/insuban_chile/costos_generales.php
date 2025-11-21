
<?

if($modificar){
 $sql_modificar="UPDATE  cruce_tablas set costounidad=$costounidad  where id_cruce_tablas=$id_cruce_tablas";
 $rest=mysql_query($sql_modificar);
 //echo "$sql_modificar<br>";
}



if($id_cruce_tablas){
$sql="SELECT * FROM  cruce_tablas  WHERE id_cruce_tablas = $id_cruce_tablas";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);
}

$sql_modificar2="UPDATE  etiquetados_folios 
 set costounidad=$costounidad  where id_cruce_tablas=$id_cruce_tablas";
 $result22=mysql_query($sql_modificar2);
//$cuantos22=mysql_num_rows($result22);

//echo "$sql_modificar2";




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
.titulo {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
	font-weight: bold;
	text-align: center;
}
.style2 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14; font-weight: bold; }
-->
</style>
<form id="form1" name="form1" method="post" action="">
    
<table width="603" height="100%" border="0" align="center">
  <tr>
    <td width="564" height="16" bgcolor="#CCCCCC" class="titulo">Ingresar Costos Generales</td>
    <td width="32" bgcolor="#CCCCCC" class="cajas"><a href="?modulo=costo_producto_terminado2.php">Volver</a></td>
  </tr>
  <tr>
    <td height="258" colspan="2" valign="top">
	  <table width="600" height="250" border="1" align="center" bordercolor="#999999">
        <tr>
          <td width="600" height="250">
          <table width="433" border="0" align="center">
          <? if ($row=mysql_fetch_array($result)){ ?>
<!--            <tr>
                <td width="122" class="titulo">Materia Prima
            
                </td>
                <td width="10" class="titulo">:</td>
                <td width="287" class="titulo"><input type="text" name="mat_prima" id="mat_prima" value="<?echo $row[mat_prima]?>"></td>
              </tr>
            <tr>
              <td class="titulo">Mano Obra</td>
              <td class="titulo">:</td>
              <td class="titulo"><input type="text" name="mano_obra" id="mano_obra" value="<?echo $row[mano_obra]?>"></td>
            </tr>
            <tr>
              <td class="titulo">Insumos</td>
              <td class="titulo">:</td>
              <td class="titulo"><input type="text" name="insumos" id="insumos" value="<?echo $row[insumos]?>"></td>
            </tr> -->
              <tr>
                <td class="titulo">Costo Unitario</td>
                <td  class="titulo">:</td>
                <td class="titulo">
                  <input type="text" name="costounidad" id="costounidad" value="<?echo $row[costounidad]?>">
                </td>
              </tr>
              <tr>
                <td class="titulo">&nbsp;</td>
                <td  class="titulo">&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td colspan="3" class="titulo">
                  <input type="submit" name="modificar" id="modificar" value="modificar">
                </td>
                </tr>
              <? }?>
          </table>
		    </td>

        </tr>
      </table>
	  </td>
  </tr>
</table>
</form>