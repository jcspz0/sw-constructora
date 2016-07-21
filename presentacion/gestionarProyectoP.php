
	<?php 
		include_once("head.php"); 
	 ?>

	<?php
		require_once("proyectoP.php");
		$proyectoP=new ProyectoP();
		$idProyecto=$_REQUEST['id'];
		$proyectoP->opcioneProyectos($idProyecto);
 	?>

	<?php 
		include_once("foot.php");
	 ?>
