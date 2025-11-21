<div id="sidebar" >		
<div class="left-box">					
		<h1>MATERIA PRIMA (MP)</h1>
    		<ul class="sidemenu">
    		<li>
            <a href="sistema.php?botmenu=1">Ingresar MP </a>
            <? if($botmenu){?>
            <br><a href="?modulo=fmpfresca.php&botmenu=1&fresca=<? echo "N";?>&nuevo=1">MP Fresca </a>
            <br><a href="?modulo=fmpsalada.php&botmenu=1&salada=<? echo "I";?>&nuevo=1">MP Salada </a>
            <? }?>
            </li>
            <li><a href="?modulo=flistaringresomp.php">Listar ingreso MP </a></li>
            <li><a href="?modulo=fstockmp.php">Stock de MP </a></li>
   			</ul>
			
          <h1>PRODUCCION (PR)</h1>
    		  <ul class="sidemenu">
               <center>Selecionar Linea de Proceso</center>
               <br>
               <center>
               <form name="linea_proceso" method="post" action="">
               <? 
			   
			  list ($ldp,$id_ldp) = crea_linea_produccion($link,$ldp,$id_ldp,1);
			  echo "$ldp ";
			   
			  ?>
              </form>
             </center>
               <br> 
               <? 
			   if($id_ldp){
			   $sql="SELECT smp.id_solicitud_mp AS id_solicitud_mp,smp.fechasmp AS fechasmp, smp.fechaentreg AS fechaentreg, smp.unidadessolicitadas AS unidadessolicitadas, org.origen AS origen, p.producto AS producto, c.calibre AS calibre, u.username AS username  
FROM solicitud_mp AS smp, origenes AS org, producto AS p, calibre AS c, usuarios AS u
WHERE smp.id_solicitud_mp = smp.id_solicitud_mp
AND smp.id_origen = org.id_origen
AND smp.id_calibre = c.id_calibre
AND smp.id_usuario = u.id_usuario
AND smp.id_producto = p.id_producto AND smp.id_ldp =$id_ldp and smp.fecharecep  = '0000-00-00' and smp.fecharechazomp  = '0000-00-00'";
$result=mysql_query($sql);
 $cuantossmp=mysql_num_rows($result);
// echo "cuantos $cuantossmp ";

			   $sqlrecha="SELECT smp.id_solicitud_mp AS id_solicitud_mp,smp.fechasmp AS fechasmp, smp.fechaentreg AS fechaentreg, smp.unidadessolicitadas AS unidadessolicitadas, org.origen AS origen, p.producto AS producto, c.calibre AS calibre, u.username AS username  
FROM solicitud_mp AS smp, origenes AS org, producto AS p, calibre AS c, usuarios AS u
WHERE smp.id_solicitud_mp = smp.id_solicitud_mp
AND smp.id_origen = org.id_origen
AND smp.id_calibre = c.id_calibre
AND smp.id_usuario = u.id_usuario
AND smp.id_producto = p.id_producto AND smp.id_ldp =$id_ldp and smp.fecharechazomp  != '0000-00-00'";
$resultrecha=mysql_query($sqlrecha);
 $cuantosrecha=mysql_num_rows($resultrecha);
// echo "cuantos $cuantossmp ";

			   
			   $sqlrep="SELECT smp.id_solicitud_mp AS id_solicitud_mp,smp.fechasmp AS fechasmp, smp.fecharecep AS fecharecep, smp.unidadessolicitadas AS unidadessolicitadas, org.origen AS origen, p.producto AS producto, c.calibre AS calibre, u.username AS username  
FROM solicitud_mp AS smp, origenes AS org, producto AS p, calibre AS c, usuarios AS u
WHERE smp.id_solicitud_mp = smp.id_solicitud_mp
AND smp.id_origen = org.id_origen
AND smp.id_calibre = c.id_calibre
AND smp.id_usuario = u.id_usuario
AND smp.id_producto = p.id_producto AND smp.id_ldp =$id_ldp AND smp.fecharecep != '0000-00-00' AND smp.fecha_asig_producc = '0000-00-00'";
$resultrep=mysql_query($sqlrep);
 $cuantosrecepcion=mysql_num_rows($resultrep);
 
    $sqlplanillaproduccion="SELECT smp.id_solicitud_mp AS id_solicitud_mp,smp.fechasmp AS fechasmp, smp.fecharecep AS fecharecep, smp.unidadessolicitadas AS unidadessolicitadas, org.origen AS origen, p.producto AS producto, c.calibre AS calibre, u.username AS username  
FROM solicitud_mp AS smp, origenes AS org, producto AS p, calibre AS c, usuarios AS u
WHERE smp.id_solicitud_mp = smp.id_solicitud_mp
AND smp.id_origen = org.id_origen
AND smp.id_calibre = c.id_calibre
AND smp.id_usuario = u.id_usuario
AND smp.id_producto = p.id_producto AND smp.id_ldp =$id_ldp AND smp.fecha_asig_producc != '0000-00-00' ";
$resultplanillaproduccion=mysql_query($sqlplanillaproduccion);
 $cuantosplanillaproduccion=mysql_num_rows($resultplanillaproduccion);

   $sqlpr="SELECT * FROM mat_prima_nacional WHERE id_estado_material = 7 AND id_ldp =$id_ldp";
   $resultpr=mysql_query($sqlpr);
   $stockpr=mysql_num_rows($resultpr);
   //echo "stockpr $stockpr<br>";
   
   $sqlpri="SELECT * FROM mat_prima_importada WHERE id_estado_material = 7 AND id_ldp =$id_ldp";
   $resultpri=mysql_query($sqlpri);
   $stockpri=mysql_num_rows($resultpri);
   //echo "stockpri $stockpri<br>";

	
		$stockprok = $stockpr + $stockpri;
	
	
 
			   }
			   ?>
               
			   <? if($id_ldp){?>
                <li><a href="?modulo=solicitudmp.php&id_ldp=<? echo $id_ldp?>">Crear solicitud de MP </a></li>
               <li> <? if($tip == 2) {?> <img src="codphp/jpgnew/flecha.jpg" width="16" height="13" /><? }?><a href="?modulo=pendientesmp.php&id_ldp=<? echo $id_ldp?>&tip=2">Solicitudes Pendientes MP  [<? echo $cuantossmp?>]</a> </li>
                <li><? if($tip == 3) {?> <img src="codphp/jpgnew/flecha.jpg" width="16" height="13" /><? }?><a href="?modulo=rechazadassmp.php&id_ldp=<? echo $id_ldp?>&infomenu=1&tip=3">Solicitudes Rechazadas  [<? echo $cuantosrecha?>]</a></li>
                <li><? if($tip == 4) {?> <img src="codphp/jpgnew/flecha.jpg" width="16" height="13" /><? }?><? if($cuantosrecepcion){?><a href="?modulo=recepcionmp.php&id_ldp=<? echo $id_ldp?>&infomenu=1&tip=4">Solicitudes Aceptadas [<? echo $cuantosrecepcion?>]</a><? }else{?>Solicitudes Aceptadas [<? echo $cuantosrecepcion?>]<? } ?></li>
                 <li><a href="?modulo=crea_planillaproduccion.php&id_ldp=<? echo $id_ldp?>&infomenu=1&tip=5">Crear Planilla de Producción </a></li>
                <li><a href="?modulo=pproducc.php&id_ldp=<? echo $id_ldp?>&infomenu=1&tip=6">Listar Planillas Producción </a></li>
                <li><a href="?modulo=stockpr.php&id_ldp=<? echo $id_ldp?>">Stock Producción</a></li>
   			  </ul>
              <? }
			  ?>
			
           <h1>PRODUCTO TERMINADO (PT)</h1>
    		<ul class="sidemenu">
    		<li><a href="?modulo=ingresarpt.php&nuevo=1">Ingresar PT </a></li>
            <li><a href="?modulo=fstockpt.php">Stock PT </a></li>
    </ul>
              <?
              
