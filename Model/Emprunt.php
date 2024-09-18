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
$messdepass="";
$messrefindiss="";
include("Connexion.php");
class Emprunt {
    private $data = array();

 
    public function __construct($cin, $ref, $dateDeb, $dateFin,$dateeffRelle) {
        $this->data ['cin']= $cin;
        $this->data['ref'] = $ref;
        $this->data['dateDeb'] = $dateDeb;
        $this->data['dateFin'] = $dateFin;
        $this->data['dateeffRelle']=$dateeffRelle;
    }


    
    public function Ajouter() {
        global $bdd;
    
       
        include("../Model/Livre.php");
        include("../Model/Adherent.php");
        ///////verifier que est un adherent 
        $adh=Adherent::getAdherent($this->data['cin']);
        if (!empty($adh)){
        /////verifier est ce que le livre est disponible 
    
        $livres = Livre::getListeLivresRefDis($this->data['ref']);
        
        if (!empty($livres)) {
            //////verifier est ce que l'adherent ne passe pa 2 livres 
            $sql = $bdd->prepare("SELECT COUNT(*) 
            FROM emprunt 
            WHERE cin = :cin 
            AND dateeffRelle = '0000-00-00'");;/////cas de livre restituerLivre
            $sql->bindParam(':cin', $this->data['cin']);
            $sql->execute();
    
            $count = $sql->fetchColumn();
     //////verifier est ce que l'adherent ne passe pa 3 livres 
            if ($count < 3) {    ///**************************        La gestion des pénalités   */
                $stmt = $bdd->prepare("INSERT INTO emprunt(cin, ref, dateDeb, dateFin,dateeffRelle) VALUES(:cin, :ref, :dateDeb, :dateFin,:dateeffRelle)");
                $stmt->bindParam(':cin', $this->data['cin']);
                $stmt->bindParam(':ref', $this->data['ref']);
                $stmt->bindParam(':dateDeb', $this->data['dateDeb']);
                $stmt->bindParam(':dateFin', $this->data['dateFin']);
                $stmt->bindParam(':dateeffRelle', $this->data['dateeffRelle']);

    
                $resultat = $stmt->execute();
                $stmt->closeCursor();
    
                // Retourner true ou false
                if ($resultat) {
                    //////////////updayte le tableau par indisponible 
                    $updateStmt = $bdd->prepare("UPDATE livre SET disponible = 'non' WHERE ref = :ref");
                    $updateStmt->bindParam(':ref', $this->data['ref']);
                    $updateStmt->execute();
                    $updateStmt->closeCursor();
    
                    return true;
                } else {
                    return false;
                }
            } else { ///// il depasser 2 livres
                $messdepass = "cette adherent a 3 livres déja!!";
                $_SESSION['error_depasse'] = $messdepass;
                header("Location: ../Vue/restitutionlivreBib.php");
                exit();
               
            }
        } else {
            $messref = "le livre est indisponible!!!!!!";
            $_SESSION['error_refindiss'] = $messref;
            header("Location: ../Vue/restitutionlivreBib.php");
            exit();
            
        }
    
    }////nest pas un adherent 
    $messcin = "n'est pas un adherent !!";
            $_SESSION['error_cin'] = $messcin;
            header("Location: ../Vue/restitutionlivreBib.php");
            exit();


}
    /*
    static function Supprimer($ref, $cin) {
        global $bdd;
    
        ////verifier les donner entrer par l'utilisateure pour specifier l'erreure 
        $sql = $bdd->prepare("SELECT * FROM emprunt WHERE ref = :ref AND cin = :cin");
        $sql->bindParam(':ref', $ref);
        $sql->bindParam(':cin', $cin);
        $sql->execute();
        $result = $sql->fetch(PDO::FETCH_ASSOC);
    
        if ($result) {
           
    
            // Supprimer l'emprunt
            $deleteStmt = $bdd->prepare("DELETE FROM emprunt WHERE ref = :ref AND cin = :cin");
            $deleteStmt->bindParam(':ref', $ref);
            $deleteStmt->bindParam(':cin', $cin);
            $deleteStmt->execute();
            $nombreEnregistrements = $deleteStmt->rowCount();
    
            if ($nombreEnregistrements > 0) {
                // Mettre le livre disponible
                $updateStmt = $bdd->prepare("UPDATE livre SET disponible = 'oui' WHERE ref = :ref");
                $updateStmt->bindParam(':ref', $ref);
                $updateStmt->execute();
                $updateStmt->closeCursor();
    
               
                return true;
            } 
            else return false;
            
        } else {
            $messsup = "Vérifiez le numéro de référence du livre et le CIN de l'adhérent.";
            $_SESSION['messsup'] = $messsup;
            header("Location: ../Vue/restitutionlivreBib.php");
            exit();
        }
    }
    /*
    public function ModifierEmpref($ref,$cin) {
        global $bdd;
    
        // Vérifier que l'emprunt existe pour la référence donnée
        $sql = $bdd->prepare("SELECT * FROM emprunt WHERE cin = :cin");
        $sql->bindParam(':cin', $cin);
        $sql->execute();
        $result = $sql->fetch(PDO::FETCH_ASSOC);
    
        if ($result) {
            // Mettre à jour la date de début de l'emprunt
            $updateStmt = $bdd->prepare("UPDATE emprunt SET ref = :ref where cin = :cin");
           
            $sql->bindParam(':cin', $cin);
            $updateStmt->bindParam(':ref', $ref);
            $updateStmt->execute();
            $updateStmt->closeCursor();
    
            // Retourner true pour indiquer que la modification a été effectuée avec succès
            return true;
        } else {
            // Retourner false si l'emprunt pour la référence donnée n'existe pas
           return false;
        }
    } 
    */
    
    /*
    public function ModifierEmpDatedebut($dateDeb, $cin) {
        global $bdd;
    
        // Vérifier que l'emprunt existe pour le CIN donné
        $sql = $bdd->prepare("SELECT * FROM emprunt WHERE cin = :cin");
        $sql->bindParam(':cin', $cin);
        $sql->execute();
        $result = $sql->fetch(PDO::FETCH_ASSOC);
    
        if ($result) {
            // Mettre à jour la date de début de l'emprunt
            $updateStmt = $bdd->prepare("UPDATE emprunt SET dateDeb = :dateDeb WHERE cin = :cin");
            $updateStmt->bindParam(':dateDeb', $dateDeb);
            $updateStmt->bindParam(':cin', $cin);
            $updateStmt->execute();
            $updateStmt->closeCursor();
    
            // Retourner true pour indiquer que la modification a été effectuée avec succès
            return true;
        } else {
            // Retourner false si l'emprunt pour le CIN donné n'existe pas
            return false;
        }
    }*/

    ////les deux date fin et debut 
    //la date fin et toujour >30jours à date debut 


    
    public function ModifierEmpDatedebut($cin, $ref, $dateDeb, $dateFin, $dateeffRelle) {
        global $bdd;
    //////$dateeffRelle=null
        // Vérifier que l'emprunt existe pour la référence donnée
        $sql = $bdd->prepare("SELECT * FROM emprunt WHERE ref = :ref AND cin = :cin");
        $sql->bindParam(':ref', $ref);
        $sql->bindParam(':cin', $cin);
        $sql->execute();
        $result = $sql->fetch(PDO::FETCH_ASSOC);
    
        if ($result) {
            // Mettre à jour la date de début et de fin de l'emprunt
            $updateStmt = $bdd->prepare("UPDATE emprunt SET dateDeb = :dateDeb, dateFin = :dateFin WHERE ref = :ref AND cin = :cin");
            $updateStmt->bindParam(':ref', $ref);
            $updateStmt->bindParam(':dateFin', $dateFin);
            $updateStmt->bindParam(':cin', $cin);
            $updateStmt->bindParam(':dateDeb', $dateDeb);
            $updateStmt->execute();
    
            if ($updateStmt->rowCount() > 0) {
                // La modification a été effectuée avec succès
                return true;
            } else {
                // Aucune modification effectuée
                return false;
            }
        } else {
            // Aucun emprunt trouvé pour la référence donnée
            return false;
        }
    }
/////modifier date  de retoure relle 
    public function ModifierdateeffRelle($cin, $ref, $dateDeb, $dateFin, $dateeffRelle) {
        global $bdd;
    ///$dateFin=$dateDeb=null
        // Vérifier que l'emprunt existe pour la référence donnée
        $sql = $bdd->prepare("SELECT * FROM emprunt WHERE ref = :ref AND cin = :cin");
        $sql->bindParam(':ref', $ref);
        $sql->bindParam(':cin', $cin);
        $sql->execute();
        $result = $sql->fetch(PDO::FETCH_ASSOC);
    
        if ($result) {
            // Mettre à jour la date effective de retour de l'emprunt
            $updateStmt = $bdd->prepare("UPDATE emprunt SET dateeffRelle = :dateeffRelle WHERE ref = :ref AND cin = :cin");
            $updateStmt->bindParam(':ref', $ref);
            $updateStmt->bindParam(':dateeffRelle', $dateeffRelle);
            $updateStmt->bindParam(':cin', $cin);
            $updateStmt->execute();
    
            if ($updateStmt->rowCount() > 0) {
                // La modification a été effectuée avec succès
                // Mettre à jour le livre comme disponible
                $updateLivre = $bdd->prepare("UPDATE livre SET disponible = 'oui' WHERE ref = :ref");
                $updateLivre->bindParam(':ref', $ref);
                $updateLivre->execute();
    
                if ($updateLivre->rowCount() > 0) {
                    return true;
                } else {
                    return false;
                }
            } else {
                // Aucune modification effectuée
                return false;
            }
        } else {
            // Aucun emprunt trouvé pour la référence donnée
            return false;
        }
    }




    ////lkol 
    public function ModifierEmp($cin, $ref, $dateDeb, $dateFin, $dateeffRelle) {
        global $bdd;
    
        // Vérifier que l'emprunt existe pour la référence donnée
        $sql = $bdd->prepare("SELECT * FROM emprunt WHERE ref = :ref AND cin = :cin");
        $sql->bindParam(':ref', $ref);
        $sql->bindParam(':cin', $cin);
        $sql->execute();
        $result = $sql->fetch(PDO::FETCH_ASSOC);
    
        if ($result) {
            // Mettre à jour la date de début de l'emprunt
            $updateStmt = $bdd->prepare("UPDATE emprunt SET dateDeb = :dateDeb, dateFin = :dateFin, dateeffRelle = :dateeffRelle WHERE ref = :ref AND cin = :cin");
            $updateStmt->bindParam(':ref', $ref);
            $updateStmt->bindParam(':dateFin', $dateFin);
            $updateStmt->bindParam(':cin', $cin);
            $updateStmt->bindParam(':dateDeb', $dateDeb);
            $updateStmt->bindParam(':dateeffRelle', $dateeffRelle);
            $updateStmt->execute();
    
            if ($updateStmt->rowCount() > 0) {
                // La modification a été effectuée avec succès
                // Mettre à jour le livre comme disponible
                $updateLivre = $bdd->prepare("UPDATE livre SET disponible = 'oui' WHERE ref = :ref");
                $updateLivre->bindParam(':ref', $ref);
                $updateLivre->execute();
    
                if ($updateLivre->rowCount() > 0) {
                    return true;
                } else {
                    return false;
                }
            } else {
                // Aucune modification effectuée
                return false;
            }
        } else {
            // Retourner false si l'emprunt pour la référence donnée n'existe pas
            return false;
        }
    }

    static function restituerLivre($ref, $dateeffRelle, $cin) {
        global $bdd;
        include("../Model/Livre.php");
        /////////ca sde double emprint date   ou le livre eté déja retourner et il nom emprenter
        $livres = Livre::getListeLivresRefIndis($ref);
    
        if (!empty($livres)) {
            // Vérifier que l'adhérent retourne le livre avec lui-même
            $sql = $bdd->prepare("SELECT * FROM emprunt WHERE ref = :ref AND cin = :cin");
            $sql->bindParam(':ref', $ref);
            $sql->bindParam(':cin', $cin);
            $sql->execute();
            $result = $sql->fetch(PDO::FETCH_ASSOC);
    
            if ($result) {

                
                // Mettre à jour le livre comme disponible
                $updateStmt = $bdd->prepare("UPDATE livre SET disponible = 'oui' WHERE ref = :ref");
                $updateStmt->bindParam(':ref', $ref);
                $updateStmt->execute();
                $updateStmt->closeCursor();
    
                if ($updateStmt->rowCount() > 0) {
                    // Mettre à jour la date de retour effective de l'emprunt
                    $updateStmt = $bdd->prepare("UPDATE emprunt SET dateeffRelle = :dateeffRelle WHERE ref = :ref AND cin = :cin");
                    $updateStmt->bindParam(':ref', $ref);
                    $updateStmt->bindParam(':dateeffRelle', $dateeffRelle);
                    $updateStmt->bindParam(':cin', $cin);
                    $updateStmt->execute();
                    $updateStmt->closeCursor();
    
                    if ($updateStmt->rowCount() > 0) {
                        // Récupérer l'enregistrement mis à jour de l'emprunt
                        $sql = $bdd->prepare("SELECT * FROM emprunt WHERE ref = :ref AND cin = :cin");
                        $sql->bindParam(':ref', $ref);
                        $sql->bindParam(':cin', $cin);
                        $sql->execute();
                        $result = $sql->fetch(PDO::FETCH_ASSOC);
    
                        if ($result) {
                            return $result;
                        } else {
                            return [];
                        }
                    } else {
                        return [];
                    }
                } else {
                    return [];
                }
            } else {
                $messsup = "il n'existe pas d'emprunt avec la référence de livre et le CIN d'adhérent donnés";
                $_SESSION['messsup'] = $messsup;
                header("Location: ../Vue/restitutionlivreBib.php");
                exit();
            }
        } else {
            $messsup = "Veuillez vérifier le numéro de référence du livre, car il ne semble pas correspondre à un livre de la bibliothèque. Soit le livre a déjà été retourné, soit il n'a jamais été emprunté.";            $_SESSION['messsup'] = $messsup;
            header("Location: ../Vue/restitutionlivreBib.php");
            exit();
        }
    }

  /*  static function getEmpNomretourner() {
        include("../Model/Adherent.php");
        global $bdd;
        $sql = $bdd->prepare("SELECT 
            a.cin,
            a.prenom,
            a.nom,
            a.Telephone,
            a.email,
            e.ref, 
            e.dateDeb, 
            e.dateFin
        FROM emprunt e
        JOIN adherent a ON e.cin = a.cin
        WHERE e.dateeffRelle = '0000-00-00'");
        
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        
        if ($result) {
            return $result;
        } else {
            return [];
        }
    }

    static function getEmpAnnee($cin, $ref,$date)
    {
       
        global $bdd;


        
    }*/
    
    static function getEmpNomretourner() {
        include("../Model/Adherent.php");
        global $bdd;
        $sql = $bdd->prepare("SELECT 
            a.cin,
            a.prenom,
            a.nom,
            a.Telephone,
            a.email,
            e.ref, 
            e.dateDeb, 
            e.dateFin
        FROM emprunt e
        JOIN adherent a ON e.cin = a.cin
        WHERE e.dateeffRelle = '0000-00-00'");
        
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        
        if ($result) {
            return $result;
        } else {
            return [];
        }
    }

    static function rechercherEmpruntParCritere($ref, $cin, $dateDeb, $dateFin, $dateeffRelle) {
        global $bdd;
        
        $stmt = $bdd->prepare("SELECT ref, cin, dateDeb, dateFin, dateeffRelle 
        FROM emprunt 
        WHERE (:ref = '' OR ref LIKE :ref) 
        AND (:cin = '' OR cin LIKE :cin) 
        AND (:dateDeb = '' OR dateDeb LIKE :dateDeb) 
        AND (:dateFin = '' OR dateFin = :dateFin) 
        AND (:dateeffRelle = '' OR dateeffRelle = :dateeffRelle)");
       
        $stmt->bindParam(':ref', $ref);
        $stmt->bindParam(':cin', $cin);
        $stmt->bindParam(':dateDeb', $dateDeb);
        $stmt->bindParam(':dateFin', $dateFin);
        $stmt->bindParam(':dateeffRelle', $dateeffRelle);
        
        
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if ($result) {
            return $result;
        } else {
            return [];
        }

        
    }
    public static function getEmpruntsByCin($cin) {
        global $bdd;
        $stmt = $bdd->prepare("SELECT * FROM emprunt WHERE cin = :cin");
        $stmt->bindParam(':cin', $cin);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        if ($result) {
            return $result;
        } else {
            return [];
        }
    }
    
}

    ?>
</body>
</html>