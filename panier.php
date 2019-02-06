<?php
session_start();
if (!isset($_SESSION['idCl'])) {
    header("location: authentification.php");
}
include 'connexion.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Panier</title>

</head>

<body>

    <div class="container text-center mt-5">
        <div class="card shadow-sm p-3">
            <div class="card-body">
                <h4 class="card-title pb-3 text-primary">DETAILS DE VOTRE PANIER</h4>
                <p class="card-text">
                        <table class="table table-light">
                                <thead>
                                    <tr>
                                        <th>Supprimer</th>
                                        <th>Designation</th>
                                        <th>Quantite</th>
                                        <th>Prix</th>
                                        <th>Montant</th>
                                    </tr>
                                </thead>
                        <?php


                        if (isset($_SESSION['id_produit']) && isset($_SESSION['quantite'])) {
                            $rien;
                            $total = 0;
                            foreach ($_SESSION['id_produit'] as $k => $v) {
                                if (!empty($v)) {
                                    $sql = "select * from produit where idProduit=$v";
                                    $result = mysqli_query($link, $sql);
                                    $row = mysqli_fetch_assoc($result);
                                    echo '<tbody>
                                                     <tr>
                                                         <td><a href="supprimer.php?id_p=' . $v . '" class="btn btn-danger">X</a></td>
                                                         <td>' . $row['libelle'] . '</td>
                                                         <td>' . $_SESSION['quantite'][$k] . '</td>
                                                         <td>' . $row['prix'] . ' DHs</td>
                                                        <td>' . $ce_prix = doubleval($row['prix']) * doubleval($_SESSION['quantite'][$k]) . ' DHs</td>
                                                     </tr>
                                                 ';
                                } else {

                                    continue;
                                }
                                $total += doubleval($ce_prix);

                            }
                            if (isset($ce_prix)) {

                                echo "<tr><td colspan='4'>Total</td><td>" . $total . "  DHs</td></tr>";
                                echo "<tr>
                                                    <td colspan='5'>
                                                        <a href='index.php' class='btn btn-success'>
                                                            <strong>Commander</strong>
                                                        </a>
                                                    </td>
                                            </tr>";
                            }


                        }//if is not set session variables ?

                        else {
                            echo "
                                    <tr>
                                        <td colspan='5'>
                                                <h3 class='text-info m-4'>Votre panier est vide!</h3>
                                                <a href='index.php' class='btn btn-primary mb-3'>Retour a l'accueil</a>
                                        </td>
                                    </tr>";
                        }

                        ?>
                        </tbody>
                        
                        
                              
                        </table>

                </p>
            </div>
        </div>
    </div>
</body>

</html>