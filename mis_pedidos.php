<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/style.css">
    <?php
        include "./f_modular.php";
        include "./seguridad.php";


        if(isset($_GET['estado'])){

            $estado=$_GET['estado'];
            $id_pedido=$_GET['id'];

            inserta_Datos("UPDATE pedidos SET pe_entrega=? WHERE pe_id=?", array($estado, $id_pedido));
            
        
        }

        if(isset($_POST['btn_eliminar'])){

            if(!isset($_POST['elimina'])){

                echo "No se ha seleccionado ningun check";

            }else{
                
                elimina_Datos($_POST['elimina'], "DELETE FROM pedidos WHERE pe_id=?");
            }


        }

    ?>

 
</head>
<body>


<div class="container">
            <div class="titulo">JABONES SCARLATTI</div>
            <div class='secciones'>
                

                <?php
                    include "./sesion.php"; 
            
      
                ?>
            </div>
            <div class="contenidop">

            <?php
            
            if(!isset($_SESSION['nombre'])){

                die("Acceso restringido");
            }else{

                
                $lista=consultar_lista2("SELECT * FROM pedidos  WHERE pe_email=? AND pe_entrega != 3 ORDER BY pe_fechent", array("pe_id", "pe_fechped", "pe_fechent", "pe_totalped", "pe_entrega"), array($_SESSION['nombre']));
                $lista2=consultar_lista2("SELECT * FROM pedidos  WHERE pe_email=? AND pe_entrega = 3 ORDER BY pe_fechent", array("pe_id", "pe_fechped", "pe_fechent", "pe_totalped", "pe_entrega"), array($_SESSION['nombre']));
                $datosp="";

                if($lista == 0 && $lista2 == 0){
                    echo "<p>No se ha realizado ningún pedido</p>";

                }
                if($lista != 0){

                    $datosp.="<h2>Mis Pedidos:</h2>";
                    $datosp.="<table class='listapedidos'>";
    
                    $datosp.="<tr><th>Id</th><th>Fecha pedido</th><th>Fecha Entrega</th><th>Precio Total</th><th>Estado</th><th>Detalles Pedido</th></tr>";
                    for($i=0; $i<count($lista); $i++){
                        $datosp.="<tr>";
                        for($z=0; $z<count($lista[$i]); $z++){
                            
                            $datosp.="<td>".$lista[$i][$z]."</td>";
       
                        }
                        $datosp.="<td><a href='./detalle_pedido.php?id_pedido=".$lista[$i][0]."'>Ver Pedido</a></td>";
                        $datosp.="</tr>";
                    }
                    $datosp.="</table>";



                }


                if($lista2 != 0){

                    $datosp.="<h2>Pedidos Entregados:</h2>";
                    $datosp.="<table class='listapedidos'>";
    
                    $datosp.="<tr><th>Id</th><th>Fecha pedido</th><th>Fecha Entrega</th><th>Precio Total</th><th>Estado</th><th>Detalles Pedido</th></tr>";
                    for($i=0; $i<count($lista2); $i++){
                        $datosp.="<tr>";
                        for($z=0; $z<count($lista2[$i]); $z++){
                            
                            $datosp.="<td>".$lista2[$i][$z]."</td>";
       
                        }
                        $datosp.="<td><a href='./detalle_pedido.php?id_pedido=".$lista2[$i][0]."'>Ver Pedido</a></td>";
                        $datosp.="</tr>";
                    }
                    $datosp.="</table>";



                }
                echo $datosp;

            }
                
    

            ?>
  
            </div>
            <div>
               
            </div>
            <div class="footer">Copyright</div>
            
            
            </div>
    </div>

    
</body>
</html>