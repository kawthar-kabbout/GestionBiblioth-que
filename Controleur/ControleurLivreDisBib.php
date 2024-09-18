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
                <li><a href="../Vue/connectbibliothécaire.php">Gérer Adhérents</a></li>
                <li><a href="../Vue/ConsultationAdherents.php">Consultation Adhérents</a></li>
                <li><a href="../Vue/ConsultationLivresBib.php">Consultation Livres</a></li>
                <li><a href="../Vue/restitutionlivreBib.php">Restitution Livres</a></li>
            </ul>
        </nav>
    </header>

    <div class="livres-container">
        <?php
        include("../Model/Livre.php");
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
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
            $categorie = isset($_POST['categorie']) ? $_POST['categorie'] : "";
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
                    $messcherch = "Aucun livre trouvé avec ces critères!";
                }
            } else {
                $messcherch = "Il faut choisir un critère!";
            }
            if (!empty($messcherch)) {
                $_SESSION['error_cherch'] = $messcherch;
                header("Location: ../Vue/ConsultationLivresBib.php");
                exit();
            }
        }
        ?>
    </div>

    <div class="button-container">
        <form action="../Controleur/ControleurLivreDisBib.php" method="POST">
            <button type="submit" name="affichedis">Afficher les livres disponibles</button>
        </form>
    </div>
</body>
</html>
<style>
    /* Styles CSS ici */
</style>
