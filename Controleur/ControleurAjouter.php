<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    //////////manesta3mouch 5ater 7achti b message erreur
 include ('../Model/Adherent.php');

if(isset($_POST['submit'])){
  $cin =$_POST['cin'];
  $nom =$_POST['nom'];
    $prenom=$_POST['prenom'];
    $tel=$_POST['tel'];
    $niveau_etudes=$_POST['niveau_etudes'];
    $filiere = $_POST['filiere'];  
    $email = $_POST['email'];
  
    $password=$_POST['password'];
    
    ///cree un objet de type user
    echo "Nom : " . $cin . "<br>";
  echo "Nom : " . $nom . "<br>";
    echo "Prénom : " . $prenom . "<br>";
    echo "Téléphone : " . $tel . "<br>";
    echo "Niveau d'études : " . $niveau_etudes . "<br>";
    echo "filiere : " . $filiere . "<br>";
    echo "Email : " . $email . "<br>";
    echo "Mot de passe : " . $password . "<br>";
   $u=new Adherent($cin,$nom,$prenom,$tel,$filiere,$niveau_etudes,$email,$password);
echo $u;
   
  if($u->Ajouter()) {
        echo "L'adhérent a été ajouté avec succès.";
    } else {
        echo "Une erreur s'est produite lors de l'ajout de l'adhérent.";
    }
}


?>
</body>
</html>