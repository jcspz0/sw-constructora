<form id="modificarDatosAnalisis"  method="post" action="analisisP.php">
<div class="modal fade" id="modificarAnalisis" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">modificar Item de Analisis de Precio Unitario</h4>
      </div>
      <div class="modal-body">
      <div id="datos_ajax_register"></div>

<div id="divModificarAnalisis">
          <div class="form-group">
            <label for="codigo0" class="control-label">Descrsssipcion:</label>
            <input type="text" class="form-control" id="descripcion" name="descripcion" >
      </div>
      <div class="form-group">
            <label for="nombre0" class="control-label">Unidad:</label>
            <input type="text" class="form-control" id="unidad" name="unidad" >
          </div>
      <div class="form-group">
            <label for="moneda0" class="control-label">Rendimiento:</label>
            <input type="text" class="form-control" id="rendimiento" name="rendimiento" >
          </div>
      <div class="form-group">
            <label for="capital0" class="control-label">Precio Unitario:</label>
            <input type="text" class="form-control" id="precio" name="precio"> 
          </div>
          
          <input type="hidden" name="idItem" value="<?php echo $_REQUEST['idItem'] ?>">
          <input type="hidden" name="crearAnalisis" value="crear">
          <input class="" name="idProyecto" type="hidden" value="<?php echo $_REQUEST['idProyecto'] ?>">
</div>
            
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar datos</button>
      </div>
    </div>
  </div>
</div>
</form>