<?php


    if (!empty($_POST['date']) && !empty($_POST['heure']) && !empty($_POST['adversaire']) && !empty($_POST['lieu'])) {
        $id_rencontre = htmlentities($_POST['Id_rencontre']);
        $date = htmlentities($_POST['date']);
        $heure = htmlentities($_POST['heure']); 
        $adversaire = htmlentities($_POST['adversaire']);
        $lieu = htmlentities($_POST['lieu']);
        $points_equipe = htmlentities($_POST['points_equipe']);
        $points_adversaire = htmlentities($_POST['points_adversaire']);
        
        $db = 'football';
        $login = 'root';
        $mdp = '';
        try {
            $linkpdo = new PDO("mysql:host=localhost;dname=$db",$login,$mdp);
        }
        catch (Exeption $e) {
             die('Error :' . $e->getMessage());
        }

        $req = $linkpdo->prepare("UPDATE football.rencontre SET Date_rencontre = :date, Heure_rencontre = :heure, Nom_adversaire = :adversaire, Lieu_de_rencontre = :lieu, Points_equipe = :points_equipe, Points_adversaire = :points_adversaire WHERE Id_rencontre = :Id_rencontre");
        $req->execute(array('Id_rencontre' => $id_rencontre, 'date' => $date, 'heure' => $heure, 'adversaire' => $adversaire,  'lieu' => $lieu, 'points_equipe' => $points_equipe, 'points_adversaire' => $points_adversaire));
        
        if ($req != FALSE) {
            print("Modification effectué avec succés");
        } else {
            print("Erreur execute");
        }
        header("location:rencontre.php");
    } else {
        header("location:rencontre.php");
    }
    
?>