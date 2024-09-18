<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="connectbibliothécaire.css" media="screen" type="text/css" />
    <title>Espace de bibliothécaire</title>
</head>
<body>
    <?php  
    if (session_status() == PHP_SESSION_NONE) {
        session_start();}

        $email = isset($_SESSION['email']) ? $_SESSION['email'] : "";
        $nom = isset($_SESSION['nom']) ? $_SESSION['nom'] : "";
        $prenom = isset($_SESSION['penom']) ? $_SESSION['penom'] : "";
        $filiere = isset($_SESSION['filiere']) ? $_SESSION['filiere'] : "";
        $niveau_etudes = isset($_SESSION['niveau_etudes']) ? $_SESSION['niveau_etudes'] : "";
        $tel = isset($_SESSION['tel']) ? $_SESSION['tel'] : "";
        $cin = isset($_SESSION['cin']) ? $_SESSION['cin'] : "";
        $messcin = isset($_SESSION['messcin']) ? $_SESSION['messcin'] : "";
        $messnom = isset($_SESSION['messnom']) ? $_SESSION['messnom'] : "";
        $messpenom = isset($_SESSION['messpenom']) ? $_SESSION['messpenom'] : "";
        $messtel = isset($_SESSION['messtel']) ? $_SESSION['messtel'] : "";
        $messfiliere = isset($_SESSION['messfiliere']) ? $_SESSION['messfiliere'] : "";
        $messniveau_etudes = isset($_SESSION['messniveau_etudes']) ? $_SESSION['messniveau_etudes'] : "";
        $messpassword = isset($_SESSION['messpassword']) ? $_SESSION['messpassword'] : "";

        // Unset session variables
        unset($_SESSION['email'], $_SESSION['nom'], $_SESSION['prenom'], $_SESSION['filiere'], $_SESSION['niveau_etudes'], $_SESSION['tel'], $_SESSION['cin'], $_SESSION['messcin'], $_SESSION['messnom'], $_SESSION['messpenom'], $_SESSION['messtel'], $_SESSION['messfiliere'], $_SESSION['messcin'], $_SESSION['messniveau_etudes'], $_SESSION['messpassword']);

        $messageSup = isset($_SESSION['messageSup']) ? $_SESSION['messageSup'] : "";
        $messageModifie = isset($_SESSION['messageModifie']) ? $_SESSION['messageModifie'] : "";
        $messemail = isset($_SESSION['messemail']) ? $_SESSION['messemail'] : "";
        $message = isset($_SESSION['message']) ? $_SESSION['message'] : "";
        $messagenon = isset($_SESSION['messagenon']) ? $_SESSION['messagenon'] : "";
        $messabonner = isset($_SESSION['messabonner']) ? $_SESSION['messabonner'] : "";

        unset($_SESSION['messabonner'], $_SESSION['messagenon'], $_SESSION['messemail'], $_SESSION['messageModifie'], $_SESSION['message'], $_SESSION['messageSup']);
   

   ?>

    <header>
        <div>
            <img src="../Images/logo.png" width="220px" alt="Logo" id="logo" />
        </div>
        <nav>
            <ul>
            <li><a href="../Vue/ControlGererAdhBib.php">Gére_Adherents</a></li>
                <li><a href="../Vue/ConsultationAdherents.php">Consultation_Adherents</a></li>
                
                <li><a href="../Vue/GererLivre.php">GererLivre</a></li>
                <li><a href="../Vue/ConsultationLivresBib.php">Consultater_Livres</a></li>
               
                <li><a href="../Vue/restitutionlivreBib.php">restitutionlivreBib</a></li>
                <li><a href="../Vue/consultationrestitutionlivreBib.php">Consultation d'emprunt</a></li>
              
            </ul>
        </nav>
    </header>

    <main>
        <h1>Espace de bibliothécaire</h1>

        <form action="../Controleur/ControlGererAdhBib.php" method="POST">
            <h2>Ajouter un nouvel adhérent</h2>
            <div>
                <span class="error"><?php echo $messabonner; ?></span>
                <span class="success"><?php echo $message; ?></span>
                <span class="error"><?php echo $messagenon; ?></span>
              
                <span class="success"><?php echo $messageSup; ?></span>
                <span class="error"><?php echo $messagenon; ?></span>
                <span class="error"><?php echo $messageModifie; ?></span>
            </div>

            <div class="form-group">
                <label for="cin">Cin :</label>
                <input type="text" name="cin" pattern="[0-9]{8}" required value="<?php if(!$cin==0) echo $cin; ?>">
                <span class="error"><?php echo $messcin; ?></span>
            </div>

            <div class="form-group">
                <label for="nom">Nom :</label>
                <input type="text" name="nom" value="<?= $nom ?>">
                <span class="error"><?php echo $messnom; ?></span>
            </div>

            <div class="form-group">
                <label for="prenom">Prénom :</label>
                <input type="text" name="prenom" value="<?= $prenom ?>">
                <span class="error"><?php echo $messpenom; ?></span>
            </div>

            <div class="form-group">
                <label for="tel">Telephone :</label>
                <input type="number" name="tel" pattern="[1-9][0-9]{7}" value="<?php if(!$tel==0) echo $tel; ?>">
                <span class="error"><?php echo $messtel; ?></span>
            </div>

            <div class="form-group">
                <label for="niveau_etudes">Niveau d'études :</label>
                <select id="niveau_etudes" name="niveau_etudes">
                    <option value="" selected disabled hidden>Sélectionner une niveau_etude</option>
                    <option value="1er anner licence" <?php if ($niveau_etudes == "1er anner licence") echo 'selected="selected"'; ?>>1er anner licence</option>
                    <option value="2emme anner licence" <?php if ($niveau_etudes == "2emme anner licence") echo 'selected="selected"'; ?>>2emme anner licence</option>
                    <option value="3emme anner licence" <?php if ($niveau_etudes == "3emme anner licence") echo 'selected="selected"'; ?>>3emme anner licence</option>
                    <option value="1er anner master" <?php if ($niveau_etudes == "1er anner master") echo 'selected="selected"'; ?>>1er anner master</option>
                    <option value="2emme anner master" <?php if ($niveau_etudes == "2emme anner master") echo 'selected="selected"'; ?>>2er anner master</option>
                </select>
                <span class="error"><?php echo $messniveau_etudes; ?></span>
            </div>

            <div class="form-group">
                <label for="filiere">Filiére :</label>
                <select id="filiere" name="filiere">
                    <option value="" selected disabled hidden>Sélectionner Filiére</option>
                    <option value="infomatique de gestion" <?php if ($filiere == "infomatique de gestion") echo 'selected="selected"'; ?>>Infomatique de gestion</option>
                    <option value="gestion" <?php if ($filiere == "gestion") echo 'selected="selected"'; ?>>Gestion</option>
                    <option value="economie" <?php if ($filiere == "economie") echo 'selected="selected"'; ?>>Economie</option>
                </select>
                <span class="error"><?php echo $messfiliere; ?></span>
            </div>

            <div class="form-group">
                <label for="password">Password :</label>
                <input type="password" id="password" name="password" pattern="[0-9]{6}">
                <span class="error"><?php echo $messpassword; ?></span>
            </div>

            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" name="email" value="<?= $email ?>">
                <span class="error"><?php echo $messemail; ?></span>
            </div>

            <div class="form-group">
                <label for="abonnee">Abonner :</label>
                <select id="filiere" name="abonnee">
                    <option value="" selected disabled hidden></option>
                    <option value="oui"> oui</option>
                    <option value="non" >non</option>
                </select>
            </div>

            <div class="form-actions">
                <button type="submit" name="Ajouter">Ajouter</button>
                <button type="submit" name="Supprimer">Supprimer</button>
                <button type="submit" name="modifier">Modifier</button>
            </div>
        </form>
    </main>
