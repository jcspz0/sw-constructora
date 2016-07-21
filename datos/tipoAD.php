<?php 
	require_once("../conexion/conexion.php");
	class TipoAD{

		var $nombre;
		var $conexion;

		public function __construct(){
			$this->nombre="";
			$this->conexion=conexion::getConexion();
		}

		public function getNombre(){
			return $this->nombre;
		}

		public function setNombre($nombre){
			$this->nombre=$nombre;
		}

		public function guardar($nombre){
			$this->setNombre($nombre);
			$this->guardar1();
		}

		public function guardar1(){
			$query='insert into tipoa values (null,"'
				.$this->getNombre().'");';
			$this->conexion->consulta($query);
			//$resultado=mysql_query($query);
		}

		public function listar(){//devuelve un array con todos los datos
			$query='select * from tipoa';
			$resultado=$this->conexion->consulta($query);
			//$resultado=mysql_query($query);
			$proyectos=array();
			if($resultado!=NULL){
				if(mysql_fetch_row($resultado)>0){
					$i=0;
					$resultado=$this->conexion->consulta($query);
					//$resultado=mysql_query($query);
					while ($res=mysql_fetch_array($resultado)) {
						$proyectos[$i]=array('id'=>$res['id'],'nombre'=>$res['nombre']);
						$i=$i+1;
					}
				}
			}
			return $proyectos;
		}

		public function obtenerNombre_IdTipoA($idTipoA){
			$query='select nombre from tipoa where id='.$idTipoA;
			$resultado=$this->conexion->consulta($query);
			//$resultado=mysql_query($query);
			$nombre;
			if($resultado!=NULL){
				if(mysql_fetch_row($resultado)>0){
					$resultado=$this->conexion->consulta($query);
					//$resultado=mysql_query($query);
					while ($res=mysql_fetch_array($resultado)) {
						$nombre=$res['nombre'];	
					}
				}
			}
			return $nombre;
		}

	};
 ?>		
