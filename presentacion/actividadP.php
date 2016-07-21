<?php 
	require_once("../negocio/actividadN.php");
	
	
		class ActividadP{

			private $actividadN;
			

			public function __construct(){
				$this->actividadN = new ActividadN(); 
				
			}

			public function listarActividades($id_proyecto){
				echo '<table id="actividades" class="table">
					<tr>
						<th>nombre de la actividad</th>		
						<th>costo de la actividad</th>
						<th>ver analisis de precio unitario</th>
					</tr>';
							$items=$this->actividadN->listaItem_IdProyecto($id_proyecto);
							foreach ($items as $item) {
								echo '<tr>';
								echo '<td>'.$this->actividadN->obtenerNombre_IdActividad($item['idActividad']).'</td>';
								echo '<td>'.$item['PParcial'].'</td>';
								echo '<td><a href="gestionarAnalisis.php?idProyecto='.$id_proyecto.'&idItem='.$item['id'].'"> ingresar </a></td>';
								echo '</tr>';
							}
						
				echo '</table>';
			}

			public function listarActividades_tipo($id_tipo){
				echo '<select name="actividad" id="actividad">';
				$actividad=$this->actividadN->listarActividades_tipo($id_tipo);
				echo '<option value="0">elija un tipo</option>';
				foreach ($actividad as $a) {
				    echo '<option value="'.$a['id'].'">'.$a['nombre'].'</option>';
				}
				echo '</select>';
			}

			public function insertarActividad($nombre,$tipo,$unidad,$renobr){
				$this->actividadN->guardarActividad($nombre,$tipo,$unidad,$renobr);
			}

			public function getFechaProyecto($id_proyecto){
				return $this->actividadN->getFechaProyecto($id_proyecto);
			}

			public function actualizarFechaProyecto($id_proyecto,$fecha){
				$this->actividadN->actualizarFechaProyecto($id_proyecto,$fecha);
			}

		}

	if(isset($_POST['crearActividadP'])){
		if($_POST['crearActividadP']=="crear"){
			$actividad=new ActividadP();
			$actividad->insertarActividad($_POST['nombre'],$_POST['tipo'],$_POST['unidad'],$_POST['renobr']);
			echo"<script type=\"text/javascript\"> window.location='../presentacion/crearActividadP.php';</script>";  
		}else{
			//echo "no creo actividad";
		}
	}else{
		//echo "no isset";
	}

 ?>