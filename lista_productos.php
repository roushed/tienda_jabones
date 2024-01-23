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
            
            if(!isset($_POST['eliminar'])){
                echo "No se ha seleccionado ningun check";
            }else{
                foreach($_POST['eliminar'] as $elemento){
                 
                    $con=Conectar();
                    $stmt=$con->prepare("DELETE FROM productos WHERE pr_id=?");
                    $stmt->bindValue(1, $elemento);
                    //$stmt->bindValue(2, $id);
                    $stmt->execute();
                    $num_filas=$stmt->rowCount();

                }
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
            <div class="contenido">
              
        
            <?php
                if(!isset($_SESSION['admin'])){

                    die("Acceso restringido");
                }else{
                crear_Tabla_del("SELECT * FROM productos", array("pr_id", "pr_nombre", "pr_descripcion", "pr_peso", "pr_precio", "pr_imagen", "unidades"));
                echo "<div class='btn_insertar'><a href='./insertar_producto.php'>Insertar</div>";
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