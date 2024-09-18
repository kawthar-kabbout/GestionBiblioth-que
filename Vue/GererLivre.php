<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Livre</title>
    
    
</head>

<body>
    
<header>
        <div>
            <img src="../Images/logo.png" width="220px" alt="Logo" id="logo" />
        </div>
        <nav>
            <ul>
            <li><a href="../Vue/GererAdhBib.php">Gére_Adherents</a></li>
                <li><a href="../Vue/ConsultationAdherents.php">Consultation_Adherents</a></li>
                
                <li><a href="../Vue/GererLivre.php">GererLivre</a></li>
                <li><a href="../Vue/ConsultationLivresBib.php">Consultater_Livres</a></li>
               
                <li><a href="../Vue/restitutionlivreBib.php">restitutionlivreBib</a></li>
                <li><a href="../Vue/consultationrestitutionlivreBib.php">Consultation d'emprunt</a></li>
              
            </ul>
        </nav>
    </header>

<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();}
    $message = isset($_SESSION['message']) ? $_SESSION['message'] : "";
    unset($_SESSION['message']);

?>

<div class="container">
    <form action="../Controleur/ContGererLivre.php" method="POST" >
        <h1>Gerer les Livre</h1>
        <span class="error" style="color: red;"><?php echo $message; ?></span>
        <label for="ref">Référence :</label>
        <input type="text" id="ref" name="ref" required>

        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" >

        <label for="nomAuteur">Nom de l'auteur :</label>
        <input type="text" id="nomAuteur" name="nomAuteur" >

        <label for="image">Image :</label>
        <input type="text" id="image" name="image" >

        <label for="categorie">Catégorie :</label>
        <select id="categorie" name="categorie" >
            <option value=""></option>
            <option value="Comptabilité">Comptabilité</option>
            <option value="Marketing">Marketing</option>
            <option value="Histoire">Histoire</option>
        </select>

        </select>

        <button type="submit" name="btnAjouter">Ajouter</button> 
        <button type="submit" name="btnSupprimer">Supprimer</button>
        <button type="submit" name="btnModifier">Modifier</button>
    </form>
</div>

</body>
</html>

<style>
       /* Styles pour le formulaire */
.container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

form {
    background-color: white;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    max-width: 400px;
    width: 100%;
}

header {
    background-color: white;
    padding: 20px;
}

h1 {
    text-align: center;
    margin-bottom: 20px;
}

label {
    display: block;
    margin-bottom: 5px;
}

input[type="text"],
input[type="file"],
select {
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

button {
    background-color: #4CAF50;
    color: white;
    border: none;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin-top: 10px;
    cursor: pointer;
    border-radius: 4px;
    width: 100%;
}

button:hover {
    background-color: #45a049;
}
/* Styles pour la partie header */
header {
    background-color: #f8f9fa; /* Couleur de fond */
    padding: 20px; /* Espacement interne */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Ombre légère */
}

/* Styles pour le logo */
#logo {
    display: block;
    margin: 0 auto; /* Centrer le logo horizontalement */
}

/* Styles pour la navigation */
nav ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    text-align: center; /* Centrer les éléments de la liste */
}

nav ul li {
    display: inline;
    margin: 0 10px; /* Espacement entre les éléments de la liste */
}

nav ul li a {
    text-decoration: none;
    color: #333; /* Couleur du texte */
    font-weight: bold;
    transition: color 0.3s ease; /* Animation de transition */
}

nav ul li a:hover {
    color: #007bff; /* Couleur du texte au survol */
}
#logo {
    float: left; /* Alignement à gauche */
    margin-right: 20px; /* Marge à droite pour l'espace */
    clear: both; /* Éviter le chevauchement avec les éléments suivants */
}


</style>