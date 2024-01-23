<?php
    include "./f_modular.php";
    session_start();
    if(isset($_GET['id'])){
        $consultac="SELECT  * FROM cesta WHERE ce_email=?";
        $registroc=hay_Registro($consultac, array($_SESSION['nombre']));

        if(!$registroc){
            $fecha=date("Y-m-d");
            $consultad="INSERT INTO cesta SET ce_id=0, ce_email=?, ce_fechacre=?";
            inserta_Datos($consultad, array($_SESSION['nombre'], $fecha));
        }

        $consultaid="SELECT * FROM cesta WHERE ce_email=?";
        $idcesta=consultar_lista_1col($consultaid, "ce_id", array($_SESSION['nombre']));
        $existeitem=consultar_lista("SELECT  * FROM item_cesta WHERE ic_idcesta=? AND ic_idproducto=?", array('ic_id', 'ic_cantidad'), array($idcesta[0], $_GET['id']));
        //Insertamos los datos a item_cesta
        //print_r($existeitem);
        $cantidad=sumar_Valores("SELECT SUM(ic_cantidad) AS total FROM item_cesta where ic_id=?", array($existeitem[0]));
        $limite=consultar_lista_1col("SELECT * FROM productos WHERE pr_id=?", "unidades", array($_GET['id']));
        
        

        if($cantidad < $limite[0]){
            if($existeitem != 0){

                $unidad=intval($existeitem[1]+1);
                inserta_Datos("UPDATE item_cesta SET ic_cantidad=? WHERE ic_id=?", array($unidad, $existeitem[0]));

            }else{
                $consultaic="INSERT INTO item_cesta SET ic_id=0, ic_idcesta=?, ic_idproducto=?, ic_cantidad=?";
                inserta_Datos($consultaic, array($idcesta[0], $_GET['id'], '1'));
                

            }
            header('Location:./lista_cesta.php');
            exit();

        }else{

            header('Location:./lista_cesta.php?errorc');
            exit();   
        }
  
    }













?>