<?php 
    include_once("head.php");
    require_once("itemP.php");
    $itemP=new ItemP();
    $idProyecto=$_REQUEST['idProyecto'];
 ?>
 <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script  >
        if (document.addEventListener) { 
           document.addEventListener("DOMContentLoaded", inicializar, false);
        }

        function inicializar(){
           $("#tipo").change(function () {
                            $("#tipo option:selected").each(function () {
                                var id_tipo = $(this).val();
                                $.post("../ajax/list_actividad.php", { id_tipo: id_tipo}, function(data){
                                    $("#actividad").html(data);
                                });
                                
                                
                                //--------- 
                            });
                        });
        } 

</script>
  
 <div class="row services">

                    <article class="service-box col-12">

                        <div class="">
                        
                                <form action="itemP.php" id="form" method="post">

                                	

                                    <div style="" class="col-md-6">
                                            
                                            <div>
                                                <label for="nombre">tipo de actividad  :</label>
                                                <?php
                                                    $itemP->obtenerTipo();
                                                ?>
                                            </div>

                                            <div class="form-group">
                                                <label for="nombre">actividad  :</label>
										        <select name="actividad" id="actividad">
                                                    <option value=0>elija un tipo de actividad</option>
    
                                                </select> 
                                            </div>

                                            <div class="form-group">
                                                <label for="nombre">tamaño(u) :</label>
                                                <input type="text" name="tamano" value="100">
                                            </div>

                                            <div class="form-group">
                                                <label for="nombre">duracion  :</label>
										    	<input type="text" name="duracion" value="1">
										    </div>

                                            <div class="form-group">
                                                <label for="nombre">actividad previa :</label>
										        <?php 
                                                    $itemP->actividadesProyecto($idProyecto) 
                                                ?>
                                            </div>

                                            <div class="form-group">
                                                <input class="" name="crearItem" type="hidden" value="crear2">
                                            </div>

                                            <div class="form-group">
                                                <input class="" name="idProyecto" type="hidden" value="<?php echo $idProyecto ?>">
                                            </div>

                                            <div class="form-group">
                                            <p>
                                                <input class="btn btn-primary" type="submit" value="Guardar">
                                                <a href="gestionarActividadP.php?id=<?php echo $idProyecto ?>" class="btn btn-primary">cancelar</a>
                                            </p>
                                            </div>
                                                                                
                                    </div>
                                </form>

                            </div>
                    </article>

                </div>
 <?php 
    include_once("foot.php");
  ?>