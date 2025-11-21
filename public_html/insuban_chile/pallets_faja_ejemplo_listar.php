<style type="text/css">
<!--
.cajas {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.titulo {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; }
.estilo_cajon_buscar_contacto {	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
}
-->
</style>
<form id="form1" name="form1" method="post" action="">
<table width="600" height="167" border="0" align="center">
  <tr>
    <td width="496" height="30" valign="top"><span class="titulo">Pallets con Fajas Listar </span></td>
    <td width="94" valign="top" class="cajas"><a href="?modulo=pallets_faja_ejemplo.php">Volver Pallet Faja </a></td>
  </tr>
  <tr>
    <td height="-1" colspan="2" valign="top">&nbsp;</td>
    </tr>
  <tr>
    <td height="21" colspan="2" valign="top"><div align="center">
      <? 
		 	$bodegas= crea_bodegas($link,$id_bodegas,1);
			echo $bodegas;
			?>
    </div></td>
  </tr>
  <tr>
    <td height="1" colspan="2" valign="top">
	  <div align="center">
	    <input name="dato" type="text" size="15" maxlength="50"/>
	    <input name="buscar" type="submit" value="Buscar" />
      </div></td>
  </tr>
    <tr>
    <td height="38" colspan="2" valign="top">
	
	
	<table width="308" border="1" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="64" height="14" bgcolor="#CCCCCC" class="titulo"><div align="left">Pallet Nro </div></td>
        <td width="156" height="14" bgcolor="#CCCCCC" class="titulo">Bodega</td>
        <td width="80" bgcolor="#CCCCCC" class="titulo">Fecha Pallet </td>
        </tr>
<?

if($id_bodegas){
$sql="SELECT f.id_fajapallet AS id_fajpa, b.bodegas,f.fpallet,f.ano_fajapallet FROM fajapallet AS f, bodegas AS b, fajas AS fs where f.id_fajapallet=f.id_fajapallet and f.id_bodegas=b.id_bodegas and b.id_bodegas=$id_bodegas and f.id_fajapallet = fs.id_fajapallet and f.id_estado_pallet != 2 group by fs.id_fajapallet";
$result=mysql_query($sql);
}

if(!$id_bodegas){  
$sql="SELECT f.id_fajapallet AS id_fajpa, b.bodegas,f.fpallet,f.ano_fajapallet FROM fajapallet AS f, bodegas AS b, fajas AS fs where f.id_fajapallet=f.id_fajapallet and f.id_bodegas=b.id_bodegas and f.id_fajapallet = fs.id_fajapallet and f.id_estado_pallet != 2 and f.ano_fajapallet = 2009 group by fs.id_fajapallet";
$result=mysql_query($sql);
}

     $largo=strlen($dato);
	 $newano=substr($dato, 0, 2);
	 $newano="20".$newano;
	 $newdato=substr($dato, 2, $largo);


if($dato){
$sql="SELECT f.id_fajapallet AS id_fajpa, b.bodegas,f.fpallet,f.ano_fajapallet FROM fajapallet AS f, bodegas AS b where  f.id_fajapallet = f.id_fajapallet  and f.id_bodegas = b.id_bodegas and f.id_estado_pallet != 2 and f.id_fajapallet = '$newdato'";
$result=mysql_query($sql);
}
	$i=0;
	while ($row=mysql_fetch_array($result))
    { 
	$fpallet=format_fecha_sin_hora($row[fpallet]);
	$id_fajpa =$row[id_fajpa];
	$i++;
	//echo $id_fajapallet;
	?>
      <tr>
        <td class="cajas"><div align="left"><a href="?modulo=pallets_faja_ejemplo.php&amp;id_f2=<?echo $row[id_fajapallet]?>"><?php echo substr($row[ano_fajapallet],2,4); ?></a><a href="?modulo=pallets_faja_ejemplo.php&id_f2=<?echo $row[id_fajpa]?>"><? echo "$id_fajpa";?></a></div></td>
        <td class="cajas"><a href="?modulo=pallets_faja_ejemplo.php&id_f2=<?echo $row[id_fajpa]?>"><? echo $row[bodegas];?></a></td>
        <td class="cajas"><a href="?modulo=pallets_faja_ejemplo.php&id_f2=<?echo $row[id_fajpa]?>"><?echo $fpallet?></a></td>
        </tr>
      <? }?>
    </table>	</td>
  </tr>
</table>
</form>