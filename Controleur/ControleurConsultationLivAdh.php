<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultation des Livres</title>
    <link rel="stylesheet" href="Consultation.css" media="screen" type="text/css">
</head>
<body>
    <header>
        <div>
            <img src="../Images/logo.png" width="220px" alt="Logo" id="logo">
        </div>
        <nav>
            <ul>
                <li><a href="../Vue/ConsultationLivAdh.php">Consultation Livre</a></li>
                <?php
              $_COOKIE['login'];
              echo "Bienvenue ". $_COOKIE["login"];
              
            ?>
            </ul>
        </nav>
    </header>

    <div class="livres-container">
        <?php
        include("../Model/Livre.php");
        if (session_status() == PHP_SESSION_NONE) {
            session_start();}
        $messcherch = "";
      
        
        $messcherch = "";
        $nom = "";
        $nomAuteur = "";
        $ref = "";

        if (isset($_POST['affichedis'])) {
            $livres = Livre::getListeLivresDisponible();
            if (!empty($livres)) {
                foreach ($livres as $livre) {
                    echo '<div class="livre">';
                    echo '<div class="livre-image">';
                    echo '<img src="../Images/' . $livre['img'] . '" alt="' . $livre['nom'] . '">';
                    echo '</div>';
                    echo '<div class="livre-content">';
                    echo '<h2>' . $livre['nom'] . '</h2>';
                    echo '<p>Auteur: ' . $livre['nomauteur'] . '</p>';
                    echo '<p>Catégorie: ' . $livre['categorie'] . '</p>';
                    echo '<p>Référence: ' . $livre['ref'] . '</p>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<div class="no-books-message">';
                echo 'Aucun livre disponible!';
                echo '</div>';
            }
        }

        if (isset($_POST['affichecriteres'])) {
            $categorie=isset($_POST['categorie']) ? $_POST['categorie'] : "";
            $nom = isset($_POST['nom']) ? $_POST['nom'] : "";
            $nomAuteur = isset($_POST['nomAuteur']) ? $_POST['nomAuteur'] : "";
            $ref = isset($_POST['ref']) ? $_POST['ref'] : "";
            if (!empty($categorie) || !empty($nom) || !empty($nomAuteur) || !empty($ref)) {
                $livres = Livre::rechercherLivres($categorie, $nom, $nomAuteur, $ref);
                if (!empty($livres)) {
                    foreach ($livres as $livre) {
                        echo '<div class="livre">';
                        echo '<div class="livre-image">';
                        echo '<img src="../Images/' . $livre['img'] . '" alt="' . $livre['nom'] . '">';
                        echo '</div>';
                        echo '<div class="livre-content">';
                        echo '<h2>' . $livre['nom'] . '</h2>';
                        echo '<p>Auteur: ' . $livre['nomauteur'] . '</p>';
                        echo '<p>Catégorie: ' . $livre['categorie'] . '</p>';
                        echo '<p>Référence: ' . $livre['ref'] . '</p>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    $messcherch = "Livre non disponible!";
                }
            } else {
                $messcherch = "Il faut choisir un critère!";
            }
            if (!empty($messcherch)) {
                $_SESSION['error_cherch'] = $messcherch;
                header("Location: ../Vue/ConsultationLivAdh.php");
                exit();
            }
        }
        
        
        ?>
    </div>

    <div class="button-container">
        <form action="../Controleur/ControleurConsultationLivAdh.php" method="POST">
            <button type="submit" name="affichedis">Afficher les livres disponibles</button>
        </form>
    </div>

    </body>
</html>
<style>
    /* Styles CSS ici */
    .no-books-message {
        text-align: center;
        font-size: 1.2rem;
        font-weight: bold;
        color: #666;
        margin-top: 2rem;
    }




header {
    background-color: white;
    color: white;
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
    color: white;
    text-decoration: none;
}
main {
    padding: 20px;
}




/* Style du bouton */
.button-container {
    text-align: center;
    margin-bottom: 20px;
}

.button-container button {
    background-color: #87CEEB; /* Couleur de fond verte */
    border: none;
    color: white; /* Couleur du texte */
    padding: 10px 20px; /* Espacement intérieur du bouton */
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 4px; /* Coins arrondis */
    transition: background-color 0.3s ease; /* Transition de la couleur de fond */
}

.button-container button:hover {
    background-color: #45a049; /* Couleur de fond verte plus foncée au survol */
}

  /* Conteneur principal */
.livres-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    margin: 20px;
}

/* Chaque livre */
.livre {
    width: 300px;
    margin: 20px;
    text-align: center;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    transition: 0.3s;
}

.livre:hover {
    box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
}

/* Image du livre */
.livre img {
    width: 100%;
    height: 400px;
    object-fit: cover;
    border-radius: 5px 5px 0 0;
    transition: transform 0.3s ease;
}

.livre img:hover {
    transform: scale(1.05);
}

/* Contenu du livre */
.livre-content {
    padding: 20px;
}

/* Titre du livre */
.livre h2 {
    font-size: 20px;
    margin-bottom: 10px;
}

/* Description du livre */
.livre p {
    font-size: 16px;
    color: #666;
    margin-bottom: 10px;
}

/* Responsive */
@media (max-width: 768px) {
    .livre {
        width: 45%;
    }
}

@media (max-width: 480px) {
    .livre {
        width: 100%;
    }
}

nav ul li a {
  text-decoration: none;
  color: black;
  font-weight: bold;
  transition: color 0.3s ease;
}

</style>
