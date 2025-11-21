<?
ini_set('memory_limit', '-1');
require "../lib/conexion.php";
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");
//require "../lib/funciones.php";


header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=Pedidos.csv");


//Ingresa llamamos al metodo DesplegarTabla
MysqlFunciones::DesplegarTabla("SELECT pt.id_pedidos, pt.id_cruce_tablas,prod.producto, cal.calibre, pt.cantidadb, p.fecha_prioridad, d.destinos
FROM pedido_tabla as pt,
producto as prod,
calibre as cal,
cruce_tablas as ct ,
pedido as p,
destinos as d
WHERE ct.id_producto=prod.id_producto and ct.id_calibre=cal.id_calibre and pt.id_cruce_tablas=ct.id_cruce_tablas and p.id_pedidos=pt.id_pedidos and p.id_destinos=d.id_destinos and p.fech_ingreso_pedido != '0000-00-00' and p.folio_piking = 0 and p.fech_envio_picking = '0000-00-00' 
order by p.fecha_prioridad desc"); //edita esto con tu consulta

?>