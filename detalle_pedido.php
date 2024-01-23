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
            <div class="contenido">
              
            <?php
                if(isset($_GET['id_pedido'])){
            
            

                    
                        $consulta="SELECT * FROM productos pr INNER JOIN item_pedido ip ON pr.pr_id = ip.ip_id_prod INNER JOIN pedidos pe ON ip.ip_id_ped = pe.pe_id WHERE pe.pe_id=? GROUP BY pr.pr_id";
                        $lista=consultar_lista2($consulta, array("pr_imagen", "pr_nombre", "pr_precio", "ip_unidades", "pe_fechent", 'pe_totalped', 'pe_entrega'), array($_GET['id_pedido']));
                        if($lista != 0){

                            $datos="<table class='tabla_pedido'>";
                            $datos.="<tr>";
                            $datos.="<td colspan='5'><h1>Pedido Nº ".$_GET['id_pedido']."</h1></td>";
                            $datos.="</tr>";
                            $datos.="<tr>";
                            $datos.="<th>Imagen</th><th>Nombre</th><th>Precio</th><th>Unidades</th><th>Fecha Entrega</th>";
                            $datos.="</tr>";

                            
                            for($i=0; $i<count($lista); $i++){
                                $total_pedido=$lista[$i][5];
                                $estado=$lista[$i][6];
                                $datos.="<tr>";
                                for($z=0; $z<count($lista[$i])-2; $z++){
                                    if($z !=0){

                                        $datos.= "<td>".$lista[$i][$z]."</td>";

                                    }else{

                                        $datos.="<td><img src='./".$lista[$i][$z]."' width='70%' height='70%'></td>";

                                    }
                                }
                                
                                $datos.="</tr>";
                            }
                            $datos.="<tr><td colspan='5'><b>Estado</b>:$estado</td></tr>";
                            if($estado == "proceso"){
                                $datos.="<tr><td colspan='5'><b><a href=''>Ver Seguimiento</a></b></td></tr>";
                            }
                            $datos.="<tr><td colspan='5'><b>TOTAL:$total_pedido €</b></td></tr>";
                            $datos.="<tr><td colspan='5'><a href='./mis_pedidos.php'>Volver</a></td></tr>";
                            $datos.="</table>";
                                                
                            echo $datos;
                        
                        }else{
                            echo "<div>No se ha realizado ningún pedido</div>";
                        }
                        
                        
                       
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