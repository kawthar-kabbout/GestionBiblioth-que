


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=
    , initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    



<?php
session_start();
include("../Model/Emprunt.php");



$mess = "";


if (isset($_POST['afficherLivresNonRetournes'])) {
    $emps = Emprunt::getEmpNomretourner();
    if ($emps) {
        echo "Les Emprunts Non Retournés :";
        echo "<table border=1>
            <tr>
                <th>CIN</th>
                <th>Prenom</th>
                <th>Nom</th>
                <th>Telephone</th>
                <th>email</th>
                <th>référence</th>
                <th>Date D'emprunt</th>
                <th>Date de retour prévue</th>
            </tr>";

        foreach ($emps as $emp) {
            echo "<tr>";
            echo "<td>" . $emp['cin'] . "</td>";
            echo "<td>" . $emp['prenom'] . "</td>";
            echo "<td>" . $emp['nom'] . "</td>";
            echo "<td>" . $emp['Telephone'] . "</td>";
            echo "<td>" . $emp['email'] . "</td>";
            echo "<td>" . $emp['ref'] . "</td>";
            echo "<td>" . $emp['dateDeb'] . "</td>";
            echo "<td>" . $emp['dateFin'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        $mess = "Aucun emprunt non retourné";
        $_SESSION['mess'] = $mess;
        header("Location: ../Vue/consultationrestitutionlivreBib.php");
        exit();
    }
}

////chrecher livre
if (isset($_POST['affiche'])) {
    $emps = Emprunt::rechercherEmpruntParCritere($_POST["ref"], $_POST["cin"], $_POST["dateDeb"], $_POST["dateFin"], $_POST["dateeffRelle"]);

    if (!empty($emps)) {
        echo "Les Emprunts :";
        echo "<table border=1>
            <tr>
                <th>CIN</th>
                <th>Référence</th>
                <th>Date D'emprunt</th>
                <th>Date de retour prévue</th>
                <th>Date de retour effective</th>
            </tr>";

        foreach ($emps as $emp) {
            echo "<tr>";
            echo "<td>" . $emp['cin'] . "</td>";
            echo "<td>" . $emp['ref'] . "</td>";
            echo "<td>" . $emp['dateDeb'] . "</td>";
            echo "<td>" . $emp['dateFin'] . "</td>";
            echo "<td>" . $emp['dateeffRelle'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        $mess = "Aucun emprunt trouvé";
        $_SESSION['mess'] = $mess;
        header("Location: ../Vue/consultationrestitutionlivreBib.php");
        exit();
    }
}
?>



<style>

    
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color: #333;
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

        nav ul li a {
            text-decoration: none;
            color: white;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        nav ul li a:hover {
            color: #ccc;
        }

        main {
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        span {
            color: red;
        }
    </style>
</body>
</html>