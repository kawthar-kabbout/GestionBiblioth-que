<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Initialiser les variables avec des valeurs par défaut
$messcherch = "";
$messcategorie = "";
$nom = "";
$messnom = "";

// Récupérer les variables de session si elles existent
if (isset($_SESSION['messcherch'])) {
    $messcherch = $_SESSION['messcherch'];
}

if (isset($_SESSION['error_cherch'])) {
    $messcherch = $_SESSION['error_cherch'];
}
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

   
    <form action="../Controleur/ControleurConsultationLivAdh.php" method="POST">
    <h1>Chercher des Livres</h1>

    
    <span style="color:red;"><?php
    echo $messcherch
    
    ?>
    </span><br>

    <label for="categorie">Chercher par Catégorie:</label>
    <select name="categorie">
        <option value="" selected disabled hidden>Sélectionner Catégorie</option>
        <option value="Copmtabilité">Copmtabilité</option>
        <option value="histoire">Histoire</option>
        <option value="Marketing">Marketing</option>
    </select>
    <span style="color:red;"></span><br>

    <label for="nom">Nom</label>
    <input type="text" name="nom">
    <span style="color:red;"></span><br>
    <label for="nom">Nom Auteur</label>
    <input type="text" name="nomAuteur">
    <span style="color:red;"></span><br>

    <label>ref:</label>
    <input type="number" name="ref">
    <span style="color:red;"></span><br>

    <div class="button-container">
        <button type="submit" name="affichecriteres">Afficher par critères</button>
    </div>

    <div class="livre"><br>
        <div class="button-container">
            <button type="submit" name="affichedis">Afficher les livres disponibles</button>
        </div>
    </div>
</form>
<div class="livres-container">
    <?php
    include("../Model/Livre.php");

    $livres = Livre::getListeLivres();

    if (!empty($livres)) {
        foreach ($livres as $livre) {
            echo '<div class="livre-container">';
            echo '<div class="livre">';
            echo '<div class="livre-image">';
            echo '<img src="../Images/' . $livre['img'] . '" alt="' . $livre['nom'] . '">';
            echo '</div>';
            echo '<div class="livre-content">';
            echo '<h3>' . $livre['nom'] . '</h3>';
            echo '<p>Auteur: ' . $livre['nomauteur'] . '</p>';
            echo '<p>Catégorie: ' . $livre['categorie'] . '</p>';
            echo '<p>Référence: ' . $livre['ref'] . '</p>';
            echo '</div>';
            echo '</div>'; // fermeture de livre
            echo '</div>'; // fermeture de livre-container
        }
    }
    ?>
</div>



<style>/* Styles généraux */
body {
    font-family: Arial, sans-serif;
    background-color: #f5f5f5;
    margin: 0;
    padding: 0;
}

/* Styles de l'en-tête */
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

/* Styles du contenu principal */
main {
    padding: 40px;
}

/* Styles du formulaire */
form {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
    background-color: #f5f5f5;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h1 {
    text-align: center;
    margin-bottom: 20px;
}

label {
    display: block;
    margin-bottom: 10px;
    font-weight: bold;
}

input[type="text"],
input[type="number"],
select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-bottom: 20px;
}

.button-container {
    text-align: center;
    margin-bottom: 20px;
}

button {
    background-color: #333;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
}

button:hover {
    background-color: #555;
}

/* Styles des livres */
.livres-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    grid-gap: 20px;
}

.livre-container {
    background-color: #f5f5f5;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
    text-align: center;
}

.livre-image {
    width: 100%;
    height: 300px;
    overflow: hidden;
    border-radius: 5px;
}

.livre-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.livre-image img:hover {
    transform: scale(1.1);
}

.livre-content {
    margin-top: 20px;
}

.livre-content h3 {
    margin-top: 0;
}

.livre-content p {
    margin: 5px 0;
}

</style>
 
</body>
</html>