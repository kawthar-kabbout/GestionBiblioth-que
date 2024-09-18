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
            <img src="../Images/logo.png" width="220px" alt="Logo " id=logo />
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
<body>
    <?php

if (session_status() == PHP_SESSION_NONE) {
   
    session_start();
}
    $messemp=isset($_SESSION['error_emp']) ? $_SESSION['error_emp'] : "";
    $messref = isset($_SESSION['error_ref']) ? $_SESSION['error_ref'] : "";
    $messcin = isset($_SESSION['error_cin']) ? $_SESSION['error_cin'] : "";
    $messdate = isset($_SESSION['error_date']) ? $_SESSION['error_date'] : "";
    $messajout = isset($_SESSION['error_ajout']) ? $_SESSION['error_ajout'] : "";
    $messajoutnon = isset($_SESSION['error_ajoutnon']) ? $_SESSION['error_ajoutnon'] : "";
    $messrefindiss = isset($_SESSION['error_refindiss']) ? $_SESSION['error_refindiss'] : "";
    $messdepasser = isset($_SESSION['error_depasse']) ? $_SESSION['error_depasse'] : "";
    $messageSup=isset($_SESSION['messsup']) ? $_SESSION['messsup'] : "";
    $messretard = isset($_SESSION['retard']) ? $_SESSION['retard'] : "";

   

  


//date 


/****** $_SESSION['error_ajout'] = $messajout;
        $_SESSION['error_ajoutnon'] = $messajounon;
        $_SESSION['error_cin'] = $messcin;
        $_SESSION['error_ref'] = $messref;
       
        $_SESSION['ref'] = $ref;
         $_SESSION['cin'] = $cin; */
         

$messdateeffRelle=isset($_SESSION['messdateeffRelle']) ? $_SESSION['messdateeffRelle'] : "";
$messdateDeb=isset($_SESSION['messdateDeb']) ? $_SESSION['messdateDeb'] : "";




unset($_SESSION['messdateeffRelle']);
unset($_SESSION['messdateDeb']);


    $dateeffRelle = isset($_SESSION['dateeffRelle']) ? $_SESSION['dateeffRelle'] : "";
    $dateDeb = isset($_SESSION['dateDeb']) ? $_SESSION['dateDeb'] : "";
    $ref=isset($_SESSION['ref']) ? $_SESSION['ref'] : "";
    $cin = isset($_SESSION['cin']) ? $_SESSION['cin'] : "";
        


////les varable 


     unset($_SESSION['dateeffRelle']);
     unset($_SESSION['dateDeb']);
     unset($_SESSION['ref']);
     unset( $_SESSION['cin'] );

    unset($_SESSION['messsup']);
    unset($_SESSION['error_ref']);
    unset($_SESSION['error_emp']);
    unset( $_SESSION['retard'] );
    unset($_SESSION['error_cin']);

    unset($_SESSION['error_ajout']);
    unset($_SESSION['error_ajoutnon']);
    
    unset($_SESSION['error_refindiss']);
    unset($_SESSION['error_depasse']);

   
    ?>

<form action="../Controleur/ControleurRestitutionlivreBib.php" method="POST">
    <h1>La gestion de emprunt d'un livre.</h1><br>
    <table>

    <span style='color:red'><?php echo $messdepasser; ?></span>
        <tr>
        <td>Référence du livre:</td>
<td>
<span style='color:red'><?php echo $messrefindiss; echo $messemp; ?></span>
    <input type="number" name="ref" value="<?php echo !$ref ? '' : $ref; ?>">
    <span style='color:red'><?php echo $messref; ?></span>
</td>

        <tr>
            <td>CIN Adhérent:</td>
            <td><input type="text" name="cin" pattern="[0-9]{8}" value="<?php echo isset($cin) ? $cin : ''; ?>"> <span style ='color:red '><?php echo $messcin; ?> </span></td>
        </tr>
        <tr>
            <td>Date d'emprunt</td>
            <td><input type="date" name="dateDeb"   value="<?php echo isset($dateDeb) ? $dateDeb : ''; ?>"  >  <span style ='color:red '><?php echo $messdateDeb; ?></span></td>
            <td>Date de retoure:</td>
            <td><input type="date" name="dateeffRelle"   value="<?php echo isset($dateeffRelle) ? $dateeffRelle : ''; ?>"></td><td> <span style ='color:red '><?php echo $messdateeffRelle; ?></span></td>
        </tr>
        <tr>
            <td></td>
            <td><button type="submit" name="ajouter">Ajouter</button>
            <button type="submit" name="supprimer">Supprimer</button>
            <button type="submit" name="modifier">Modifier</button>
            <button type="submit" name="restituerLivre">Rrestituer</button>
        
        </td>
    <?php
    
        echo "<span style='color:green;'>" . $messajout.$messageSup . "</span>";
    
        echo "<span style='color:red;'>" . $messajoutnon . "</span>";
   
    ?>
    
    
    </td>
    <tr> 
    <p></p>
           </td></tr>
   
    
        </tr>
    </table>
  
    
</form>




<?php



?>

<style>body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
    margin: 0;
    padding: 0;
}

header {
  background-color: white;
  color: #fff;
  padding: 20px;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

header nav ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    display: flex;
}

header nav ul li {
    margin-right: 20px;
}

nav ul li a {
  text-decoration: none;
  color: black;
  font-weight: bold;
  transition: color 0.3s ease;
}

header nav ul li a:hover {
    color: #ccc;
}

form {
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    max-width: 600px;
    margin: 50px auto;
}

form h1 {
    text-align: center;
    margin-bottom: 20px;
}

form table {
    width: 100%;
    border-collapse: collapse;
}

form table td {
    padding: 10px;
}

form table input[type="number"],
form table input[type="text"],
form table input[type="date"] {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

form table button {
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
}

form table button:hover {
    background-color: #45a049;
}

form table span {
    font-size: 14px;
}
</style>

</body></html>