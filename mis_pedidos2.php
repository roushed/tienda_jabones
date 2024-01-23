<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/style.css">
    <?php
       
       include "./seguridad.php";
       include "./f_modular.php";
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
                $lista=array("pendiente" => array(),  "entregado" => array());
                
                try{     
                    $con=Conectar();
                    $stmt=$con->prepare("SELECT * FROM pedidos  WHERE pe_email=? ORDER BY pe_fechent");
                    $stmt->bindValue(1, $_SESSION['nombre']);
                    //$stmt->bindValue(2, $id);
                    $stmt->execute();
                    
                    $num_filas=$stmt->rowCount();
                    while($fila=$stmt->fetch(PDO::FETCH_ASSOC)){
                        if($fila['pe_entrega'] == "pendiente" || $fila['pe_entrega'] == "proceso" ){
                           
                            array_push($lista['pendiente'], $fila);
                        
                        }else if($fila['pe_entrega'] == "entregado"){
                            
                            array_push($lista['entregado'], $fila);

                        }
                        
                    }
                    
                    $datos="";
                    foreach($lista as $clave => $valor){

                        $datos.="<table class='listapedidos'>";
                        $datos.="<tr><th>Id</th><th>Correo</th><th>Fecha pedido</th><th>Fecha Entrega</th><th>Precio Total</th><th>Estado</th><th>Detalles Pedido</th></tr>";
                        foreach($valor as $clave2 => $valor2){
                            $datos.="<tr>";
                            foreach($valor2 as $clave3 => $valor3){
                                $datos.="<td>$valor3</td>";

                            }
                            $datos.="<td><a href='./detalle_pedido.php?id_pedido=".$valor2['pe_id']."'>Ver Pedido</a></td>";
                            $datos.="</tr>";
                        }
                        $datos.="</table>";
                    }

                    echo $datos;
                }catch(PDOException $e){
                    echo $e->getMessage();
            
                }

            ?>
                   
            </div>
            <div class="btn_generar">
               

            </div>
            <div class="footer">Copyright</div>
            
            
            </div>
    </div>

</body>
</html>