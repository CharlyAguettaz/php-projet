<?php
    if (!empty($_POST['id']) && isset($_POST['id'])) {
        $db = 'football';
        $login = 'root';
        $mdp = '';
        try {
            $linkpdo = new PDO("mysql:host=localhost;dname=$db",$login,$mdp);
        }
        catch (Exeption $e) {
             die('Error :' . $e->getMessage());
        }
        $req = $linkpdo->prepare("SELECT * FROM football.players WHERE numLicence LIKE ?");
        $req->execute(array(htmlentities($_POST['id'])));
        $res=$req->fetch();
    }
    if (!empty($_POST['date']) && !empty($_POST['heure']) && !empty($_POST['adversaire']) && !empty($_POST['lieu'])) {
        $date = htmlentities($_POST['date']);
        $heure = htmlentities($_POST['heure']); 
        $adversaire = htmlentities($_POST['adversaire']);
        $lieu = htmlentities($_POST['lieu']);
        $points_equipe = htmlentities($_POST['points_equipe']);
        $points_adversaire = htmlentities($_POST['points_adversaire']);
        

        $req2 = $linkpdo->prepare("UPDATE football.rencontre SET nom = :nom, prenom = :prenom, photo = :photo, dateDeNaissance = :dateDeNaissance, taille = :taille, poids = :poids, postePrefere = :postePrefere WHERE numLicence = :numLicence");
        $req2->execute(array('nom' => $nom, 'prenom' => $prenom, 'photo' => $photo, 'dateDeNaissance' => $dateDeNaissance,  'taille' => $taille, 'poids' => $poids, 'postePrefere' => $postePrefere, 'statut' => $statut, 'numLicence' => $numLicence));
        $res=$req2->fetch();
        if ($req2 != FALSE) {
            print("Modification effectué avec succés");
        } else {
            print("Erreur execute");
        }
    }
?>

<html>
    <body>  
        <p>
            <a href="http://localhost/php-projet/ajoutJoueur.php">Ajouter un joueur</a> /
            <a href="http://localhost/php-projet/recherche.php">Rechercher un joueur</a>
        </p>            
        <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
            Date : <input type="date" name="date"><br />
            Heure : <input type="text" name="heure"><br />
            Adversaire : <input type="text" name="adversaire" ><br />
            Lieu : <input type="text" name="lieu"><br />
            But Pour : <input type="number" name="points_equipe" ><br />
            But Contre : <input type="number" name="points_adversaire" ><br />

            <input type='Submit' value='Valider'>
        </form>
        
    </body>
</html>