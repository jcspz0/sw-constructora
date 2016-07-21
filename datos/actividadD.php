<?php 
	require_once("../conexion/conexion.php");
	class ActividadD{

		var $nombre;
		var $tipo;
		var $unidad;
		var $conexion;
		var $renobr;

		public function __construct(){
			$this->nombre="";
			$this->tipo="";
			$this->unidad="";
			$this->renobr="";
			$this->conexion=conexion::getConexion();
		}

		public function getNombre(){
			return $this->nombre;
		}

		public function setNombre($nombre){
			$this->nombre=$nombre;
		}

		public function getRenobr(){
			return $this->renobr;
		}

		public function setRenobr($renobr){
			$this->renobr=$renobr;
		}

		public function getTipo(){
			return $this->tipo;
		}

		public function setTipo($tipo){
			$this->tipo=$tipo;
		}

		public function getUnidad(){
			return $this->unidad;
		}

		public function setUnidad($unidad){
			$this->unidad=$unidad;
		}

		public function guardar($nombre,$tipo,$unidad,$renobr){
			$this->setNombre($nombre);
			$this->setTipo($tipo);
			$this->setUnidad($unidad);
			$this->setRenobr($renobr);
			$this->guardar1();
		}

		public function guardar1(){
			$query='insert into actividad values (null,"'
				.$this->getTipo().'","'
				.$this->getNombre().'","'
				.$this->getUnidad().'","'
				.$this->getRenobr().'");';
			$this->conexion->consulta($query);
			//$resultado=mysql_query($query);
		}

		public function listar(){//devuelve un array con todos los datos
			$query='select * from actividad';
			$resultado=$this->conexion->consulta($query);
			//$resultado=mysql_query($query);
			$proyectos=array();
			if($resultado!=NULL){
				if(mysql_fetch_row($resultado)>0){
					$i=0;
					//$resultado=$this->conexion->consulta($query);
					$resultado=mysql_query($query);
					while ($res=mysql_fetch_array($resultado)) {
						$proyectos[$i]=array('id'=>$res['id'],'nombre'=>$res['nombre'],'tipo'=>$res['tipo'],'unidad'=>$res['unidad'],'renobr'=>$res['renobr']);
						$i=$i+1;
					}
				}
			}
			return $proyectos;
		}

		public function obtenerNombre_IdActividad($idActividad){
			$query='select nombre from actividad where id='.$idActividad;
			$resultado=$this->conexion->consulta($query);
			//$resultado=mysql_query($query);
			$nombre="";
			if($resultado!=NULL){
				if(mysql_fetch_row($resultado)>0){
					//$resultado=$this->conexion->consulta($query);
					$resultado=mysql_query($query);
					while ($res=mysql_fetch_array($resultado)) {
						$nombre=$res['nombre'];	
					}
				}
			}
			return $nombre;
		}

		public function obtenerrenobr($idActividad){
			$query='select * from actividad where id='.$idActividad;
			$resultado=$this->conexion->consulta($query);
			//$resultado=mysql_query($query);
			$nombre;
			if($resultado!=NULL){
				if(mysql_fetch_row($resultado)>0){
					//$resultado=$this->conexion->consulta($query);
					$resultado=mysql_query($query);
					while ($res=mysql_fetch_array($resultado)) {
						$nombre=$res['renobr'];	
					}
				}
			}
			return $nombre;
		}

		public function obtenerTipo(){
			$query='select * from tipoa';
			$resultado=$this->conexion->consulta($query);
			//$resultado=mysql_query($query);
			$proyectos=array();
			if($resultado!=NULL){
				if(mysql_fetch_row($resultado)>0){
					$i=0;
					//$resultado=$this->conexion->consulta($query);
					$resultado=mysql_query($query);
					while ($res=mysql_fetch_array($resultado)) {
						$proyectos[$i]=array('id'=>$res['id'],'nombre'=>$res['nombre']);
						$i=$i+1;
					}
				}
			}
			return $proyectos;
		}

		public function listarActividades_tipo($id_tipo){
			$query='select * from actividad where tipo='.$id_tipo;
			$resultado=$this->conexion->consulta($query);
			//$resultado=mysql_query($query);
			$proyectos=array();
			if($resultado!=NULL){
				if(mysql_fetch_row($resultado)>0){
					$i=0;
					//$resultado=$this->conexion->consulta($query);
					$resultado=mysql_query($query);
					while ($res=mysql_fetch_array($resultado)) {
						$proyectos[$i]=array('id'=>$res['id'],'nombre'=>$res['nombre'],'tipo'=>$res['tipo'],'unidad'=>$res['unidad'],'renobr'=>$res['renobr']);
						$i=$i+1;
					}
				}
			}
			return $proyectos;
		}

		public function obtenerActividad_IdActividad($idActividad){
			$query='select * from actividad where id='.$idActividad;
			$resultado=$this->conexion->consulta($query);
			//$resultado=mysql_query($query);
			$proyectos=array();
			if($resultado!=NULL){
				if(mysql_fetch_row($resultado)>0){
					$i=0;
					//$resultado=$this->conexion->consulta($query);
					$resultado=mysql_query($query);
					while ($res=mysql_fetch_array($resultado)) {
						$proyectos[$i]=array('id'=>$res['id'],'nombre'=>$res['nombre'],'tipo'=>$res['tipo'],'unidad'=>$res['unidad'],'renobr'=>$res['renobr']);
						$i=$i+1;
					}
				}
			}
			return $proyectos[0];
		}

	};
 ?>		
