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
              
                <?php
                    if(isset($_GET['id'])){
                        $id=$_GET['id'];

                        try{
                            
                           
                            $con=Conectar();
                            $stmt=$con->prepare("SELECT * FROM productos WHERE pr_id=?");
                            $stmt->bindValue(1, $id);
                            //$stmt->bindValue(2, $id);
                            $stmt->execute();     

                            $datos="";
                            $datos.="<table class='tabla_detallep'>";
                           
                            while($fila=$stmt->fetch(PDO::FETCH_ASSOC)){

                                $datos.="<tr>";
                                $datos.="<td><img src='".$fila['pr_imagen']."' width='50%' height='50%'></td>";
                                $datos.="</tr>";
                                $datos.="<tr>";
                                $datos.="<td><p><b>".$fila['pr_nombre']."</a></b></p><p>".$fila['pr_descripcion']."</p><p>Peso:".$fila['pr_peso']." Kgs</p><p>Precio:".$fila['pr_precio']." €</p>";
                                if(isset($_SESSION["autentificar"])){
                                    
                                        if(isset($_SESSION['nombre'])){

                                        $limite=consultar_lista_1col("SELECT * FROM productos WHERE pr_id=?", "unidades", array($fila['pr_id']));
                                
                                        if($limite[0] != 0){
                                        $datos.="<p><a href='./procesa_cesta.php?id=".$fila['pr_id']."&mail=".$_SESSION['nombre']."'>Añadir en la Cesta</a></p>";
                                        }else{
                                            $datos.="<p><b><font color='#AB4D51'>No disponible!</font></b></p>";
                                        }
                                    }
                                }else{
                                    $datos.="<p>Para añadir a la cesta debe de <a href='./inicio_sesion.php'>Iniciar Sesión</font></b></p>";

                                }
                                $datos.="</td>";
                                $datos.="</tr>";
                                
                            }
                            $datos.="</table>";
                            
                            echo $datos;
                        

                        }catch(PDOException $e){
                            echo $e->getMessage();

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