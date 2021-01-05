<?php


    if (!empty($_POST['date']) && !empty($_POST['heure']) && !empty($_POST['adversaire']) && !empty($_POST['lieu'])) {
        $id_rencontre = htmlentities($_POST['Id_rencontre']);
        $date = htmlentities($_POST['date']);
        $heure = htmlentities($_POST['heure']); 
        $adversaire = htmlentities($_POST['adversaire']);
        $lieu = htmlentities($_POST['lieu']);
        
        $db = 'football';
        $login = 'root';
        $mdp = '';
        try {
            $linkpdo = new PDO("mysql:host=localhost;dname=$db",$login,$mdp);
        }
        catch (Exeption $e) {
             die('Error :' . $e->getMessage());
        }

        $req = $linkpdo->prepare("UPDATE football.rencontre SET Date_rencontre = :date, Heure_rencontre = :heure, Nom_adversaire = :adversaire, Lieu_de_rencontre = :lieu WHERE Id_rencontre = :Id_rencontre");
        $req->execute(array('Id_rencontre' => $id_rencontre, 'date' => $date, 'heure' => $heure, 'adversaire' => $adversaire,  'lieu' => $lieu));
        
        if ($req != FALSE) {
            print("Modification effectué avec succés");
        } else {
            print("Erreur execute");
        }
    } else {
        echo "Erreur de modification : Erreur sur la séléction des informations par l'utilisateur";
    }
    
?>

<html>
<head>
  
</head>
<link rel="stylesheet" href="style.css" />
    <body>
    <header>
    <nav class="menu">
               <a href="http://localhost/php-projet/ajoutJoueur.php">Ajouter un joueur</a> /
               <a href="http://localhost/php-projet/recherche.php">Rechercher un joueur</a> /
               <a href="http://localhost/php-projet/ajoutRencontre.php">Ajouter une rencontre</a> /
               <a href="http://localhost/php-projet/rencontre.php">Rechercher une rencontre</a>
         </nav>  
    <h1> Modification de rencontre </h1>
          </header>
        <p>
            <a href="recherche.php">Revenir sur la page de recherche<a>
        <p>
    </body>
</html>