
<?php 
	include_once("head.php");
 ?>
<script src="../lib/codebase/ext/dhtmlxgantt.js"></script>   
<link href="../lib/codebase/ext/dhtmlxgantt.css" rel="stylesheet"> 
<script src="../lib/codebase/ext/dhtmlxgantt_undo.js"></script> 
<script src="../lib/codebase/ext/dhtmlxgantt_critical_path.js" type="text/javascript" charset="utf-8"></script>  
<div id="gantt_here" style='width:1000px; height:500px;'></div>
 <style>
  html, body{
    background:gray;
    padding:10px;
  }
  #gantt_here{
    background:white;
    width:600px; 
    height:600px;
  }

 		.deadline {
			position: absolute;
			border-radius: 12px;
			border: 2px solid #585858;
			-moz-box-sizing: border-box;
			box-sizing: border-box;

			width: 22px;
			height: 22px;
			margin-left: -11px;
			margin-top: 6px;
			z-index: 1;
			background: url("../lib/codebase/common/deadline_icon.png") center no-repeat;
		}

		.overdue-indicator {
			width: 24px;
			margin-top: 5px;
			height: 24px;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			border-radius: 17px;
			color: white;
			background: rgb(255, 60, 60);
			line-height: 25px;
			text-align: center;
			font-size: 24px;
		}

		.gantt_task_cell.week_end{
			background-color: #EFF5FD;
		}
		.gantt_selected .gantt_task_cell.week_end{
			background-color: #f0e493;
		}

