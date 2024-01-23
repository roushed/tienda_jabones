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



        if(isset($_POST['btn_eliminar'])){

            if(!isset($_POST['elimina'])){

                echo "No se ha seleccionado ningun check";

            }else{
                
                elimina_Datos($_POST['elimina'], "DELETE FROM pedidos WHERE pe_id=?");
            }


        }

        if(isset($_GET['estado'])){

            $estado=$_GET['estado'];
            $id_pedido=$_GET['id'];

            inserta_Datos("UPDATE pedidos SET pe_entrega=? WHERE pe_id=?", array($estado, $id_pedido));
            
        
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
            
            if(!isset($_SESSION['admin'])){

                die("Acceso restringido");
            }else{

                
                    $lista=consultar_lista2("SELECT * FROM pedidos WHERE pe_entrega = 2 ORDER BY pe_entrega, pe_fechent DESC", array("pe_id", "pe_email", "pe_fechped", "pe_fechent", "pe_totalped", "pe_entrega"), array());
                    $datos="";
                    $datos.="<table class='listapedidos'>";
                    $datos.="<form method='post' action='lista_pedidos.php'>";
                    $datos.="<tr><th>Id</th><th>Email</th><th>Fecha pedido</th><th>Fecha Entrega</th><th>Precio Total</th><th>Estado</th><th></th><th><input type='submit' value='Eliminar' name='btn_eliminar'></th></tr>";
                    for($i=0; $i<count($lista); $i++){
                        $datos.="<tr>";
                        for($z=0; $z<count($lista[$i]); $z++){
                            
                            if($z != 0){
                                $datos.="<td>".$lista[$i][$z]."</td>";

                            }else{
                                $datos.="<td><a href='./detalle_pedido.php?id_pedido=".$lista[$i][$z]."'>".$lista[$i][$z]."</a></td>";
                            }
                        }
                        $datos.="<td><input type='button' value='Finalizar Pedido' onClick=window.location.href='./pedidos_proceso.php?estado=3&id=".$lista[$i][0]."'></td>";
                        $datos.="<td><input type='checkbox' multiple name='elimina[]' value='".$lista[$i][0]."'></td>";
                        $datos.="</tr>";
                        }
                    $datos.="</form>";
                    $datos.="</table>";
                    $datos.= "<div class='btn_finalizado'><a href='./lista_pedidos.php'>Pedidos Pendientes</div>";
                    $datos.= "<div class='btn_finalizado'><a href='./pedidos_proceso.php'>Pedidos en Proceso</div>";
                    $datos.= "<div class='btn_finalizado'><a href='./pedidos_finalizados.php'>Pedidos Finalizados</div>";

                    echo $datos;

            
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