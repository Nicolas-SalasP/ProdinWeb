<?php
   include('../controlador/session.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Sistema de Pedidos</title>
   <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/css/select2.min.css" rel="stylesheet" />
  </head>
  <body>
  
    <div class="container">
		  <div class="row-fluid">
		  
			<div class="col-md-12">
			<h2><span class="glyphicon glyphicon-cloud"></span> Nueva Solicitud</h2>
			<hr>
			<form class="form-horizontal" role="form" id="datos_pedido">
				<div class="row">
				  
				  <div class="col-md-3">
				  <label for="proveedor" class="control-label">Seleccionar Area</label>
					 <select class="proveedor form-control" id="proveedor" required>
					</select>
				  </div>
				  
					<div class="col-md-3">
						<label for="solicitante" class="control-label">Solicitante</label>
						<input type="text" class="form-control input-sm" id="solicitante" value="<?php echo $login_session; ?>">
					</div>
<!--					
					<div class="col-md-2">
						<label for="condiciones" class="control-label">Condiciones de pago</label>
						<input type="text" class="form-control input-sm" id="condiciones" value="Contado" required>
					</div>
					
					<div class="col-md-4">
						<label for="comentarios" class="control-label">Comentarios</label>
						<input type="text" class="form-control input-sm" id="comentarios" placeholder="Comentarios o instruciones especiales">
					</div>
-->							
				</div>
						
				
				<hr>
				<div class="col-md-12">
					<div class="pull-right">
						<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">
						 <span class="glyphicon glyphicon-plus"></span> Agregar productos
						</button>
						<button type="submit" class="btn btn-default">
						  <span class="glyphicon glyphicon-send"></span> Solicitar
						</button>
					</div>	
				</div>
			</form>
			<br><br>
		<div id="resultados" class='col-md-12'></div><!-- Carga los datos ajax -->
	
			<!-- Modal -->
			<div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			  <div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Buscar productos</h4>
				  </div>
				  <div class="modal-body">
					<form class="form-horizontal">
					  <div class="form-group">
						<div class="col-sm-6">
						  <input type="text" class="form-control" id="q" placeholder="Buscar productos" onkeyup="load(1)">
						</div>
						<button type="button" class="btn btn-default" onclick="load(1)"><span class='glyphicon glyphicon-search'></span> Buscar</button>
					  </div>
					</form>
					<div id="loader" style="position: absolute;	text-align: center;	top: 55px;	width: 100%;display:none;"></div><!-- Carga gif animado -->
					<div class="outer_div" ></div><!-- Datos ajax Final -->
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					
				  </div>
				</div>
			  </div>
			</div>
			
			</div>	
		 </div>
	</div>

   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	<script type="text/javascript" src="js/VentanaCentrada.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js"></script>
	<script>
		$(document).ready(function(){
			load(1);
		});

		function load(page){
			var q= $("#q").val();
			var parametros={"action":"ajax","page":page,"q":q};
			$("#loader").fadeIn('slow');
			$.ajax({
				url:'../ajax/productos_pedido.php',
				data: parametros,
				 beforeSend: function(objeto){
				 $('#loader').html('<img src="../img/ajax-loader.gif"> Cargando...');
			  },
				success:function(data){
					$(".outer_div").html(data).fadeIn('slow');
					$('#loader').html('');
					
				}
			})
		}
	</script>
	<script>
	function agregar (id)
		{
			var precio_venta=$('#precio_venta_'+id).val();
			var cantidad=$('#cantidad_'+id).val();
			var proveedor=$('#proveedor_'+id).val();
			var solicitante=$('#solicitante_'+id).val();
/*			//Inicia validacion
			if (isNaN(cantidad))
			{
			alert('Esto no es un numero');
			document.getElementById('cantidad_'+id).focus();
			return false;
			}
			if (isNaN (precio_venta))
			{
			alert('Esto no es un numero');
			document.getElementById('precio_venta_'+id).focus();
			return false;
			}
			//Fin validacion
*/			
		var parametros={"proveedor":proveedor,"solicitante":solicitante, "id":id,"precio_venta":precio_venta,"cantidad":cantidad};	
		$.ajax({
        type: "POST",
        url: "../ajax/agregar_pedido.php",
        data: parametros,
		 beforeSend: function(objeto){
			$("#resultados").html("Mensaje: Cargando...");
		  },
        success: function(datos){
		$("#resultados").html(datos);
		}
			});
		}
		
			function eliminar (id)
		{
			
			$.ajax({
        type: "GET",
        url: "../ajax/agregar_pedido.php",
        data: "id="+id,
		 beforeSend: function(objeto){
			$("#resultados").html("Mensaje: Cargando...");
		  },
        success: function(datos){
		$("#resultados").html(datos);
		}
			});

		}
		
		$("#datos_pedido").submit(function(){
		  var proveedor = $("#proveedor").val();
		  var solicitante = $("#solicitante").val();
//		  var condiciones = $("#condiciones").val();
//		  var comentarios = $("#comentarios").val();
		  if (proveedor>0)
		 {
			VentanaCentrada('../pdf/documentos/pedido_pdf.php?proveedor='+proveedor+'&transporte='+solicitante+'&condiciones='+condiciones+'&comentarios='+comentarios,'Pedido','','1024','768','true');	
		 } else {
			 alert("Selecciona el Area");
			 return false;
		 }
		 
	 	});
	</script>
	
	
<script type="text/javascript">
$(document).ready(function() {
    $( ".proveedor" ).select2({        
    ajax: {
        url: "../ajax/load_proveedores.php",
        dataType: 'json',
        delay: 250,
        data: function (params) {
            return {
                q: params.term // search term
            };
        },
        processResults: function (data) {
            return {
                results: data
            };
        },
        cache: true
    },
    minimumInputLength: 1
});
});
</script>
  </body>
</html>