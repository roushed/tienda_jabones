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

        if(!isset($_SESSION['admin'])){

            die("Acceso restringido");
        }else{

            
           

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
            
                <div class="cuadro_insert">
                    <center><h1>Inserta un producto:</h1></center>
                    <form action="insertar_producto.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                     
                        <input type="text" placeholder="Introduce tu nombre..." required class="form-control" name="nombre"><label>S/N</label>
                    </div>
                    <div class="form-group">
                        
                        <input type="text" placeholder="Introduce el peso.." required class="form-control" name="peso"><label>Kgs</label>
                    </div>
                    <div class="form-group">
                       
                        <input type="text" placeholder="Introduce el precio..." required class="form-control" name="precio"><label>€</label>
                    </div>
                    <div class="form-group">
                        <input type="number" placeholder="Introduce las unidades" required class="form-control" min="0" max="100" name="unidades"><label>Unidades </label>
                    </div>
                    <div class="form-group">
                        <label>Imagen </label>
                        </label><input type="file" required class="form-control" name="imagen">
                        
                    </div>

                    <div class="form-group">
                    
                        <textarea name="descripcion" placeholder="Escribe una descripción" rows="10" cols="50"  required class="form-control"></textarea>
                    </div>
                    <div>

                        <?php
                                if(isset($_POST['envio'])){

                                    $correcto=validacionFormulario(array($_POST['nombre'], $_POST['descripcion'], $_POST['peso'], $_POST['precio'], $_POST['unidades']), array("text", "text", "number", "number", "number"));
                                    
                                    if(count($correcto) != 0){
                                        
                                    }else{

                                        if (is_uploaded_file ($_FILES['imagen']['tmp_name'] )){
                                            $nombreFichero = $_FILES['imagen']['name'];
                                            $formato=pathinfo($nombreFichero, PATHINFO_EXTENSION);
                                            $nombreDirectorio = "img/";
                                            if (is_dir($nombreDirectorio)){ 
                                                $nombreCompleto = $nombreDirectorio.$nombreFichero;
                                                if($formato == "jpg" || $formato == "jpeg" || $formato == "JPG"){
                                                move_uploaded_file ($_FILES['imagen']['tmp_name'],$nombreCompleto);
                                                }else{
                                                    echo "Formato de imagen incorecto";
                                                }
                                            }
                                        }
                                        
                                        $consulta="INSERT INTO productos SET pr_id=0, pr_nombre=?, pr_descripcion=?, pr_peso=?, pr_precio=?, pr_imagen=?, unidades=?";
                                        inserta_Datos($consulta, array($_POST['nombre'], $_POST['descripcion'], $_POST['peso'], $_POST['precio'], $nombreCompleto, $_POST['unidades'] ));
                                        header('Location:./lista_productos.php');
                                        exit();
                                    }
                                }

                            ?>

                    </div>
                    <p><input type="submit" value="Insertar" name="envio"></p>
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