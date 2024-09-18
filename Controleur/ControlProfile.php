<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include("../Model/Emprunt.php");

$cin = $_COOKIE["login"];

if (isset($_POST['affiche'])) {
    $emprunts = Emprunt::getEmpruntsByCin($cin);
    if (!empty($emprunts)) {
        echo "<div class='table-container'>";
        echo "<table>";
        echo "<tr>";
        echo "<th>Ref</th>";
        echo "<th>Date Demprunt</th>";
        echo " <th>Date de retour prévue</th>" ;
        echo "<th>Date retour Réelle</th>";
        echo "<th>Retard</th>";
        echo "</tr>";

        foreach ($emprunts as $emprunt) {
            if ($emprunt['dateeffRelle'] == "0000-00-00") {
                $dateEffectiveRetour = new DateTime($emprunt['dateFin']);
                $dateActuelle = new DateTime();
                $retard = $dateEffectiveRetour->diff($dateActuelle)->format('%a jours');

                echo "<tr>";
                echo "<td>" . $emprunt['ref'] . "</td>";
                echo "<td>" . $emprunt['dateDeb'] . "</td>";
                echo "<td>" . $emprunt['dateFin'] . "</td>";
                echo "<td>" . $emprunt['dateeffRelle'] . "</td>";
                echo "<td>" . $retard . "</td>";
                echo "</tr>";
            }
        }
        echo "</table>";
        echo "</div>";
    } else {
        $mess = "Aucun emprunt non retourné";
        $_SESSION['mess'] = $mess;
        header("Location: ../Vue/ProfilAdh.php");
        exit();
    }
}
?>
<style>/* Styles du tableau */
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