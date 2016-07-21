<?php 
	require_once("../datos/tipoAD.php");
	class TipoAN{

		private $tipoAD;

		public function __construct(){
			$this->tipoAD = new TipoAD(); 
		}

		public function guardarTipoA($nombre,$tipo){
			$this->tipoAD->guardar($nombre,$tipo);
		}

		public function listaTipoA(){
			$lista=$this->tipoAD->listar();
			return $lista;
		}

		public function obtenerNombre_IdTipoA($idtipoA){
			return $this->tipoAD->obtenerNombre_IdActividad($idtipoA);
		}

	};

	if(isset($_POST['pagina'])){
		if($_POST['pagina']=="crear"){
			$listaActividadesN=new TipoAD();
			$listaActividadesN->guardarActividad($_POST['nombre'],$_POST['tipo']);
			echo"<script type=\"text/javascript\">alert('ingresado correctamente'); window.location='../presentacion/crearActividadP.php';</script>";  
		}else{
			echo "no creo actividad";
		}
	}else{
		//echo "no isset";
	}
?>