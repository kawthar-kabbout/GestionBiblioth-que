

<?php
  if (session_status() == PHP_SESSION_NONE) {
    session_start();}
$mess=isset($_SESSION['mess']) ? $_SESSION['mess'] : "";/*
$messchercher=isset(  $_SESSION['messchercher']) ? $_SESSION['messchercher'] : "";
unset($_SESSION['messchercher']);*/
unset($_SESSION['mess']);
  
?>
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

    </div>

    <div>
    <div class="form-container">
    <!-- Votre formulaire ici -->


        <form action="../Controleur/ControleureConsultationrestitutionlivreBib.php" method="POST">
            <h1>Consultation des Emprunts</h1>
            <label for="">Afficher les Emprunts non retournés</label>
            <button type="submit" name="afficherLivresNonRetournes">Afficher les Emprunts non retournés</button><br>

            <span style ='color:red '><?php echo $mess; ?></span>

     <h2>Chercher emprunts</h2><label for="">Référence du livre:</label> 
            
            
            <input type="number" name="ref"><br>
          
            <label for="">CIN Adhérent:</label>
                
                <input type="text" name="cin" pattern="[0-9]{8}" ><br>
           
                <label for="">Date d'emprunt</label>
            
                
                <input type="date" name="dateDeb" ><br>
                <label for="">Date retour Prevue:</label>
                
                <input type="date" name="dateFin"><br>
                
           

            
                <label for="">Date retour effective</label>
                <input type="date" name="dateeffRelle" ><br>
           

            
            <button type="submit" name="affiche">Afficher</button>
            </form>   
    </div>
   















    <style>/* Styles généraux */


/* Styles pour la navigation */
nav ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: flex-end;
    align-items: center;
}

nav ul li {
    margin-left: 20px;
}

nav ul li:first-child {
    margin-left: 0;
}

nav ul li a {
    text-decoration: none;
    color: #333;
    font-weight: bold;
    transition: color 0.3s ease;
}

nav ul li a:hover {
    color: #007bff;
}

nav ul li.active a {
    color: #007bff;
}




body {
    font-family: Arial, sans-serif;
    background-color: #f9f9f9;
    margin: 0;
    padding: 0;
}

/* Styles pour la partie header */
header {
    background-color: #ffffff;
    padding: 20px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

/* Styles pour le logo */
#logo {
    max-width: 220px;
}

/* Styles pour la navigation */
nav ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    display: flex;
}

nav ul li {
    margin-left: 20px;
}

nav ul li:first-child {
    margin-left: 0;
}

nav ul li a {
    text-decoration: none;
    color: #333;
    font-weight: bold;
    transition: color 0.3s ease;
}

nav ul li a:hover {
    color: #007bff;
}

nav ul li.active a {
    color: #007bff;
}

/* Styles pour le formulaire */
.form-container {
    background-color: #f2f2f2;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    max-width: 400px;
    margin: 20px auto;
}

h1 {
    font-size: 24px;
    text-align: center;
    margin-bottom: 20px;
}

h2 {
    font-size: 20px;
    margin-top: 20px;
}

label {
    display: block;
    margin-bottom: 5px;
}

input[type="number"],
input[type="text"],
input[type="date"] {
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

button {
    background-color: #007bff;
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
    transition: background-color 0.3s ease;
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
