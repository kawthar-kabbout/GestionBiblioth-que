<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
session_start();
   include("../Model/Users.php");

   if(isset($_POST['submit'])){
    $login =$_POST['login'];
    $password=$_POST['password'];
    

    ///cree un objet de type user
    $u=new Users($login,$password);
    if ($u->connect())
    {
     
      header("location:../Vue/GererAdhBib.php"); 


    }
    else
   {
// Affiche le contenu des données soumises via le formulaire
//var_dump($_POST);
$mess="verifier votre login et voter password ";
$_SESSION['mess'] = $mess;
header("location:../Vue/AuthentificationKawthar.php"); 

echo "Login et mot de passe incorrects";
   }
   }
   ?>
</body>
</html>