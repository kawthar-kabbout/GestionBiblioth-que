




<?php


/*
if (session_status() == PHP_SESSION_NONE) {
    session_start();
 
    $login = isset($_SESSION['login']) ? $_SESSION['login'] : "";
    unset($_SESSION['login']);
}

include("../Model/Adherent.php");

   

    $cin = $login;
 $adherents = Adherent:: getAdherent($cin);
 $nom = "";
 $prenom = "";
 
 if (!empty($adherents)) {
     foreach ($adherents as $adherent) {
         $nom = $adherent['nom'];
         $prenom = $adherent['prenom'];
     }
 }

*/

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<div>
<header>
        <div>
            <img src="../Images/logo.png" width="220px" alt="Logo " id=logo />
           <?php


//var_dump($_COOKIE);

    $_COOKIE['login'];
echo "Bienvenue ". $_COOKIE["login"];

 




?>
        </div>
        <nav>
        <ul>
                <li><a href="../Vue/ConsultationLivAdh.php">Consultation_Livre</a></li>
                <li><a href="../Vue/ProfilAdh.php">Profile</a></li>

                
            </ul>
        </nav>
    </header>

<body><main>
    <h1>Bienvenue dans votre espace bibliothécaire</h1>
    <p>Découvrez notre collection de livres, gérez vos emprunts et bien plus encore !</p>
    <!-- Ajoutez ici le contenu de votre page d'accueil -->
</main>

<footer>
    <p>&copy; 2024 Espace Bibliothécaire. Tous droits réservés.</p>
</footer>
</body>
<style>
    /* Body styles */
    body {
        font-family: Arial, sans-serif;
        background-color: #f5f5f5;
    }

    /* Header styles */
    header {
        background-color: #333;
        color: #fff;
        padding: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    #logo {
        max-width: 200px;
    }

    nav ul {
        list-style-type: none;
        display: flex;
    }

    nav li {
        margin-left: 20px;
    }

    nav a {
        color: #fff;
        text-decoration: none;
        font-weight: bold;
        transition: color 0.3s ease;
    }

    nav a:hover {
        color: #ccc;
    }

    /* Main content styles */
    main {
        padding: 40px;
    }

    h1 {
        font-size: 36px;
        margin-bottom: 20px;
    }

    p {
        line-height: 1.6;
        margin-bottom: 20px;
    }

    /* Footer styles */
    footer {
        background-color: #333;
        color: #fff;
        text-align: center;
        padding: 20px;
    }

    header p {
        font-size: 18px;
        font-weight: bold;
        color: #fff;
        margin: 0;
    }
</style>
</html>