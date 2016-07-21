
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>jQuery.Gantt</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge;chrome=IE8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="http://maxcdn.bootstrapcdn.com/bootstrap/latest/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="../lib/jQuery.Gantt-master/css/style.css" type="text/css" rel="stylesheet">
        <link href="http://cdnjs.cloudflare.com/ajax/libs/prettify/r298/prettify.min.css" rel="stylesheet" type="text/css">
        <style type="text/css">
            body {
                font-family: Helvetica, Arial, sans-serif;
                font-size: 13px;
                padding: 0 0 50px 0;
            }
            h1 {
                margin: 40px 0 20px 0;
            }
            h2 {
                font-size: 1.5em;
                padding-bottom: 3px;
                border-bottom: 1px solid #DDD;
                margin-top: 50px;
                margin-bottom: 25px;
            }
            table th:first-child {
                width: 150px;
            }
            /* Bootstrap 3.x re-reset */
            .fn-gantt *,
            .fn-gantt *:after,
            .fn-gantt *:before {
              -webkit-box-sizing: content-box;
                 -moz-box-sizing: content-box;
                      box-sizing: content-box;
            }
        </style>
    </head>
    <body>

        <div class="container">

            <h1>
                DIAGRAMA DE GANTT
            </h1>

            

            <h2 id="example">
                diagrama
            </h2>

            <div class="gantt"></div>

        <a href="gestionarProyectoP.php?id=<?php echo $_REQUEST['id'] ?>" class="btn btn-primary">volver</a>

    <script src="../lib/jQuery.Gantt-master/js/jquery.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
    <script src="../lib/jQuery.Gantt-master/js/jquery.fn.gantt.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/latest/js/bootstrap.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/prettify/r298/prettify.min.js"></script>
    <script>
        $(function() {

            "use strict";
            var ff=2;

            $(".gantt").gantt({
                source: [
                    <?php 
                        require_once("../negocio/itemN.php");
                        require_once("../negocio/actividadN.php");
                        $itemN=new ItemN();
                        $actividadN=new ActividadN();
                        $items=$itemN->listaItem_IdProyecto($_REQUEST['id']);
                        foreach ($items as $item ) {
                            $nombre=$actividadN->obtenerNombre_IdActividad($item['idActividad']);
                            echo '{';
                            echo 'name: "'.$nombre.'",';
                            echo 'values: [{';
                                echo 'from: "/Date('.$itemN->getFechaI($item['id']).')/",';
                                echo 'to: "/Date('.$itemN->getFechaF($item['id']).')/",';
                                echo 'label: "'.$nombre.'",';
                                echo 'customClass: "ganttRed",';
                                echo 'dataObj: ff="'.$actividadN->obtenerConsejo($item['idActividad']).'"';
                            echo '}';//adicionar otro item
                            echo '],';
                            echo 'id: '.$item['id'].',';
                            echo '},';
                        }
                    ?>
                    ],
                navigate: "scroll",
                scale: "days",
                maxScale: "months",
                minScale: "hours",
                itemsPerPage: 15,
                useCookie: false,
                onItemClick: function(data) {
                    //alert("Item clicked - show some details "+data);
                    if(data!=""){
                        alert(data);
                    }
                },
                onAddClick: function(dt, rowId) {
                    //alert("Empty space clicked - add an item!");
                    alert(dt+" - "+rowId);
                },
                onRender: function() {
                    if (window.console && typeof console.log === "function") {
                        console.log("chart rendered");
                    }
                }
            });

            /*$(".gantt").popover({
                selector: ".bar",
                title: "I'm a popover",
                content: "And I'm the content of said popover.",
                trigger: "hover"
            });*/

            prettyPrint();

        });
    </script>

    </body>
</html>

</html>
