<?
$sql="SELECT * FROM articulo_prod_sem where id_articulo_prod_sem != 0";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);
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
<blockquote>
  <form id="form1" name="form1" method="post" action="">
    <table width="486" height="194" border="0" align="center">
      <tr>
        <td width="449" height="30" valign="top"><span class="titulo">Listar Articulos de Produccci&oacute;n </span></td>
        <td width="147" valign="top" class="cajas"><a href="?modulo=articulos_prod_sem.php">Volver Articulos Producci&oacute;n </a></td>
      </tr>
      <tr>
        <td colspan="2" valign="top"><table width="600" border="1" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td width="27" height="14" bgcolor="#CCCCCC" class="titulo">N&ordm;</td>
            <td height="14" bgcolor="#CCCCCC" class="titulo">Nombre</td>
            <td height="14" bgcolor="#CCCCCC" class="titulo">Precio Nac </td>
            <td height="14" bgcolor="#CCCCCC" class="titulo">Precio Dolar </td>
            <td height="14" bgcolor="#CCCCCC" class="titulo">Precio Euro </td>
          </tr>
          <?
	$i=0;
	while ($row=mysql_fetch_array($result))
    { 
	$id_articulo_prod_sem=$row[id_articulo_prod_sem];
	$i++;
	?>
          <tr>
            <td nowrap="nowrap" class="cajas"><? echo $i;?></td>
            <td width="193" nowrap="nowrap" class="cajas"><a href="?modulo=articulos_prod_sem.php&id_art=<?echo $row[id_articulo_prod_sem]?>"><?echo $row[nombre]?></a></td>
            <td width="136" nowrap="nowrap" class="cajas"><a href="?modulo=articulos_prod_sem.php&amp;id_art=<?echo $row[id_articulo_prod_sem]?>"><?echo $row[precio_nac]?></a></td>
            <td width="117" nowrap="nowrap" class="cajas"><a href="?modulo=articulos_prod_sem.php&amp;id_art=<?echo $row[id_articulo_prod_sem]?>"><?echo $row[precio_dolar]?></a></td>
            <td width="117" nowrap="nowrap" class="cajas"><a href="?modulo=articulos_prod_sem.php&amp;id_art=<?echo $row[id_articulo_prod_sem]?>"><?echo $row[precio_euro]?></a></td>
          </tr>
          <? }?>
        </table></td>
      </tr>
    </table>
  </form>
</blockquote>
