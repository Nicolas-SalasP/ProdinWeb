<script> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana1","width=400,height=160,scrollbars=NO,resizable=NO,Top=100,left=200") 
} 
</script>
<div id="header">
			<ul>
				<li id="current"></li>
				<li><a href="?modulo=codphp/infgestionproductiva.php"><span>Gestion Productiva</span></a></li>
				<li><a href="?modulo=fstockmp.php"><span>Stock de MP</span></a></li>
				<li><a href="#"><span>Stock de PR</span></a></li>
				<li><a href="#"><span>Stock de PT</span></a></li>
          		<li><a href="javascript:ventanaSecundaria('ejemplo.php')"><span>Importar Folios M3</span></a></li>
          		<li><a href="javascript:ventanaSecundaria('importar_rcp.php')"><span>Subir RCP</span></a></li>          		
          	    <li><a href="?modulo=procesos/presentacion/proceso1_3.php"><span>Procesos Productivos</span></a></li>
				<li><a href="close_session.php"><span>Cerrar</span></a></li>			
			</ul>
</div>