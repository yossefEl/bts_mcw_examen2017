<?php
session_start();
if(!empty($_SESSION["id_produit"])) {
    foreach($_SESSION["id_produit"] as $k => $v) {
        if($_GET["id_p"] == $v)
            unset($_SESSION["id_produit"][$k]);	
            unset($_SESSION["qauntite"][$k]);
            header('Location: panier.php');			
        if(empty($_SESSION["id_produit"]))
            {unset($_SESSION["id_produit"]);
            unset($_SESSION["quantite"]);
            header('Location: panier.php');}
    }
}