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
    

        if(isset($_POST['editar'])){

            $id_p=$_POST['id_p'];
            $nombre=$_POST['nombre'];
            $descripcion=$_POST['descripcion'];
            $peso=$_POST['peso'];
            $precio=$_POST['precio'];
            $unidades=$_POST['unidades'];

            inserta_Datos("UPDATE productos SET pr_nombre=?, pr_descripcion=?, pr_peso=?, pr_precio=?, unidades=? WHERE pr_id=?", array($nombre, $descripcion, $peso, $precio, $unidades, $id_p));
            header('Location:./lista_productos.php');
            exit();
            
         
        }

    ?>
</head>
<body>
<?php
    if(isset($_GET['id_p'])){
                
        $id_pr=$_GET['id_p'];
                
        $registro=consultar_lista("SELECT * FROM productos WHERE pr_id=?", array("pr_nombre", "pr_descripcion", "pr_peso", "pr_precio", "unidades"), array($id_pr));
        
    }

?>

<div class="container">
            <div class="titulo">JABONES SCARLATTI</div>
            <div class='secciones'>
            <?php
               
               include "./sesion.php";
            ?>
            </div>
            <div class="contenido">
            
                <div class="cuadro_insert">
                   
                
                <form method="post" action="editar_producto.php">
                    <p class="editar"><input type="hidden" name="id_p" value="<?php echo $id_pr?>"></p>
                    <p class="editar"><input type="text" name="nombre" id="" value="<?php echo $registro[0] ?>"></p>
                    <p class="editar"><input type="text" name="descripcion" id="" value="<?php echo $registro[1] ?>"></p>
                    <p class="editar"><label>Peso:</label><input type="text" name="peso" id="" value="<?php echo $registro[2] ?>"><label>Kgs</label></p>
                    <p class="editar"><label>Precio:</label><input type="text" name="precio" id="" value="<?php echo $registro[3] ?>"><label>€</label></p>
                    <p class="editar"><input type="number" min="0" max="100" name="unidades" id="" value="<?php echo $registro[4] ?>"><label>Unidades:</label></p>
                    <p class="editar"><input type="submit" value="Editar" name="editar"></p>
                </form>


                   
                </div>
            </div>
            
            <div>
               
            </div>
            <div class="footer">Copyright</div>
            
            
            </div>
    </div>






</body>
</html>