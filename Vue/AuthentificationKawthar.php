<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
      rel="stylesheet"
      href="Authentification.css"
      media="screen"
      type="text/css"
    />
    <link rel="stylesheet" href="Consultation.css"  media="screen"
      type="text/css">
    <title>Document</title>
</head>
<body>

<?php
  if (session_status() == PHP_SESSION_NONE) {
    session_start();}
$mess=isset($_SESSION['mess']) ? $_SESSION['mess'] : "";

unset($_SESSION['mess']);
?>

<div id="container">
      <!-- zone de connexion -->
<form action="../Controleur/ControleurUtilisateur.php" method="POST">
        <h1>Connexion</h1>

        <label><b>Nom d'utilisateur</b></label><br>
        <input type="text" placeholder="Entrer le nom d'utilisateur" name="login" required
        /><br>

        <label><b>Mot de passe</b></label><br>
        <input type="text"placeholder="Entrer le mot de passe" name="password" required/><br>
        <input type="submit" name ="submit"   id="submit" value="submit" /><span style ='color:red '>
        <script>
    var message = "<?php echo $mess; ?>";
    if (message !== "") {
        alert(message);
    }
</script>
        </form>
</div>
<style>body{
    background:url("../Images/lib.jpg" );
    background-size: cover;
	background-repeat:no-repeat;

}

#container{
    width:400px;
    margin:0 auto;
    margin-top:10%;
    background: rgba(211,211,211,.3);
	
	display: flex;
	
}

form {
    width:100%;
    padding: 30px;
    border: 1px solid #f1f1f1;
   
    background: rgba(43, 42, 42, 0.066);
	box-shadow: 0 15px 20px rgba(0,0,0.1);
    /*box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);*/
}
#container h1{
    width: 38%;
    margin: 0 auto;
    padding-bottom: 10px;
}
/*jute pour les zone de saisie*/
input[type=text], input[type=password] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

input[type=submit] {
    background-color: rgb(221, 118, 78);
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}
input[type=submit]:hover {
    background-color: white;
    color: rgba( 71, 147, 227, 1);
    border: 1px solid whitesmoke;
}</style>
</body>
</html>