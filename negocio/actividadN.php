<?php 
	require_once("../datos/actividadD.php");
	require_once("../negocio/itemN.php");
	require_once("../negocio/proyectoN.php");
	class ActividadN{

		private $actividadD;
		private $itemN;
		private $proyectoN; 

		public function __construct(){
			$this->actividadD = new ActividadD(); 
			$this->itemN = new ItemN();
			$this->proyectoN =  new ProyectoN();
		}

		public function guardarActividad($nombre,$tipo,$unidad,$consejo){
			$this->actividadD->guardar($nombre,$tipo,$unidad,$consejo);
		}

		public function listaActividad(){
			$lista=$this->actividadD->listar();
			return $lista;
		}

		public function obtenerNombre_IdActividad($idActividad){
			return $this->actividadD->obtenerNombre_IdActividad($idActividad);
		}

		public function obtenerActividad_IdActividad($idActividad){
			return $this->actividadD->obtenerActividad_IdActividad($idActividad);
		}

		public function listaItem_IdProyecto($id_proyecto){
			return $this->itemN->listaItem_IdProyecto($id_proyecto);
		}

		public function obtenerConsejo($idActividad){
			return $this->actividadD->obtenerConsejo($idActividad);
		}

		public function obtenerTipo(){
			return $this->actividadD->obtenerTipo();
		}

		public function listarActividades_tipo($id_tipo){
			return $this->actividadD->listarActividades_tipo($id_tipo);
		}

		public function getFechaProyecto($id_proyecto){
			return $this->proyectoN->getFechaProyecto($id_proyecto);
		}

		public function actualizarFechaProyecto($id_proyecto,$fecha){
			$this->proyectoN->actualizarFechaProyecto($id_proyecto,$fecha);
		}

	};

	
?>