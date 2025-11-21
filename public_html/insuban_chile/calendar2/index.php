<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Calendario</title>
	<link rel="stylesheet" href="">
	<link rel="stylesheet" type="text/css" href="css/fullcalendar.min.css">
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/home.css">
</head>
<body>

<?php
require "config.php";
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");

  $SqlEventos   = ("SELECT p.id_paking_relacion, p.folio_piking , p.id_paking , ef.id_pedidos, p.fecha_ingreso_paking, p.fdespacho_piking, ef.factura, e.estado_folio, e.id_estado_folio, count( DISTINCT ef.id_etiquetados_folios) AS cf
, d.destinos AS destinos from paking AS p, etiquetados_folios AS ef, estado_folio AS e, destinos AS d 
where  ef.id_estado_folio = e.id_estado_folio and p.id_etiquetados_folios = ef.id_etiquetados_folios and ef.id_destinos=d.id_destinos and ef.id_estado_folio = 3 
group by p.id_paking_relacion order by p.folio_piking  desc");
 
 $resulEventos = mysql_query($SqlEventos);

?>
<div class="mt-5"></div>

<div class="container">
  <div class="row">
    <div class="col msjs">
      <?php
        include('msjs.php');
      ?>
    </div>
  </div>

<div class="row">
  <div class="col-md-12 mb-3">
  <h3 class="text-center" id="title">Calendario Picking</h3>
  </div>
</div>
</div>



<div id="calendar"></div>


<?php  
//  include('modalNuevoEvento.php');
  include('modalUpdateEvento.php');
?>

<script src ="js/jquery-3.0.0.min.js"> </script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<script type="text/javascript" src="js/moment.min.js"></script>	
<script type="text/javascript" src="js/fullcalendar.min.js"></script>
<script src='locales/es.js'></script>

<script type="text/javascript">
$(document).ready(function() {
  $("#calendar").fullCalendar({
    header: {
      left: "prev,next today",
      center: "title",
      right: "month,agendaWeek,agendaDay"
    },

    locale: 'es',

    defaultView: "month",
    navLinks: true, 
    editable: false,
    eventLimit: true, 
    selectable: true,
    selectHelper: false,

//Nuevo Evento
//  select: function(start, end){
//      $("#exampleModal").modal();
//      $("input[name=fecha_inicio]").val(start.format("DD-MM-YYYY"));
       
//      var valorFechaFin = end.format("DD-MM-YYYY");
//      var F_final = moment(valorFechaFin, "DD-MM-YYYY").subtract(1, 'days').format('DD-MM-YYYY'); //Le resto 1 dia
//      $('input[name=fecha_fin').val(F_final);  

//    },
      
    events: [
      <?php
       while($dataEvento = mysql_fetch_array($resulEventos)){ ?>                                                     
          {
          _id:   '<?php echo $dataEvento[folio_piking]; ?>',
          title: '<?php echo utf8_encode($dataEvento[destinos]) ?>',
          start: '<?php echo $dataEvento[fdespacho_piking]; ?>',
          fact: '<?php echo $dataEvento[factura]; ?>',
          ped: '<?php echo $dataEvento[id_pedidos]; ?>',          
          color: 'Blue'
          },
 
        <?php } ?>
    ],

/*
//Eliminar Evento
eventRender: function(event, element) {
    element
      .find(".fc-content")
      .prepend("<span id='btnCerrar'; class='closeon material-icons'>&#xe5cd;</span>");
    
    //Eliminar evento
    element.find(".closeon").on("click", function() {

  var pregunta = confirm("Deseas Borrar este Evento?");   
  if (pregunta) {

    $("#calendar").fullCalendar("removeEvents", event._id);

     $.ajax({
            type: "POST",
            url: 'deleteEvento.php',
            data: {id:event._id},
            success: function(datos)
            {
              $(".alert-danger").show();

              setTimeout(function () {
                $(".alert-danger").slideUp(500);
              }, 3000); 

            }
        });
      }
    });
  },


//Moviendo Evento Drag - Drop
eventDrop: function (event, delta) {
  var idEvento = event._id;
  var start = (event.start.format('DD-MM-YYYY'));
  var end = (event.end.format("DD-MM-YYYY"));

    $.ajax({
        url: 'drag_drop_evento.php',
        data: 'start=' + start + '&end=' + end + '&idEvento=' + idEvento,
        type: "POST",
        success: function (response) {
          $("#respuesta").html(response);
        }
    });
},
*/

//Modificar Evento del Calendario 
eventClick:function(event){
    var idEvento = event._id;
    var fact = event.fact;
    var ped = event.ped;    
    $('input[name=idEvento').val(idEvento);
    $('input[name=evento').val(event.title);
    $('input[name=fecha_inicio').val(event.start.format('DD-MM-YYYY'));
    $('input[name=fact').val(fact);
    $('input[name=ped').val(ped);    

    $("#modalUpdateEvento").modal();
  },


  });


//Oculta mensajes de Notificacion
  setTimeout(function () {
    $(".alert").slideUp(300);
  }, 2000); 


});

</script>



</body>
</html>