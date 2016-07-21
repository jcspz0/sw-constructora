<?php 
	require_once("../conexion/conexion.php");

	class AnalisisD
	{
		private $conexion;
		private $descripcion;
		private $unidad;
		private $rendimiento;
		private $precioUnitario;
		private $precioParcial;
		private $idItem;

		public function __construct()
		{
			$this->descripcion="";
			$this->unidad="";
			$this->rendimiento=0;
			$this->precioUnitario=0.0;
			$this->precioParcial=0.0;
			$this->idItem="0";
			$this->conexion=conexion::getConexion();
		}

		public function getDescripcion()
		{	
			return $this->descripcion;
		}

		public function setDescripcion($descripcion)
		{
			$this->descripcion=$descripcion;
		}

		public function getUnidad()
		{
			return $this->unidad;
		}

		public function setUnidad($unidad)
		{
			$this->unidad=$unidad;
		}

		public function getRendimiento()
		{
			return $this->rendimiento;
		}

		public function setRendimiento($rendimiento)
		{
			$this->rendimiento=$rendimiento;
		}

		public function getPrecioUnitario()
		{
			return $this->precioUnitario;
		}

		public function setPrecioUnitario($precioUnitario)
		{
			$this->precioUnitario=$precioUnitario;
		}

		public function getPrecioParcial()
		{
			return $this->getPrecioUnitario()*$this->getRendimiento();
			//return $this->precioParcial;
		}

		public function setPrecioParcial($precioParcial)
		{
			$this->setPrecioParcial=$precioParcial;
		}

		public function getIdItem()
		{
			return $this->idItem;
		}

		public function setIdItem($idItem)
		{
			$this->idItem=$idItem;
		}

		public function guardar($descripcion,$unidad,$rendimiento,$precio,$precioParcial,$idItem){
			$this->setDescripcion($descripcion);
			$this->setUnidad($unidad);
			$this->setRendimiento($rendimiento);
			$this->setPrecioUnitario($precio);
			$this->setPrecioParcial($precioParcial);
			$this->setIdItem($idItem);
			$this->guardar1();
		}

		public function guardar1(){
			$query='insert into analisisitem values (null,"'
				.$this->getDescripcion().'","'
				.$this->getUnidad().'",'
				.$this->getRendimiento().','
				.$this->getPrecioUnitario().','
				.$this->getPrecioParcial().','
				.$this->getIdItem().');';
			$this->conexion->consulta($query);
			//$resultado=mysql_query($query);
		}

		public function listarAnalisis_IdItem($idItem)
		{
			$query='select * from analisisitem where idItem='.$idItem;
			$resultado=$this->conexion->consulta($query);
			//$resultado=mysql_query($query);
			$proyectos=array();
			if($resultado!=NULL){
				if(mysql_fetch_row($resultado)>0){
					$i=0;
					//$resultado=$this->conexion->consulta($query);
					$resultado=mysql_query($query);
					while ($res=mysql_fetch_array($resultado)) {
						$proyectos[$i]=array('id'=>$res['id'],'descripcion'=>$res['descripcion'],'unidad'=>$res['unidad'],'rendimiento'=>$res['rendimiento'],
							'precioUnitario'=>$res['precioUnitario'],'precioParcial'=>$res['precioParcial'],'idItem'=>$res['idItem']);
						$i=$i+1;
					}
				}
			}
			return $proyectos;
		}

		public function calcularPrecioItem($idItem)
		{
			$query='select SUM(precioParcial) as precio FROM analisisitem where idItem='.$idItem;
			$resultado=$this->conexion->consulta($query);
			//$resultado=mysql_query($query);
			$proyectos=array();
			if($resultado!=NULL){
				if(mysql_fetch_row($resultado)>0){
					$i=0;
					//$resultado=$this->conexion->consulta($query);
					$resultado=mysql_query($query);
					while ($res=mysql_fetch_array($resultado)) {
						$proyectos[$i]=array('precio'=>$res['precio']);
						$i=$i+1;
					}
				}
			}
			return $proyectos[0]['precio'];
		}

	}
 ?>