$sqlcpen="SELECT ces.id_c_es_so AS id_c_es_so,ces.id_ce AS id_ce, pro.producto AS producto, org.origen AS origen, proc.id_procedencia AS id_procedencia, ces.fechaces AS fechaces, us.username AS username, cambio_estado As cambio_estado from usuarios AS us, cambio_estado_solicitud AS ces, procedencia AS proc, producto AS pro, origenes AS org, cambio_estado AS cestado where ces.id_usuario = us.id_usuario and ces.id_procedencia = proc.id_procedencia and ces.id_origen = org.id_origen and ces.id_producto = pro.id_producto and ces.id_ce  = cestado.id_ce and ces.fecha_cierre_proceso  = '0000-00-00' ";
$resultcpen=mysql_query($sqlcpen);
$cuantoscpen=mysql_num_rows($resultcpen);
 
		  ?>
              
           <h1>MOVIMIENTO FOLIOS</h1>
    		 <ul class="sidemenu">
    		 <!--<li><a href="?modulo=solicitudmovfolios.php">Crear Solicitud Movimiento</a></li>-->
             <li><a href="?modulo=solicitudmovfolios.php">Movimiento Folios</a></li>
             <!-- <li><a href="#">Movimientos Pendientes</a></li>
             <li><a href="#">Listar Movimientos Folios</a></li>-->
             </ul>
             
              <h1>CAMBIO ESTADO</h1>
    		 <ul class="sidemenu">
    		 <li><a href="?modulo=solicitudcestado.php">Crear Solicitud Cambio Estado</a></li>
              <li><a href="?modulo=solicitudcpendientes.php">Cambios Estados Pendientes [<? echo "$cuantoscpen";?>]</a></li>
             <li><a href="?modulo=solicitudchistorial.php">Listar Cambios de Estados</a></li>
             </ul>
           
 			 <h1>OPERARIOS</h1>
    		 <ul class="sidemenu">
    		 <li><a href="?modulo=ingropera.php&nuevo=1">Ingresar operarios </a></li>
             <li><a href="?modulo=ingropera_listar.php&id_ldp=<? echo $id_ldp?>">Listar Operarios </a></li>
             </ul>
             
               <h1>ORIGENES</h1>
    		 <ul class="sidemenu">
    		 <li><a href="?modulo=ingrorigen.php&nuevo=1">Ingresar Origen</a></li>
             <li><a href="?modulo=ingrorigen_listar.php">Listar Origen</a></li>
             </ul>
             
 </div>
</div>
