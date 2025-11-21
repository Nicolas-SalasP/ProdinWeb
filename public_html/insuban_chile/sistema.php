<?
ini_set('memory_limit', '-1');
require "lib/conexion.php";
require( 'lib/session_admin.php');
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");
require "lib/funciones.php";

?>
<script>
window.onload=function(){
var pos=window.name || 0;
window.scrollTo(0,pos);
}
window.onunload=function(){
window.name=self.pageYOffset || (document.documentElement.scrollTop+document.body.scrollTop);
}
</script>
<script language="JavaScript" type="text/javascript"> 
<!-- 
function Confirmar(form1) { 

var borrar = confirm("Estás seguro/a de que desea eliminar el registro?"); 

return borrar; //true o false 

} 
//--> 
</script>

<table width="757" border="0" align="center">
  <tr>
    <td height="4"><div align="center">
      <? include "banner.php";?>
    </div></td>
  </tr>
  <tr>
    <td height="1"><div align="center">
      <? include "cerrar_session.php";?>
    </div></td>
  </tr>
  <tr>
    <td height="0" align="right">&nbsp;</td>
  </tr>
  <tr>
    <td height="-1" align="right"> <a href="insuban_chile_produccion" target="_blank"><span class="titulo">Sistema de produccion </span></a></td>
  </tr>
  <tr>
    <td height="-2" align="right">&nbsp;</td>
  </tr>
  <tr>
    <td height="20"><div align="center">
      <?php 
	  //echo "Aqui".$modulo;
       if ($modulo)
    
       include "$modulo";
       else 
       include "menu.php";
    //echo "Aqui2".$modulo;
   ?>
    </div></td>
  </tr>
  <tr>
    <td height="20"><div align="center">
      <? include "inferior.php";?>
    </div></td>
  </tr>
</table>
