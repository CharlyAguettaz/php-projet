<?php
            if (!empty($_POST['date']) && !empty($_POST['heure']) && !empty($_POST['adversaire']) && !empty($_POST['lieu'])) {
                $date = htmlentities($_POST['date']);
                $heure = htmlentities($_POST['heure']); 
                $adversaire = htmlentities($_POST['adversaire']);
                $lieu = htmlentities($_POST['lieu']);
                $points_equipe = htmlentities($_POST['points_equipe']);
                $points_adversaire = htmlentities($_POST['points_adversaire']);
                
                $db = 'football';
                $login="root";
                $mdp="";
                try {
                    $linkpdo = new PDO("mysql:host=localhost;dname=$db",$login, $mdp);
                }
                catch (Exeption $e) {
                    die('Error :' . $e->getMessage());
                }
                $req2 = $linkpdo->prepare("SELECT * FROM football.rencontre WHERE Date_rencontre LIKE ?");
                $req2->execute(array($date));
                $res=$req2->fetch();
                if ($res == false) {
                    $req = $linkpdo->prepare("INSERT INTO football.rencontre(Date_rencontre, Heure_rencontre, Nom_adversaire, Lieu_de_rencontre, Points_equipe, Points_adversaire) VALUES(:date, :heure, :adversaire, :lieu, :points_equipe, :points_adversaire)");
                    $req->execute(array('date' => $date, 'heure' => $heure, 'adversaire' => $adversaire, 'lieu' => $lieu, 'points_equipe' => $points_equipe,  'points_adversaire' => $points_adversaire));
                    if ($req != FALSE) {
                        print("Ajout effectuer avec succés");
                    } else {
                        print("Erreur execute");
                    }
                } else {
                    echo "Ajout impossible, un autre match est déjà prévu a ce jour.";
                }
            }
        ?>

<html>
    <body>
        <p>
            <a href="http://localhost/php-projet/ajoutJoueur.php">Ajouter un joueur</a> /
            <a href="http://localhost/php-projet/recherche.php">Rechercher un joueur</a> /
            <a href="http://localhost/php-projet/ajoutRencontre.php">Ajouter une rencontre</a> /
            <a href="http://localhost/php-projet/rencontre.php">Rechercher une rencontre</a>
        </p>
        <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
            Date : <input type="date" name="date" required><br />
            Heure : <input type="time" name="heure" required><br />
            Adversaire : <input type="text" name="adversaire" required ><br />
            Lieu : <input type="text" name="lieu" required><br />
            But Pour : <input type="number" name="points_equipe" ><br />
            But Contre : <input type="number" name="points_adversaire" ><br />

            <input type='Submit' value='Valider'>
        </form>
        
    </body>
</html>