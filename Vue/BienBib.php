<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil Bibliothèque</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        header {
            background-color: #fff; /* Couleur de fond blanche */
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Ombre légère */
        }
        header img {
            width: 220px;
            height: auto;
        }
        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }
        nav ul li {
            display: inline;
            margin-right: 20px;
        }
        nav ul li a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }
        nav ul li a:hover {
            color: #007bff; /* Couleur de survol */
        }
    </style>
</head>


<?php



?>
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
    <h1>Bienvenue dans l'espace bibliothèque</h1>
   <h3>Bienvenue dans notre bibliothèque virtuelle</h3>

   
<footer>
    <p>&copy; 2024 Espace Bibliothécaire. Tous droits réservés.</p>
</footer>
</body>
</html>
