<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=*, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();}
$messagenon="";

include("../Model/Connexion.php");
class Livre {
    private $data = array();

    function __construct($ref, $nomauteur, $categorie, $nom, $img,$disponible){
        $this->data['ref'] = $ref;
        $this->data['nomauteur'] = $nomauteur;
        $this->data['categorie'] = $categorie;
        $this->data['nom'] = $nom;
        $this->data['img'] = $img;
        $this->data['disponible'] = $disponible;
    }

    public function __get($attr) {
        if (!isset($this->data[$attr])) return "erreur";
        else return ($this->data[$attr]);
    }

    public function __set($attr,$value) {
        $this->data[$attr] = $value;
    }

        public function __toString() {
            $s="";
            return $s;

    }
   

   static function getListeLivres(){
        
    global $bdd;
    
        $sql=$bdd->query("select * from livre ");
        // Récupérer les résultats de la requête sous forme de tableau associatif
       
$sql->execute();

if($sql->rowCount() > 0) {
    
    $livres = $sql->fetchAll(PDO::FETCH_ASSOC);
    return $livres; // Retourne le tableau des adhérents
} else {
    return []; // Retourne un tableau vide si aucun adhérent n'est trouvé
}



}
static function getListeLivresDisponible(){
    global $bdd;
    $sql=$bdd->query("SELECT * FROM livre WHERE disponible ='oui'");
       
$sql->execute();

if($sql->rowCount() > 0) {
    
    $livres = $sql->fetchAll(PDO::FETCH_ASSOC);
    return $livres; // Retourne le tableau des adhérents
} else {
    return []; // Retourne un tableau vide si aucun adhérent n'est trouvé
}
}

static function getListeLivrescategorie($categorie){
    global $bdd;
    $sql=$bdd->prepare("SELECT * FROM livre WHERE categorie = :categorie and disponible ='oui'");
    $sql->bindParam(':categorie', $categorie);
    $sql->execute();

if($sql->rowCount() > 0) {
    
    $livres = $sql->fetchAll(PDO::FETCH_ASSOC);
    return $livres; // Retourne le tableau des adhérents
} else {
    return [];

}}

static function getListeLivresNom($nom){
    $nom2="";
    global $bdd;
   $nom2="%$nom%";
    $sql=$bdd->prepare("SELECT * FROM livre WHERE nom LIKE :nom AND disponible = 'oui'");
    $sql->bindParam(':nom', $nom2);
     $sql->execute();

if($sql->rowCount() > 0) {
    
    $livres = $sql->fetchAll(PDO::FETCH_ASSOC);
    return $livres; // Retourne le tableau des adhérents
} else {
    return [];

}}

static function getListeLivresnomnomAuteur($nomAuteur) {
    global $bdd;
    $nom2 = "%$nomAuteur%";
    $sql = $bdd->prepare("SELECT * FROM livre WHERE nomauteur LIKE :nomauteur AND disponible = 'oui'");
    $sql->bindParam(':nomauteur', $nom2, PDO::PARAM_STR);
    $sql->execute();

    if ($sql->rowCount() > 0) {
        $livres = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $livres;
    } else {
        return [];
    }
}

static function getListeLivresRefDis($ref)
{

    global $bdd;
    $sql = $bdd->prepare("SELECT * FROM livre WHERE ref = :ref AND disponible = 'oui'");
    $sql->bindParam(':ref', $ref);
    $sql->execute();
    
    if ($sql->rowCount() > 0) {
        $livres = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $livres; // Retourne le tableau des livres
    } else {
        return [];
    }
}

static function getListeLivresRef($ref)
{

    global $bdd;
    $sql = $bdd->prepare("SELECT * FROM livre WHERE ref = :ref ");
    $sql->bindParam(':ref', $ref);
    $sql->execute();
    
    if ($sql->rowCount() > 0) {
        $livres = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $livres; // Retourne le tableau des livres
    } else {
        return [];
    }
}






static function getListeLivresRefIndis($ref)
{

    global $bdd;
    $sql = $bdd->prepare("SELECT * FROM livre WHERE ref = :ref AND disponible = 'non'");
    $sql->bindParam(':ref', $ref);
    $sql->execute();
    
    if ($sql->rowCount() > 0) {
        $livres = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $livres; // Retourne le tableau des livres
    } else {
        return [];
    }
}



function ajouterLivre($ref, $nom, $nomAuteur, $categorie, $img, $disponible) {
    global $bdd;

    try {
        $sql = $bdd->prepare("INSERT INTO livre (ref, nom, nomauteur, categorie, img, disponible) VALUES (:ref, :nom, :nomauteur, :categorie, :img, :disponible)");

        $sql->bindParam(':ref', $ref);
        $sql->bindParam(':nom', $nom);
        $sql->bindParam(':nomauteur', $nomAuteur);
        $sql->bindParam(':categorie', $categorie);
        $sql->bindParam(':img', $img);
        $sql->bindParam(':disponible', $disponible);

        if ($sql->execute()) {
            return true; 
        } else {
            return false; 
        }
    } catch (PDOException $e) {
        $messagenon = "Une erreur s'est produite lors de l'ajout de l'adhérent : " . $e->getMessage();
        $_SESSION['message'] = $messagenon;
        header("location:../Vue/GererLivre.php");
        exit();
    }
}
 static function summpimer($ref){

    global $bdd;

    try {
        // Vérifier d'abord si le livre existe
        $sql_check = $bdd->prepare("SELECT * FROM livre WHERE ref = :ref");
        $sql_check->bindParam(':ref', $ref);
        $sql_check->execute();

        if ($sql_check->rowCount() > 0) {
            // Si le livre existe, inverser sa disponibilité
            $sql = $bdd->prepare("UPDATE livre SET disponible = 'non' WHERE ref = :ref");
            $sql->bindParam(':ref', $ref);

            if ($sql->execute()) {
                return true; // Modification réussie
            } else {
                return false; // Erreur lors de la modification
            }
        } else {
            return false; // Le livre n'existe pas
        }
    } catch (PDOException $e) {
        $messagenon = "Une erreur s'est produite lors de la modification de la disponibilité du livre : " . $e->getMessage();
        $_SESSION['message'] = $messagenon;
        header("location:../Vue/GererLivre.php");
        exit();
    }

 }

