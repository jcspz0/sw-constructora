<?php 
	require_once("../datos/analisisD.php");
	require_once("../negocio/itemN.php");

	class AnalisisN
	{
		private $analisisD;
		private $itemN;

		public function __construct()
		{
			$this->analisisD=new AnalisisD();
			$this->itemN=new ItemN();
		}

		public function insertarAnalisis($descripcion,$unidad,$rendimiento,$precio,$idItem)
		{
			$precioParcial=1;
			$precioParcial=$precioParcial*$precio*$rendimiento;
			$this->analisisD->guardar($descripcion,$unidad,$rendimiento,$precio,$precioParcial,$idItem);
		}

		public function listaAnalisis_IdItem($idItem)
		{
			$lista=$this->analisisD->listarAnalisis_IdItem($idItem);
			return $lista;
		}

		public function actualizarCostoItem($idProyecto,$idItem)
		{
			$precioParcial=$this->analisisD->calcularPrecioItem($idItem);
			$this->itemN->actualizarPrecioParcial($idProyecto,$idItem,$precioParcial);
		}

	}
 ?>