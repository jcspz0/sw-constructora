<?php 
    include_once("head.php");
 ?>
 <div class="row services">

                    <article class="service-box col-12">

                        <div class="">
                        
                                <form action="proyectoP.php" id="form" method="post">
                                    <div style="" class="col-md-6">
                                            <div class="form-group">
                                                <label for="nombre">Nombre:</label>
                                                <input class="form-control" name="nombre" type="text" >
                                            </div>

                                            <div class="form-group">
                                                <label for="nombre">Propietario:</label>
                                                <input class="form-control" name="nombrePropietario" type="text" >
                                            </div>

                                            <div class="form-group">
                                                <label for="nombre">Direccion:</label>
                                                <input class="form-control" name="direccion" type="text" >
                                            </div>

                                            <div class="form-group">
                                                <label for="nombre">Responsable:</label>
                                                <input class="form-control" name="responsable" type="text" >
                                            </div>

                                            <div class="form-group">
                                                <input class="" name="crearProyecto" type="hidden" value="crear">
                                            </div>

                                            <div class="form-group">
                                            <p>
                                                <input class="wpcf7-form-control wpcf7-submit" type="submit" value="Guardar">
                                                <input type="submit" value="Cancelar" class="wpcf7-form-control wpcf7-submit" />
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