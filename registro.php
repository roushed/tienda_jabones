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
            
                <div class="cuadro_insert">
                    <center><h1>Registro de Usuario</h1></center>
                    <form action="" method="post">
                        <?php
                           crearFormularioText(array("email", "password", "passwordrep", "nombre", "direccion", "cp", "telefono"), array("text", "password", "password", "text", "text", "number", "number")) 
                        ?>
                    <p><input type="submit" value="Registrar" name="envio"></p>
                    </form>

                    <div>
                        <?php
                            if(isset($_POST['envio'])){
                                
                                $correcto=validacionFormulario(array($_POST["email"], $_POST["password"], $_POST["nombre"]), array("email", "password", "text"));
                                $pass=comparaPassword($_POST['password'], $_POST['passwordrep']);
                           ;
                                if(count($correcto) != 0 || !$pass){
                                    echo "Hay algun error";
                                }else{

                                    echo "Esta todo correcto!";
                                    $consulta="INSERT INTO clientes SET cli_email=?, cli_password=?, cli_nombre=?, cli_direccion=?, cli_cp=?, cli_telefono=?";
                                    inserta_Datos($consulta, array($_POST["email"], $_POST["password"], $_POST["nombre"], $_POST["direccion"],$_POST["cp"], $_POST['telefono']));
                                }
                            }
                        ?>
                    </div>


                   
                </div>
            </div>
            
            <div>
               
            </div>
            <div class="footer">Copyright</div>
            
            
            </div>
    </div>






</body>
</html>