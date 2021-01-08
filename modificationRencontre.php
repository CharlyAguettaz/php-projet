<?php
    session_start();
    if ($_SESSION['user'] != 'root') {
        header("location:index.php");
    }

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
        catch (Exception $e) {
             die('Error :' . $e->getMessage());
        }

        $req = $linkpdo->prepare("UPDATE football.rencontre SET Date_rencontre = :date, Heure_rencontre = :heure, Nom_adversaire = :adversaire, Lieu_de_rencontre = :lieu WHERE Id_rencontre = :Id_rencontre");
        $req->execute(array('Id_rencontre' => $id_rencontre, 'date' => $date, 'heure' => $heure, 'adversaire' => $adversaire,  'lieu' => $lieu));
        
        header("location:rencontre.php");
    } 
    
?>