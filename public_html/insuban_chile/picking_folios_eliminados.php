<?
$sql="SELECT p.id_paking_relacion, p.folio_piking , p.observaciones_picking , p.id_paking , p.feliminacionpiking  from paking AS p where  observaciones_picking != ''";
$rest=mysql_query($sql);
$cuantos=mysql_num_rows($rest);
?>
<style type="text/css">
<!--
.cajas {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.titulo {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; }
.numero {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 14px;
	font-weight: bold;
}
.style2 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14; font-weight: bold; }
.alerta {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 15px}
-->
</style>
<script language="JavaScript"> 
function seleccionar_todo(){ 
   for (i=0;i<document.form1.elements.length;i++) 
      if(document.form1.elements[i].type == "checkbox") 
         document.form1.elements[i].checked=1 
} 

function deseleccionar_todo(){ 
   for (i=0;i<document.form1.elements.length;i++) 
      if(document.form1.elements[i].type == "checkbox") 
         document.form1.elements[i].checked=0 
} 
</script>
<table width="493" border="0" align="center">
  <tr>
    <td width="479" height="30" class="titulo">Picking Eliminados </td>
    <td width="122" class="titulo"><a href="?modulo=picking_folios.php">Volver Folios Picking</a></td>
  </tr>
  <tr>
    <td colspan="2">
	<? if($cuantos){?>
	<table width="600" border="1" align="center" bordercolor="#CCCCCC">
      <tr>
        <td width="575"><form action="" method="post" name="form1" id="form1">
            <table width="595" border="1" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td width="10%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">N&ordm; Piking </td>
                <td width="72%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Observaciones</td>
                <td width="18%" bgcolor="#CCCCCC" class="titulo">Fecha Eliminaci&oacute;n </td>
              </tr>
              <? if ($cuantos) {
			        $i=$cuantos + 1;
					$color = "#000000";$i = 0;
					
					
	   				while ($r=mysql_fetch_array($rest)) { 
					
					$color = ($color == "#CCCCCC") ? "#FFFFFF" : "#CCCCCC";
					$i--;
					$feliminacionpiking=format_fecha_sin_hora($r[feliminacionpiking]);
					
	          ?>
              <tr>
                <td bgcolor="<? echo $color?>" class="cajas">&nbsp;<?echo $r[folio_piking]?></td>
                <td bgcolor="<? echo $color?>" class="cajas"><?echo $r[observaciones_picking]?></td>
                <td bgcolor="<? echo $color?>" class="cajas"><div align="center"><? echo $feliminacionpiking;?></div></td>
              </tr>
              <? } //while ($r=mysql_fetch_array($rest)) {  ?>
            </table>
            <? } //if ($cuantos) { ?>
        </form></td>
      </tr>
    </table><? }else{?>
    <table width="600" border="1" align="center" bordercolor="#CCCCCC">
      <tr>
        <td height="145" class="titulo"><div align="center">Paking sin Fajas </div></td>
      </tr>
    </table>
    <? }?></td>
  </tr>
</table>
