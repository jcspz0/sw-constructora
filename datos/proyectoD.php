<?php 
	
	require_once("../conexion/conexion.php");

	class ProyectoD{

		var $nombre;
		var $nombrePropietario;
		var $direccion;
		var $responsable;
		var $fechaIni;
		var $conexion;

		public function __construct(){
			$this->nombre="";
			$this->nombrePropietario="";
			$this->direccion="";
			$this->responsable="";
			$this->total=0;
			$this->fechaIni="";
			$this->conexion=conexion::getConexion();
		}

		public function getNombre(){
			return $this->nombre;			
		}

		public function setNombre($nombre){
			$this->nombre=$nombre;
		}

		public function getNombrePropietario(){
			return $this->nombrePropietario;
		}

		public function setNombrePropietario($nombrePropietario){
			$this->nombrePropietario=$nombrePropietario;
		}

		public function getDireccion(){
			return $this->direccion;
		}

		public function setDireccion($direccion){
			$this->direccion=$direccion;
		}

		public function getResponsable(){
			return $this->responsable;
		}

		public function setResponsable($responsable){
			$this->responsable=$responsable;
		}

		public function getTotal(){
			return $this->total;
		}

		public function setTotal($total){
			$this->total=$total;
		}

		public function getFechaIni(){
			return $this->fechaIni;
		}

		public function setFechaIni($fechaIni){
			$this->fechaIni=$fechaIni;
		}


		public function guardar($nombre,$nombrePropietario,$direccion,$responsable,$fechaIni){
			$this->setNombre($nombre);
			$this->setNombrePropietario($nombrePropietario);
			$this->setDireccion($direccion);
			$this->setResponsable($responsable);
			$this->setFechaIni($fechaIni);
			$this->guardar1();
		}

		public function guardar1(){
			$query='insert into proyecto values (null,"'
				.$this->getNombre().'","'
				.$this->getNombrePropietario().'","'
				.$this->getDireccion().'","'
				.$this->getResponsable().'","'
				.$this->getFechaIni().'","'
				.$this->getTotal().'");';
			$this->conexion->consulta($query);
			//$resultado=mysql_query($query);
		}

		public function listar(){//devuelve un array con todos los datos
			$query='select * from proyecto';
			$resultado=$this->conexion->consulta($query);
			//$resultado=mysql_query($query);
			$proyectos=array();
			if($resultado!=NULL){
				if(mysql_fetch_row($resultado)>0){
					$i=0;
					$resultado=$this->conexion->consulta($query);
					//$resultado=mysql_query($query);
					while ($res=mysql_fetch_array($resultado)) {
						$proyectos[$i]=array('id'=>$res['id'],'nombre'=>$res['nombre'],'nombrePropietario'=>$res['nombrePropietario'],'direccion'=>$res['direccion'],'responsable'=>$res['responsable'],'total'=>$res['total'],'fechaIni'=>$res['fechaIni']);
						$i=$i+1;
					}
				}
			}
			return $proyectos;
		}

		public function obtenerProyecto($idProyecto){
			$query='select * from proyecto where id='.$idProyecto;
			$resultado=$this->conexion->consulta($query);
			//$resultado=mysql_query($query);
			$proyecto=NULL;
			if($resultado!=NULL){
				if(mysql_fetch_row($resultado)>0){
					$resultado=$this->conexion->consulta($query);
					//$resultado=mysql_query($query);
					while($res=mysql_fetch_array($resultado)){
						$proyecto=array('id'=>$res['id'],'nombre'=>$res['nombre'],'nombrePropietario'=>$res['nombrePropietario'],'direccion'=>$res['direccion'],'responsable'=>$res['responsable'],'fechaIni'=>$res['fechaIni'],'total'=>$res['total']);
					}
				}
			}
			return $proyecto;
		}

		public function actualizarFechaProyecto($id_proyecto,$fecha){
			$query='update proyecto set fechaIni="'.$fecha.'" WHERE id='.$id_proyecto;
			$this->conexion->consulta($query);
		}

		public function actualizarTotal($idProyecto,$total)
		{
			$query='update proyecto set total='.$total.' WHERE id='.$idProyecto;
			$this->conexion->consulta($query);
		}

	};


 ?>