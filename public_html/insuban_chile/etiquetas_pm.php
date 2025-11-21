<HTML>
<style type="text/css">
<!--
.cajas {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.titulo {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; }
-->
</style>
<BODY>
<form name="myForm" method="post" action="barcode-create2.php" target="popup"
	onsubmit="window.open('', 'popup', 'width = 800, height = 600, top=0, left=0, scrollbars=yes')">

<table width="250" border="0" align="center">
  <tr>
    <td width="240"><div align="center" class="titulo">Procedencia</div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><div align="center">
      <? $procedencia=crea_procedencia($link,$row[id_procedencia],0);
		echo $procedencia;?>
    </div></td>
  </tr>
  <tr>
    <td><div align="center" class="cajas">Cantidad de Etiquetas</div></td>
    </tr>
  <tr>
    <td><div align="center">
      <input name="cantidad" type="text" class="cajas" id="barcode" size="5" maxlength="5">
    </div></td>
  </tr>
  <tr>
    <td><div align="center">
      <? $operarios=crea_operarios($link,$row[id_operarios]);
		echo $operarios;?>
    </div></td>
  </tr>
  <tr>
    <td><label>
      <div align="center">
        <input name="imprimir" type="submit" class="cajas" id="imprimir" value="Imprimir" >
        </div>
    </label></td>
  </tr>
</table>
</form>
</BODY>

</HTML>