<?php 
	require_once("../conexion/conexion.php");
	class ItemD{
		
		var $idProyecto;
		var $idActividad;
		var $tamano;
		var $pParcial;
		var $conexion;
	//var $m_conexion;

		public function __construct(){
			$this->idProyecto="";
			$this->idActividad="";
			$this->tamano=0;
			$this->pParcial=0;
			$this->conexion=conexion::getConexion();
		}

		public function getIdProyecto(){
			return $this->idProyecto;
		}

		public function setIdProyecto($idProyecto){
			$this->idProyecto=$idProyecto;
		}

		public function getIdActividad(){
			return $this->idActividad;
		}

		public function setIdActividad($idActividad){
			$this->idActividad=$idActividad;
		}

		public function getTamano(){
			return $this->tamano;
		}

		public function setTamano($tamano){
			$this->tamano=$tamano;
		}

		public function getPParcial(){
			return $this->pParcial;
		}

		public function setPParcial($pParcial){
			$this->pParcial=$pParcial;
		}

		public function guardar($actividad,$idProyecto,$tamano){
			$this->setIdActividad($actividad);
			$this->setIdProyecto($idProyecto);
			$this->setTamano($tamano);
			return $idItem=$this->guardar1();
		}

		public function guardar1(){
			$query='insert into item values (null,"'
				.$this->getIdProyecto().'","'
				.$this->getIdActividad().'","'
				.$this->gettamano().'","'
				.$this->getPParcial().'");';
			$this->conexion->consulta($query);
			//$resultado=mysql_query($query);
			return $idItem=$this->obtenerUltimoId();
		}

		public function obtenerUltimoId(){
			$query='Select * from item order by id desc limit 1';
			$resultado=$this->conexion->consulta($query);
			//$resultado=mysql_query($query);
			$items=array();
			if($resultado!=NULL){
				if(mysql_fetch_row($resultado)>0){
					$i=0;
					$resultado=$this->conexion->consulta($query);
					//$resultado=mysql_query($query);
					while ($res=mysql_fetch_array($resultado)) {
						$items[$i]=array('id'=>$res['id'],'idProyecto'=>$res['idProyecto'],'idActividad'=>$res['idActividad'],'tamano'=>$res['tamano'],'PParcial'=>$res['PParcial']);
						$i=$i+1;
					}
				}
			}
			return $items[0]['id'];
		}

		public function listarItem_IdProyecto($idProyecto){
			$query='select * from item where idProyecto='.$idProyecto;
			$resultado=$this->conexion->consulta($query);
			//$resultado=mysql_query($query);
			$items=array();
			if($resultado!=NULL){
				if(mysql_fetch_row($resultado)>0){
					$i=0;
					$resultado=$this->conexion->consulta($query);
					//$resultado=mysql_query($query);
					while ($res=mysql_fetch_array($resultado)) {
						$items[$i]=array('id'=>$res['id'],'idProyecto'=>$res['idProyecto'],'idActividad'=>$res['idActividad'],'tamano'=>$res['tamano'],'PParcial'=>$res['PParcial']);
						$i=$i+1;
					}
				}
			}
			return $items;
		}

		public function listarItem_IdProyecto_tipo0($idProyecto){
			$query='select diagrama.id as id,diagrama.idItem as idItem, item.idActividad as idActividad, 
			item.tamano as tamano from item, diagrama where item.id=diagrama.idItem AND diagrama.tipo=0 and idProyecto='.$idProyecto;
			$resultado=$this->conexion->consulta($query);
			//$resultado=mysql_query($query);
			$items=array();
			if($resultado!=NULL){
				if(mysql_fetch_row($resultado)>0){
					$i=0;
					$resultado=$this->conexion->consulta($query);
					//$resultado=mysql_query($query);
					while ($res=mysql_fetch_array($resultado)) {
						$items[$i]=array('id'=>$res['id'],'idItem'=>$res['idItem'],'idActividad'=>$res['idActividad'],'tamano'=>$res['tamano']);
						$i=$i+1;
					}
				}
			}
			return $items;
		}

		public function listarItem_IdProyecto_tipo1($idProyecto){
			$query='select diagrama.id as id,diagrama.idItem as idItem, item.idActividad as idActividad, 
			item.tamano as tamano from item, diagrama where item.id=diagrama.idItem AND diagrama.tipo=1 and idProyecto='.$idProyecto;
			$resultado=$this->conexion->consulta($query);
			//$resultado=mysql_query($query);
			$items=array();
			if($resultado!=NULL){
				if(mysql_fetch_row($resultado)>0){
					$i=0;
					$resultado=$this->conexion->consulta($query);
					//$resultado=mysql_query($query);
					while ($res=mysql_fetch_array($resultado)) {
						$items[$i]=array('id'=>$res['id'],'idItem'=>$res['idItem'],'idActividad'=>$res['idActividad'],'tamano'=>$res['tamano']);
						$i=$i+1;
					}
				}
			}
			return $items;
		}

		public function guardarDiagrama($idItem,$predecesor,$fechaIni,$fechaFin){
			$query='insert into diagrama values (null,'
				.$idItem.','
				.$predecesor.',"'
				.$fechaIni.'","'
				.$fechaFin.'");';
			$this->conexion->consulta($query);
			//$resultado=mysql_query($query);
		}

		public function getFechaI_idItem($idItem){
			$query='select * from diagrama where idItem='.$idItem;
			$resultado=$this->conexion->consulta($query);
			//$resultado=mysql_query($query);
			$items=array();
			if($resultado!=NULL){
				if(mysql_fetch_row($resultado)>0){
					$i=0;
					$resultado=$this->conexion->consulta($query);
					//$resultado=mysql_query($query);
					while ($res=mysql_fetch_array($resultado)) {
						$items[$i]=array('id'=>$res['id'],'idItem'=>$res['idItem'],'predecesor'=>$res['predecesor'],'fechaIni'=>$res['fechaIni'],'fechaFin'=>$res['fechaFin']);
						$i=$i+1;
					}
				}
			}
			return $items[0]['fechaIni'];
		}

		public function getFechaF_idItem($idItem){
			$query='select * from diagrama where idItem='.$idItem;
			$resultado=$this->conexion->consulta($query);
			//$resultado=mysql_query($query);
			$items=array();
			if($resultado!=NULL){
				if(mysql_fetch_row($resultado)>0){
					$i=0;
					$resultado=$this->conexion->consulta($query);
					//$resultado=mysql_query($query);
					while ($res=mysql_fetch_array($resultado)) {
						$items[$i]=array('id'=>$res['id'],'idItem'=>$res['idItem'],'predecesor'=>$res['predecesor'],'fechaIni'=>$res['fechaIni'],'fechaFin'=>$res['fechaFin']);
						$i=$i+1;
					}
				}
			}
			return $items[0]['fechaFin'];
		}

		public function siguientes($idItem){
			$query='select * FROM diagrama where predecesor='.$idItem;
			$resultado=$this->conexion->consulta($query);
			//$resultado=mysql_query($query);
			$items=array();
			if($resultado!=NULL){
				if(mysql_fetch_row($resultado)>0){
					$i=0;
					$resultado=$this->conexion->consulta($query);
					//$resultado=mysql_query($query);
					while ($res=mysql_fetch_array($resultado)) {
						$items[$i]=array('idItem'=>$res['idItem'],'predecesor'=>$res['predecesor'],'fechaIni'=>$res['fechaIni'],'fechaFin'=>$res['fechaFin'],'duracion'=>$res['duracion']);
						$i=$i+1;
					}
				}
			}
			return $items;
		}

		public function getDiagrama($idItem){
			$query='select * from diagrama where idItem='.$idItem;
			$resultado=$this->conexion->consulta($query);
			//$resultado=mysql_query($query);
			$items=array();
			if($resultado!=NULL){
				if(mysql_fetch_row($resultado)>0){
					$i=0;
					$resultado=$this->conexion->consulta($query);
					//$resultado=mysql_query($query);
					while ($res=mysql_fetch_array($resultado)) {
						$items[$i]=array('id'=>$res['id'],'idItem'=>$res['idItem'],'predecesor'=>$res['predecesor'],'fechaIni'=>$res['fechaIni'],'fechaFin'=>$res['fechaFin']);
						$i=$i+1;
					}
				}
			}
			return $items[0];
		}

		public function obtenerIdProyecto($idItem){
			$query='Select * from item where id='.$idItem;
			$resultado=$this->conexion->consulta($query);
			//$resultado=mysql_query($query);
			$items=array();
			if($resultado!=NULL){
				if(mysql_fetch_row($resultado)>0){
					$i=0;
					$resultado=$this->conexion->consulta($query);
					//$resultado=mysql_query($query);
					while ($res=mysql_fetch_array($resultado)) {
						$items[$i]=array('id'=>$res['id'],'idProyecto'=>$res['idProyecto'],'idActividad'=>$res['idActividad'],'tamano'=>$res['tamano'],'PParcial'=>$res['PParcial']);
						$i=$i+1;
					}
				}
			}
			return $items[0]['idProyecto'];
		}

		public function guardarDiagrama_Duracion($idItem,$predecesor,$fechaIni,$fechaFin,$duracion){
			$query='insert into diagrama values (null,'
				.$idItem.','
				.$predecesor.',"'
				.$fechaIni.'","'
				.$fechaFin.'",'
				.$duracion.','
				.'0'.');';
			$this->conexion->consulta($query);
		}

		public function guardarDiagrama_Duracion1($idItem,$predecesor,$fechaIni,$fechaFin,$duracion){
			$query='insert into diagrama values (null,'
				.$idItem.','
				.$predecesor.',"'
				.$fechaIni.'","'
				.$fechaFin.'",'
				.$duracion.','
				.'1'.');';
			$this->conexion->consulta($query);
		}

		public function getDuracion($idItem){
			$query='Select * from diagrama where id='.$idItem;
			$resultado=$this->conexion->consulta($query);
			//$resultado=mysql_query($query);
			$items=array();
			if($resultado!=NULL){
				if(mysql_fetch_row($resultado)>0){
					$i=0;
					$resultado=$this->conexion->consulta($query);
					//$resultado=mysql_query($query);
					while ($res=mysql_fetch_array($resultado)) {
						$items[$i]=array('id'=>$res['id'],'idItem'=>$res['idItem'],'predecesor'=>$res['predecesor'],'fechaIni'=>$res['fechaIni'],'fechaFin'=>$res['fechaFin'],'duracion'=>$res['duracion']);
						$i=$i+1;
					}
				}
			}
			return $items[0]['duracion'];
		}

		public function listarItemGantt_IdProyecto($idProyecto){
			$query='select diagrama.id as id,diagrama.idItem as idItem, diagrama.predecesor as predecesor 
			FROM diagrama,item where diagrama.idItem=item.id and tipo=0 and item.idProyecto='.$idProyecto;
			$resultado=$this->conexion->consulta($query);
			//$resultado=mysql_query($query);
			$items=array();
			if($resultado!=NULL){
				if(mysql_fetch_row($resultado)>0){
					$i=0;
					$resultado=$this->conexion->consulta($query);
					//$resultado=mysql_query($query);
					while ($res=mysql_fetch_array($resultado)) {
						$items[$i]=array('id'=>$res['id'],'idItem'=>$res['idItem'],'predecesor'=>$res['predecesor']);
						$i=$i+1;
					}
				}
			}
			return $items;
		}

		public function listarItemGantt_IdProyecto1($idProyecto){
			$query='select diagrama.id as id,diagrama.idItem as idItem, diagrama.predecesor as predecesor 
			FROM diagrama,item where diagrama.idItem=item.id and tipo=1 and item.idProyecto='.$idProyecto;
			$resultado=$this->conexion->consulta($query);
			//$resultado=mysql_query($query);
			$items=array();
			if($resultado!=NULL){
				if(mysql_fetch_row($resultado)>0){
					$i=0;
					$resultado=$this->conexion->consulta($query);
					//$resultado=mysql_query($query);
					while ($res=mysql_fetch_array($resultado)) {
						$items[$i]=array('id'=>$res['id'],'idItem'=>$res['idItem'],'predecesor'=>$res['predecesor']);
						$i=$i+1;
					}
				}
			}
			return $items;
		}

		

		public function UltimoItem_IdProyecto($idProyecto){
			$query='Select * from item  WHERE idProyecto='.$idProyecto.' order by id desc limit 1';
			$resultado=$this->conexion->consulta($query);
			//$resultado=mysql_query($query);
			$items=array();
			if($resultado!=NULL){
				if(mysql_fetch_row($resultado)>0){
					$i=0;
					$resultado=$this->conexion->consulta($query);
					//$resultado=mysql_query($query);
					while ($res=mysql_fetch_array($resultado)) {
						$items[$i]=array('id'=>$res['id'],'idProyecto'=>$res['idProyecto'],'idActividad'=>$res['idActividad'],'tamano'=>$res['tamano'],'PParcial'=>$res['PParcial']);
						$i=$i+1;
					}
				}
			}
			return $items[0];
		}

		public function modificarDiagrama($idItem,$duracion,$fechaIni,$fechaFin){
			$query='update diagrama set fechaIni="'.$fechaIni.'",fechaFin="'.$fechaFin.'",duracion='.$duracion.' WHERE idItem='.$idItem;
			$this->conexion->consulta($query);
		}

		public function modificarDiagrama1($idItem,$duracion,$fechaIni,$fechaFin){
			$query='update diagrama set fechaIni="'.$fechaIni.'",fechaFin="'.$fechaFin.'",duracion='.$duracion.' WHERE tipo=1 and idItem='.$idItem;
			$this->conexion->consulta($query);
		}

		public function actualizarPrecioParcial($idItem,$precioParcial)
		{
			$query='update item set PParcial='.$precioParcial.' WHERE id='.$idItem;
			$this->conexion->consulta($query);
		}

		public function getTotal_IdItem($idProyecto)
		{
			$query='select SUM(PParcial) as total FROM item where idProyecto='.$idProyecto;
			$resultado=$this->conexion->consulta($query);
			//$resultado=mysql_query($query);
			$proyectos=array();
			if($resultado!=NULL){
				if(mysql_fetch_row($resultado)>0){
					$i=0;
					//$resultado=$this->conexion->consulta($query);
					$resultado=mysql_query($query);
					while ($res=mysql_fetch_array($resultado)) {
						$proyectos[$i]=array('total'=>$res['total']);
						$i=$i+1;
					}
				}
			}
			return $proyectos[0]['total'];
		}

	};
 ?>