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

        if(isset($_GET['deleted'])){
            $consulta="DELETE FROM clientes WHERE cli_email=?";
            elimina_Datos(array($_SESSION['nombre']), $consulta);
            $_COOKIE=array();
            setcookie(session_name(), time()-3600);
            session_destroy();
            header('Location:./inicio_sesion.php');
            exit();
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
            try{     
           
            $con=Conectar();
            $stmt=$con->prepare("SELECT * FROM clientes WHERE cli_email=?");
            $stmt->bindValue(1, $_SESSION['nombre']);
            //$stmt->bindValue(2, $id);
            $stmt->execute();
            //$num_filas=$stmt->rowCount();
            $datos="<div class='div_cuadrado'>";
            while($fila=$stmt->fetch(PDO::FETCH_ASSOC)){
                $datos.="<p>";
                //array_push($lista_mascotas['Pl'],$fila['rasgo']);
                $datos.= "<div>";
                    $datos.="<div><h2>Mi Perfil (".$_SESSION['nombre'].")</h2></div>";
                    $datos.= "<div>".$fila['cli_nombre']."</div>";
                    $datos.= "<div>".$fila['cli_direccion']."</div>";
                    $datos.= "<div>".$fila['cli_cp']."</div>";
                    $datos.= "<div>".$fila['cli_telefono']."</div>";
                    $datos.="<div><a href='./cambiar_pass.php'>Cambiar Contraseña</a></div>";
                    $datos.="<div><a href='./mi_perfil.php?deleted'>Dar de Baja</a></div>";
                    $datos.="</div>";
                $datos.= "</div>";
                $datos.="</p>";
                
            }
            $datos.= "<div class='btn_editarp'><a href='./editar_perfil.php'>Editar Perfil</div>";
            $datos.="</div>";
            
            echo $datos;

    
            }catch(PDOException $e){
                echo $e->getMessage();

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