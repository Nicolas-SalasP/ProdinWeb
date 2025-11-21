<?
$sql="SELECT * FROM usuarios AS u, usuarios_nivel AS un where u.id_usuario != 0 and u.id_usuario != 8 and u.id_u_n = un.id_u_n  order by u.unombre asc";
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
.style1 {	color: #FF0000;
	font-weight: bold;
}
-->
</style>
<blockquote>
  <form id="form1" name="form1" method="post" action="">
    <table width="610" height="180" border="0" align="center">
      <tr>
        <td width="604" valign="top"><table width="600" border="1" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td width="53" height="7" bgcolor="#CCCCCC" class="titulo">&nbsp;N&ordm;</td>
            <td width="239" height="7" bgcolor="#CCCCCC" class="titulo">&nbsp;Usuarios </td>
            <td width="244" bgcolor="#CCCCCC" class="titulo">&nbsp;Nivel de Usuario </td>
            <td width="54" bgcolor="#CCCCCC" class="titulo">&nbsp;ID </td>
          </tr>
          <?
	$i=0;
	while ($row=mysql_fetch_array($result))
    { 
	$id_usuario=$row[id_usuario];
	$i++;
	?>
          <tr>
            <td class="cajas">&nbsp;<? if($id_usuario != 8){?><? echo $i;?><? }?></td>
            <td class="cajas">&nbsp;
			<? if($id_usuario != 8){?>
			<a href="?modulo=usuarios.php&id_us=<?echo $row[id_usuario]?>"><?echo strtoupper("$row[unombre]");?>&nbsp;<?echo strtoupper("$row[uapellido]");?></a>
			<? } ?>			</td>
            <td class="cajas">&nbsp;<? echo $row[u_n];?></td>
            <td class="cajas"><? if($id_usuario != 8){?><span class="style1">&nbsp;<? echo $id_usuario?></span><? }?></td>
          </tr>
          <? }?>
        </table></td>
      </tr>
    </table>
  </form>
</blockquote>
