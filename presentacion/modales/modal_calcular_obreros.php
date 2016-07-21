
<form id="calcularObreros">
<div class="modal fade" id="calcularObreros" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">calcular Obreros</h4>
      </div>
      <div class="modal-body">
			<div id="divcantobrero">

         <div class="form-group">
            <input type="hidden" class="form-control" id="id" name="id">
          </div>
		  
		  <div class="form-group">
		  	<label for="tamano">tamaño de la actividad(unidades):</label>
			<input type="text" name="tamano" id="tamano" value="0">
		  </div>
		  <div class="form-group">
		  	<label for="renobr">rendimiento del obrero en 1 hora</label>
			<input type="text" name="renobr" id="renobr" value="1">
		  </div>
		  <div class="form-group">
		  	<label for="hrsdia">horas de trabajo diario:</label>
			<input type="text" name="hrsdia" id="hrsdia" value="8">
		  </div>
		  <div class="form-group">
		  	<label for="cantdia">cantidad de dias para completar la actividad: </label>
			<input type="text" name="cantdia" id="cantdia" value="1">
		  </div>
		  <div class="form-group">
		  	
		  	<div id="cantobr">
		  		<label for="cantobr">cantidad de obreros necesarios para la actividad: </label>
		  	</div>
			
		  </div>

          </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="btnCalcularObreros">Actualizar datos</button>
      </div>
    </div>
  </div>
</div>
</form>