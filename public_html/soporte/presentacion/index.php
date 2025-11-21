<? include("../datos/config.php");?>
<head>
		<meta charset="utf-8">
		<title>TICKET TI</title>
			<!-- Bootstrap -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/animate.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">

		<style>
		p {
		    font-size: 24px;
		    color: blue;
		}
		</style>


</head>
<body>
		<header>
			<section class="hero">
				  <div class="container">
					<div class="row hero-content">
						<div class="col-md-12">					
							<h1 class="animated fadeInDown">Ticket de Soporte TI Insuban</h1>

							<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
							  <div class="form-group">
							  	<div class="col-xs-3">
							  	<input type="hidden" name="estado" value="Abierto">
							    <label for="titulo">Solicitante:</label>
							    <input type="text" class="form-control" name="titulo" required>
							    </div>
							  </div>
							  <div class="form-group">
							   <div class="col-xs-4">
							    <label for="email">Correo:</label>
							    <input type="text" class="form-control" name="email" required>
							    </div>
							  </div>
							  <div class="form-group">
							   <div class="col-xs-4">
							    <label for="email">Categoria:</label>
							    <select name="cat">
								  <option value="Software">Software</option> 
								  <option value="Hardware">Hardware</option>
								  <option value="Citrix">Citrix</option>
								  <option value="M3">M3</option>
								  <option value="Otros">Otros</option>								  								  
								</select>
							    </div>
							  </div>							  
							  <div class="form-group">
							    <div class="col-xs-6">
							    <label for="mensaje">Requerimiento:</label>
							    <textarea class="form-control" rows="5" name="mensaje" required></textarea>
							    </div>
							  </div>
							  <div class="form-group">
							    <div class="col-xs-6">
							    <label for="mensaje">adjuntar imagen: (solo formato jpg)</label>
           						 <input type="file" class="form-control" id="image" name="image" multiple>
							    </div>
							  </div>							  
							  <input type="submit" value="Enviar ticket" name="enviar">
							</form>		
							
							<? include("../datos/config.php");

                            if($_POST['enviar']) {	

                            $mensaje = $_POST['mensaje'];
                            $mensajef = utf8_decode($mensaje);	

							$anexo_user = mysql_query("SELECT anexo FROM anexos where correo = '".$_POST['email']."' ");
							$anexo = mysql_fetch_array($anexo_user); 
                                
 							$image = $_FILES['image']['tmp_name'];
        					$imgContenido = addslashes(file_get_contents($image));												
							
							$ip = php_uname('n');
							$date=date('d-m-Y H:i:s');
                            
                            $enviarticket = mysql_query("INSERT INTO tickets_soporte (titulo, email, mensaje, estadoReporte, fecha, tickets_soporte_name, anexo, imagenes, categoria ) values ('".$_POST['titulo']."', '".$_POST['email']."','$mensajef', '".$_POST['estado']."',  '$date', '$ip', '$anexo[0]', '$imgContenido', '$cat' )");
							}

							if($enviarticket) {
							$InfoEnvio = '<font color="Blue"><b>Ticket Recibido. </b><br> Si necesita enviar otro Ticket, pinche <a href=""> AQUÍ.</a>.</font>';
							}?>

<!--							else {
							$InfoEnvio = '<font color="Orange"><b>No se ha podido enviar el ticket a soporte. </b><a href=""> Intente nuevamente</a>.</font>';
							}?>
-->
							<br><br>
							<?=$InfoEnvio?>

							<br>
							<? include("../datos/config.php");

							$cuentaticket = mysql_query("SELECT * FROM tickets_soporte ORDER BY id DESC LIMIT 1");
							$ticket = mysql_fetch_array($cuentaticket);

							$email = $ticket['email'];
							$soporte = "soporte@insuban.cl";

							{?>
							<? if($enviar) { 
							echo "<p><b>SU N° DE TICKET ES: 0$ticket[0]</b></p>";
							
							$to = "$email , $soporte"; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
							$email_subject = "$mensajef";
//							$email_body = " RESUMEN: $mensaje \n FECHA:      $date \n ESTADO:   $estado \n\n TICKET Nº: 00$ticket[0]\n \n \n REQUERIMIENTO: \n\n  $mensaje. \n";
							$email_body = " 
****************************************************
*					                                
*\tTICKET:\t 0$ticket[0]
*						
****************************************************
SOLICITANTE: \t $titulo
ASUNTO:\t $mensajef
FECHA:\t\t $date
ESTADO:\t $estado

****************************************************							
REQUERIMIENTO: 
$mensajef
						
*****************************************************
Guarde este numero de ticket para realizar seguimiento.\n
No responda este mail.

Soporte Insuban Spa. 2020. ";
							$headers = "From: noreply@insuban.cl\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
							$headers .= "Reply-To: $email ";	
							mail($to,$email_subject,$email_body,$headers);
						    } ?>   
						</div>
					</div>
				</div>
			</section>
		</header>
		<? } ?>
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>

<!-- *************************************************************************************** -->
