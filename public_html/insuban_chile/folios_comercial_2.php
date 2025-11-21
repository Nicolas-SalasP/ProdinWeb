<?php
$query1=mysql_query("SELECT *
FROM pedido_tabla as pt, pedido as pd, destinos as ds
where pt.id_pedidos = pd.id_pedidos and pd.id_destinos = ds.id_destinos
and pd.folio_piking = 0 and pd.fecha_prioridad != '0000-00-00' order by pd.fecha_prioridad desc, pt.id_cruce_tablas  ");
?>

<head>
<script src="http://code.jquery.com/jquery-latest.min.js"></script> 
<style>
.resaltar{background-color:#FF0;}
</style> 
  <script type='text/javascript' >
    $.expr[':'].icontains = function(obj, index, meta, stack){
    return (obj.textContent || obj.innerText || jQuery(obj).text() || '').toLowerCase().indexOf(meta[3].toLowerCase()) >= 0;
    };
    $(document).ready(function(){   
        $('#buscador').keyup(function(){
                     buscar = $(this).val();
                     $('#lista tr').removeClass('resaltar');
                            if(jQuery.trim(buscar) != ''){
                               $("#lista tr:icontains('" + buscar + "')").addClass('resaltar');
                            }
            });
    });   
 </script> 
</head>

<p>Buscar :<input name="buscador" id="buscador" type="text" /></p>

<center><a href="informes_excel/folios_comercial_excel.php">Exportar a Excel</a></center>

<TABLE  id="lista" BORDER WIDTH="100%">
<tr><th>Fecha</th><th>Destino</th><th>Codigo Prod</th><th>Cantidad</th></tr>

<? while($row = mysql_fetch_row($query1)) {

$pedido =$row[1];
$codProd =$row[2];
$cantidad =$row[3];
$fechaD =$row[16];
$dateD =format_fecha_sin_hora($fechaD);
$destino =$row[26]; 

echo "<TR><TD>" .$dateD. "</TD><TD>" .$destino. "</TD><TD>" .$codProd. "</td><td>" .$cantidad. "</TD></TR>";
}

?>	
</TABLE>