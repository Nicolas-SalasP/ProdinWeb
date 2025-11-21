<script> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana1","width=450,height=120,scrollbars=NO,resizable=NO,Top=100,left=200") 
} 
</script>
<script> 
function ventanaCalendario (URL){ 
   window.open(URL,"ventana1","width=1000,height=1200,scrollbars=NO,resizable=NO,Top=100,left=200") 
} 
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

<script type="text/javascript">
$(window).load(function() {
    $(".loader").fadeOut("slow");
});
</script>

<div class="loader"></div>

<style type="text/css">
.loader {
    position: fixed;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background: url('jpg/cargando.gif') 50% 50% no-repeat rgb(249,249,249);
    opacity: .8;
}
.stylenegrita {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
}
.style4 {font-family: Arial, Helvetica, sans-serif; font-size: 10px; }

</style>
<?
ini_set('memory_limit', '-1');
?>
<table width="657" border="0" align="center">
  <tr>
    <td width="163" valign="top"><table width="144" border="0" align="center">
      <tr>
        <td width="138" bgcolor="#DAD9D9"><div align="center" class="stylenegrita">Tablas</div></td>
      </tr>
      <tr>
        <td><!--<a href="?modulo=productos_alt.php"><img src="jpg/equivalencia_productos.jpg" width="137" height="17" border="0" /></a--></td>
      </tr>
      <tr>
        <td><? if($permiso1 != 3) {?><a href="?modulo=especies_listar.php" class="style4"><img src="botones/especie1.jpg" width="137" height="17" border="0" /></a><? }else{?><img src="botones/especie2.jpg" width="137" height="17" border="0" /><? }?></td>
      </tr>
      <tr>
        <td><? if($permiso2 != 3){?><a href="?modulo=productos_listar.php"><img src="botones/productos1.jpg" width="137" height="17" border="0" /></a><? }else{?><img src="botones/productos2.jpg" width="137" height="17" border="0" /><? }?></td>
      </tr>
      <tr>
        <td><? if($permiso3 != 3){?><a href="?modulo=unidades_medidas_listar.php"><img src="botones/unidades_medidas1.jpg" width="137" height="17" border="0" /></a><? }else{?><img src="botones/unidades_medidas2.jpg" width="137" height="17" border="0" /><? }?></td>
      </tr>
      <tr>
        <td><? if($permiso4 != 3){?><a href="?modulo=medidas_productos_listar.php"><img src="botones/medidas1.jpg" width="137" height="17" border="0" /></a><? }else{?><img src="botones/medidas2.jpg" width="137" height="17" border="0" /><? }?></td>
      </tr>
      <tr>
        <td><? if($permiso5 != 3){?><a href="?modulo=calibres_listar.php"><img src="botones/calibres1.jpg" width="137" height="17" border="0" /></a><? }else{?><img src="botones/calibres2.jpg" width="137" height="17" border="0" /><? }?></td>
      </tr>
      <tr>
        <td class="style4"><? if($permiso6 != 3){?><a href="?modulo=caracteristicas_producto_listar.php"><img src="botones/caract_productos1.jpg" width="137" height="17" border="0" /></a><? }else{?><img src="botones/caract_productos2.jpg" width="137" height="17" border="0" /><? }?></td>
      </tr>
      <tr>
        <td class="style4"><? if($permiso7 != 3){?><a href="?modulo=caracteristica_envase_listar.php"><img src="botones/carac_envases1.jpg" width="137" height="17" border="0" /></a><? }else{?><img src="botones/carac_envases2.jpg" width="137" height="17" border="0" /><? }?></td>
      </tr>

      <tr>
        <td class="style4"><? if($permiso8 != 3){?><a href="?modulo=operarios_listar.php"><img src="botones/operarios1.jpg" width="137" height="17" border="0" /></a><? }else{?><img src="botones/operarios2.jpg" width="137" height="17" border="0" /><? }?></td>
      </tr>
      
      <tr>
        <td><? if($permiso9 != 3){?><a href="?modulo=funciones_operador_listar.php"><img src="botones/funciones_operarios1.jpg" width="137" height="17" border="0" /></a><? }else{?><img src="botones/funciones_operarios2.jpg" width="137" height="17" border="0" /><? }?></td>
      </tr>
      
      <tr>
        <td><? if($permiso10 != 3){?><a href="?modulo=unidades_produccion_listar.php"><img src="botones/unidades_pro1.jpg" width="137" height="17" border="0" /></a><? }else{?><img src="botones/unidades_pro2.jpg" width="137" height="17" border="0" /><? }?></td>
      </tr>
      <tr>
        <td><? if($permiso11 != 3){?><a href="?modulo=envases_listar.php"><img src="botones/envases1.jpg" width="137" height="17" border="0" /></a><? }else{?><img src="botones/envases2.jpg" width="137" height="17" border="0" /><? }?></td>
      </tr>
      <tr>
        <td><? if($permiso12 != 3){?><a href="?modulo=destinos_listar.php"><img src="botones/destinos1.jpg" width="137" height="17" border="0" /></a><? }else{?><img src="botones/destinos2.jpg" width="137" height="17" border="0" /><? }?></td>
      </tr>
      <tr>
        <td><? if($permiso12 != 3){?><a href="?modulo=destinos.php&nuevo=1"><img src="botones/button_agregar-cliente3.jpg" width="137" height="17" border="0" /></a><? }else{?><img src="botones/button_agregar-cliente.jpg" width="137" height="17" border="0" /><? }?></td>
      </tr>      
      <tr>
        <td><? if($permiso13 != 3){?><a href="?modulo=origenes_listar.php"><img src="botones/origenes1.jpg" width="137" height="17" border="0" /></a><? }else{?><img src="botones/origenes2.jpg" width="137" height="17" border="0" /><? }?></td>
      </tr>
      <tr>
        <td><? if($permiso14 != 3){?><a href="?modulo=bodegas_listar.php"><img src="botones/bodegas1.jpg" width="137" height="17" border="0" /></a><? }else{?><img src="botones/bodegas2.jpg" width="137" height="17" border="0" /><? }?></td>
      </tr>
      
      <tr>
        <td><? if($permiso16 != 3){?><a href="?modulo=datos_empresa.php"><img src="botones/datos_empresa1.jpg" width="137" height="17" border="0" /></a><? }else{?><img src="botones/datos_empresa2.jpg" width="137" height="17" border="0" /><? }?></td>
      </tr>
      <tr>
        <td><? if($permiso17 != 3){?><a href="?modulo=usuarios_listar.php"><img src="botones/usuarios1.jpg" width="137" height="17" border="0" /></a><? }else{?><img src="botones/usuarios2.jpg" width="137" height="17" border="0" /><? }?></td>
      </tr>
    </table></td>
    <td width="158" valign="top"><table width="141" border="0" align="center">
      <tr>
        <td width="137" bgcolor="#DAD9D9" class="stylenegrita"><div align="center">Asignacion</div></td>
      </tr>
      
      <tr>
        <td><? if($permiso18 != 3){?><a href="?modulo=especie_producto_listar.php" class="style4"><img src="botones/asignar_especie_producto1.jpg" width="137" height="17" border="0" /></a><? }else{?><img src="botones/asignar_especie_producto2.jpg" width="137" height="17" border="0" /><? }?></td>
      </tr>
      <tr>
        <td><? if($permiso19 != 3){?><a href="?modulo=producto_unidad_medida_listar.php"><img src="botones/asignar_unidades_medidas1.jpg" width="137" height="17" border="0" /></a><? }else{?><img src="botones/asignar_unidades_medidas2.jpg" width="137" height="17" border="0" /><? }?></td>
      </tr>
      <tr>
        <td><? if($permiso20 != 3){?><a href="?modulo=producto_medidas_productos_listar.php"><img src="botones/asignar_medidas1.jpg" width="137" height="17" border="0" /></a><? }else{?><img src="botones/asignar_medidas2.jpg" width="137" height="17" border="0" /><? }?></td>
      </tr>
      <tr>
        <td><? if($permiso21 != 3){?><a href="?modulo=planillas_produccion_diarias_listar.php"><img src="botones/asignar_calibres1.jpg" width="137" height="17" border="0" /></a><? }else{?><img src="botones/asignar_calibres2.jpg" width="137" height="17" border="0" /><? }?></td>
      </tr>
      <tr>
        <td><? if($permiso22 != 3){?><a href="?modulo=producto_caracteristicas_listar.php"><img src="botones/asignar_caract_producto1.jpg" width="137" height="17" border="0" /></a><? }else{?><img src="botones/asignar_caract_producto2.jpg" width="137" height="17" border="0" /><? }?></td>
      </tr>
      <tr>
        <td><? if($permiso23 != 3){?><a href="?modulo=caracteristicas_envases_listar.php"><img src="botones/asignar_caract_envase1.jpg" width="137" height="17" border="0" /></a><? }else{?><img src="botones/asignar_caract_envase2.jpg" width="137" height="17" border="0" /><? }?></td>
      </tr>
      <tr>
        <td>
          <? if($permiso24 != 3){?><a href="?modulo=codificacion_productos.php"><img src="botones/crear_producto_1.jpg" width="137" height="17" border="0" /></a><? }else{?><img src="botones/codigo_producto2.jpg" width="137" height="17" border="0" /><? }?></td>
      </tr>
      
      <tr>
        <td>
          <? if($permiso25 != 3){?><a href="?modulo=codificacion_productos_listar.php"><img src="botones/mod_elim_producto_t_1.jpg" width="137" height="17" border="0" /></a><? }else{?><img src="botones/mod_elim_producto_t_2.jpg" width="137" height="17" border="0" /><? }?></td>
      </tr>
      <tr>
        <td><? if($permiso49 != 3){?><a href="?modulo=costo_producto_terminado.php"><img src="botones/listar_producto_terminado_1.jpg" width="137" height="17" border="0" /></a><? }else{?><img src="botones/listar_producto_terminado_2.jpg" width="137" height="17" border="0" /><? }?></td>
      </tr>

      <tr>
        <td><? if($permiso50 != 3){?><a href="?modulo=costo_producto_terminado2.php"><img src="botones/asignar_indice_producto_1.jpg" width="137" height="17" border="0" /></a><? }else{?><img src="botones/asignar_indice_producto_2.jpg" width="137" height="17" border="0" /><? }?></td>
      </tr>

      <tr>  
        <td height="17"></td>
      </tr>
  
      <tr><?if($permiso55 != 1 and $nivel_usua == 1){?>
        <td bgcolor="#CCCCCC" class="stylenegrita"><div align="center">Inventario</div></td>
      </tr><?}?>
      <tr>
        <td><?if($permiso55 != 1 and $nivel_usua == 1){?><a href="informes_excel/inv_mpn_excel.php"><img src="botones/btn_base_inv_mpn_1.jpg" width="139" height="20" border="0" /></a><? }else{?><img src="botones/btn_base_inv_mpn_2.jpg" width="139" height="20" border="0" /><? }?></td>
      </tr>
      <tr>
        <td><?if($permiso55 != 1 and $nivel_usua == 1){?><a href="informes_excel/inv_pt_excel.php"><img src="botones/btn_base_inv_1.jpg" width="139" height="20" border="0" /></a><? }else{?><img src="botones/btn_base_inv_2.jpg" width="139" height="20" border="0" /><? }?></td>
      </tr>
      <tr>
        <td><?if($permiso55 != 1 and $nivel_usua == 1){?><a href="informes_excel/inv_mpi_excel.php"><img src="botones/btn_base_inv_mpi_1.jpg" width="139" height="20" border="0" /></a><? }else{?><img src="botones/btn_base_inv_mpi_2.jpg" width="139" height="20" border="0" /><? }?></td>
      </tr>
      <tr>
        <td><?if($permiso55 != 1 and $nivel_usua == 1){?><a href="informes_excel/inv_agro_excel.php"><img src="botones/button_c-barras-agrosuper.jpg" width="139" height="13" border="0" /></a><? }else{?><img src="botones/button_c-barras-agrosuper2.jpg" width="139" height="13" border="0" /><? }?></td>
      </tr>