</style>

    <script type="text/javascript">
    //----cargado de datos-------------------------------
    	
    function cargarTasks(){
    	return 	{
    	data:[
    		<?php 
    			require_once("../negocio/itemN.php");
            	require_once("../negocio/actividadN.php");
            	$itemN=new ItemN();
            	$actividadN=new ActividadN();
            	$items=$itemN->listaItem_IdProyecto_tipo0($_REQUEST['id']);
            	foreach ($items as $item ) {
            		$actividad=$actividadN->obtenerActividad_IdActividad($item['idActividad']);
            		echo '{';
            		echo 'id:'.$item['idItem'].',';
            		echo 'idItem:'.$item['id'].',';
            		echo 'text:"'.$actividad['nombre'].'",';
            		//echo 'Limite:"'.$itemN->getFechaIG($item['id']).'",';
            		echo 'start_date:"'.$itemN->getFechaIG($item['idItem']).'",';
            		//echo 'deadline:new Date('.$itemN->getFechaF($item['id']).'),';
            		echo 'deadline:""'.',';
            		echo 'duration:'.$itemN->getDuracion($item['id']).',';
            		echo 'tamano:'.$item['tamano'].',';
            		echo 'renobr:'.$actividad['renobr'];
            		echo '},';
            	}
    		 ?>
    		//{id:1, text:"Project #1",start_date:"01-04-2013", duration:11}
    	],
    	links:[
    		<?php 
    			$items=$itemN->listaItemGantt_IdProyecto($_REQUEST['id']);
            	foreach ($items as $item ) {
            		if($item['predecesor']!="0"){
            			echo '{';
            			echo 'id:'.$item['idItem'].',';
            			echo 'source:'.$item['predecesor'].',';
            			echo 'target:'.$item['idItem'].',';
            			echo 'type:gantt.config.links.finish_to_start';
            			echo '},';
            		}
            	}
    		 ?> 
    	]
    };
    
    }

    var tasks = cargarTasks();

    tasksGlobal = cargarTasks();
    //----------------------------------

    

    //---------------
    gantt.config.fit_tasks = true; 
    	
	gantt.config.scale_unit = "day";
	gantt.config.step = 1;
	gantt.config.date_scale = "%d"; 
	gantt.config.subscales = [
			{unit:"month", step:1, date:"%M"}
		];
	gantt.config.min_column_width = 50;
	gantt.config.scale_height = 90;
	gantt.config.undo = true;
	gantt.config.redo = true;

	gantt.attachEvent("onBeforeTaskChanged", function(id, mode, old_task){
	    var task = gantt.getTask(id);
	    if(mode == gantt.config.drag_mode.progress){
	        if(task.progress < old_task.progress){
	            dhtmlx.message(task.text + " progress can't be undone! " +id.text+"--"+mode.text+"--");
	            return false; 
	        }
	    }
	    return true;
	});

	gantt.locale.labels.deadline_enable_button = 'Agregar';
	gantt.locale.labels.deadline_disable_button = 'Remover';
	

	gantt.config.lightbox.sections = [
		{name: "description", height: 70, map_to: "text", type: "textarea", focus: true},
		{name: "time", map_to: "auto", type: "duration"},
		{name: "deadline", map_to: {start_date:"deadline"},
			type: "duration_optional",
			button: true,
			single_date: true}
	];

	gantt.config.columns = [
		{name: "overdue", label: "", width: 38, template: function (obj) {
			if (obj.deadline) {
				var deadline = gantt.date.parseDate(obj.deadline, "xml_date");
				if (deadline && obj.end_date > deadline) {
					return '<div class="overdue-indicator">!</div>';
				}
			}
			return '<div></div>';
		}
		},
		{name: "text", label: "Actividad", width: "*", tree: true, resize: true },
		{name: "start_date", label: "Fecha inicial", align: "center", width:80 },
		{name: "deadline", label: "Plazo", width:80, align: "center" },
		{name: "duration", label: "Duracion", align: "center", width: 60 },
		//{name: "add", label: "", width: 36 }
	];
	gantt.config.grid_width = 420;
	gantt.locale.labels.section_deadline = "Deadline";

	gantt.addTaskLayer(function draw_deadline(task) {
		if (task.deadline) {
			var el = document.createElement('div');
			el.className = 'deadline';
			var sizes = gantt.getTaskPosition(task, task.deadline);

			el.style.left = sizes.left + 'px';
			el.style.top = sizes.top + 'px';

			el.setAttribute('title', gantt.templates.task_date(task.deadline));
			return el;
		}
		return false;
	});

	function caminoCritico(toggle){
		toggle.enabled = !toggle.enabled;
		if(toggle.enabled){
			toggle.innerHTML = "ocultar camino critico";
			gantt.config.highlight_critical_path = true;
		}else{
			toggle.innerHTML = "mostrar camino critico";
			gantt.config.highlight_critical_path = false;
		}
		gantt.render();
	}

	gantt.templates.task_class = function (start, end, task) {
		if (task.deadline && end.valueOf() > task.deadline.valueOf()) {
			return 'overdue';
		}
	};

	gantt.templates.rightside_text = function (start, end, task) {
		if (task.deadline) {
			if (end.valueOf() > task.deadline.valueOf()) {
				var overdue = Math.ceil(Math.abs((end.getTime() - task.deadline.getTime()) / (24 * 60 * 60 * 1000)));
				var text = "<b>retrasado: " + overdue + " dias</b>";
				return text;
			}
		}
	};

	function mes(){
		gantt.config.scale_unit = "month"; 
		gantt.config.date_scale = "%M"; 
		gantt.templates.scale_cell_class = function(date){
		    if(date.getDay()==0||date.getDay()==30){
		        return "month";
		    }
		};
		gantt.config.subscales = [];
		gantt.render();
	}

	function semana(){
		gantt.config.scale_unit = "week"; 
		gantt.config.date_scale = "%W, %M"; 
		gantt.templates.scale_cell_class = function(date){
			var firstDay = new Date(date.getFullYear(), date.getMonth(), 1).getDay(),
			week = Math.ceil((date.getDate() + firstDay)/7);
			if((gantt.date.month_start(date)).getDay() != 1){ //If week starts at Monday
			week--;
			}
			return "Semana " + String(week);
			};
		gantt.config.subscales = [
			{unit:"week", step:1, template:weekScaleTemplate}
		];
		gantt.render();
	}

	function dia(){
		gantt.config.scale_unit = "day"; 
		gantt.config.date_scale = "%d"; 
		gantt.templates.scale_cell_class = function(date){
		    if(date.getDay()==0||date.getDay()==1){
		        return "day";
		    }
		};
		gantt.config.subscales = [
			{unit:"month", step:1, date:"%M"}
		];
		gantt.render();
	}

	

	var weekScaleTemplate = function(date){
		var firstDay = new Date(date.getFullYear(), date.getMonth(), 1).getDay(),
		week = Math.ceil((date.getDate() + firstDay)/7);
		if((gantt.date.month_start(date)).getDay() != 1){ //If week starts at Monday
		week--;
		}
		return "Semana " + String(week);
	};

	function undo(){
		gantt.undo();
	}

	function redo(){
		gantt.redo();
	}

	

	gantt.attachEvent("onTaskLoading", function(task){
		if(task.deadline){
			//console.log("taskloading");
			//task.deadline = gantt.date.parseDate(task.deadline, "xml_date");
			//task.deadline = ""
		}	
		//console.log(task.text);	

		//task.deadline ;

		return true;
	});

	gantt.attachEvent("onTaskSelected", function(id,item){
   		var task=gantt.getTask(id);
   		//task.text="aaaaa";
   		//draw_deadline(task);
   		//console.log(new Date(task.deadline.valueOf()));
   		for (var i = 0; i< tasksGlobal['data'].length; i++) {
   			if(tasksGlobal['data'][i]['id']==task.id){
   				console.log("id-"+tasksGlobal['data'][i]['id']);
   				console.log("idItem-"+tasksGlobal['data'][i]['idItem']);
   				console.log(getCantDias(tasksGlobal['data'][i]['tamano'],tasksGlobal['data'][i]['renobr'],8,1));
   				$("#divcantdia #tamano").attr("value",tasksGlobal['data'][i]['tamano']);
	    		$("#divcantdia #renobr").attr("value",tasksGlobal['data'][i]['renobr']);
	    		$("#divcantobrero #tamano").attr("value",tasksGlobal['data'][i]['tamano']);
	    		$("#divcantobrero #renobr").attr("value",tasksGlobal['data'][i]['renobr']);
   			}
   		};
   	});

	gantt.attachEvent("onAfterTaskDrag", function(id, mode, e){
	  var tarea=gantt.getTask(id);  
	var today = new Date(tarea.start_date.valueOf());
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!

    var yyyy = today.getFullYear();
    if(dd<10){
        dd='0'+dd
    } 
    if(mm<10){
        mm='0'+mm
    } 
    var today = yyyy+'-'+mm+'-'+dd;

	  modificarTask(tarea.id,tarea.duration,today);

	  console.log(tarea.id+"-"+tarea.duration+"-"+today);
	});


	function modificarTask(id,duracion,fechaIni){
		$.post("../presentacion/itemP.php", { idItem: id, duracion: duracion, fechaIni: fechaIni,modificarItem: "modificar"}, function(data){
        //$("#actividad").html(data);
    	});  
	}

	function generarPlazo(){
		var idGantt;
		<?php 
			$items=$itemN->listaItemGantt_IdProyecto($_REQUEST['id']);
           	foreach ($items as $item ) {
           		echo 'idGantt=gantt.getTask('.$item['idItem'].');';
           		echo 'idGantt.deadline=new Date('.$itemN->getFechaLimite($item['idItem']).');';
            }
		?>
	}

	function cargarLimite(){
		/*var idGantt=gantt.getTask(task.id);
		var name='"'+'#'+'idGantt.id"';
		console.log(name);
		idGantt.deadline=$(name).val();*/
		$(".limit").each(function(){
			var idGantt=gantt.getTask(this.id);
			idGantt.deadline=new Date($(this).val());
			console.log(idGantt.deadline);
		});
	}

	function generarPlazoDinamico(){
		$.post("../ajax/limites.php", {id:"<?php echo $_REQUEST['id']; ?>"}, function(data){
            $("#limite").html(data);
        });
	}

	function recorrerTask(toggle){
		/*gantt.eachTask(function(task){
			task.deadline=new Date('2016,07,10');
		})
		gantt.render();*/
		toggle.enabled = !toggle.enabled;
		if(toggle.enabled){
			toggle.innerHTML = "ocultar plazo";
			generarPlazoDinamico();
			//gantt.eachTask(function(task){
			//task.deadline=task.start_date//new Date('2016,07,10');
			cargarLimite();
			//})
		}else{
			toggle.innerHTML = "mostrar plazo";
			generarPlazoDinamico();
			cargarLimite();
			gantt.eachTask(function(task){
			task.deadline="";
		})
		}
		gantt.render();
	}

	//gantt.config.xml_date = "%Y-%m-%d %H:%i"; 
	gantt.config.task_date = "%d-%m-%Y";

	dibujar();

	function dibujar(){
		gantt.init("gantt_here");
	gantt.parse (tasks);	
	}
	

	function getCantDias(tamano,renObr,HrsDia,cantObr){
		return Math.ceil(tamano/(renObr*HrsDia*cantObr));
	}
	function getCantObr(tamano,renObr,HrsDia,cantDias){
		return Math.ceil(tamano/(renObr*HrsDia*cantDias));
	}

	//gantt.load('data.php');
	//var dp=new gantt.dataProcessor("data.php");  
	//dp.init(gantt);
    </script>

