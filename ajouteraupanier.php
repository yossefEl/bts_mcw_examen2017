<?php
session_start();

if (!isset($_SESSION['idCl'])) {
    header("location: authentification.php");
}

if (isset($_GET['ajouter'])) {

    if (isset($_SESSION['id_produit'])) {
        $exist=0;
        foreach ($_SESSION['id_produit'] as $k => $v) {
            if ($v == $_GET['id_produit']) {
                $_SESSION['quantite'][$k] += $_GET['quantite'];  
                $exist=1;
                header('location: index.php');
                
            }
        }
    } 
    if(!isset($_SESSION['id_produit']) || $exist==0){
        $_SESSION['id_produit'][] = $_GET['id_produit'];
        $_SESSION['quantite'][] = $_GET['quantite'];
        header('location: index.php');
    }

}//ajouter
else {
    header('location: index.php');
}