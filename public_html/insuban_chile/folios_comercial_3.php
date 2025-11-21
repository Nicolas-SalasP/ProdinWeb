<?
$sql20="SELECT pt.id_pedidos, pt.id_cruce_tablas,prod.producto, cal.calibre, pt.cantidadb, p.fecha_prioridad, d.destinos
FROM pedido_tabla as pt, producto as prod, calibre as cal, cruce_tablas as ct , pedido as p, destinos as d
WHERE ct.id_producto=prod.id_producto and ct.id_calibre=cal.id_calibre and pt.id_cruce_tablas=ct.id_cruce_tablas and p.id_pedidos=pt.id_pedidos and p.id_destinos=d.id_destinos and p.fech_ingreso_pedido != '0000-00-00' and p.folio_piking = 0 and p.fech_envio_picking = '0000-00-00' 
group by p.fecha_prioridad asc";
$result20=mysql_query($sql20);
 
    echo "<table border='1' cellpadding='4' cellspacing='0'>";
    $pedido = array();
    $fecha = array();
    $destino = array();

    while ($row20 = mysql_fetch_array($result20)) {
        $pedido[] = $row20['id_pedidos'];
        $fecha[] = $row20['fecha_prioridad'];
        $destino[] = $row20['destinos'];
        $codigo[] = $row20['id_cruce_tablas'];
        $producto[] = $row20['producto'];          
 
    }
    echo "<tr>";
    echo "<td>pedido</td>";
    foreach($pedido as $ped) {
        echo "<td><b>" . $ped . "</b></td>";
    }
    echo "</tr>";

    echo "<tr>";
    echo "<td>fecha</td>";
    foreach($fecha as $fec) {
        echo "<td><h5>" . $fec . "</h5></td>";
    }
    echo "</tr>";

    echo "<tr>";
    echo "<td>destino</td>";
    foreach($destino as $des) {
        echo "<td>" . $des . "</td>";
    }
   echo "</tr>";

   echo "</table>";
?>
