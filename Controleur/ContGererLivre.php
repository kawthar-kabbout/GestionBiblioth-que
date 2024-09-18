<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$message="";
include("../Model/Livre.php");
    if (isset($_POST['btnAjouter'])) {

        $ref = $_POST['ref'];
        $nom = $_POST['nom'];
        $nomAuteur = $_POST['nomAuteur'];
        $image = $_POST['image'];
        $categorie = $_POST['categorie'];
        $disponible = "oui";
        
        // Assurez-vous que les valeurs sont correctement récupérées depuis $_POST
        
        if (!empty($ref) && !empty($nom) && !empty($nomAuteur) && !empty($image) && !empty($categorie) && !empty($disponible)) {
            // Appel de la méthode ajouterLivre() avec les six arguments requis
            $livre = new Livre($ref, $nom, $nomAuteur, $categorie, $image, $disponible);
            if ($livre->ajouterLivre($ref, $nom, $nomAuteur, $categorie, $image, $disponible)) {
                $message = "Le livre est ajouté avec succès.";
            } else {
                $message = "Une erreur s'est produite lors de l'ajout de ce livre.";
            }
        } else {
            $message = "Tous les champs sont obligatoires.";
        }
        
        $_SESSION['message'] = $message;
        header("Location: ../Vue/GererLivre.php");
        exit();
    }
    
    ////supprimer lovre 
    
    if (isset($_POST['btnSupprimer'])){
        $ref=$_POST['ref'];
        $livre = Livre::summpimer($ref);
        if($livre){
            $message= "Le livre a été supprimé avec succès.";
        }
        else{
            $message= "Une erreur s'est produite lors de la suppression du livre verifier le ref du livre.";
        }
        $_SESSION['message'] = $message;
        header("Location: ../Vue/GererLivre.php");
        exit();
    }
    if (isset($_POST['btnModifier'])){
        $ref = $_POST['ref'];
        $nom = $_POST['nom'];
        $nomAuteur = $_POST['nomAuteur'];
        $image = $_POST['image'];
        $categorie = $_POST['categorie'];
        $disponible = $_POST['disponible'];
        if (!empty($ref)){
            $livre = new Livre($ref, $nom, $nomAuteur, $categorie, $image, $disponible);
            if ($livre->modifierLivre($ref, $nom, $nomAuteur, $categorie, $img, $disponible)) {
                $message = "Le livre a été modifié avec succès.";
            } else {
                $message = "Une erreur s'est produite lors de la modification du livre.";
            }
        }else{
            $message = "Le champ référence est obligatoire !";
        }
      
        $_SESSION['message'] = $message;
        header("Location: ../Vue/GererLivre.php");
        exit();  

    }
    
?>