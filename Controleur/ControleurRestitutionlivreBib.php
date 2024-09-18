<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
include("../Model/Emprunt.php");
if (session_status() == PHP_SESSION_NONE) {
    session_start();}

$messrefindiss = isset($_SESSION['error_refindiss']) ? $_SESSION['error_refindiss'] : "";
$messajout = "";
$messajoutnon = "";
$messref = "";

$messcin = "";
   $messageSup="";
$messcin = "";
$messref = "";
$cin = "";

$messajout = "";
$messdateDeb="";
$messdateeffRelle="";
$ref = 0;
$dateDeb="";
$dateFin = date('Y-m-d');
$dateActuelle = date('Y-m-d');
$messajoutnon="";
$messretard="";
if (isset($_POST['ajouter'])) {
    if (!empty($_POST['cin'])) {
        $cin = $_POST['cin'];
    } else {
        $messcin = "le champs cin est oubligatoire!!";
    }

    if (!empty($_POST['ref'])) {
        $ref = $_POST['ref'];
    } else {
        $messref = "le champ référence est oblogatoire!!";
    }

    if (!empty($_POST['dateDeb'])) {
        $dateDeb = $_POST['dateDeb'];//lel kol
        $dateFin = date('Y-m-d', strtotime($dateDeb . ' + 1 month'));////// la date de fin après un mois à partir d'une date de début
        if ($dateDeb < $dateActuelle ) {
            $messdateDeb = "La date de début doit être supérieure à la date d'aujourd'hui.";
        }
    } else {
        $messdateDeb = "le champ date est obligatoire!!!";
    }

    if ($messcin == "" && $messref == "" && $messdateDeb == "") {
        $datdateeffRelle='0000-00-00';
        $e = new Emprunt($cin, $ref, $dateDeb, $dateFin,$datdateeffRelle);
        if ($e->Ajouter()) {
            $messajout = "Emprunt est ajouter avec succer Date de retoure: $dateFin";


            //vider les champs 
            $ref="";
            $cin="";
            $dateDeb="";
            $dateeffRelle="";
            

        } else {
            $messajoutnon = "Verifier vs donner ";
        }
    }
    if ($messajout != "" || $messdateDeb!="" || $messcin != "" || $messref != "") {
        $_SESSION['error_ajout'] = $messajout;
        $_SESSION['error_ajoutnon'] = $messajounon;
        $_SESSION['messdateDeb'] = $messdateDeb;
        $_SESSION['error_cin'] = $messcin;
        $_SESSION['error_ref'] = $messref;    
        $_SESSION['dateeffRelle'] = $dateeffRelle;
        $_SESSION['dateDeb'] = $dateDeb;
        $_SESSION['ref'] = $ref;
         $_SESSION['cin'] = $cin;
    
        // Redirection vers la page chercher.php
        header("Location: ../Vue/restitutionlivreBib.php");
        exit();
}

}


