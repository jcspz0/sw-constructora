<?php 
	require_once("../presentacion/actividadP.php");
	$n=new ActividadP();
	$fecha=$_REQUEST['fechaIni'];
	$n->actualizarFechaProyecto($_REQUEST['id'],$fecha);
	echo '
    		<label for="nombre">Fecha Inicial: '.$n->getFechaProyecto($_REQUEST['id']).'</label>
            <input class="form-control" name="fechaIni" type="date" ><br>
        ';
 ?>