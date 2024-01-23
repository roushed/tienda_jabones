<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
        

        if (isset($_GET['cerrar'])){
        
            $_COOKIE=array();
            setcookie(session_name(), time()-3600);
            session_destroy();
            header('Location:./inicio_sesion.php');
        }

    ?>
</head>
<body>
    
        <?php
           
            $datos="";
            //if(!isset($_SESSION['admin']) && !isset($_SESSION['nombre'])){
                //session_start();
            //}
          
            
            if(isset($_SESSION["autentificar"])){

                if(isset($_SESSION['nombre'])){

                    $nombre="usuario";

                }else if(isset($_SESSION['admin'])){

                    $nombre="admin";
                }
                
            }else{

                $nombre="invitado";

            }
                
            switch ($nombre) {

                case "invitado":
                    $datos.="<div class='seccion'>Bienvenido/a $nombre</div>";
                    $datos.="<div class='seccion'><a href='./registro.php'>Registro </a></div>";
                    $datos.="<div class='seccion'><a href='./ver_productos.php'>Ver productos </a></div>";
                    $datos.="<div class='seccion'><a href='./inicio_sesion.php'>&nbsp Iniciar Sesion </a></div>";
                   
                    break;

                case "usuario":
                    $datos.="<div class='seccion'>Bienvenido/a ".$_SESSION['nombre']."</div>";
                    $datos.="<div class='seccion'><a href='./ver_productos.php'>Ver productos </a></div>";
                    $datos.="<div class='seccion'><a href='./lista_cesta.php'>&nbspVer carrito </a>";
                    $consulta="SELECT * FROM item_cesta it INNER JOIN cesta c ON c.ce_id=it.ic_idcesta WHERE c.ce_email=?";
                    $num_filas=contar_Registros($consulta, array($_SESSION['nombre']));
                    $datos.="<span class='num_art'>$num_filas</span></div>";
                    $datos.="<div class='seccion'><a href='./mis_pedidos.php'>&nbspMis Pedidos </a></div>";
                    $datos.="<div class='seccion'><a href='./mi_perfil.php'>&nbspMi Perfil </a></div>";
                    $datos.="<div class='seccion'><a href='./panel.php?cerrar'>&nbspCerrar Sesión </a></div>";
                    
                    break;

                case "admin":
                    $datos.="<div class='seccion'>Bienvenido/a ".$_SESSION['admin']."</div>";
                    $datos.="<div class='seccion'><a href='./lista_productos.php'>Altas/Bajas de productos </a></div>";
                    $datos.="<div class='seccion'><a href='./lista_pedidos.php'>&nbspGestión de pedidos </a>";
                    $consulta2="SELECT * FROM pedidos WHERE pe_entrega = 1";
                    $num_pedidos=contar_Registros($consulta2, array());
                    $datos.="<span class='num_art'>$num_pedidos</span></div>";
                    $datos.="<div class='seccion'><a href='./panel.php?cerrar'>&nbspCerrar Sesión</a></div>";
                    
                    break;
            }
            
                
                echo $datos;
        ?>
</body>
</html>