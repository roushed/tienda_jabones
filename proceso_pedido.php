
<?php
    include "./seguridad.php";
    include "./f_modular.php";
    if(isset($_POST['pedido'])){

        $fecha=date("Y-m-d");
        $fecha_pos=date("Y-m-d",strtotime($fecha."+ 1 week"));
        $total_art=0; 

            
        inserta_Datos("INSERT INTO pedidos SET pe_id=0, pe_email=?, pe_fechped=?, pe_fechent=?, pe_totalped=?, pe_entrega=1", array($_SESSION['nombre'], $fecha, $fecha_pos, $_SESSION['total']));
        $idpedido=sumar_Valores("SELECT MAX(pe_id)  AS total FROM pedidos", array());
        //$l_idproducto=consultar_lista_1col("SELECT * FROM item_cesta WHERE ic_idcesta=?", "ic_idproducto", array($_POST['idcesta']));
        $l_idproducto=consultar_lista2("SELECT * FROM item_cesta WHERE ic_idcesta=?", array("ic_idproducto", "ic_cantidad"), array($_POST['idcesta']));

       
        for($i=0; $i<count($l_idproducto); $i++){

            inserta_Datos("INSERT INTO item_pedido SET ip_id=0, ip_id_ped =?, ip_id_prod=?, ip_unidades=?", array($idpedido, $l_idproducto[$i][0], $l_idproducto[$i][1]));
            inserta_Datos("UPDATE productos SET unidades=unidades-".$l_idproducto[$i][1]." WHERE pr_id=?", array($l_idproducto[$i][0]));
            
        }
        header('Location:./lista_articulospedidos.php?id_pedido='.urlencode($idpedido));          
    }


?>