<?php 
	require_once("../datos/proyectoD.php");

	class ProyectoN{
		
		private $proyecto;

		public function __construct(){
			$this->proyecto = new proyectoD(); 
		}

		public function guardarProyecto($nombre,$propietario,$direccion,$responsable,$fechaAct){
			$this->proyecto->guardar($nombre,$propietario,$direccion,$responsable,$fechaAct);
		}

		public function listaProyectos(){
			$lista=$this->proyecto->listar();
			return $lista;
		}

		public function obtenerProyecto($idProyecto){
			return $this->proyecto->obtenerProyecto($idProyecto);
		}

		public function getFechaProyecto($id_proyecto){
			$fecha = $this->proyecto->obtenerProyecto($id_proyecto);
			return $fecha['fechaIni'];
		}

		public function actualizarFechaProyecto($id_proyecto,$fecha){
			$this->proyecto->actualizarFechaProyecto($id_proyecto,$fecha);
		}

		public function actualizarTotal($idProyecto,$total)
		{
			$this->proyecto->actualizarTotal($idProyecto,$total);
		}

	};

	
	
?>