<!--sssssssssssssssssssssssssssssssssssssssssssssss-->

		
		<div style="height: 34px;line-height: 30px;margin:3px auto" class="col-md-1">
        	<input  class="btn btn-primary" type="button" value="semanas" onclick="semana()">
        </div>
        <div style="height: 34px;line-height: 30px;margin:3px auto" class="col-md-1">
        	<input  class="btn btn-primary" type="button" value="meses" onclick="mes()">
        </div>
        <div style="height: 34px;line-height: 30px;margin:3px auto" class="col-md-1">
        	<input  class="btn btn-primary" type="button" value="dias" onclick="dia()">
        </div>
        <!--div style="text-align: center;height: 30px;line-height: 40px;">
			<button  class="btn btn-primary" style="height: 34px;line-height: 30px;margin:3px auto" onclick="recorrerTask(this)">mostrar plazo</button>
		</div-->
        <!--div style="" class="col-md-1">
        	<input  class="btn btn-primary" type="button" value="deshacer" onclick="undo()">
        </div>
        <div style="" class="col-md-1">
        	<input  class="btn btn-primary" type="button" value="hacer" onclick="redo()">
        </div-->
        <!--div style="text-align: center;height: 40px;line-height: 40px;">
			<button  class="btn btn-primary" style="height: 34px;line-height: 30px;margin:3px auto" onclick="caminoCritico(this)">mostrar camino critico</button>
		</div-->

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script type="text/javascript" >
        if (document.addEventListener) { 
           document.addEventListener("DOMContentLoaded", inicializar, false);
        }

        if (document.addEventListener) { 
           document.addEventListener("DOMContentLoaded", generarPlazoDinamico, false);
        }

        function generarPlazoDinamico(){
		$.post("../ajax/limites.php", {id:"<?php echo $_REQUEST['id']; ?>"}, function(data){
            $("#limite").html(data);
        });
	}

        function inicializar(){
           $("#tipo").change(function () {
                            $("#tipo option:selected").each(function () {
                                var id_tipo = $(this).val();
                                $.post("../ajax/list_actividad.php", { id_tipo: id_tipo}, function(data){
                                    $("#actividad").html(data);
                                });
                                
                                
                                //--------- 
                            });
                        });
        } 




			/*function guardar(){
				$.post("itemP.php", $("#formulario").serialize(), function(data){
                    //$("#fecha").html(data);
                    
                });
					var taskId = gantt.addTask({
						<?php 
							require_once("../negocio/itemN.php");
				            require_once("../negocio/actividadN.php");
							$itemN=new ItemN();
				            $actividadN=new ActividadN();
				            $items=$itemN->UltimoItem_IdProyecto($_REQUEST['id']);
				            echo 'id:'.$items['id'].',';
				            echo 'text:"'.$actividadN->obtenerNombre_IdActividad($items['idActividad']).'",';
				            echo 'start_date:"'.$itemN->getFechaIG($items['id']).'",'; 
				            echo 'deadline:""'.',';
				            echo 'duration:'.$itemN->getDuracion($items['id']);
						?>
					});

				
        	}*/





