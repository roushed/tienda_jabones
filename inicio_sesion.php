<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/style.css">

    <?php
      
       include "./conectar.php";
       function comprobar_Login($login, $password, $consulta, $campo, $campo2){
           $arr_usuario=array();
           try{
           
               $con=Conectar();
               $stmt=$con->prepare($consulta);
               $stmt->bindValue(1, $login);
               $stmt->bindValue(2, $password);
               //$stmt->bindValue(2, $id);
               $stmt->execute();
               $num_filas=$stmt->rowCount();
               while($fila=$stmt->fetch(PDO::FETCH_ASSOC)){
                   $correo=$fila[$campo];
                   $pass=$fila[$campo2];
               }
               
           }catch(PDOException $e){
               echo $e->getMessage();
      
           }
           
           array_push($arr_usuario, $correo, $pass);
           return $arr_usuario;

       }


   ?>

   <?php
       

       
           
           
           session_start();
           if(!isset($_SESSION['autentificar'])){
            if(isset($_POST['inicio'])){
                if(!empty($_POST['usuario']) || !empty($_POST['contrasena'])){ 
                    
                    $consulta="SELECT * FROM clientes WHERE cli_email=? AND cli_password=?";
                    $usuario=comprobar_Login($_POST['usuario'],$_POST['contrasena'], $consulta, 'cli_email', 'cli_password');
                    if(empty($usuario[0]) && empty($usuario[1])){
                    $consulta="SELECT * FROM administrador WHERE ad_email=? AND ad_password=?";
                    $admin=comprobar_Login($_POST['usuario'], $_POST['contrasena'], $consulta, 'ad_email', 'ad_password');
                    }
                    //echo $admin;
                    

                    

                    if($_POST['usuario'] == $usuario[0] && $_POST['contrasena'] == $usuario[1]){
                
                        $_SESSION['autentificar']=true;
                        $_SESSION['nombre']=$_POST['usuario'];
                        header('Location:./panel.php');
                    
                    }else if($_POST['usuario'] == $admin[0] && $_POST['contrasena'] == $admin[1]){

                        $_SESSION['autentificar']=true;
                        $_SESSION['admin']=$_POST['usuario'];
                        header('Location:./panel.php');
                    
                    }else{
                        
                        header('Location:./inicio_sesion.php?error=1');
                    }

                }else{
                    
                    header('Location:./inicio_sesion.php?error=2');
                    
                }
            }

           }else{
               //echo $login." - ".$_POST['usuario'];
               header('Location:./panel.php');


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
            <div class="contenido_i">
                <div class="cuadrito">
                <form action="inicio_sesion.php" method="post">
                    <p><label>Login</label><input type="text" name="usuario" id=""></p>
                    <p><label>Password</label><input type="password" name="contrasena" id=""></p>
                    <p><input type="submit" value="Entrar" name="inicio"></p>
                    <div class="msg_error">

                            <?php

                                    if(isset($_GET['error'])){
                                        if($_GET['error'] == 1){

                                            echo "<p>Nombre de usuario y contraseña incorrectos</p>";
                                        }

                                        if($_GET['error'] == 2){

                                            echo "<p>Campos vacios</p>";
                                        }

                                    }

                            ?>
                    </div>
                </form> 


                </div>         
            </div>
            <div class="footer">Copyright</div>
        </div>

</body>
</html>