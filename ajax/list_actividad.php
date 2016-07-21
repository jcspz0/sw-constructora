<?php
	require_once("../presentacion/actividadP.php");
    $actividadP=new ActividadP();
	$tipo = $_POST["id_tipo"];
	$act=$actividadP->listarActividades_tipo($tipo);
	while($list_act = mysql_fetch_array($act))
	{
		echo "<option value=\"".$list_act['id']."\">".$list_act['nombre']."</option>";
	}
	
?>