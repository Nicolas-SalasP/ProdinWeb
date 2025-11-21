<? include("../../datos/config.php");
$seleccionarticket = mysql_query("SELECT * FROM tickets_soporte where id=$id");
while($mostrarticket = mysql_fetch_array($seleccionarticket)) {

$mail = $mostrarticket[email];
$mensaje = $mostrarticket[mensaje];
$mensajef = utf8_encode($mensaje);
$soporte = "soporte@insuban.cl";

//var_dump($id);
?>
<meta charset="utf-8">
<h3>TICKET N°: <?=$id?></h3><br>
<form action="" method="post">
<input type="hidden" name="id" value="<?=$id?>">
<input type="hidden" name="estado" value="Cerrado">
REQUERIMIENTO : <br>
<label><? echo $mensajef;?></label><br><br>
SOLUCION : <br>
<textarea rows="8" name="solucion" cols="41" required></textarea><br><br>
<input type="submit" value="Guardar" name="enviar">
<input type='button' value='Cancelar' onclick='window.close();' />
</form>


<?
if($_POST['enviar']) {

$solucion = $_POST['solucion'];
$solucionf = utf8_decode($solucion);

$date=date('d-m-Y H:i:s');
$grabarSolu = mysql_query("UPDATE tickets_soporte SET solucion='$solucionf', estadoReporte='$_POST[estado]', fechaSoporte='$date' WHERE id='$id' ");
if($grabarSolu) {
$InfoEnvio = '<font color="#00FF00"><b>Solución anexada correctamente.<a href="#" onclick="window.close();">Cerrar</a></b></font>';
}else {
$InfoEnvio = '<font color="#FF0000"><b>No se ha podido anexar la información.<a href="">Recargar pagina</a></b></font>';
}

		$to = "$mail"; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
		$email_subject = "$mensaje";
		$email_body = " RESUMEN: $mensaje \n FECHA:      $date \n ESTADO:   $estado \n\n SOLICITUD: 0$id \n\n\n RESPUESTA: $solucionf \n\n\n **** SE DA POR CERRADO ESTE TICKET ****\n                    Gracias por utilizar Ticket TI\n              Derechos Reservados Insuban Spa.";
		$headers = "From: noreply@insuban.cl\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
		$headers .= "Reply-To: $mail ";	
		mail($to,$email_subject,$email_body,$headers);

}
}?>
<br>
<?=$InfoEnvio?>