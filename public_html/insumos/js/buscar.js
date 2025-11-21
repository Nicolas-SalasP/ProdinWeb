$(document).ready(function(){

$('#articulo').focus()
$('#articulo').on('keyup', function(){
	var articulo = $('#articulo').val()
	$.ajax({
		type: 'POST',
		url: 'php/buscar.php',
		data: {'articulo': articulo},
		beforeSend: function(){
			$('#result').html()
		}
	})
})
})