<?php 
	require_once("../negocio/analisisN.php");

	class AnalisisP
	{
		private $analisisN;

		public function __construct()
		{
			$this->analisisN=new AnalisisN();
		}

		public function insertarAnalisis($descripcion,$unidad,$rendimiento,$precio,$idItem)
		{
			$this->analisisN->insertarAnalisis($descripcion,$unidad,$rendimiento,$precio,$idItem);
		}

		public function listarAnalisis($id_Item)
		{
				echo '<table id="analisis" class="table">
					<tr>
						<th>descripcion</th>		
						<th>unidad</th>
						<th>rendimiento</th>
						<th>precio unitario</th>
						<th>precio parcial</th>
						<th></th>
					</tr>';
							$analisis=$this->listaAnalisis_IdItem($id_Item);
							foreach ($analisis as $a) {
								echo '<tr>';
								echo '<td>'.$a['descripcion'].'</td>';
								echo '<td>'.$a['unidad'].'</td>';
								echo '<td>'.$a['rendimiento'].'</td>';
								echo '<td>'.$a['precioUnitario'].'</td>';
								echo '<td>'.$a['precioParcial'].'</td>';
								//echo '<td><button type="button" value="'.$a['id'].'" name="btnModificar" class="btn btn-default" data-toggle="modal" data-target="#modificarAnalisis"> modifiar</button></td>';
								echo '</tr>';
							}
						
				echo '</table>';
		}

		public function listaAnalisis_IdItem($idItem)
		{
			return $lista=$this->analisisN->listaAnalisis_IdItem($idItem);
		}

		public function actualizarCostoItem($idProyecto,$idItem)
		{
			$this->analisisN->actualizarCostoItem($idProyecto,$idItem);
		}

	}

	if(isset($_REQUEST['crearAnalisis'])){
		if($_REQUEST['crearAnalisis']=="crear"){
			$analisis=new AnalisisP();
			$analisis->insertarAnalisis($_REQUEST['descripcion'],$_REQUEST['unidad'],$_REQUEST['rendimiento'],$_REQUEST['precio'],$_REQUEST['idItem']);
			$analisis->actualizarCostoItem($_REQUEST['idProyecto'],$_REQUEST['idItem']);	
			echo"<script type=\"text/javascript\">window.location='../presentacion/gestionarAnalisis.php?idProyecto=".$_REQUEST['idProyecto']."&idItem=".$_REQUEST['idItem']."';</script>";  
		}else{
			//echo "no creo actividad";
		}
	}else{
		//echo "no isset";
	}

?>