 public function modifierLivre($ref, $nom, $nomAuteur, $categorie, $img, $disponible) {
    global $bdd;
    $modif = false;

    try {
        $stmt = $bdd->prepare("SELECT * FROM livre WHERE ref = :ref");
        $stmt->bindParam(':ref', $ref);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $updateQuery = "UPDATE livre SET ";
            $updateData = array();

            if (!empty($nomAuteur)) {
                $updateQuery .= "nomauteur = :nomauteur, ";
                $updateData[':nomauteur'] = $nomAuteur;
            }

            if (!empty($categorie)) {
                $updateQuery .= "categorie = :categorie, ";
                $updateData[':categorie'] = $categorie;
            }

            if (!empty($nom)) {
                $updateQuery .= "nom = :nom, ";
                $updateData[':nom'] = $nom;
            }

            if (!empty($img)) {
                $updateQuery .= "img = :img, ";
                $updateData[':img'] = $img;
            }

            if (!empty($disponible)) {
                $updateQuery .= "disponible = :disponible, ";
                $updateData[':disponible'] = $disponible;
            }

            // Supprimer la virgule en trop à la fin de la requête UPDATE
            $updateQuery = rtrim($updateQuery, ', ');

            $updateQuery .= " WHERE ref = :ref";
            $updateData[':ref'] = $ref;

            $stmt = $bdd->prepare($updateQuery);
            $stmt->execute($updateData);

            $modif = true;
        }

        return $modif;
    } catch (PDOException $e) {
        $messagenon = "Une erreur s'est produite lors de la modification du livre : " . $e->getMessage();
        $_SESSION['message'] = $messagenon;
        header("location:../Vue/GererLivre.php");
        exit();
    }
}

static function rechercherLivres($categorie, $nom, $nomAuteur, $ref) {
    global $bdd;
    $sql = "SELECT * FROM livre 
    WHERE (:categorie = '' OR categorie = :categorie) 
    AND (:nom = '' OR nom LIKE :nom) 
    AND (:nomAuteur = '' OR nomAuteur LIKE :nomAuteur) 
    AND (:ref = '' OR ref = :ref)
    AND disponible = 'oui'";
    $stmt = $bdd->prepare($sql);
    $stmt->bindParam(':categorie', $categorie);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':nomAuteur', $nomAuteur);
    $stmt->bindParam(':ref', $ref);
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




}






?>
</body>
</html>