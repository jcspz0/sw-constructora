<?php 
			require_once("../negocio/itemN.php");
			$itemN=new ItemN();
			$items=$itemN->listaItemGantt_IdProyecto($_REQUEST['id']);
			
           	foreach ($items as $item ) {
           		echo '<input class="limit" type="hidden" id="'.$item['idItem'].'" value="'.$itemN->getFechaLimit($item['idItem']).'">';
           	}

		?>