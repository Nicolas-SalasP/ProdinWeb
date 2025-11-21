<? 
$cadena2= "@";   

if (strrpos($email, $cadena2))   
    $si=1; 

if($enviar and $si){
$nombresitio = "Contacto Insuban";
$contacto = "insuban@insuban.cl";
$administrador .= "------Informacion de Contactenos INSUBAN LTDA------\n\n";
$administrador .= "Nombre: $nombre\n";
$administrador .= "Compania: $compania\n";
$administrador .= "E-mail: $email\n";
$administrador .= "Telefono: $cod - $telefono\n";
$administrador .= "Comentarios:\n";
$administrador .= "$comentario\n\n";
$administrador .= "------Informacion de Contactenos INSUBAN LTD------\n";
mail("$contacto", "$nombresitio", $administrador, "From: $email");
$enviado=1;
}
?>

<style type="text/css">
<!--
body {
	background-image: url(jpg/fon.jpg);
}
.tex_inferior {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 10px;
	color: #666;
	text-decoration: none;
	text-align: center;
}
.texto {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 12px;
	color: #666;
}

-->
</style>
<link href="hoja_estilo.css" rel="stylesheet" type="text/css" />
<script language="JavaScript">
<!--
var nav4 = window.Event ? true : false;
function acceptNum(evt){	
// NOTE: Backspace = 8, Enter = 13, '0' = 48, '9' = 57	
var key = nav4 ? evt.which : evt.keyCode;	
return (key >= 48 && key <= 57);
}

function fixElement(element, message) {
alert(message);
element.focus();
}

function isMailReady(form1) {
var passed = false;

if (document.form1.nombre.value=="") {     
    alert('Debe ingresar nombre');
    document.form1.nombre.onfocus;
    return false;
}
if (document.form1.compania.value=="") {     
    alert('Debe ingresar compañia');
    document.form1.compania.onfocus;
    return false;
}

if (form1.email.value.indexOf("@") == -1 || form1.email.value.indexOf(".") == -1)
{
fixElement(form1.email, "Introduzca una direccion e-mail correcta.");

}

if (document.form1.cod.value=="") {     
    alert('Debe ingresar código');
    document.form1.cod.onfocus;
    return false;
}

if (document.form1.telefono.value=="") {     
    alert('Debe ingresar Teléfono');
    document.form1.telefono.onfocus;
    return false;
}

else {
getInfo(form1);
passed = true;
}
return passed;
}

function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</SCRIPT>
<style type="text/css">
<!--
@import url("hoja_estilo.css");
-->
</style>
<table width="906" border="0" align="center">
  <tr>
    <td width="34" rowspan="3"><img src="jpg/procesadora_insuban_horizontal.jpg" width="34" height="304" border="0" /></td>
    <td colspan="2">&nbsp;</td>
    <td width="392"><center><img src="jpg/sobre.jpg" width="190" height="204" /></center></td>
    <td width="393">
    <form id="form1" name="form1" method="post" action="" onsubmit = "return isMailReady(this);">
    <table width="509" border="0" align="right">
      <tr>
        <td height="30" colspan="4"><div align="left"><span class="arial_11_gris_bold">Complete el siguiente formulario y  nos pondremos en contacto con Usted.</span></div></td>
      </tr>
      <tr>
        <td width="77"><div align="left"><span class="arial_11_gris_bold">Nombre</span></div></td>
        <td width="3" class="arial_11_gris_bold">:</td>
        <td width="342"><div align="left">
          <input name="nombre" type="text" size="50" maxlength="30" id="nombre" />
        </div></td>
        <td width="69">&nbsp;</td>
      </tr>
      <tr>
        <td><div align="left" class="arial_11_gris_bold">Compa&ntilde;ia</div></td>
        <td class="arial_11_gris_bold">:</td>
        <td><div align="left">
          <input name="compania" type="text" size="50" maxlength="30" id="compania" />
        </div></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><div align="left" class="arial_11_gris_bold">E-mail</div></td>
        <td class="arial_11_gris_bold">:</td>
        <td><div align="left">
          <input name="email" type="text" size="50" maxlength="30" id="email" />
        </div></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><div align="left" class="arial_11_gris_bold">Tel&eacute;fono</div></td>
        <td class="arial_11_gris_bold">:</td>
        <td><div align="left">
          <input name="cod" type="text" size="4" maxlength="4" id="cod" />
          -
          <input name="telefono" type="text" size="38" maxlength="10" id="telefono" />
        </div></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><div align="left" class="arial_11_gris_bold">Comentarios</div></td>
        <td class="arial_11_gris_bold">:</td>
        <td rowspan="2"><div align="left">
          <textarea name="comentario" cols="51" rows="3" id="comentario"></textarea>
        </div></td>
        <td rowspan="2">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan="2"><div align="left">
          <input name="enviar" type="submit" value="enviar" />
          &nbsp;<? if($enviado and $email and $si){?><span class="tex_inferior">Su mensaje fue enviado.</span><? }?></div>
          
          </td>
      </tr>
    </table>
    </form>
    </td>
  </tr>
  <tr>
    <td width="70" height="4">&nbsp;</td>
    <td height="4" colspan="3"><hr /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3"><table width="787" border="0" align="center">
      <tr>
        <td width="208" valign="top" class="arial_11_gris">Agrimares S.L.<br />
          Casa Matriz<br />
          Gran Via Carlos III, 65 Entlo. 3<br />
          08034 Barcelona - Espa&ntilde;a<br />
          Tel. 34-93.490.83.50<br />
          Fax. 34-93.490.99.71<br />
          E-mail: <a href="mailto:info@agrimares.net">info@agrimares.net</a></td>
        <td width="200" valign="top" class="arial_11_gris">Insuban Ltda.<br />
          Antillanca Norte, 391<br />
          Poligono Industrial lo Boza<br />
          Pudahuel - Santiago -  Chile<br />
          Te. 56-2.945.85.00<br />
          Fax. 56-2.945.85.29<br />
          E-mail: <a href="mailto:insuban@insuban.cl">insuban@insuban.cl</a></td>
        <td width="213" valign="top" class="arial_11_gris">ESB do Brasil Ltda.<br />
          Rua Joao Andriollo, 1167<br />
          Area  Triperia Bairro Ana Rech<br />
          Caxias do Sul / RS -  BRASIL<br />
          Tel/Fax. 55.54.32.83.85.16<br />
          E-mail: <a href="mailto:esb@esbdobrasil.com">esb@esbdobrasil.com</a></td>
        <td width="148" valign="top" class="arial_11_gris">TRICOLSA S.A.S.<br />
          Calle 103 Nr. 6 -164<br />
          Copacabana - Antioquia<br />
          COLOMBIA<br />
          Tel. 57-4.274.40.60<br />
          Fax. 57-4.27497.44<br />
          E-mail: <a href="mailto:ventas@tricolsa.co">ventas@tricolsa.co</a></td>
      </tr>
    </table></td>
  </tr>
</table>
