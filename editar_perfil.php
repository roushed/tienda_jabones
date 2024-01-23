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

            
            $nombre=$_POST['nombre'];
            $direccion=$_POST['direccion'];
            $cp=$_POST['cp'];
            $telefono=$_POST['telefono'];

            inserta_Datos("UPDATE clientes SET cli_nombre=?, cli_direccion=?, cli_cp=?, cli_telefono=? WHERE cli_email=?", array($nombre, $direccion, $cp, $telefono, $_SESSION['nombre']));
            header('Location:./mi_perfil.php');
            exit();
            
         
        }

    ?>
</head>
<body>
<?php
    if(isset($_SESSION['nombre'])){
                
                
        $registro=consultar_lista("SELECT * FROM clientes WHERE cli_email=?", array("cli_nombre", "cli_direccion", "cli_cp", "cli_telefono"), array($_SESSION['nombre']));
        
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
                   
                
                <form method="post" action="">
           
                    <p class="editar"><label>Nombre:</label><input type="text" name="nombre" id="" value="<?php echo $registro[0] ?>"></p>
                    <p class="editar"><label>Direccion:</label><input type="text" name="direccion" id="" value="<?php echo $registro[1] ?>"></p>
                    <p class="editar"><label>CP:</label><input type="text" name="cp" id="" value="<?php echo $registro[2] ?>"></p>
                    <p class="editar"><label>Telefono:</label><input type="text" name="telefono" id="" value="<?php echo $registro[3] ?>"></p>
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