<?

$sql="SELECT * FROM origenes AS org, estado AS es, procedencia AS proc where org.id_origen != 0 and org.id_estado = es.id_estado and org.id_procedencia = proc.id_procedencia order by origen asc";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);


?>
<table width="98%" border="0">
  <tr>
    
    <td width="31" height="19" bgcolor="#FF9933"><? //echo $id_ldp?></td>
    <td colspan="8" bgcolor="#CCCCCC"><strong>&nbsp;Total Origenes: <?echo $cuantos?></strong></td>
  </tr>
  <tr>
    <td width="31" height="19" nowrap="nowrap" bgcolor="#FF9933"><center>
      <strong>&nbsp;N&ordm;</strong>
    </center></td>
    <td width="220" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;ORIGEN</strong></td>
    <td width="274" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;DOMICILIO</strong></td>
    <td width="287" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;CUIDAD</strong></td>
    <td width="312" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;PROCEDENCIA</strong></td>
    <td width="159" colspan="4" nowrap="nowrap" bgcolor="#FF9933"><strong>&nbsp;ESTADO</strong></td>
  </tr>
  <?
	if($cuantos){
    $i=$op;
    $color = "#000000";$i = 0;
    while ($row=mysql_fetch_array($result))
    {
	$i++;
	$color = ($color == "#CCCCCC") ? "#FFFFFF" : "#CCCCCC";
	$id_origen=$row[id_origen];
	$origen=$row[origen];
	$domicilio=$row[domicilio];
	$ciudad=$row[ciudad];
	$estado=$row[estado];
	$procedencia=$row[procedencia];

  ?>
  <tr>
    <td height="19" nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $i?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<a href="?modulo=ingrorigen.php&id_origen=<? echo $id_origen?>"><? echo $origen?></a></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $domicilio?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $ciudad ?></td>
    <td nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $procedencia?></td>
    <td colspan="4" nowrap="nowrap" bgcolor="<? echo $color?>">&nbsp;<? echo $estado?></td>
    <? }
	}
	?>
  </tr>
</table>