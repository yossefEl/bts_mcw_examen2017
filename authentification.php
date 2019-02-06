<?php


session_start();
include 'connexion.php';
if (isset($_POST['submit-auth']) && isset($_POST['login']) && isset($_POST['pwd'])) {
    $login = mysqli_real_escape_string($link, $_POST['login']);
    $pass = mysqli_real_escape_string($link, $_POST['pwd']);
    $sql = "SELECT * from client";
    $result = mysqli_query($link, $sql);
    if ($row = mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            if ($row['nomClient'] == $login && $row['motPasse'] == $pass) {
                $_SESSION['idCl'] = $row['idClient'];
                $_SESSION['nomCl'] = $row['nomClient'];
            }
        }
        if(!isset($_SESSION['idCl']))
        {
            header("location: authentification.php?error=incorrect");
        }        
    }

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
    <title>Authentification</title>
</head>

<body>
    <div class="container login-form">
        <div class="card shadow p-5">
            <div class="card-body">
                <h4 class="card-title text-center">Authentification</h4>
                <p class="card-text">
                    <?php
                    //gestion des erreurs 
                    if (isset($_GET['error'])) {
                        if ($_GET['error'] == 'required') {
                            echo "<span class='text-danger'>Mot de passe et non d'utilisateur sont obligatoires!</span>";
                        }
                        if ($_GET['error'] == 'no_user') {
                            echo "<span class='text-danger'>Utilisateur n'existe pas!</span>";
                        } else if ($_GET['error'] == 'incorrect') {
                            echo "<span class='text-danger'>Mot de passe ou non d'utilisateur sont incorrects!</span>";
                        }
                        //fermer la connexion
                        mysqli_close($link);

                    }
                    if(isset($_SESSION['idCl']))
                    {
                        echo "<div class='text-center mt-3'
                        <span class='alert-success'>Vous etes Authentifié</span><br>
                        <a href='index.php' class='btn btn-success mt-3'>Retour A l'accueil</a>
                        ";

                    }
                
                    else{echo '<form action="authentification.php" method="post">
                        <input type="text" name="login" class="form-control mb-2" placeholder="nom d\'utilisateur">
                        <input type="password" name="pwd" class="form-control mb-3" placeholder="mot de passe">
                        <input type="submit" name="submit-auth" value="Authentification" class="btn btn-primary form-control">
                    </form>';}
                    ?>
                </p>
            </div>
        </div>
    </div>
</body>

</html>
