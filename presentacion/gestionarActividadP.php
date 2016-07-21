
	<?php
		include_once("head.php"); 
		require_once("actividadP.php");
		$n=new ActividadP();
 	?>

 <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">

  <script>
  $(function() {
    $( "#datepicker" ).datepicker();
  });
  </script>
  <script  >
        if (document.addEventListener) { 
           document.addEventListener("DOMContentLoaded", inicializar, false);
        }


			function actualizarFecha(){
				$.post("../ajax/actualizarFecha.php", $("#formulario").serialize(), function(data){
                    $("#fecha").html(data);
                });
        	}
</script>
  	<div style="" class="col-md-3">
	 	<a class="btn btn-primary" href="crearItem2P.php?idProyecto=<?php echo $_REQUEST['id']; ?>">agregar actividad</a>

	 	<a class="btn btn-primary" href="gestionarProyectoP.php?id=<?php echo $_REQUEST['id']; ?>">volver</a>
 	</div>
 	<form method="POST" id="formulario">
 		<div id="fecha" style="" class="col-md-3">
            <label for="nombre">Fecha Inicial: <?php echo $n->getFechaProyecto($_REQUEST['id']); ?></label>
            <input class="form-control" name="fechaIni" type="date" ><br>
        </div>
        <div style="" class="col-md-3">
        	<input type="hidden" name="id" value='<?php echo $_REQUEST['id']; ?>'>
        	<input  class="btn btn-primary" type="button" value="actualizar fecha" onclick="actualizarFecha()">
        </div>
 	</form>

	<?php 
		
		$n->listarActividades($_REQUEST['id']);
	 ?>

	<?php 
		include_once("foot.php");
	 ?>