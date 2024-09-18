<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();}
include("Connexion.php");
$messagenon="";
    
class Adherent{


    
    private $data = array();

    function __construct($cin,$nom, $prenom,$tel,$filiere,$niveau_etudes,$email,$password, $abonne){
        $this->data['cin'] = $cin;
        $this->data['nom'] = $nom;
        $this->data['prenom'] = $prenom;
        $this->data['tel']=$tel;
        $this->data['filiere']=$filiere;
        $this->data['niveau_etudes']=$niveau_etudes;
        $this->data['email']=$email;
        $this->data['password']=$password;
        $this->data['abonne']=$abonne;

        
    }

    public function __get($attr) {
        if (!isset($this->data[$attr])) return "erreur";
        else return ($this->data[$attr]);
    }

    public function __set($attr,$value) {
        $this->data[$attr] = $value;
    }

       

    
    public function Ajouter() {
        global $bdd;
    
        try {
            $stmt = $bdd->prepare("INSERT INTO adherent(cin, nom, prenom, Telephone, filiere, niveau_etudes, email, password, abonne) VALUES(:cin, :nom, :prenom, :tel, :filiere, :niveau_etudes, :email, :password, :abonne)");
            $stmt->bindParam(':cin', $this->data['cin']);
            $stmt->bindParam(':nom', $this->data['nom']);
            $stmt->bindParam(':prenom', $this->data['prenom']);
            $stmt->bindParam(':tel', $this->data['tel']);
            $stmt->bindParam(':filiere', $this->data['filiere']);
            $stmt->bindParam(':niveau_etudes', $this->data['niveau_etudes']);
            $stmt->bindParam(':email', $this->data['email']);
            $stmt->bindParam(':password', $this->data['password']);
            $stmt->bindParam(':abonne', $this->data['abonne']);
    
            $resultat = $stmt->execute();
            $stmt->closeCursor();
    
            if ($resultat) {
                $stmt1 = $bdd->prepare("INSERT INTO users(login, password) VALUES (:login, :password)");
                $stmt1->bindParam(':login', $this->data['cin']);
                $stmt1->bindParam(':password', $this->data['password']);
    
                $stmt1->execute();
                $stmt1->closeCursor();
    
                if ($stmt1->rowCount() > 0) {
                    return true;
                } else {
                    return false;
                }
            } else {
                $errorInfo = $stmt->errorInfo();
                $messagenon = "Une erreur s'est produite lors de l'ajout de l'adhérent ou il existe déjà: " . $errorInfo[2];
                $_SESSION['messagenon'] = $messagenon;
                header("location:../Vue/GererAdhBib.php");
                exit();
            }
        } catch (PDOException $e) {
            $messagenon = "Une erreur s'est produite lors de l'ajout de l'adhérent : " . $e->getMessage();
            $_SESSION['message'] = $messagenon;
            header("location:../Vue/GererAdhBib.php");
            exit();
        }
    }

    static function Supprimer($cin){
        global $bdd;
    
       
        $sql = $bdd->prepare("UPDATE adherent SET abonne = 'non ' WHERE cin = :cin ");
        $sql->bindParam(':cin', $cin); 
    
        
        $sql->execute();
    
       
        $nombreEnregistrements = $sql->rowCount();
        if($nombreEnregistrements > 0) {
            /*
            $stmt1 = $bdd->prepare("DELETE FROM users WHERE login = :login ");
            $stmt1->bindParam(':login', $cin); 
    

            $stmt1->execute();
    
            
            $nombreEnregistrementsUser = $stmt1->rowCount();
            if($nombreEnregistrementsUser > 0) {*/
                return true; 
          
        } else {
            return false; 
        }
    }

