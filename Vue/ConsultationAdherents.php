<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
   
</head>
<body>

<div>
    <header>
        <div>
            <?php
if (session_status() == PHP_SESSION_NONE) {
   
    session_start();
}

            $errorNom = isset($_SESSION['error_nom']) ? $_SESSION['error_nom'] : "";
            $errorCin = isset($_SESSION['error_cin']) ? $_SESSION['error_cin'] : "";
            $errorPrenom = isset($_SESSION['error_prenom']) ? $_SESSION['error_prenom'] : "";
            $errorFil = isset($_SESSION['error_fil']) ? $_SESSION['error_fil'] : "";
            $errorCherch = isset($_SESSION['error_cherch']) ? $_SESSION['error_cherch'] : "";

            unset($_SESSION['error_nom']);
            unset($_SESSION['error_cin']);
            unset($_SESSION['error_prenom']);
            unset($_SESSION['error_fil']);
            unset($_SESSION['error_cherch']);
            ?>
        </div>
        <nav>
            <img src="../Images/logo.png" width="220px" alt="Logo " id="logo"/>
            <ul><li><a href="../Vue/GererAdhBib.php">Gére_Adherents</a></li>
                <li><a href="../Vue/ConsultationAdherents.php">Consultation_Adherents</a></li>
                
                <li><a href="../Vue/GererLivre.php">GererLivre</a></li>
                <li><a href="../Vue/ConsultationLivresBib.php">Consultater_Livres</a></li>
               
                <li><a href="../Vue/restitutionlivreBib.php">restitutionlivreBib</a></li>
                <li><a href="../Vue/consultationrestitutionlivreBib.php">Consultation d'emprunt</a></li>
               </ul>
        </nav>
    </header>
</div>

<div>
    <form action="../Controleur/ConsultationChAdh.php" method="POST">
        <h1>Chercher Adherents</h1>

        
        <span style='color:red '>  <?php echo $errorCherch; ?></span>
        <br>
        <label for="">CIN</label>
        <input type="text" name="cin"  pattern="[0-9]{8}">
        <span style='color:red '>  </span><br>
        <label for="">Nom</label>
        <input type="text" name="nom">
        <span style='color:red '> </span><br>

        <label for="prenom">Prénom :</label>

        <input type="text" name="prenom">
        <span style='color:red '> </span><br>
        <label for="tel">Telephone :</label>
                <input type="number" name="tel" pattern="[1-9][0-9]{7}" ><br>
                <label for="filiere">Filiére:</label>
        <select id="filiere" name="filiere">
            <option value="" selected disabled hidden>Sélectionner une option</option>
            <option value="infomatique de gestion">Infomatique de gestion</option>
            <option value="gestion">Gestion</option>
            <option value="economie">Economie</option>
        </select>
                <label for="niveau_etudes">Niveau d'études :</label>
                <select id="niveau_etudes" name="niveau_etudes">
                    <option value="" selected disabled hidden>Sélectionner une niveau_etude</option>
                    <option value="1er anner licence" >1er anner licence</option>
                    <option value="2emme anner licence" >2emme anner licence</option>
                    <option value="3emme anner licence">3emme anner licence</option>
                    <option value="1er anner master" >1er anner master</option>
                    <option value="2emme anner master">2er anner master</option>
                </select><br> <div class="form-group">
                <label for="password">Password :</label>
                <input type="password" id="password" name="password" pattern="[0-9]{6}">
                <span class="error"></span>
            </div>

            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" name="email">
                <span class="error"></span>
            </div>

            <div class="form-group">
                <label for="abonnee">Abonner :</label>
                <select id="filiere" name="abonnee">
                    <option value="" selected disabled hidden></option>
                    <option value="oui"> oui</option>
                    <option value="non" >non</option>
                </select>
        
        <span style='color:red '>  </span>


        <button type="submit" name="Chercherbtn">Chercher</button>
        <br>
    </form>
</div>

<div class="table-container">
    <table border="1">
        <?php
        include("../Model/Adherent.php");
        $adherents = Adherent::afficheAdh();
        if (!empty($adherents)) {
            echo "
        <tr>
            <th>CIN</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Téléphone</th>
            <th>Niveau d'études</th>
            <th>Email</th>
        </tr>";
            foreach ($adherents as $adherent) {
                echo "<tr>";
                echo "<td>" . $adherent['cin'] . "</td>";
                echo "<td>" . $adherent['nom'] . "</td>";
                echo "<td>" . $adherent['prenom'] . "</td>";
                echo "<td>" . $adherent['Telephone'] . "</td>";
                echo "<td>" . $adherent['niveau_etudes'] . "</td>";
                echo "<td>" . $adherent['email'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "Aucun adhérent trouvé ";
        }
        ?>
    </table>
</div>


<style>
        /* Styles pour le formulaire */
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: white;
            padding: 20px;
        }

        .logo {
            float: left;
            margin-right: 20px;
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            text-align: right;
        }

        nav ul li {
            display: inline;
            margin-left: 20px;
        }

        nav ul li:first-child {
            margin-left: 10;
        }

        nav ul li a {
            text-decoration: none;
            color: black;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        nav ul li a:hover {
            color: blue;
        }

        nav ul li a:hover {
            color: var(--primary-color);
            text-decoration: underline;
        }

        /* Styles pour le formulaire */
        form {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        form h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        form label {
            display: block;
            margin-bottom: 10px;
        }

        form input[type="text"],
        form input[type="number"],
        form select {
            width: calc(100% - 22px);
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }

        form button {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        form button:hover {
            background-color: #45a049;
        }

        form table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        form table th,
        form table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        form table th {
            background-color: #f2f2f2;
        }

        /* Styles pour l'affichage du tableau */
        .table-container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .table-container table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table-container th,
        .table-container td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .table-container th {
            background-color: #f2f2f2;
        }
    </style>

</body>
</html>
