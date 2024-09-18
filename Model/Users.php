<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

class Users {
    private $data = array();

    function __construct($login, $password){
        $this->data['login'] = $login;
        $this->data['password'] = $password;
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

    public function connect(){
        include("Connexion.php");
        $sql=$bdd->query("select * from users where login='$this->login' and  password='$this->password'");
        $sql->setFetchMode(PDO::FETCH_OBJ);
        
        while ($utilisateur=$sql->fetch())
        {
            if('admin'==$this->login && 'admin'==$this->password)
            {
                header("location:../Vue/BienBib.php");
                return true;
            }
            else if($utilisateur->login==$this->login && $utilisateur->password==$this->password)
            {
                $login = $this->data['login'];
                setcookie("login", $login, time()+600, "/3_5_24final/Projet_Kawthar_Kabbout220408/Projet_Kawthar_Kabbout");
                header("location:../Vue/Bien.php");
                exit();
            }
            else {
                header("location:../Vue/AuthentificationKawthar.php");
                echo "Login et mot de passe incorrects";
                return false;
            }
        }
    }
}
?>