        /*
    $stmt=$bdd->prepare("DELETE FROM article WHERE ref = :ref") ;
            $stmt->bindParam(':ref',$this->référence);
            $stmt->execute();
            $stmt->closeCursor();

            if($stmt->rowCount()>0)
            return true;
            else return false;
   */
  public function Modifier() {
    global $bdd;
    $modif = false;

    try {
        $stmt = $bdd->prepare("SELECT * FROM adherent WHERE cin = :cin");
        $stmt->bindParam(':cin', $this->data['cin']);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $updateQuery = "UPDATE adherent SET ";
            $updateData = array();

            if (!empty($this->data['nom'])) {
                $updateQuery .= "nom = :nom, ";
                $updateData[':nom'] = $this->data['nom'];
            }

            if (!empty($this->data['prenom'])) {
                $updateQuery .= "prenom = :prenom, ";
                $updateData[':prenom'] = $this->data['prenom'];
            }

            if (!empty($this->data['tel'])) {
                $updateQuery .= "Telephone = :tel, ";
                $updateData[':tel'] = $this->data['tel'];
            }

            if (!empty($this->data['filiere'])) {
                $updateQuery .= "filiere = :filiere, ";
                $updateData[':filiere'] = $this->data['filiere'];
            }

            if (!empty($this->data['niveau_etudes'])) {
                $updateQuery .= "niveau_etudes = :niveau_etudes, ";
                $updateData[':niveau_etudes'] = $this->data['niveau_etudes'];
            }

            if (!empty($this->data['email'])) {
                $updateQuery .= "email = :email, ";
                $updateData[':email'] = $this->data['email'];
            }

           
            $passwordUpdated = false;
            if (!empty($this->data['password'])) {
                $updateQuery .= "password = :password, ";
                $updateData[':password'] = $this->data['password'];
                $passwordUpdated = true;
            }

            if (!empty($this->data['abonne'])) {
                $updateQuery .= "abonne = :abonne, ";
                $updateData[':abonne'] = $this->data['abonne'];
            }

            
            $updateQuery = rtrim($updateQuery, ', ');

            $updateQuery .= " WHERE cin = :cin";
            $updateData[':cin'] = $this->data['cin'];

            $stmt = $bdd->prepare($updateQuery);
            $stmt->execute($updateData);

            
            if ($passwordUpdated) {
                $sql = $bdd->prepare("UPDATE users SET password = :password WHERE login = :cin");
                $sql->bindParam(':cin', $this->data['cin']);
                $sql->bindParam(':password', $this->data['password']);
                $sql->execute();
            }

            $modif = true;
        }

        return $modif;
    } catch (PDOException $e) {
        $messagenon = "Une erreur s'est produite lors de la modification de l'adhérent : " . $e->getMessage();
        $_SESSION['message'] = $messagenon;
        header("location:../Vue/GererAdhBib.php");
        exit();
    }
}




    
static function ListeFiliere($filiere){
    global $bdd;
$sql = $bdd->prepare("SELECT * FROM adherent WHERE filiere = :filiere");


$sql->bindParam(':filiere', $filiere);


$sql->execute();
if($sql->rowCount()>0)
{if($sql->rowCount() > 0) {
    
    $adherents = $sql->fetchAll(PDO::FETCH_ASSOC);
    return $adherents; // Retourne le tableau des adhérents
} else {
    return []; // Retourne un tableau vide si aucun adhérent n'est trouvé
}
}
}

static function getAdherent($cin){
    global $bdd;
    $sql = $bdd->prepare("SELECT * FROM adherent WHERE cin = :cin and abonne = 'oui'");
    $sql->bindParam(':cin', $cin);
    $sql->execute();
    if ($sql->rowCount() > 0) 
    {$adh = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $adh; // Retourne le tableau des adhérents
    } else {
        return [];}
}
static function getAdherentNOM($nom){
    global $bdd;
    $sql = $bdd->prepare("SELECT * FROM adherent WHERE nom = :nom");
    $sql->bindParam(':nom', $nom);
    $sql->execute();
    if ($sql->rowCount() > 0) 
    {$adh = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $adh; // Retourne le tableau des adhérents
    } else {
        return [];}
}
static function getAdherentPrenom($prenom){
    global $bdd;
    $sql = $bdd->prepare("SELECT * FROM adherent WHERE prenom = :prenom");
    $sql->bindParam(':prenom', $prenom);
    $sql->execute();
    if ($sql->rowCount() > 0) 
    {$adh = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $adh; // Retourne le tableau des adhérents
    } else {
        return [];}
}


static function afficheAdh(){
    global $bdd;
    $sql = $bdd->prepare("SELECT * FROM adherent");
   
    $sql->execute();
    if ($sql->rowCount() > 0) 
    {$adh = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $adh; // Retourne le tableau des adhérents
    } else {
        return [];}
    
}




static function rechercherADH($cin, $nom, $prenom, $tel, $filiere, $niveau_etudes, $email, $password, $abonne) {
    global $bdd;
    $sql = "SELECT * FROM adherent 
    WHERE (:cin = '' OR cin LIKE :cin) 
    AND (:nom = '' OR nom LIKE :nom) 
    AND (:prenom = '' OR prenom LIKE :prenom) 
    AND (:tel = '' OR Telephone LIKE :tel) 
    AND (:filiere = '' OR filiere = :filiere) 
    AND (:niveau_etudes = '' OR niveau_etudes = :niveau_etudes) 
    AND (:email = '' OR email LIKE :email) 
    AND (:password = '' OR password = :password) 
    AND (:abonne = '' OR abonne = :abonne)";
    $stmt = $bdd->prepare($sql);
    $stmt->bindParam(':cin', $cin);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':tel', $tel);
    $stmt->bindParam(':filiere', $filiere);
    $stmt->bindParam(':niveau_etudes', $niveau_etudes);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':abonne', $abonne);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($result) {
        return $result;
    } else {
        return [];
    }
}



}
 /*   
    $u=new Adherent("dali","kabbout",23416137,3,"LG","",);
    echo $u;
       
      if($u->Supprimer()) {
            $message=  "Suppression réussie.";
        } else {
            $message ="Échec de la suppression.";
        }
*/


?>