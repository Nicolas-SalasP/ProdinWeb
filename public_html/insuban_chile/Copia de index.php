<style type="text/css">
<!--
.style1 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-weight: bold;
}
.style2 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
-->
</style>
<title>Sistema Prodin Web</title>
<table width="307" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3"><img src="jpg/logo_ingreso.jpg" width="304" height="39" border="0" /></td>
  </tr>
  <tr>
    <td width="16"><img src="jpg/vertical_izq_ingreso.jpg" width="15" height="152" border="0" /></td>
    <td width="272"><table width="237" height="136" border="0" align="center">
      <tr>
        <td width="231" height="132" background="jpg/fondo_gris_ingreso.jpg"><form action="validar.php" method="post" name="form1" id="form1">
            <table width="200" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td width="40" class="style1">&nbsp;</td>
                <td colspan="2" class="style1">&nbsp;</td>
                <td width="94">&nbsp;</td>
              </tr>
              <tr>
                <td class="style1">&nbsp;</td>
                <td width="47" class="style1">Usuario</td>
                <td width="19" class="style1">:</td>
                <td width="94"><input name="username" type="text" class="style2" id="username" size="10" maxlength="20" /></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><span class="style1">Clave</span></td>
                <td><span class="style1">:</span></td>
                <td><input name="password" type="password" class="style2" id="clave" size="10" maxlength="20" /></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td colspan="3"><div align="center"><span class="style2">
                    <? 
			  echo $error; 
			  //$error1=$_GET['error']; echo $error1;
			  ?>
                </span></div></td>
              </tr>
              <tr>
                <td colspan="4"><div align="center">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="ingresar" type="submit" class="style2" value="Ingresar" />
                </div></td>
              </tr>
            </table>
        </form></td>
      </tr>
    </table></td>
    <td width="19"><img src="jpg/vertical_der_ingreso.jpg" width="16" height="152" border="0" /></td>
  </tr>
  <tr>
    <td colspan="3"><img src="jpg/horizon_ingreso.jpg" width="304" height="18" border="0" /></td>
  </tr>
</table>