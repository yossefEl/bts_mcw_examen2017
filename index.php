<?php

session_start();
include 'connexion.php';

//*******Pour afficher la premiere categorie a la premiere fois**********
$id_cat;
$sql = "select * from categorie";
$res = mysqli_query($link, $sql);
if (!isset($_GET['cat'])) {
    $row = mysqli_fetch_assoc($res);
    $id_cat = $row['idCategorie'];
    mysqli_data_seek($res, 0);
} else {
    $id_cat = $_GET['cat'];
    mysqli_data_seek($res, 0);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Accueil</title>
</head>

<body>

    <!-- navigation bar -->
    <nav class="navbar navbar-expand navbar-light bg-white shadow-sm p-3" style="100%">
        <a class="navbar-brand" href="#"><strong>EXAM 2017</strong></a>
        <div class="container">
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">

                    <?php
                    if ($row = mysqli_num_rows($res) > 0) {
                        while ($row = mysqli_fetch_assoc($res)) {
                            if ($id_cat == $row['idCategorie']) {
                                echo '<li class="nav-item active">
                                    <a class="nav-link" href="index.php?cat=' . $row['idCategorie'] . '">' . $row['designation'] . ' </a>
                                    </li>';
                            } else {
                                echo '<li class="nav-item">
                                <a class="nav-link" href="index.php?cat=' . $row['idCategorie'] . '">' . $row['designation'] . ' </a>
                                </li>';
                            }

                        }
                    }
                    ?>
                    <li class="nav-item"><a class="nav-link" href="panier.php">Voir panier</a></li>
                
                            <?php
                            if(!isset($_SESSION['idCl']))
                            {
                                echo '<li class="nav-item" style="position:relative;right:-73%;color:#fff;"><a class="white-text btn btn-success" href="authentification.php">Authentifier</a></li>';
                            }else
                            {echo '<li class="nav-item" style="position:relative;right:-73%;color:#fff;"><a class="white-text btn btn-danger" href="deconnecter.php">Déconnecter</a></li>';}
                            ?>
        
                    
                    </form>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Produit -->
    <div class="container mt-4 mb-5">
        <?php
        $sql="select * from produit where `idCategorie` = $id_cat";
        $result=mysqli_query($link,$sql);
        if($row=mysqli_num_rows($result)>0)
        {
            while($row=mysqli_fetch_assoc($result))
            {
                echo '
                <div class="card shadow-sm mb-3 w-100">
                <div class="card-img-top d-flex align-items-center">
                    <div>
                        <img class="img p-4" src="img/'.$row['photo'].'" alt="Card image cap" style="width:300px">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">'.$row['libelle'].'</h5>
                        <p class="card-text">
                            <form action="ajouteraupanier.php" method="get" class="form-inline">
                                <input type="hidden" value="'.$row['idProduit'].'" name="id_produit">
                                <input type="" name="quantite" value="1" class="form-control" style="width: 120px">
                                <input name="ajouter" class="btn btn-primary ml-2" type="submit" value="Ajouter au panier">
                            </form>
                            <a href="details.php?idp='.$row['idProduit'].'" class="btn btn-secondary mt-3">Details</a>
                        </p>
                    </div>
                </div>
            </div>
                ';
            }
        }
        else
        {
            echo "
                <h3 class='text-danger text-center'>Rien est trouve dans cette categorie!</h3>
            ";
        }
        ?>

    </div>
</body>

</html>