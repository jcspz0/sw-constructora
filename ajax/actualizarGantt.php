
	<script type="text/javascript">	alert("as");
		var ganttData = [
		<?php 
			require_once("../negocio/itemN.php");
            require_once("../negocio/actividadN.php");

            $itemN=new ItemN();
            $actividadN=new ActividadN();
            $items=$itemN->listaItem_IdProyecto($_REQUEST['id']);




            foreach ($items as $item ) {
                $nombre=$actividadN->obtenerNombre_IdActividad($item['idActividad']);
                            echo '{';
                            echo 'id: '.$item['id'].',';
                            echo 'name: "'.$nombre.'",';
                            echo 'series: [{';
                            	echo 'name: "'.'planeado'.'",';
                            	echo 'start: new Date('.$itemN->getFechaI($item['id']).'),';
                            	echo 'end: new Date('.$itemN->getFechaF($item['id']).'),';
                            	//echo 'start: new Date('.$itemN->getFechaI($item['id']).'),';
                            	//echo 'end: new Date('.$itemN->getFechaE($item['id'],2).'),';
                            	echo 'color: "#000000",';
								echo 'consejo: "'.$itemN->diferencia_fecha($itemN->getFechaI($item['id']),$itemN->getFechaF($item['id'])).'"';
                            	echo '},';
                            echo ']},';
                            //-----------



                            echo '{';
                            echo 'id: '.$item['id'].',';
                            echo 'name: "'.$nombre.'",';
                            echo 'series: [{';
                            	echo 'name: "'.'planeado'.'",';
                            	echo 'start: new Date('.$itemN->getFechaI($item['id']).'),';
                            	echo 'end: new Date('.$itemN->getFechaF($item['id']).'),';
                            	//echo 'start: new Date('.$itemN->getFechaI($item['id']).'),';
                            	//echo 'end: new Date('.$itemN->getFechaE($item['id'],2).'),';
                            	echo 'color: "#ffffff",';
								echo 'consejo: "'.$itemN->diferencia_fecha($itemN->getFechaI($item['id']),$itemN->getFechaF($item['id'])).'"';
                            	echo '},';
                            echo ']},';
            }
		 ?>

		];

	</script>		
	