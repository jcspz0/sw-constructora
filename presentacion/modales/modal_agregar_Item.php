<?php require_once("itemP.php");
    $itemP=new ItemP();
    $idProyecto=$_REQUEST['id']; 
    ?>
<form id="guardarDatos">
<div class="modal fade" id="dataRegister" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Agregar item</h4>
      </div>
      <div class="modal-body">
			<div id="datos_ajax_register"></div>
          <div>
            <label for="nombre">tipo de actividad  :</label>
             <?php
                $itemP->obtenerTipo();
             ?>
            </div>
                                            <div class="form-group">
                                                <label for="nombre">actividad  :</label>
										        <select name="actividad" id="actividad">
                                                    <option value=0>elija un tipo de actividad</option>
    
                                                </select> 
                                            </div>

                                            <div class="form-group">
                                                <label for="nombre">tamaño(u) :</label>
                                                <input type="text" name="tamano" value="100">
                                            </div>

                                            <div class="form-group">
                                                <label for="nombre">duracion  :</label>
										    	<input type="text" name="duracion" value="1">
										    </div>

                                            <div class="form-group">
                                                <label for="nombre">actividad previa :</label>
										                           <?php 
                                                    $itemP->actividadesProyecto($idProyecto) 
                                                ?>
                                            </div>

                                            <div class="form-group">
                                                <input class="" name="crearItem" type="hidden" value="crear3">
                                            </div>

                                            <div class="form-group">
                                                <input class="" name="idProyecto" type="hidden" value="<?php echo $idProyecto ?>">
                                            </div>
                                            <input type="hidden" name="id" value='<?php echo $_REQUEST['id']; ?>'>
          
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar datos</button>
      </div>
    </div>
  </div>
</div>
</form>

