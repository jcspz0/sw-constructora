<?php 
	require_once("../datos/itemD.php");
	require_once("../negocio/actividadN.php");
	require_once("../negocio/proyectoN.php");
	class ItemN{

		private $itemD;
		private $proyectoN;

		public function __construct(){
			$this->itemD = new ItemD(); 
			//$this->actividadN = new ActividadN();
			$this->proyectoN=new ProyectoN();
		}

		public function guardarItem($actividad,$idProyecto,$tamano){
			return $idItem=$this->itemD->guardar($actividad,$idProyecto,$tamano);
		}

		public function listaItem_IdProyecto($idProyecto){
			$lista=$this->itemD->listarItem_IdProyecto($idProyecto);
			return $lista;
		}

		public function listaItem_IdProyecto_tipo0($idProyecto){
			$lista=$this->itemD->listarItem_IdProyecto_tipo0($idProyecto);
			return $lista;
		}

		public function listaItem_IdProyecto_tipo1($idProyecto){
			$lista=$this->itemD->listarItem_IdProyecto_tipo1($idProyecto);
			return $lista;
		}

		public function listaItemGantt_IdProyecto($idProyecto){
			$lista=$this->itemD->listarItemGantt_IdProyecto($idProyecto);
			return $lista;
		}

		public function guardarDiagrama($idItem,$predecesor,$fechaIni,$fechaFin){
			$this->itemD->guardarDiagrama($idItem,$predecesor,$fechaIni,$fechaFin);
		}

		public function obtenerNombre_IdActividad($idActividad){
			$actividadN=new ActividadN();
			return $actividadN->obtenerNombre_IdActividad($idActividad);
		}

		public function getFechaI($idItem){
			$fecha1=$this->itemD->getFechaI_idItem($idItem);
			//$fecha2=''.substr($fecha1, 6, 4).','.substr($fecha1, 3, 2).','.substr($fecha1, 0, 2).'';
			return str_replace("-", ",", $fecha1);
		}

		public function getFechaIG($idItem){
			$fecha1=$this->itemD->getFechaI_idItem($idItem);
			//$fecha2=''.substr($fecha1, 6, 4).'-'.substr($fecha1, 3, 2).'-'.substr($fecha1, 0, 2).'';
			$fecha2=''.substr($fecha1, 8, 2).'-'.substr($fecha1, 5, 2).'-'.substr($fecha1, 0, 4).'';
			return $fecha2;
		}

		public function getFechaF($idItem){
			$fecha1=$this->itemD->getFechaF_idItem($idItem);
			//return $fecha2=''.substr($fecha1, 6, 4).','.substr($fecha1, 3, 2).','.substr($fecha1, 0, 2).'';
			return str_replace("-", ",", $fecha1);
		}

		public function getFechaI2($idItem){
			$fecha1=$this->itemD->getFechaI_idItem($idItem);
			return $fecha2=''.substr($fecha1, 6, 4).','.substr($fecha1, 3, 2).','.substr($fecha1, 0, 2).'';
			//return str_replace("-", ",", $fecha1);
		}

		public function getFechaF2($idItem){
			$fecha1=$this->itemD->getFechaF_idItem($idItem);
			return $fecha2=''.substr($fecha1, 6, 4).','.substr($fecha1, 3, 2).','.substr($fecha1, 0, 2).'';
			//return str_replace("-", ",", $fecha1);
		}

		public function getFechaE($idItem,$dias){
			$dias--;
			$fecha1=$this->itemD->getFechaF_idItem($idItem);
			
			//return str_replace("-", ",", $fecha1);
			$nuevafecha = strtotime ( '+'.$dias.' day' , strtotime ( $fecha1 ) ) ;
			$nuevafecha = date ( 'Y-m-d' , $nuevafecha );
			return str_replace("-", ",", $nuevafecha);
		}

		public function diferencia_fecha($date1, $date2){
			$date1=str_replace(",", "/", $date1);
			$date2=str_replace(",", "/", $date2);
	       if (!is_integer($date1)) $date1 = strtotime($date1);
	       if (!is_integer($date2)) $date2 = strtotime($date2);  
	       return floor(abs($date1 - $date2) / 60 / 60 / 24);
		} 

		public function getDiagrama($id){
			return $this->itemD->getDiagrama($id);
		}

		public function guardarDiagramaDuracion($idItem,$predecesor,$duracion){
			$fechaIni="";
			if($predecesor=="0"){
				$fechaIni=$this->obtenerFechaProyecto($idItem);
			}else{
				$fecha=$this->itemD->getFechaF_idItem($predecesor);
				$fechaIni=$this->getFecha_dias($fecha,1);
			}
			$fechaFin=$this->getFecha_dias($fechaIni,$duracion-1);
			return $this->itemD->guardarDiagrama_Duracion($idItem,$predecesor,$fechaIni,$fechaFin,$duracion);
		}

		public function guardarDiagramaDuracion1($idItem,$predecesor,$duracion){
			$fechaIni="";
			if($predecesor=="0"){
				$fechaIni=$this->obtenerFechaProyecto($idItem);
			}else{
				$fecha=$this->itemD->getFechaF_idItem($predecesor);
				$fechaIni=$this->getFecha_dias($fecha,1);
			}
			$fechaFin=$this->getFecha_dias($fechaIni,$duracion-1);
			return $this->itemD->guardarDiagrama_Duracion1($idItem,$predecesor,$fechaIni,$fechaFin,$duracion);
		}

		public function obtenerFechaProyecto($idItem){
			$idProyecto=$this->itemD->obtenerIdProyecto($idItem);
			return $this->proyectoN->getFechaProyecto($idProyecto);
		}

		public function getFecha_dias($fechaIni,$duracion){
			$nuevafecha = strtotime ( '+'.$duracion.' day' , strtotime ( $fechaIni ) ) ;
			$nuevafecha = date ( 'Y-m-d' , $nuevafecha );
			return $nuevafecha;
		}

		public function getDuracion($idItem){
			return $this->itemD->getDuracion($idItem);
		}

		public function getFechaLimite($idItem){
			$fecha1="2100-01-01";
			$siguientes=$this->itemD->siguientes($idItem);
			$entro=false;
			foreach ($siguientes as $sig ) {
				$entro=true;
				$fechaSig=$this->itemD->getFechaI_idItem($sig['idItem']);
				if($fecha1>$fechaSig){
					$fecha1=$fechaSig;
				}
			}
			if(!$entro){
				$fecha1=$this->itemD->getFechaF_idItem($idItem);
				$fecha2=''.substr($fecha1, 0, 4).','.(substr($fecha1, 5, 2)-1).','.(substr($fecha1, 8, 2)+1).'';
				return $fecha2;
			}
			//$fecha1=$this->itemD->getFechaI_idItem($idItem);
			$fecha2=''.substr($fecha1, 0, 4).','.(substr($fecha1, 5, 2)-1).','.(substr($fecha1, 8, 2)).'';
			return $fecha2;
		}

		public function getFechaLimit($idItem){
			$fecha1="2100-01-01";
			$siguientes=$this->itemD->siguientes($idItem);
			$entro=false;
			foreach ($siguientes as $sig ) {
				$entro=true;
				$fechaSig=$this->itemD->getFechaI_idItem($sig['idItem']);
				if($fecha1>$fechaSig){
					$fecha1=$fechaSig;
				}
			}
			if(!$entro){
				$fecha1=$this->itemD->getFechaF_idItem($idItem);
				$fecha2=''.substr($fecha1, 0, 4).','.(substr($fecha1, 5, 2)).','.(substr($fecha1, 8, 2)+1).'';
				return $fecha2;
			}
			//$fecha1=$this->itemD->getFechaI_idItem($idItem);
			$fecha2=''.substr($fecha1, 0, 4).','.(substr($fecha1, 5, 2)).','.(substr($fecha1, 8, 2)).'';
			return $fecha2;
		}

		public function UltimoItem_IdProyecto($idProyecto){
			$lista=$this->itemD->UltimoItem_IdProyecto($idProyecto);
			return $lista;
		}

		public function modificarDiagrama($idItem,$duracion,$fechaIni){
			$fechaFin=$this->getFecha_dias($fechaIni,$duracion-1);
			$this->itemD->modificarDiagrama($idItem,$duracion,$fechaIni,$fechaFin);
		}

		public function modificarDiagrama1($idItem,$duracion,$fechaIni){
			$fechaFin=$this->getFecha_dias($fechaIni,$duracion-1);
			$this->itemD->modificarDiagrama1($idItem,$duracion,$fechaIni,$fechaFin);
		}

		public function getCantDias($tamano,$redObr,$HrsDia,$cantObr){
			return ceil($tamano/($redObr*$HrsDia*$cantObr));
		}

		public function getCantObr($tamano,$redObr,$HrsDia,$cantDias){
			return ceil($tamano/($redObr*$HrsDia*$cantDias));
		}

		public function actualizarPrecioParcial($idProyecto,$idItem,$precioParcial)
		{
			$this->itemD->actualizarPrecioParcial($idItem,$precioParcial);
			$total=$this->itemD->getTotal_IdItem($idProyecto);
			$this->proyectoN->actualizarTotal($idProyecto,$total);
		}

	};
?>