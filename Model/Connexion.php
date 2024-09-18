<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    try
    {
        $bdd = new PDO('mysql:host=localhost;dbname=bibliotheque', 'root', '');
       
    }
    
    catch (PDOException $e)
{
die('Erreur : ' . $e->getMessage());
}
    ?>
</body>
</html>