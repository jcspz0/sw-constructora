<?php 
	require_once("../datos/ganttD.php");
	require_once("itemN.php");
	//echo __DIR__;
	//$url= substr(__DIR__,0,-7) ;
	//$url= $url."datos\itemN.php";
	//require_once($url);

	class GanttN{

		var $lista_gantt;
		var $i;
		var $item;

		public function __construct(){
			$this->i=0;;
			$this->lista_gantt=array();
			$this->item=new ItemN();
		}

		public function addGannt($gantt){
			$this->lista_gantt[$this->i]=$gantt;
			$this->i++;
		}

		public function add($item,$predecesor,$duracion){
			$gantt=new GanttD($item,$predecesor,$duracion);
			$this->lista_gantt[$this->i]=$gantt;
			$this->i++;
		}

		public function addC($item,$predecesor,$duracion,$color,$critico){
			$gantt=new GanttD($item,$predecesor,$duracion,$color,$critico);
			$this->lista_gantt[$this->i]=$gantt;
			$this->i++;
		}

		public function getGantt($pos){
			return $this->lista_gantt[$pos];
		}

		public function cargarGanttItem($idProyecto){
			$items=$this->item->listaItem_IdProyecto($idProyecto);
			foreach ($items as $item) {
				$aux=$this->item->getDiagrama($item['id']);
				$id=$aux['id'];
				$id_item=$aux['idItem'];
				$predecesor=$aux['predecesor'];
				$duracion=$this->item->diferencia_fecha($aux['fechaIni'],$aux['fechaFin']);
				$g=new GanttD();
				$lista_gantt[]=$g->crear($id,$id_item,$predecesor,$duracion);
			}
		}

		public function holguras($idProyecto){
			
		}

	}
 ?>