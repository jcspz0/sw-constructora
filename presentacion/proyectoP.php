<?php
		require_once("../negocio/proyectoN.php");
		$proyectoN=new ProyectoN();
		class ProyectoP{

			private $proyectoN;

			public function __construct(){
				$this->proyectoN = new proyectoN(); 
			}

			public function listarProyectos(){
				$proyectos=$this->proyectoN->listaProyectos();
				echo '<table id="proyectos" class="table">
						<tr>
							<th>nombre del proyecto</th>
							<th>total costo del proyecto</th>	
							<th>fecha de inicio del proyecto</th>	
							<th>ingresar al proyecto</th>
						</tr>';
				foreach ($proyectos as $proyecto) {
					echo '<tr>';
					echo '<td>'.$proyecto['nombre'].'</td>';
					echo '<td>'.$proyecto['total'].'</td>';
					echo '<td>'.$proyecto['fechaIni'].'</td>';
					echo '<td><a href="gestionarProyectoP.php?id='.$proyecto['id'].'">ingresar</a><td>';
					echo '</tr>';
				}
				echo '</table>';
			}

			public function opcioneProyectos($idProyecto){
				echo '<table id="proyectos" class="table">';
				//$proyectos=$proyectoN->obtenerProyecto($idProyecto);
				echo '<tr>';
				echo '<th><h4>ver actividades</h4></th>';
				//echo '<th><h4>ver analisis de precio unitario</h4></th>';
				echo '</tr>';
				echo '<tr>';
				echo '<td><a href="gestionarActividadP.php?id='.$idProyecto.'"><img src="img/image-actividad.png" alt="actividades"/></a></td>';
				//echo '<td><a href="gestionarProyectoP.php?id='.$idProyecto.'"><img src="img/image-precio.png" alt="analisis de precio unitario"/></a></td>';
				echo '</tr>';
				echo '<tr>';
				echo '<th><h4>ver planificaicon</h4></th>';
				echo '<th><h4>ver diagrama de gantt</h4></th>';
				echo '</tr>';
				echo '<tr>';
				echo '<td><a href="diagramaGantt2P.php?id='.$idProyecto.'"><img src="img/image-planificacion.png" alt="planificacion"/></a></td>';
				echo '<td><a href="diagramaGantt3P.php?id='.$idProyecto.'"><img src="img/image-gantt.png" alt="diagrama de gantt"/></a></td>';
				echo '</tr>';
				echo '</table>';
			}

			public function guardarProyecto($nombre,$nombrePropietario,$direccion,$responsable){
				$fechaAct=date("Y").'-'.date('m').'-'.date('d');
				$this->proyectoN->guardarProyecto($nombre,$nombrePropietario,$direccion,$responsable,$fechaAct);
			}

		}

	if(isset($_POST['crearProyecto'])){
		if($_POST['crearProyecto']=="crear"){
			$proyectoN=new ProyectoP();
			$proyectoN->guardarProyecto($_POST['nombre'],$_POST['nombrePropietario'],$_POST['direccion'],$_POST['responsable']);
			echo"<script type=\"text/javascript\"> window.location='index.php';</script>";  
		}else{
			//echo "no crear";
		}
	}else{
		//echo "no isset";
	}

 	?>