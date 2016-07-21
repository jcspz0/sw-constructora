<?php 
	include_once("head.php"); 
 ?>

<?php 
 $_REQUEST['idProyecto'];
 $_REQUEST['idItem'];
 require_once("analisisP.php");
 $analisis=new AnalisisP();
 $lista=$analisis->listaAnalisis_IdItem($_REQUEST['idItem']);
 ?>


<script type="text/javascript">
	
	$('#guardarDatosAnalisis').submit(function( event ) {
		var parametros = $(this).serialize();
			 $.ajax({
					type: "POST",
					url: "analisisP.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#datos_ajax_register").html("Mensaje: Cargando...");
					  },
					success: function(datos){
					$("#datos_ajax_register").html(datos);
					
					load(1);
				  }
			});
		  event.preventDefault();
	});

	$('#modificarDatosAnalisis').submit(function( event ) {
		var parametros = $(this).serialize();
			 $.ajax({
					type: "POST",
					url: "analisisP.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#datos_ajax_register").html("Mensaje: Cargando...");
					  },
					success: function(datos){
					$("#datos_ajax_register").html(datos);
					
					load(1);
				  }
			});
		  event.preventDefault();
	});

	$(function(){
	    $("#btnModificar").click(function(){

	    	

	    	tamano=$("#divcantdia #tamano").val();
	    	renObr=$("#divcantdia #renobr").val();
	    	HrsDia=$("#divcantdia #hrsdia").val();
	    	cantObr=$("#divcantdia #cantobr").val();

	    	res=getCantDias(tamano,renObr,HrsDia,cantObr);
            $("#divcantdia #cantdia").html("<label for=\"cantdia\">cantidad de dias para completar la actividad: "+res+" </label>");
          	
        });

    });
	

</script>



 <div class="container-fluid">
	 
		<div class='col-xs-6'>	
			<h3> Analisis de Precio Unitario</h3>
		</div>
		<div class='col-xs-6'>
			<h3 class='text-right'>		
				<button type="button" class="btn btn-default" data-toggle="modal" data-target="#dataRegister1"><i class='glyphicon glyphicon-plus'></i> Agregar</button>
				<a href="gestionarActividadP.php?id=<?php echo $_REQUEST['idProyecto'] ?>" class="btn btn-primary">volver</a>
			</h3>
		</div>	
	
		<?php 
			$analisis->listarAnalisis($_REQUEST['idItem']);
		 ?>
	  
</div>
	

	
<?php 
	include_once("modales/modal_agregar_Analisis.php");
	//include_once("modales/modal_modificar_Analisis.php");
 ?>
<?php 
	include_once("foot.php");
 ?>