$( "#guardarDatos" ).submit(function( event ) {
		var parametros = $(this).serialize();
			 $.ajax({
					type: "POST",
					url: "itemP.php",
					data: parametros,
					 beforeSend: function(objeto){
						//$("#datos_ajax_register").html("Mensaje: Cargando...");
					  },
					success: function(datos){
					//$("#datos_ajax_register").html(datos);
					//load(1);
					//$("#limitew").html(datos);

				  }
			});
		  event.preventDefault();
		  return false;
		});



	$(function(){
	    $("#btnCalcularDia").click(function(){
	    	tamano=$("#divcantdia #tamano").val();
	    	renObr=$("#divcantdia #renobr").val();
	    	HrsDia=$("#divcantdia #hrsdia").val();
	    	cantObr=$("#divcantdia #cantobr").val();

	    	res=getCantDias(tamano,renObr,HrsDia,cantObr);
            $("#divcantdia #cantdia").html("<label for=\"cantdia\">cantidad de dias para completar la actividad: "+res+" </label>");
          	
        });

    });

    $(function(){
	    $("#btnCalcularObreros").click(function(){
	    	tamano=$("#divcantobrero #tamano").val();
	    	renObr=$("#divcantobrero #renobr").val();
	    	HrsDia=$("#divcantobrero #hrsdia").val();
	    	cantDias=$("#divcantobrero #cantdia").val();

	    	res=getCantObr(tamano,renObr,HrsDia,cantDias);
            $("#divcantobrero #cantobr").html("<label for=\"cantobr\">cantidad de obreros necesarios para la actividad: "+res+" </label>");
          	
        });

    });

</script>


<button type="button" class="btn btn-default" data-toggle="modal" data-target="#dataRegister"><i class='glyphicon glyphicon-plus'></i> Agregar</button>

<button type="button" class="btn btn-default" data-toggle="modal" data-target="#calcularDias"><i ></i> calcular dias</button>

<button type="button" class="btn btn-default" data-toggle="modal" data-target="#calcularObreros"><i ></i> calcular obreros</button>

<a class="btn btn-primary" href="gestionarProyectoP.php?id=<?php echo $_REQUEST['id']; ?>">volver</a>

<?php include_once("modales/modal_agregar_Item.php"); ?>
<?php include_once("modales/modal_calcular_dias.php"); ?>
<?php include_once("modales/modal_calcular_obreros.php"); ?>

 <div id="limite">
 	
 	<input type="hidden" id="1" value="a">
 </div>

 <?php 
	include_once("foot.php");
 ?>