<!--
      <tr>
        <td><?if($permiso55 != 1 and $nivel_usua == 1){?><a href="informes_excel/stock_agro_excel.php"><img src="botones/button_stock-agrosuper.png" width="139" height="13" border="0" /></a><? }else{?><img src="botones/button_c-barras-agrosuper2.jpg" width="139" height="13" border="0" /><? }?></td>
      </tr>             
-->
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>

    </table></td>
    <td width="163" valign="top"><table width="144" border="0" align="center">
      <tr>
        <td width="138" bgcolor="#DAD9D9" class="stylenegrita"><div align="center">Movimientos</div></td>
      </tr>
      <tr>
        <td ><? if($permiso34 != 3){?><a href="?modulo=ejemplo_etiquetas_folios.php"><img src="botones/etiquetas_por_folios1.jpg" width="137" height="17" border="0" /></a><? }else{?><img src="botones/etiquetas_por_folios2.jpg" width="137" height="17" border="0" /><? }?></td>
      </tr>
      <tr>
        <td ><? if($permiso35 != 3){?><a href="?modulo=movimientos_folios.php"><img src="botones/movimientos_folios1.jpg" width="137" height="17" border="0" /></a><? }else{?><img src="botones/movimientos_folios2.jpg" width="137" height="17" border="0" /><? }?></td>
      </tr>
      <tr>
        <td></td>
      </tr>
      <tr>
        <td ><? if($permiso56 != 3){?><a href="?modulo=listar_pallet.php"><img src="botones/generar_palletpt2.jpg" width="137" height="17" border="0" /></a><? }else{?><img src="botones/generar_palletpt1.jpg" width="137" height="17" border="0"/><? } ?></td>
      </tr>
      
      <tr>
        <td ><? if($permiso36 != 3){?><a href="?modulo=capturas_folios.php"><img src="botones/capturas_folios1.jpg" width="137" height="17" border="0" /></a><? }else{?><img src="botones/capturas_folios2.jpg" width="137" height="17" border="0" /><? }?></td>
      </tr>
      <tr>
        <td ><? if($permiso37 != 3){?><a href="?modulo=listar_piking.php"><img src="botones/modificar_picking1.jpg" width="137" height="17" border="0" /></a><? }else{?><img src="botones/modificar_picking2.jpg" width="137" height="17" border="0" /><? }?></td>
      </tr>
      <tr>
        <td ><? if($permiso47 != 3){?><a href="?modulo=pedido_listar.php"><img src="botones/armar_pedid_negro.jpg" width="137" height="17" border="0" /></a><? }else{?><img src="botones/armar_pedido_gris.jpg" width="137" height="17" border="0" /><? }?></td>
      </tr>
      <tr>
        <td ><? if($permiso38 != 3){?><a href="?modulo=picking_folios.php"><img src="botones/folios_piking1.jpg" width="137" height="17" border="0" /></a><? }else{?><img src="botones/folios_piking2.jpg" width="137" height="17" border="0" /><? }?></td>
      </tr>
      <tr>
        <td ><? if($permiso47 != 3){?><a href="?modulo=picking_folios_despachados.php"><img src="botones/button_despachados.jpg" width="139" height="13" border="0" /></a><? }else{?><img src="botones/button_despachados2.jpg" width="137" height="13" border="0" /><? }?></td>
      </tr>
  

      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    
    </table></td>
    <td width="155" valign="top"><table width="141" border="0" align="center">
      <tr>
        <td bgcolor="#DAD9D9" class="stylenegrita"><div align="center">Informes</div></td>
      </tr>
      <tr>
        <td ><? if($permiso39 != 3){?><a href="?modulo=informes_folios.php"><img src="botones/informes_folios1.jpg" width="137" height="17" border="0" /></a><? }else{?><img src="botones/informes_folios2.jpg" width="137" height="17" border="0" /><? }?></td>
      </tr>
      <tr>
        <td ><? if($permiso40 != 3){?><a href="?modulo=informes_pallet_fajas.php"><img src="botones/informes_pallets_fajas1.jpg" width="137" height="17" border="0" /></a><? }else{?><img src="botones/informes_pallets_fajas2.jpg" width="137" height="17" border="0" /><? }?></td>
      </tr>
      <tr>
        <td ><!--<? //if($permiso41 != 3){?><a href="?modulo=informe_materia_prima.php"><img src="botones/informes_materia_prima1.jpg" width="137" height="17" border="0" /></a><? //}else{?><img src="botones/informes_materia_prima2.jpg" width="137" height="17" border="0" /><? //}?>--></td>
      </tr>
      <tr>
        <td ><? if($permiso42 != 3){?><a href="?modulo=informe_fajas_etiquetas.php"><img src="botones/fajas_cetiquetas1.jpg" width="137" height="17" border="0" /></a><? }else{?><img src="botones/fajas_cetiquetas2.jpg" width="137" height="17" border="0" /><? }?></td>
      </tr>
      <tr>
        <td ><? if($permiso43 != 3){?><a href="?modulo=informes_trazabilidad.php"><img src="botones/trazab_folios1.jpg" width="137" height="17" border="0" /></a><? }else{?><img src="botones/trazab_folios2.jpg" width="137" height="17" border="0" /><? }?></td>
      </tr>
      <tr>
        <td ><? if($permiso44 != 3){?><a href="?modulo=informes_folios_trazabilidad.php"><img src="botones/trazab_mat_prima1.jpg" width="137" height="17" border="0" /></a><? }else{?><img src="botones/trazab_mat_prima2.jpg" width="137" height="17" border="0" /><? }?></td>
      </tr>
      <tr>
        <td ><a href="?modulo=informes_bodegas.php"></a></td>
      </tr>
      <tr>
        <td ><? if($permiso45 != 3){?><a href="?modulo=etiquetas_pm.php"><img src="botones/etiqueta_pmaterial1.jpg" width="137" height="17" border="0" /></a><? }else{?><img src="botones/etiqueta_pmaterial2.jpg" width="137" height="17" border="0" /><? }?></td>
      </tr>
      <tr>
        <td ><? if($permiso46 != 3){?><a href="?modulo=etiquetas_pup.php"><img src="botones/etiquetas_punidad_pro1.jpg" width="137" height="17" border="0" /></a><? }else{?><img src="botones/etiquetas_punidad_pro2.jpg" width="137" height="17" border="0" /><? }?></td>
      </tr>
      <tr>
        <td >&nbsp;</td>
      </tr>
      <tr>
        <td >&nbsp;</td>
      </tr>
      <tr>
        <td >&nbsp;</td>
      </tr>    
        <tr><? if($permiso55 == 2){?> 
        <td bgcolor="#CCCCCC" class="stylenegrita" align="center">Utiles </td>
      </tr>
      <tr>
        <td class="style4" align="center"><a href="javascript:ventanaSecundaria('ejemplo.php')"><h4>Importar Folios M3</h4></a></td>
      </tr>
      <tr>
        <td class="style4" align="center"><a href="javascript:ventanaSecundaria('reservar.php')"><h4>Reserva para Reproceso</h4></a></td>
      </tr>      
      <tr>
        <td class="style4" align="center"><a href="javascript:ventanaCalendario('calendar/')"><h4>Calendario Pedidos</h4></a></td>
      </tr> 
      <tr>
        <td class="style4" align="center"><a href="javascript:ventanaCalendario('calendar2/')"><h4>Calendario Picking</h4></a></td>
      </tr> 
      <?}?>
<!--
     <tr>
        <td bgcolor="#CCCCCC" class="stylenegrita" >PRODUCION POR MES</td>
      </tr>
      <tr>
        <td class="style4" ><a href="?modulo=produccion_por_mes.php">Obtener Producci&oacute;n por mes</a></td>
      </tr>
      <tr>
        <td class="style4" >&nbsp;</td>
      </tr>
      <tr>
        <td bgcolor="#CCCCCC" class="style4" ><span class="stylenegrita">INF. DE PRODUCCION</span></td>
      </tr>
      <tr>
        <td class="style4" ><? if($permiso57 != 3){?><a href="?modulo=informes_por_planta.php">Informes de producci&oacute;n por planta</a><? }else{?>Informes de Producci&oacute;nn <? }?></td>
      </tr> -->
      <tr>
        <td class="style4" >&nbsp;</td>
      </tr>

    </table>&nbsp;</td>
  </tr>
</table>


