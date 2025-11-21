<?
// 1. LIMPIEZA VISUAL: Ocultar errores naranjas/rojos
error_reporting(0);
ini_set('display_errors', 0);

// 2. INICIAR SESIÓN Y EXTRAER VARIABLES
// Esto es vital: Saca los datos de $_SESSION y $_GET/$_POST y los convierte 
// en variables normales ($nombre_usuario, $modulo, etc.)
if (!isset($_SESSION)) {
    session_start();
}

// Convertir $_SESSION['algo'] -> $algo
if (isset($_SESSION)) {
    extract($_SESSION);
}

// Convertir $_GET['modulo'] -> $modulo
extract($_REQUEST);

ini_set('memory_limit', '-1');
require "sconre.php";
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="stylesheet" href="images/Underground.css" type="text/css" />         
<title>Insuban</title>
<style type="text/css">
</style>
<script>
window.onload=function(){
var pos=window.name || 0;
window.scrollTo(0,pos);
}
window.onunload=function(){
window.name=self.pageYOffset || (document.documentElement.scrollTop+document.body.scrollTop);
}
</script>

<script language="JavaScript"> 
function Abrir_ventana (pagina) { 
var opciones="toolbar=yes,location=yes, directories=yes, status=yes, menubar=yes, scrollbars=yes, resizable=yes, width=900, height=900, top=100, left=100"; 
window.open(pagina,"",opciones); 
} 
</script>
<script language="JavaScript"> 
function Abrir_ventana_nueva(pagina) { 
var opciones="toolbar=no,location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=900, height=500, top=200, left=220"; 
window.open(pagina,"",opciones); 
} 
</script>
<script language="JavaScript" type="text/JavaScript"> 

function MM_openBrWindow(theURL,winName,features) { 
  window.open(theURL,winName,features); 
} 

</script>

<script language="JavaScript"> 
function cambiar(esto)
{
    vista=document.getElementById(esto).style.display;
    if (vista=='none')
        vista='block';
    else
        vista='none';
    document.getElementById(esto).style.display = vista;
}
</script>
 <script language="javascript">
 function solonum(){
 var key=window.event.keyCode;
 if (key < 48 || key > 57){
 window.event.keyCode=0;
 }}
 </script>
<script language="JavaScript" type="text/javascript" src="lib/cal.js">
</script>

<script language="JavaScript"> 
function seleccionar_todo(){ 
   for (i=0;i<document.form1.elements.length;i++) 
      if(document.form1.elements[i].type == "checkbox") 
         document.form1.elements[i].checked=1 
} 

function deseleccionar_todo(){ 
   for (i=0;i<document.form1.elements.length;i++) 
      if(document.form1.elements[i].type == "checkbox") 
         document.form1.elements[i].checked=0 
} 
</script>
<script language="JavaScript" type="text/javascript"> 
</script> 
</head>
<body>
<div id="wrap">
<? include "submenu.php";?>                     
<? include "logoi.php";?>
<? include "menuizq.php";?>
<div id="main">
<form name="form1" method="post" action="" onsubmit = "return isMailReady(this);">
<? include "principal.php";?>
</form>
</div>
</div>
<? include "inferior.php";?>
</body>
</html>