////////// supprimer l'emprunt et mettre à jour le livre disponibleif 
    if (isset($_POST['supprimer'])){
        $ref = $_POST['ref'];
        $cin=$_POST['cin'];
        if (!empty($cin) && !empty($ref)){ 
            
            $resultat = Emprunt::Supprimer($ref,$cin);
                if($resultat){
                    $messajout="l'emprint a ete supprimer avec succe";
             //vider les champs 
           $ref="";
            $cin="";
                }
                
                else {
                    $messajounon = "Une erreur s'est produite lors de la suppression de l'emprunt.";
                }
        
        }   if (empty($_POST['ref'])) {
            $messref = "Le champ référence est obligatoire!!";
        }
        if (empty($_POST['cin'])) {
            $messcin = "Le champ cin est obligatoire";
        }
        
                                                            //
   if ($messajounon!=""||$messref!=""||$messcin!=""||$messajout !=""){
    $_SESSION['error_ajout'] = $messajout;
        $_SESSION['error_ajoutnon'] = $messajounon;
        $_SESSION['error_cin'] = $messcin;
        $_SESSION['error_ref'] = $messref;
       
        $_SESSION['ref'] = $ref;
         $_SESSION['cin'] = $cin;
        header("Location: ../Vue/restitutionlivreBib.php");
        exit();
    }
   
} 
            
          
      
    
    
   


    //modifier emp :
   
    if (isset($_POST['modifier'])) {
        $cin = $_POST['cin'];
        $ref = $_POST['ref'];
        $dateDeb = $_POST['dateDeb'];
        $dateeffRelle=$_POST['dateeffRelle'];
        
        $dateFin = date('Y-m-d', strtotime($dateDeb . ' + 1 month')); // La date de fin après un mois à partir de la date de début
    
        if (!empty($cin) && !empty($ref) && !empty($dateDeb)&& !empty($dateeffRelle)) {
            if ($dateDeb < date('Y-m-d')) {
                $messdateDeb = "La date de début doit être antérieure à la date de fin, et les deux dates doivent être supérieures à la date actuelle.";
            } else {
                $emprunt = new Emprunt($cin, $ref, $dateDeb, $dateFin, $dateeffRelle);
                $emp = $emprunt->ModifierEmp($cin, $ref, $dateDeb, $dateFin, $dateeffRelle);
                if ($emp != false) {
                    $messajout = "La date de l'emprunt a été modifiée avec succès.";
                    //vider les champs 
            $ref="";
            $cin="";
            $dateDeb="";
            $dateeffRelle="";
                } else {
                    $messajoutnon = "Un problème est survenu lors de la modification , Veuillez vérifier vos données.";
                }
            }
            ////modifier seulement date dateeffRelle
        }else  if (!empty($cin) && !empty($ref) && !empty($dateeffRelle)){
            if ($dateeffRelle < date('Y-m-d')) {
                $messdateeffRelle = "La date de début doit être antérieure à la date de fin, et les deux dates doivent être supérieures à la date actuelle.";
            } else {
                $dateDeb="";
                $dateFin="";
                $emprunt = new Emprunt ($cin, $ref, $dateDeb, $dateFin, $dateeffRelle);
                $emp = $emprunt->ModifierdateeffRelle($cin, $ref, $dateDeb, $dateFin, $dateeffRelle );
                if ($emp != false) {
                    $messajout = "La date de l'emprunt a été modifiée avec succès.";
                    //vider les champs 
            $ref="";
            $cin="";
            $dateDeb="";
            $dateeffRelle="";
                } else {
                    $messajoutnon = "Un problème est survenu lors de la modification , Veuillez vérifier vos données.";
                }
            }
        
        }else  if (!empty($cin) && !empty($ref) && !empty($dateDeb)){
                if ($dateDeb < date('Y-m-d')) {
                    $messdateDeb = "La date de début doit être antérieure à la date de fin, et les deux dates doivent être supérieures à la date actuelle.";
                } else {
                    $dateeffRelle="";
                    $emprunt = new Emprunt($cin, $ref, $dateDeb, $dateFin, $dateeffRelle);
                    $emp = $emprunt->ModifierEmpDatedebut($cin, $ref, $dateDeb, $dateFin, $dateeffRelle);
                    if ($emp != false) {
                        $messajout = "La date de l'emprunt a été modifiée avec succès.";
                        //vider les champs 
            $ref="";
            $cin="";
            $dateDeb="";
            $dateeffRelle="";
                    } else {
                        $messajoutnon = "Un problème est survenu lors de la modification , Veuillez vérifier vos données.";
                    }{
          
        }
    
      
    }
}
if (empty($cin)) {
    $messcin = "Le champ CIN est obligatoire.";
}
if (empty($ref)) {
    $messref = "Le champ référence est obligatoire.";
}
if (empty($dateDeb)&&(empty($dateeffRelle))) {
    $messajoutnon = "Le champ date  est obligatoire.";
} 

if ($messcin != "" ||$messref="" || $messajoutnon != "" || $messajout != "") {
    $_SESSION['error_cin'] = $messcin;
    $_SESSION['messdateDeb'] = $messdateDeb;
    $_SESSION['error_ajoutnon'] = $messajoutnon;
    $_SESSION['error_ajout'] = $messajout;
    $_SESSION['error_ref'] = $messref;
  
    $_SESSION['dateeffRelle'] = $dateeffRelle;
    $_SESSION['dateDeb'] = $dateDeb;
    $_SESSION['ref'] = $ref;
     $_SESSION['cin'] = $cin;
    header("Location: ../Vue/restitutionlivreBib.php");
    exit();
}

}

    ////La gestion de restitution d’un livre. 
    if (isset($_POST['restituerLivre']) ) {
        $ref = $_POST['ref'];
        $dateeffRelle = $_POST['dateeffRelle'];
        
        $cin=$_POST['cin'];

        if (!empty($cin) && !empty($ref) && !empty($dateeffRelle)){
        
         $restitue = Emprunt::restituerLivre($ref, $dateeffRelle, $cin);

            if (!empty($restitue)) {
                $dateFin = $restitue['dateFin'];
                $dateDeb=$restitue['dateDeb'];
              // Vérifier que la date de retour effective est supérieure à la date de début de l'emprunt
        if ($dateeffRelle <= $dateDeb) {
            $messdateeffRelle = "La date de retour effective doit être supérieure à la date de début de l'emprunt.";
            $_SESSION['messdateeffRelle'] = $messdateeffRelle;
            header("Location: ../Vue/restitutionlivreBib.php");
            exit();
                }
                // Gérer le retard
                $today = new DateTime($dateeffRelle);
                $finEmprunt = new DateTime($dateFin);
                $retard = $today->diff($finEmprunt)->days;
        
                if ($retard > 30) {
                    $messageSup = "L'emprunt a été restitué avec succès. Le retard est de $retard jours.";
                    //vider les champs 
            $ref="";
            $cin="";
          
            $dateeffRelle="";
                } else {
                    $messageSup = "L'emprunt a été restitué avec succès. Il n'y a pas de retard.";
                    //vider les champs 
        /*    $ref="";
            $cin="";
         
            $dateeffRelle="";*/
                }
        
            } else {
                $messageSup = "Un problème est survenu lors de la restitution du livre.";
            }
        
        }
            if (empty($cin)) {
                $messcin = "Le champ CIN est obligatoire.";
            }
            if (empty($ref)) {
                $messref = "Le champ référence est obligatoire.";
            }
            if (empty($dateeffRelle)) {
                $messdateeffRelle = "Le champ date de retoure est obligatoire.";
            }
       
        
        
   if ($dateeffRelle!=""||$messref!=""||$messcin!=""||$messageSup !=""){
    $_SESSION['error_cin'] = $messcin;
    $_SESSION['error_date'] = $messdate;
    $_SESSION['messsup'] = $messageSup;
    $_SESSION['error_ref'] = $messref;

    
    $_SESSION['messdateeffRelle'] = $messdateeffRelle;

    $_SESSION['dateeffRelle'] = $dateeffRelle;
  
    $_SESSION['ref'] = $ref;
     $_SESSION['cin'] = $cin;
        header("Location: ../Vue/restitutionlivreBib.php");
        exit();
    }
    }
    
     
?>    


</body>
</html>