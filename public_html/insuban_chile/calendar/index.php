<?php error_reporting(0); ini_set('display_errors', 0); ?>
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

  $SqlEventos   = ("SELECT *
FROM pedido AS p
left outer join destinos as d on p.id_destinos = d.id_destinos
left outer join observaciones as o on p.id_pedidos = o.id_pedido
WHERE p.fech_ingreso_pedido != '0000-00-00' and p.folio_piking = 0 and p.fech_envio_picking = '0000-00-00'
group by p.id_pedidos asc");
 
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
                <h3 class="text-center" id="title">Calendario Pedidos</h3>
            </div>
        </div>
    </div>

    <div id="calendar"></div>
    <?php include('modalUpdateEvento.php'); ?>

    <script src="js/jquery-3.0.0.min.js"> </script>
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

            events: [
                <?php
  while($dataEvento = mysql_fetch_array($resulEventos)){ ?> {
                    _id: '<?php echo $dataEvento['id_pedidos']; ?>',
                    title: '<?php echo utf8_encode($dataEvento['destinos']) ?>',
                    start: '<?php echo $dataEvento['fecha_prioridad']; ?>',
                    notas: '<?php echo utf8_decode(trim(preg_replace('/[\t\n\r\s]+/', ' ',$dataEvento['observacion']))) ?>',
                    color: 'Green'
                },

                <?php } ?>
            ],

            //Modificar Evento del Calendario 
            eventClick: function(event) {
                var idEvento = event._id;
                var notas = event.notas;
                $('input[name=idEvento').val(idEvento);
                $('input[name=evento').val(event.title);
                $('input[name=fecha_inicio').val(event.start.format('DD-MM-YYYY'));
                $('textarea[name=notas').val(notas);

                $("#modalUpdateEvento").modal();
            },


        });


        //Oculta mensajes de Notificacion
        setTimeout(function() {
            $(".alert").slideUp(300);
        }, 2000);

    });
    </script>
</body>

</html>