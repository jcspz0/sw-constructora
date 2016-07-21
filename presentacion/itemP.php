<?php 

	require_once("../negocio/itemN.php");
	require_once("../negocio/actividadN.php");


	class ItemP{

		private $itemN;
		private $actividadN;

		public function __construct(){
			$this->itemN=new ItemN();
			$this->actividadN=new ActividadN();
		}

		public function listaActividad(){
			echo '<select name="actividad" class="form-group"> ';
			$actividad=$this->actividadN->listaActividad();
			foreach ($actividad as $a) {
			    echo '<option value="'.$a['id'].'">'.$a['nombre'].'</option>';
			}
			echo '</select>';

		}

		public function actividadesProyecto($idProyecto){
			echo '<select name="predecesor" class="form-group"> 
										        <option value="0">sin actividad previa</option>;';
			$items=$this->itemN->listaItem_IdProyecto($idProyecto);
			foreach ($items as $it) {
			    echo '<option value="'.$it['id'].'">'.$this->itemN->obtenerNombre_IdActividad($it['idActividad']).'</option>';
			}
			echo '</select>';
		}

		public function guardarItem($actividad,$idProyecto,$tamano){
			return $idItem=$this->itemN->guardarItem($actividad,$idProyecto,$tamano);
		}

		public function guardarDiagrama($idItem,$predecesor,$fechaIni,$fechaFin){
			$this->itemN->guardarDiagrama($idItem,$predecesor,$fechaIni,$fechaFin);
		}

		public function obtenerTipo(){
			echo '<select name="tipo" id="tipo" class="form-group"> ';
			$actividad=$this->actividadN->obtenerTipo();
			echo '<option value="0">elija un tipo</option>';
			foreach ($actividad as $a) {
			    echo '<option value="'.$a['id'].'">'.$a['nombre'].'</option>';
			}
			echo '</select>';
		}

		public function guardarDiagramaDuracion($idItem,$predecesor,$duracion){
			$this->itemN->guardarDiagramaDuracion($idItem,$predecesor,$duracion);
		}

		public function guardarDiagramaDuracion1($idItem,$predecesor,$duracion){
			$this->itemN->guardarDiagramaDuracion1($idItem,$predecesor,$duracion);
		}

		public function modificarDiagrama($idItem,$duracion,$fechaIni){
			$this->itemN->modificarDiagrama($idItem,$duracion,$fechaIni);
		}

		public function modificarDiagrama1($idItem,$duracion,$fechaIni){
			$this->itemN->modificarDiagrama1($idItem,$duracion,$fechaIni);
		}

	}
 	


	if(isset($_REQUEST['crearItem'])){
		$res=1;
		if($_REQUEST['crearItem']=="crear"){
			$itemP=new ItemP();
			$idItem=$itemP->guardarItem($_REQUEST['actividad'],$_REQUEST['idProyecto']);
			$itemP->guardarDiagrama($idItem,$_REQUEST['predecesor'],$_REQUEST['fechaIni'],$_REQUEST['fechaFin']);
			echo"<script type=\"text/javascript\"> window.location='../presentacion/gestionarActividadP.php?id=".$_REQUEST['idProyecto']."';</script>";  
			//echo '<script type=\text/javascript\>alert("ingresado correctamente"); window.location="../presentacion/gestionarActividadP.php";</script>';  
		}else{
			if($_REQUEST['crearItem']=="crear2"){
				$itemP=new ItemP();
				$idItem=$itemP->guardarItem($_REQUEST['actividad'],$_REQUEST['idProyecto'],$_REQUEST['tamano']);
				$itemP->guardarDiagramaDuracion($idItem,$_REQUEST['predecesor'],$_REQUEST['duracion']);
				$itemP->guardarDiagramaDuracion1($idItem,$_REQUEST['predecesor'],$_REQUEST['duracion']);
				echo"<script type=\"text/javascript\">window.location='../presentacion/gestionarActividadP.php?id=".$_REQUEST['idProyecto']."';</script>";  
			}
			if($_REQUEST['crearItem']=="crear3"){
				$itemP=new ItemP();
				$idItem=$itemP->guardarItem($_REQUEST['actividad'],$_REQUEST['idProyecto'],$_REQUEST['tamano']);
				$itemP->guardarDiagramaDuracion($idItem,$_REQUEST['predecesor'],$_REQUEST['duracion']);
				$itemP->guardarDiagramaDuracion1($idItem,$_REQUEST['predecesor'],$_REQUEST['duracion']);
				echo"<script type=\"text/javascript\">window.location='../presentacion/diagramaGantt3P.php?id=".$_REQUEST['idProyecto']."';</script>";  
			}
		}
	}else{
		//echo "no isset";
		if(isset($_REQUEST['modificarItem'])){
			if($_REQUEST['modificarItem']=="modificar1"){
				$itemP=new ItemP();
				$itemP->modificarDiagrama1($_REQUEST['idItem'],$_REQUEST['duracion'],$_REQUEST['fechaIni']);	
			}
			if($_REQUEST['modificarItem']=="modificar"){
				$itemP=new ItemP();
				$itemP->modificarDiagrama($_REQUEST['idItem'],$_REQUEST['duracion'],$_REQUEST['fechaIni']);	
				//$itemP->modificarDiagrama1($_REQUEST['idItem'],$_REQUEST['duracion'],$_REQUEST['fechaIni']);	
			}
			
		}
	}

	

 ?>