</body>
</html>


<style>
body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
    margin: 0;
    padding: 0;
}

:root {
    --primary-color: #007bff;
    --secondary-color: #333;
    --error-color: red;
    --success-color: green;
}

h1 {
    text-align: center;
    color: var(--secondary-color);
    font-size: 32px;
    font-weight: bold;
    text-transform: uppercase;
    margin-top: 20px;
    margin-bottom: 20px;
}

main {
    width: 80%;
    max-width: 600px;
    margin: 0 auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    margin-top: 50px;
    display: flex;
    flex-direction: column;
    align-items: center;
}

form {
    width: 100%;
}

.form-group {
    display: flex;
    flex-direction: column;
    margin-bottom: 15px;
}

.form-group label {
    font-weight: bold;
    margin-bottom: 5px;
}

.form-group input,
.form-group select {
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
}

.form-group input::placeholder,
.form-group select::placeholder {
    color: #ccc;
}

.form-group input:focus,
.form-group select:focus {
    outline: none;
    box-shadow: 0 0 2px 1px var(--primary-color);
}

.form-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.form-actions button {
    background-color: var(--primary-color);
    color: #fff;
    cursor: pointer;
    transition: background-color 0.3s ease;
    padding: 12px 20px;
    border: none;
    border-radius: 5px;
    font-size: 16px;
}

.form-actions button:hover {
    background-color: #0056b3;
}

.error {
    color: var(--error-color);
    font-size: 12px;
    margin-top: 5px;
}

.success {
    color: var(--success-color);
    font-size: 12px;
    margin-top: 5px;
}
/* Styles pour la partie header */
header {
    background-color: white; /* Couleur de fond */
    padding: 20px; /* Espacement interne */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Ombre légère */
}

/* Styles pour le logo */
#logo {
    float: left; /* Alignement à gauche */
    margin-right: 20px; /* Marge à droite pour l'espace */
}

/* Styles pour la navigation */
nav ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    text-align: right; /* Alignement à droite */
}

nav ul li {
    display: inline;
    margin-left: 20px; /* Espacement entre les éléments de la liste */
}

nav ul li:first-child {
    margin-left: 10px; /* Réduire l'espacement pour le premier élément */
}

nav ul li a {
    text-decoration: none;
    color: black; /* Couleur du texte */
    font-weight: bold;
    transition: color 0.3s ease; /* Animation de transition */
}

nav ul li a:hover {
    color: blue; /* Couleur du texte au survol */
}

/* Style pour le lien actif */
nav ul li.active a {
    color: blue; /* Couleur du texte pour le lien actif */
}

             </style> 
