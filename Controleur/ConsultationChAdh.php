<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$messnom = "";
$messcin = "";
$nom = "";
$prenom = "";
$niveau_etudes = "";
$filiere = "";
$password = "";
$messpenom = "";
$messlib = "";
$email = "";
$messniveau_etudes = "";
$messemail = "";
$messfiliere = "";
$messpassword = "";
$messageModifie = "";
$messcherch = "";
$messfil = "";

include("../Model/Adherent.php");

if (isset($_POST['Chercherbtn'])) {
    $cin = $_POST['cin'];
    $nom = isset($_POST['nom']) ? $_POST['nom'] : "";
    $prenom = isset($_POST['prenom']) ? $_POST['prenom'] : "";
    $tel = isset($_POST['tel']) ? $_POST['tel'] : "";
    $filiere = isset($_POST['filiere']) ? $_POST['filiere'] : "";
    $niveau_etudes = isset($_POST['niveau_etudes']) ? $_POST['niveau_etudes'] : "";
    $email = isset($_POST['email']) ? $_POST['email'] : "";
    $password = isset($_POST['password']) ? $_POST['password'] : "";
    $abonne = isset($_POST['abonnee']) ? $_POST['abonnee'] : "";

    $adherents = Adherent::rechercherADH($cin, $nom, $prenom, $tel, $filiere, $niveau_etudes, $email, $password, $abonne);
    if (!empty($adherents)) {
        echo "Les adhérents correspondant aux critères de recherche :";
        echo "<table>
            <tr>
                <th>CIN</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Téléphone</th>
                <th>Niveau d'études</th>
                <th>Email</th>
                <th>Abonné</th>
            </tr>";
        foreach ($adherents as $adherent) {
            echo "<tr>";
            echo "<td>" . $adherent['cin'] . "</td>";
            echo "<td>" . $adherent['nom'] . "</td>";
            echo "<td>" . $adherent['prenom'] . "</td>";
            echo "<td>" . $adherent['Telephone'] . "</td>";
            echo "<td>" . $adherent['niveau_etudes'] . "</td>";
            echo "<td>" . $adherent['email'] . "</td>";
            echo "<td>" . $adherent['abonne'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        $messcherch = "Aucun adhérent ne correspond aux critères de recherche.";
    }
    if ($messcherch!=""){
        $_SESSION['error_cherch'] = $messcherch;

    header("Location: ../Vue/ConsultationAdherents.php");
    exit() ;
    }
   
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<style>
    table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
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
</style>
</body>
</html>
