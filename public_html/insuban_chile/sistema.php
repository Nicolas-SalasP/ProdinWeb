<?php
ini_set('memory_limit', '-1');
require "lib/conexion.php";
require "lib/session_admin.php";

$link = mysqli_connect($localhost, $user, $pass, $db);

if (!$link) {
    die("Error crítico de conexión: " . mysqli_connect_error());
}

require "lib/funciones.php";

$modulo = isset($_GET['modulo']) ? $_GET['modulo'] : null;
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
</script>

<table width="757" border="0" align="center">
  <tr>
    <td height="4"><div align="center">
      <?php include "banner.php"; ?>
    </div></td>
  </tr>
  <tr>
    <td height="1"><div align="center">
      <?php include "cerrar_session.php"; ?>
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
       if ($modulo) {
           if (file_exists($modulo)) {
               include $modulo;
           } else {
               echo "El módulo solicitado no existe.";
           }
       } else {
           include "menu.php";
       }
    ?>
    </div></td>
  </tr>
  <tr>
    <td height="20"><div align="center">
      <?php include "inferior.php"; ?>
    </div></td>
  </tr>
</table>