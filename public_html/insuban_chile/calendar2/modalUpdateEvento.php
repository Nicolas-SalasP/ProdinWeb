<div class="modal" id="modalUpdateEvento"  tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Detalle</h5>
<!--        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> -->
      </div>
  
  <form name="formEventoUpdate" id="formEventoUpdate" action="UpdateEvento.php" class="form-horizontal" method="POST">
    
    <input type="hidden" class="form-control" name="idEvento" id="idEvento">
    <div class="form-group">
      <label for="idEvento" class="col-sm-12 control-label"> Picking</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="idEvento" id="idEvento" placeholder="Pedido" disabled/>
      </div>
    </div>
    <div class="form-group">
      <label for="evento" class="col-sm-12 control-label"> Destino</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="evento" id="evento" placeholder="Destino" disabled/>
      </div>
    </div>
    <div class="form-group">
      <label for="fecha_inicio" class="col-sm-12 control-label"> Fecha Despacho</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="fecha_inicio" id="fecha_inicio" placeholder="Fecha Prioridad" disabled/>
      </div>
    </div>
    <div class="form-group">
      <label for="notas" class="col-sm-12 control-label"> Factura</label>
      <div class="col-sm-10">
     <input  class="form-control" name="fact" id="fact" disabled /> 
      </div>
    </div>
     <div class="form-group">
      <label for="notas" class="col-sm-12 control-label"> Pedido Asociado</label>
      <div class="col-sm-10">
     <input  class="form-control" name="ped" id="ped" disabled /> 
      </div>
    </div>


     <div class="modal-footer">
<!--       <button type="submit" class="btn btn-success">Actualizar</button> 
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>  -->
      </div>
 
  </form>
      
    </div>
  </div>
</div>