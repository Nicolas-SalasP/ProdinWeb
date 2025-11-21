<?
	//$sql="SELECT count(DISTINCT pt.id_pedido_tablas) AS cantidad_p, d.destinos,p.id_pedidos, p.id_prioridades, d.id_destinos, p.fech_ingreso_pedido, p.fech_termino_pedido , p.fech_despacho_pedido FROM pedido AS p, pedido_tabla AS pt,destinos AS d WHERE p.id_pedidos = pt.id_pedidos and p.id_destinos = d.id_destinos order by p.id_prioridades";
	
	//$sql="SELECT * FROM pedido LEFT JOIN pedido_tabla ON pedido.id_pedidos = pedido_tabla.id_pedidos WHERE pedido.urgencia =1";
	

?>