<script language="JavaScript" type="text/javascript" src="lib/cal.js">
</script>
<style type="text/css">
<!--
.Estilo3 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px; }
.Estilo6 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px; font-weight: bold; }
.Estilo7 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
	font-weight: bold;
}
-->
</style>

<<br />
<?
require "lib/funciones.php";
$responsable=get_operarios($link,$id_responsable,"id_responsable");
$operador=get_operarios($link,$id_operador,"id_operador");
$plantillas_formatos=get_plantillas_formatos($link,$id_plantillas_formatos);
if ($id_plantillas_formatos)
  {
   $sql="SELECT *  FROM cruce_plant_calibre AS c, producto AS p
         WHERE c.id_producto = p.id_producto 
		 AND c.id_plantillas_formatos = $id_plantillas_formatos
         GROUP BY p.id_producto";
   $rest=mysql_query($sql);
   $row=mysql_fetch_array($rest);
   $id_producto=$row[id_producto];
   $producto=$row[nombre];
   
   if ($id_producto)
     {
	  $sql="SELECT * FROM cruce_plant_calibre AS t1, calibre AS t2
			WHERE t1.id_calibre = t2.id_calibre
			AND t1.id_plantillas_formatos =$id_plantillas_formatos
			AND t1.id_producto = $id_producto
			ORDER BY orden";
	  $restcal=mysql_query($sql);
    }
  }

?>
<form id="metrajes" name="Form1" method="post" action="">

<table width="680" border="1" align="center">
  <tr>
    <td colspan="2"><table width="672" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="83" nowrap="nowrap">Metraje N&ordm; </td>
        <td width="87" nowrap="nowrap"><input name="metraje_n" type="text" id="metraje_n" size="8" /></td>
        <td width="50" nowrap="nowrap">Fecha</td>
        <td width="114" nowrap="nowrap"><span class="style3">
          <input name="fechametraje" type="text"  id="fechametraje"  value="<?echo $fechametraje?>" size="8" maxlength="10" />
          <span class="style1"><a href="javascript:show_Calendario('metrajes.fechametraje');">Ver</a></span></span></td>
        <td width="53" nowrap="nowrap">Turno</td>
		
        <td width="157" nowrap="nowrap">
		  <input name="turno" type="radio" value="1">
          Dia
          <input name="turno" type="radio" value="2">
          Noche
		</td>
		
        <td width="75" nowrap="nowrap">Maquina</td>
        <td width="53" nowrap="nowrap">
		<input name="maquina" type="text" id="maquina" size="5" />
		</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="391" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="74">Producto</td>
        <td width="317"><input name="id_producto" type="hidden" id="id_producto" /> <?echo $producto?></td>
      </tr>
    </table></td>
    <td width="268" rowspan="2"><table width="268" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="164">Origen Material </td>
        <td width="88">Cant. Entrega </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input name="cant1" type="text" id="cant1" size="10" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input name="cant2" type="text" id="cant2" size="10" /></td>
      </tr>
      <tr>
        <td height="23">&nbsp;</td>
        <td><input name="cant3" type="text" id="cant3" size="10" /></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td width="396" height="83"><table width="393" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="136">Formato Carga: </td>
        <td width="257"><?echo $plantillas_formatos?></td>
      </tr>
      <tr>
        <td>Responsable Planilla </td>
        <td><?echo $responsable?></td>
      </tr>
      <tr>
        <td>Operario</td>
        <td><?echo $operador?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="60" colspan="2" valign="top"><table width="670" border="0" cellpadding="0">
      <tr>
        <td width="133" height="23" nowrap="nowrap">Calibre</td>
        <td width="60" nowrap="nowrap"><div align="right"><span class="Estilo3">Metraje 1</span></div></td>
        <td width="60" nowrap="nowrap"><div align="right"><span class="Estilo3">Metraje 2</span></div></td>
        <td width="60" nowrap="nowrap"><div align="right"><span class="Estilo3">Metraje 3</span></div></td>
        <td width="60" nowrap="nowrap"><div align="right"><span class="Estilo3">Metraje 4</span></div></td>
        <td width="60" nowrap="nowrap"><div align="right"><span class="Estilo3">Metraje 5</span></div></td>
        <td width="60" nowrap="nowrap"><div align="right"><span class="Estilo3">Metraje 6</span></div></td>
        <td width="50" nowrap="nowrap"><div align="right"><span class="Estilo6">TOTAL</span></div></td>
        </tr>
	  <? while ($rc=mysql_fetch_array($restcal))
	          { ?>
      <tr>
        <td><span class="Estilo7"><?echo "($rc[id_calibre]) ($rc[calibre]) ($rc[color])";?></span></td>
        <td><div align="right">
          <input name="m1" type="text" id="m1" size="5" />
        </div></td>
        <td><div align="right">
          <input name="m2" type="text" id="m2" size="5" />
        </div></td>
        <td><div align="right">
          <input name="m3" type="text" id="m3" size="5" />
        </div></td>
        <td><div align="right">
          <input name="m4" type="text" id="m4" size="5" />
        </div></td>
        <td><div align="right">
          <input name="m5" type="text" id="m5" size="5" />
        </div></td>
        <td><div align="right">
          <input name="m6" type="text" id="m6" size="5" />
        </div></td>
        <td><div align="right">
          <input name="m62" type="text" id="m62" size="5" />
        </div></td>
        </tr>
	   <?  } ?>
    </table></td>
  </tr>
  <tr>
    <td height="19" colspan="2"><table width="670" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="110" nowrap="nowrap">Observaciones:</td>
        <td width="430" nowrap="nowrap"><input name="observaciones" type="text" id="observaciones" size="60" /></td>
        <td width="48" nowrap="nowrap">Total</td>
        <td width="82" nowrap="nowrap"><input name="total" type="text" id="total" size="10" /></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="19" colspan="2"><table width="671" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="73">Mantener:</td>
        <td width="90"><input name="fecha" type="checkbox" id="fecha" value="checkbox" />
          Fecha</td>
        <td width="92"><input name="turno" type="checkbox" id="turno" value="checkbox" />
          Turno</td>
        <td width="108"><input name="Maquina" type="checkbox" id="Maquina" value="checkbox" />
          Maquina</td>
        <td width="103"><input name="producto" type="checkbox" id="producto" value="checkbox" />
          Producto</td>
        <td width="115"><input name="responsable" type="checkbox" id="responsable" value="checkbox" />
          Responsable</td>
        <td width="90"><input name="formato" type="checkbox" id="formato" value="checkbox" />
          Formato</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="20" colspan="2">&nbsp;</td>
  </tr>
  
</table>
</form>
