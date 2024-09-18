
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <link rel="stylesheet" href="Consultation.css"  media="screen" type="text/css">
</head>
<body>
<header>
    <div>
        <img src="../Images/logo.png" width="220px" alt="Logo " id="logo" />
    </div>
    <nav>
        <ul><li><a href="../Vue/GererAdhBib.php">Gére_Adherents</a></li>
                <li><a href="../Vue/ConsultationAdherents.php">Consultation_Adherents</a></li>
                
                <li><a href="../Vue/GererLivre.php">GererLivre</a></li>
                <li><a href="../Vue/ConsultationLivresBib.php">Consultater_Livres</a></li>
               
                <li><a href="../Vue/restitutionlivreBib.php">restitutionlivreBib</a></li>
                <li><a href="../Vue/consultationrestitutionlivreBib.php">Consultation d'emprunt</a></li>
              
             
        </ul>
    </nav>
</header>

<body>
    <?php

if (session_status() == PHP_SESSION_NONE) {
   
  session_start();
}
    $messnomAuteur = isset($_SESSION['error_nomAuteur']) ? $_SESSION['error_nomAuteur'] : "";
    $messnom = isset($_SESSION['error_nom']) ? $_SESSION['error_nom'] : "";
    $messref = isset($_SESSION['error_ref']) ? $_SESSION['error_ref'] : "";
    $messcategorie = isset($_SESSION['error_categorie']) ? $_SESSION['error_categorie'] : "";
    $messcherch = isset($_SESSION['error_cherch']) ? $_SESSION['error_cherch'] : "";
    unset($_SESSION['error_nom']);
    unset($_SESSION['error_nomAuteur']);
    unset($_SESSION['error_ref']);
    unset($_SESSION['error_categorie']);
    unset($_SESSION['error_cherch']);
    ?>
    
    
    <form action="../Controleur/ControleurLivreDisBib.php" method="POST">
    <h1>Chercher des Livres</h1>

    
    <span style="color:red;"></span><br>

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
            echo '<h3>' . $livre['nom'] . '</h3>'; // Légende du livre
            echo '<div class="livre">';
            echo '<img src="../Images/' . $livre['img'] . '" alt="' . $livre['nom'] . '">';
            echo '<h2>' . $livre['nom'] . '</h2>';
            echo '<p>Auteur: ' . $livre['nomauteur'] . '</p>';
            echo '<p>Catégorie: ' . $livre['categorie'] . '</p>';
            echo '<p>Référence: ' . $livre['ref'] . '</p>';
            echo '</div>'; // fermeture de livre
            echo '</div>'; // fermeture de livre-container
        }
    }
    ?>
</div>


<style>
  body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
}

header {
  background-color: white;
  color: #fff;
  padding: 20px;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

nav ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  display: flex;
}

nav li {
  margin-right: 20px;
}

nav a {
    color: black;
  text-decoration: none;
}

main {
  padding: 20px;
}

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

span.error {
  color: red;
  font-weight: bold;
}
.livres-container {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  grid-gap: 20px;
}

.livre {
  background-color: #f5f5f5;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  padding: 20px;
  text-align: center;
}

.livre img {
  max-width: 100%;
  height: auto;
  margin-bottom: 10px;
}

.livre h2 {
  margin-top: 0;
}

.livre p {
  margin: 5px 0;
}

</style>
 
</body>
</html>