<?php
session_start();

include ('../Model/Adherent.php');
$message="";
$messageSup="";
$cin=0;
$messnom="";
$messtel="";
$tel=0; 
$nom="";
$prenom="";
$niveau_etudes="";
$filiere="";
$password="";
$messpenom="";
$messlib="";
$email="";
$messniveau_etudes="";
$messemail="";
$messfiliere="";
$messpassword="";
$messageModifie="";
$messcin="";
$abonne="";

if(isset($_POST['Ajouter'])){

  if (empty($_POST['cin']))
    {
        $messcin="le champs cin est obligatoire";}
else
    {
        $cin=$_POST['cin'];
  
    }
    if (empty($_POST['nom']))
    {
        $messnom="le champs nom est obligatoire";}
else
    {
        $nom=$_POST['nom'];
  
    }
    if (empty($_POST['prenom']))
    {
        $messpenom="le champ prenom est obligatoire ";

    }else{
        $prenom=$_POST['prenom'];
        

    }
    if(empty($_POST['tel']))
    {
        $messtel="le champs Telephone est obligatoire";

    }else{
        $tel=$_POST['tel'];
       
    }
    if(empty($_POST['niveau_etudes'] )) {
    
        $messniveau_etudes="le champs niveau_etudes est obligatoire";}
    else{
    
        $niveau_etudes=$_POST['niveau_etudes'];
      }
    
    if(empty($_POST['filiere'] )) {
            
        $messfiliere="le champs filiere est obligatoire";}
    else{
        $filiere=$_POST['filiere'];
       }
       if(empty($_POST['password'] )) {
        $messpassword="le champs password est obligatoire";
        }
    else{
    
        $password=$_POST['password'];
    }
     
    if(empty($_POST['email'] )) {
        $messemail="le champs email est obligatoire";
        }
    else{
    
        $email=$_POST['email'];
    }
 if (!empty($cin)&& !empty($nom)&& !empty($prenom)&& !empty($tel)&& !empty($filiere)&& !empty($niveau_etudes)&& !empty($email)&& !empty($password)){
  
    $abonne="oui";
   $u=new Adherent($cin,$nom, $prenom,$tel,$filiere,$niveau_etudes,$email,$password ,$abonne);

   
  if($u->Ajouter()) {
        $message= "L'adhérent a été ajouté avec succès.";
        ///vider les champs
        $nom="";
        $prenom="";
        $email="";
        $filiere="";
        $niveau_etudes="";
        $tel="";

    } else {
        $messagenon ="Une erreur s'est produite lors de l'ajout de l'adhérent.";
    }
}

if ($messagenon!=""||$message!=""||$cin!=""|$email!=""||$nom!=""||$prenom!=""||$filiere!=""||$niveau_etudes!=""|| $tel!=""||$messcin!=""||  $messnom!="" || $messpenom!=""||$messtel=""||$messfiliere!=""||$messfiliere!=""||$messniveau_etudes!=""||$messpassword!="" ||$messemail!="") {
    $_SESSION['message'] = $message;
    $_SESSION['messagenon'] = $messagenon;
    $_SESSION['email'] = $email;
    $_SESSION['nom'] = $nom;
     $_SESSION['penom'] = $prenom;
     $_SESSION['filiere'] = $filiere;
     $_SESSION['niveau_etudes'] = $niveau_etudes;
     $_SESSION['tel'] = $tel;
     $_SESSION['cin'] = $cin;

     $_SESSION['messcin'] = $messcin;
     $_SESSION['messnom'] = $messnom;
     $_SESSION['messpenom'] = $messpenom;
     $_SESSION['messtel'] = $messtel;
     $_SESSION['messfiliere'] = $messfiliere;
     $_SESSION['messniveau_etudes'] = $messniveau_etudes;
     $_SESSION['messpassword'] = $messpassword;
     $_SESSION['messemail'] = $messemail;
     header("Location: ../Vue/GererAdhBib.php");
     exit();



}

}


if (isset($_POST['Supprimer']) && !empty($_POST['cin'])) {
    $cin = $_POST['cin'];
    $messageSup = "";
    $messagenon = "";

    if (!empty($cin)) {
        if (Adherent::Supprimer($cin)) {
            $messageSup = "L'adhérent a été supprimé avec succès.";
        } else {
            $messagenon = "Une erreur s'est produite lors de la suppression de l'adhérent.";
        }
    }

    if ($messageSup != "" || $messagenon != "") {
        $_SESSION['messagenon'] = $messagenon;
        $_SESSION['messageSup'] = $messageSup;
        header("location:../Vue/GererAdhBib.php");
        exit();
    }
}

  
////modifer adh
  
if (isset($_POST['modifier'])) {
    $cin = $_POST['cin'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $tel = $_POST['tel'];
    $filiere = $_POST['filiere'];
    $niveau_etudes = $_POST['niveau_etudes'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $abonne = $_POST['abonnee'];

    if (empty($cin)) {
        $messcin = "Le champ CIN est obligatoire.";
    } else {
        //$cin,$nom, $prenom,$tel,$filiere,$niveau_etudes,$email,$password, $abonne
        $u = new Adherent($cin, $nom, $prenom, $tel, $filiere, $niveau_etudes, $email, $password, $abonne);
        if ($u->Modifier()) {
            $messageModifie = "L'adhérent a été modifié avec succès.";
        } else {
            $messageModifie = "Une erreur s'est produite lors de la modification de l'adhérent.";
        }
    }

    $_SESSION['message'] = $messageModifie;
  

    header("Location: ../Vue/GererAdhBib.php");
    exit();
}



?>