<?php




        
include("../Model/Connexion.php");
    
$sql = $bdd->query("SELECT * FROM adherent WHERE 'password'='".$this->data['password']."" );//les simples quotes sont OBLIGATOIRES//

// Récupérer les résultats de la requête sous forme de tableau associatif

$sql->setFetchMode(PDO::FETCH_OBJ);

////tab pour les paramettre de cette adh
$adhs=array();  
while ($utilisateur=$sql->fetch())
{
    $adhs=$utilisateur;
}



?>