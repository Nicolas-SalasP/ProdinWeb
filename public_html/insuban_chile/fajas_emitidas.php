<?
if ($Modificar)
  {
 // echo "hay que modificar";
  foreach($_POST as $key => $value){
         $dat=split("-",$key);
		 if ($dat[0] == "est")
		    {
			 $sq="update fajas set estado ='$value' where id_faja=$dat[1]";
			 $rest=mysql_query($sq);
			 
			 //echo $sq;
			}
         }
		
  }
$sql="select * from fajas as f, producto as p 
      where f.id_producto = p.id_producto
";
$r=mysql_query($sql);
?><style type="text/css">
<!--
.cajas {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.titulo {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; }
-->
</style>
<blockquote>

  <form action="?modulo=fajas_emitidas.php" method="post">
    <table width="600" border="1" align="center" bordercolor="#999999">
      <tr>
        <td width="600"><table width="585" border="0" align="center">
          <tr>
            <td width="48" class="titulo"><div align="center">Faja</div></td>
            <td width="53" class="titulo"><div align="center">Lote</div></td>
            <td width="138" class="titulo">Producto</td>
            <td width="86" class="titulo">E.Emisi&oacute;n</td>
            <td width="99" class="titulo">F.Vencimiento</td>
            <td width="43" class="titulo">Neto</td>
            <td width="44" class="titulo">Tara</td>
            <td width="40" class="titulo">Est</td>
          </tr>
          <tr>
            <td><div align="center"></div></td>
            <td><div align="center"></div></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <? while ($ro=mysql_fetch_array($r))  { 
		  $femision=format_fecha_sin_hora($ro[femision]);
	  	  $fvencimiento=format_fecha_sin_hora($ro[fvencimiento]);
	      $ffaena=format_fecha_sin_hora($ro[ffaena]);
		  ?>
          <tr>
            <td nowrap="nowrap"><label></label>              
              <div align="center" class="cajas"><?php echo substr($ro[ano],2,4); ?><? echo $ro[id_faja];?></div></td>
            <td nowrap="nowrap" class="cajas"><div align="center"><?echo $ro[loten]?></div></td>
            <td nowrap="nowrap" class="cajas"><?echo $ro[nombre]?></td>
            <td nowrap="nowrap" class="cajas"><?echo $femision?></td>
            <td nowrap="nowrap" class="cajas"><?echo $fvencimiento?></td>
            <td nowrap="nowrap" class="cajas"><?echo $ro[neto]?></td>
            <td nowrap="nowrap" class="cajas"><?echo $ro[tara]?></td>
            <td nowrap="nowrap"><label>
              <input name="est-<?echo $ro[id_faja]?>" type="text" class="cajas" value="<?echo $ro[estado] ?>" size="2" maxlength="2" />
            </label></td>
          </tr>
          <?  } ?>
          <tr>
            <td height="21" colspan="8" nowrap="nowrap">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="8" nowrap="nowrap">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="8" nowrap="nowrap"><div align="center">
              <input name="Modificar" type="submit" class="cajas" id="Modificar" value="Modificar" />
            </div></td>
          </tr>
        </table></td>
      </tr>
    </table>
  </form>
</blockquote>
