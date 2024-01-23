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
        session_start();
       
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
         
        
                
            <div class='tablas'>
            
                    
                  <?php
                  $num_reg=6;
                  $hasta=0;
                  $pagina='1';
                  if(isset($_GET['pagina'])){
                      
                      $pagina=$_GET['pagina'];
                      $hasta=intval($_GET['pagina']-1)*$num_reg;
              
                  }
                  $consulta="SELECT * FROM productos ORDER BY pr_id LIMIT $hasta, $num_reg";
                  $lista=consultar_lista2($consulta, array('pr_id', 'pr_nombre', 'pr_descripcion', 'pr_peso', 'pr_precio', 'pr_imagen'), array());
                  $datost="";
                  for($i=0; $i<count($lista); $i++){

                    $datost.="<table>";
                    $datost.="<tr>";
                    $datost.="<td class='descripcion_i'><img src='".$lista[$i][5]."'></td>";
                    $datost.="</tr>";
                    $datost.="<tr>";
                    $datost.="<td class='descripcion_p'><p><b><a href='./detalles_producto.php?id=".$lista[$i][0]."'>".$lista[$i][1]."</a></b></p><p>".$lista[$i][2]."</p></p><p>".$lista[$i][3]." kgs</p><p>Precio: ".$lista[$i][4]." €</p>";
                    if(isset($_SESSION['autentificar'])){

                        if(isset($_SESSION['nombre'])){


                            //$fech_act=date('Y-m-d');
                            //$fech_res=date("Y-m-d",strtotime($fech_act."- 30 days"));
                            //$consulta2="SELECT SUM(ip.ip_unidades) AS total FROM pedidos p INNER JOIN item_pedido ip ON p.pe_id=ip.ip_id_ped WHERE p.pe_email=? AND pe_fechped BETWEEN '$fech_res' AND '$fech_act'";
                            //$consulta2="SELECT SUM(ip.ip_unidades) AS total FROM pedidos p INNER JOIN item_pedido ip ON p.pe_id=ip.ip_id_ped WHERE ip.ip_id_prod=".$lista[$i][0];
                            //$cantidad=sumar_Valores($consulta2, array());
                            $limite=consultar_lista_1col("SELECT * FROM productos WHERE pr_id=?", "unidades", array($lista[$i][0]));
                            
                            if($limite[0] != 0){
                                $datost.="<p><div class='anadir'><a href='./procesa_cesta.php?id=".$lista[$i][0]."'>Añadir en la Cesta</a></div></p>";
                            }else{
                                $datost.="<p><font color='#AB4D51'>No disponible</font></p>";
                            }

                        }

                    }
                    $datost.="</td>";
                    $datost.="</tr>";
                    $datost.="</table>";


                  }
                    
                   echo $datost;
                ?>
        </div>
                
        </div>
        <div>
            <?php

                $datosp="<div class='contenedor'>";
                //$num_pag=round($num_filas/$num_reg)+1;
                $consult_total="SELECT * FROM productos";
                $num_grupos=contar_Registros($consult_total, array());
                $num_pag=round($num_grupos/$num_reg,0, PHP_ROUND_HALF_UP);
                //echo $num_pag;
                $pag_anterior=intval($pagina)-1;
                $pag_anterior=strval($pag_anterior);
                if($pagina != "1"){

                    $datosp.="<div class='div_estado'><a href='./ver_productos.php?pagina=$pag_anterior'>Anterior</a></div>";

                }      
                for($i=0; $i<$num_pag; $i++){
                    
                        if($pagina == strval($i+1)){
                            
                            $datosp.="&nbsp<div class='seleccionado'><a href='./ver_productos.php?pagina=".strval($i+1)."'>".($i+1)."</a></div>";

                        }else{
                            $datosp.="&nbsp<div class='div_noselect'><a href='./ver_productos.php?pagina=".strval($i+1)."'>".($i+1)."</a></div>";

                        }  
                }

                $pag_siguiente=intval($pagina)+1;
                $pag_siguiente=strval($pag_siguiente);

                if($pagina != strval($num_pag)){
                    $datosp.="&nbsp<div class='div_estado'><a href='./ver_productos.php?pagina=$pag_siguiente'>Siguiente</a></div>";

                }
                $datosp.="</div>";

                echo $datosp;
        ?>
        </div>
        <div class="footer">Copyright</div>
      
    </div>
    
 
</body>
</html>