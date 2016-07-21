<?php 
	class GanttD{

		var $id;
		var $item;
		var $predecesor;
		var $duracion;
		var $color;
		var $critico;

		public function __construct(){
			$this->id=0;
			$this->item=0;
			$this->predecesor=0;
			$this->duracion=0;
			$this->color="#ffffff";
			$this->critico=false;
		}

		public function crear($id,$item,$predecesor,$duracion){
			$this->id=$id;
			$this->item=$item;
			$this->predecesor=$predecesor;
			$this->duracion=$duracion;	
			$this->color="#ffffff";
			$this->critico=false;
			return $this;
		}

		public function crearC($id,$item,$predecesor,$duracion,$color,$critico){
			$this->id=$id;
			$this->item=$item;
			$this->predecesor=$predecesor;
			$this->duracion=$duracion;	
			$this->color=$color;
			$this->critico=$critico;
		}

		public function getId(){
			return $this->id;
		}

		public function setId($id){
			$this->id=$id;
		}

		public function getItem(){
			return $this->item;
		}

		public function getPredecesor(){
			return $this->predecesor;
		}

		public function getDuracion(){
			return $this->duracion;
		}

		public function setItem($item){
			$this->item=$item;
		}

		public function setPredecesor($predecesor){
			$this->predecesor=$predecesor;
		}

		public function setDureacion($duracion){
			$this->duracion=$duracion;
		}

		public function getColor(){
			return $this->color;
		}

		public function setIColor($color){
			$this->color=$color;
		}

		public function getCritico(){
			return $this->critico;
		}

		public function setCritico($critico){
			$this->critico=$critico;
		}

		//-----------------------------------------------------------------------------


		

	};
 ?>