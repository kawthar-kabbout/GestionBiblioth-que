<?php
    session_start();
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
            <img src="../Images/logo.png" width="220px" alt="Logo " id="logo" />
            <?php
                if(isset($_COOKIE["login"])){
                    echo "Bienvenue " . $_COOKIE["login"];
                }
            ?>
        </div>
        <nav>
            <ul>
                <li><a href="../Vue/ConsultationLivAdh.php">Consultation_Livre</a></li>
                <li><a href="../Vue/ProfilAdh.php">Profile</a></li>
            </ul>
        </nav>
    </header>

    <body>
        <form action="../Controleur/ControlProfile.php" method="POST">
            <button type="submit" name="affiche">Nombre de jours restant dans la période d’emprunt</button>

            <?php
                $mess = isset($_SESSION['mess']) ? $_SESSION['mess'] : "";
                unset($_SESSION['mess']);
                include("../Model/Emprunt.php");
                echo "<span style='color: red;'>$mess</span>";

                if(isset($_COOKIE["login"])){
                    $cin = $_COOKIE['login'];
                    $emprunts = Emprunt::getEmpruntsByCin($cin);

                    if (!empty($emprunts)) {
                        echo "<div class='table-container'>";
                        echo "<table>";
                        echo "<tr>";
                        echo "<th>Ref</th>";
                        echo "<th>Date Début</th>";
                        echo "<th>Date Fin</th>";
                        echo "<th>Date Effet Réelle</th>";
                        echo "</tr>";

                        foreach ($emprunts as $emprunt) {
                            echo "<tr>";
                            echo "<td>" . $emprunt['ref'] . "</td>";
                            echo "<td>" . $emprunt['dateDeb'] . "</td>";
                            echo "<td>" . $emprunt['dateFin'] . "</td>";
                            echo "<td>" . $emprunt['dateeffRelle'] . "</td>";
                            echo "</tr>";
                        }

                        echo "</table>";
                        echo "</div>";
                    } else {
                        echo "Vous n'avez emprunté aucun livre.";
                    }
                } else {
                    echo "Vous n'êtes pas connecté.";
                }
            ?>
        </form>
    </body>
</div>
</html>
<style>
    /* Styles généraux */
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

    /* Styles du tableau */
    .table-container {
        display: flex;
        justify-content: center;
        margin-top: 40px;
    }

    table {
        border-collapse: collapse;
        width: 80%;
        background-color: #fff;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }

    th, td {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #333;
        color: #fff;
    }

    tr:hover {
        background-color: #f2f2f2;
    }
</style>
