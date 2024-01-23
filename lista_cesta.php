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

       $idcesta=consultar_lista_1col("SELECT * FROM cesta WHERE ce_email=?", "ce_id", array($_SESSION['nombre']));
    
  
       switch(true) {
 
            case isset($_GET['elimina']):

                elimina_Datos(array($_GET['elimina']), "DELETE FROM item_cesta WHERE ic_id=?");
                header('Location:./lista_cesta.php');
                exit(); 
                break;
                
            case isset($_GET['aumentaid']):
             
                //$fech_act=date('Y-m-d');
                //$fech_res=date("Y-m-d",strtotime($fech_act."- 30 days"));
                //$consulta2="SELECT SUM(ip.ip_unidades) AS total FROM pedidos p INNER JOIN item_pedido ip ON p.pe_id=ip.ip_id_ped WHERE p.pe_email=? AND pe_fechped BETWEEN '$fech_res' AND '$fech_act'";
  
                $cantidad=sumar_Valores("SELECT SUM(ic_cantidad) AS total FROM item_cesta where ic_id=?", array($_GET['aumentaid']));
                $limite=consultar_lista_1col("SELECT * FROM productos WHERE pr_id=?", "unidades", array($_GET['idproducto']));
                echo $limite[0];
                echo $cantidad;
                if($cantidad < $limite[0]){
                    
                    inserta_Datos("UPDATE item_cesta SET ic_cantidad=ic_cantidad+1 WHERE ic_id=?", array($_GET['aumentaid']));
                    
                }

                header('Location:./lista_cesta.php');
                exit(); 

                break;

            case isset($_GET['disminuyeid']):
                $cantidad=consultar_lista_1col("SELECT * FROM item_cesta WHERE ic_id=?", "ic_cantidad", array($_GET['disminuyeid']));
                if($cantidad[0] != 1){
                inserta_Datos("UPDATE item_cesta SET ic_cantidad=ic_cantidad-1 WHERE ic_id=?", array($_GET['disminuyeid']));
                }

                header('Location:./lista_cesta.php'); 
                exit();  
                break;
     
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
            <div class="contenido">
   
                
                    <?php

                        $lista_total=array();
                        $total=0;
                        //echo $email;

                        $consulta="SELECT *, ic.ic_cantidad*pr.pr_precio AS multi FROM productos pr, clientes cl, cesta c, item_cesta ic WHERE cl.cli_email=c.ce_email AND c.ce_id=ic.ic_idcesta AND ic.ic_idproducto=pr.pr_id AND c.ce_email=?";
                        $lista=consultar_lista2($consulta, array('pr_imagen', 'pr_nombre', 'pr_precio', 'ic_id','ic_idcesta','ic_idproducto','ic_cantidad', 'multi'), array($_SESSION['nombre']));
                        
                        if($lista != 0){
                            $datos="<table class='tabla_cesta'>";
                            $datos.="<tr class='titulo_cesta'><th colspan='3'>Cesta de la compra</td></th></tr>";
                            if(isset($_GET['errorc'])){

                                $datos.="<tr><td colspan='3'><div class='advert'><p>No se admiten más unidades del artículo<p></div></td></tr>";

                            }
                               
                                for($i=0; $i<count($lista); $i++){
                                    $datos.="<tr><a name='ancla-".$i."'></a>";
                                    $datos.="<td><div class='img_item'><img src='".$lista[$i][0]."'></div></td><td><p>".$lista[$i][1]."</p><p><b>".$lista[$i][2]." €</b></p><p>&nbsp<input type='button' class='cantidades' value='-' onClick=window.location.href='./lista_cesta.php?disminuyeid=".$lista[$i][3]."#ancla-$i'>&nbsp<input type='text' size='1' value='".$lista[$i][6]."' readonly>&nbsp<input type='button' class='cantidades' value='+' onClick=window.location.href='./lista_cesta.php?aumentaid=".$lista[$i][3]. "&idproducto=" .$lista[$i][5]. "#ancla-$i'></p></td><td><a href='./lista_cesta.php?elimina=".$lista[$i][3]."'>Eliminar</a></td>";
                                    $datos.="</tr>";
                                    $total+=intval($lista[$i][7]);


                                }
                                
                                
                            $_SESSION['total']=$total;
                            $datos.="<tr><td colspan='2'><h1>TOTAL: $total €</h1></td></tr>";
                            $datos.="<tr><td colspan='2'><p><form method='POST' action='proceso_pedido.php'><input type='hidden' value='".$lista[0][4]."' name='idcesta'><input type='submit' value='Realizar Pedido' name='pedido'></form></p></td></tr>";
                            $datos.="</table>";
                            
                            
                            //print_r($lista_total);
                            echo $datos;

                        }else{
                            echo "No se han añadido artículos a la cesta";
                        }
                        

                ?>

            </div>


            <div class="footer">Copyright</div>
            
            
            </div>
    </div>

</body>
</html>